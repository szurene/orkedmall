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
$sql = "
INSERT INTO payment
(paymentDate, paymentStatus, amount, paymentMethod, membershipID)
VALUES (?, ?, ?, ?, ?)
";

$stmt = $conn->prepare($sql);
$stmt->bind_param(
    "ssdsi",
    $paymentDate,
    $paymentStatus,
    $amount,
    $paymentMethod,
    $membershipID
);

if (!$stmt->execute()) {
    die("Payment processing failed: " . $stmt->error);
}

/* =========================
   CLEAR PAYMENT SESSION
========================= */
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
