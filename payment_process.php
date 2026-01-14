<?php
session_start();
include 'db.php';

/* =========================
   SECURITY VALIDATION
========================= */
if (
    !isset($_SESSION['membershipID']) ||
    !isset($_SESSION['amount']) ||
    !isset($_POST['paymentMethod'])
) {
    die("Invalid payment request");
}

$membershipID  = $_SESSION['membershipID'];
$amount        = $_SESSION['amount'];
$paymentMethod = $_POST['paymentMethod'];
$paymentDate   = date("Y-m-d"); // correct format for MySQL DATE

/* =========================
   PREVENT DUPLICATE PAYMENT
========================= */
$checkSql = "
    SELECT paymentID 
    FROM membership 
    WHERE membershipID = ? AND paymentID IS NOT NULL
";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("i", $membershipID);
$checkStmt->execute();
$checkStmt->store_result();

if ($checkStmt->num_rows > 0) {
    echo "<script>
        alert('Payment already completed.');
        window.location.href='memberDashboard.php';
    </script>";
    exit();
}

/* =========================
   GET MEMBERSHIP NAME
========================= */
$sqlType = "
    SELECT mt.mTypeName
    FROM membership ms
    JOIN membership_type mt ON ms.mTypeID = mt.mTypeID
    WHERE ms.membershipID = ?
";
$stmtType = $conn->prepare($sqlType);
$stmtType->bind_param("i", $membershipID);
$stmtType->execute();
$typeResult = $stmtType->get_result();
$typeRow = $typeResult->fetch_assoc();
$membershipName = $typeRow['mTypeName'];

/* =========================
   INSERT PAYMENT (Pending first)
========================= */
$paymentStatus = "Pending"; // default pending
$sql = "INSERT INTO payment (paymentDate, paymentStatus, amount, paymentMethod) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssds", $paymentDate, $paymentStatus, $amount, $paymentMethod);

if (!$stmt->execute()) {
    die("Payment insert error: " . $stmt->error);
}

// Get the new paymentID
$paymentID = $stmt->insert_id;

/* =========================
   LINK PAYMENT TO MEMBERSHIP
========================= */
$updateSql = "UPDATE membership SET paymentID = ? WHERE membershipID = ?";
$updateStmt = $conn->prepare($updateSql);
$updateStmt->bind_param("ii", $paymentID, $membershipID);
$updateStmt->execute();

/* =========================
   SIMULATE PAYMENT RESULT
   (replace with real gateway integration)
========================= */
$success = true; // change to false to simulate failed payment

if ($success) {
    $finalStatus = "Completed";
} else {
    $finalStatus = "Failed";
}

// Update payment status
$updateStatusSql = "UPDATE payment SET paymentStatus = ? WHERE paymentID = ?";
$updateStatusStmt = $conn->prepare($updateStatusSql);
$updateStatusStmt->bind_param("si", $finalStatus, $paymentID);
$updateStatusStmt->execute();

/* =========================
   SEND CONFIRMATION EMAIL IF COMPLETED
========================= */
if ($finalStatus === "Completed") {
    require_once 'mailer/config.php';

    $sqlDetails = "
        SELECT m.email, m.fullName, ms.startDate, ms.endDate, mt.duration
        FROM membership ms
        JOIN member m ON ms.memberID = m.memberID
        JOIN membership_type mt ON ms.mTypeID = mt.mTypeID
        WHERE ms.membershipID = ?
    ";
    $stmtDetails = $conn->prepare($sqlDetails);
    $stmtDetails->bind_param("i", $membershipID);
    $stmtDetails->execute();
    $detailsResult = $stmtDetails->get_result();
    $details = $detailsResult->fetch_assoc();

    if ($details) {
        $email          = $details['email'];
        $fullName       = $details['fullName'];
        $startDate      = $details['startDate'];
        $endDate        = $details['endDate'];
        $durationMonths = $details['duration'];
        $memberID       = $_SESSION['memberID']; 

        if (sendRegistrationEmail(
                $email, 
                $fullName, 
                $memberID, 
                $startDate, 
                $endDate, 
                $durationMonths, 
                $amount, 
                $paymentMethod
            )) {
            $_SESSION['email_sent'] = true;
        } else {
            $_SESSION['email_sent'] = false;
            error_log("Failed to send registration email to: $email");
        }
    }
}

/* =========================
   CLEAR PAYMENT SESSION
========================= */
unset($_SESSION['membershipID'], $_SESSION['amount']); 

/* =========================
   SHOW ALERT BASED ON STATUS
========================= */
$message = "Membership: $membershipName\nPayment Method: $paymentMethod\nAmount: RM" . number_format($amount, 2);

if ($finalStatus === "Completed") {
    echo "<script>
        alert('Payment Successful!\\n$message');
        window.location.href='memberDashboard.php';
    </script>";
} else if ($finalStatus === "Pending") {
    echo "<script>
        alert('Payment is pending. Please complete it.\\n$message');
        window.location.href='memberDashboard.php';
    </script>";
} else {
    echo "<script>
        alert('Payment Failed. Please try again.\\n$message');
        window.location.href='payment.php';
    </script>";
}

exit();
?>
