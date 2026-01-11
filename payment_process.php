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

$paymentDate   = date("Y-m-d");
$paymentStatus = "Paid";

/* =========================
   PREVENT DUPLICATE PAYMENT
========================= */
$checkSql = "SELECT paymentID FROM payment WHERE membershipID = ?";
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
   INSERT PAYMENT
========================= */
$sql = "INSERT INTO payment (paymentDate, paymentStatus, amount, paymentMethod, membershipID) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssdsi", $paymentDate, $paymentStatus, $amount, $paymentMethod, $membershipID);

if (!$stmt->execute()) {
    die("Payment processing failed: " . $stmt->error);
}

/* =========================
   SEND CONFIRMATION EMAIL 
========================= */
require_once 'mailer/config.php';

// 1. Fetch the member details and membership dates needed for the email
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
    $memberID       = $_SESSION['memberID']; // Still in session from register process

    // 2. Trigger the email
    if (sendRegistrationEmail($email, $fullName, $memberID, $startDate, $endDate, $durationMonths)) {
        $_SESSION['email_sent'] = true;
    } else {
        $_SESSION['email_sent'] = false;
        error_log("Failed to send registration email to: $email");
    }
}

/* =========================
   CLEAR PAYMENT SESSION
========================= */
// Note: Keeping memberID in session might be useful for the dashboard login
unset($_SESSION['membershipID'], $_SESSION['amount']); 

/* =========================
   SUCCESS ALERT + REDIRECT
========================= */
echo "<script>
    alert(
        'Payment Successful!\\n' +
        'Membership: $membershipName\\n' +
        'Payment Method: $paymentMethod\\n' +
        'Amount: RM" . number_format($amount,2) . "'
    );
    window.location.href='memberDashboard.php';
</script>";
exit();
