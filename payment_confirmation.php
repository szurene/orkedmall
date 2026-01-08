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
    die("Invalid payment confirmation request");
}

$membershipID  = $_SESSION['membershipID'];
$amount        = $_SESSION['amount'];
$paymentMethod = $_POST['paymentMethod'];
$paymentDate   = date("d M Y");

/* =========================
   GET MEMBERSHIP NAME
========================= */
$sql = "
SELECT mt.mTypeName
FROM membership ms
JOIN membership_type mt ON ms.mTypeID = mt.mTypeID
WHERE ms.membershipID = ?
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $membershipID);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Membership not found");
}

$row = $result->fetch_assoc();
$membershipName = $row['mTypeName'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Payment - Orked Mall</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/payment.css">
</head>
<body>

<!-- HEADER -->
<header class="topbar">
    <div class="logo">
        <a href="index.php">
            <img src="images/orked.png" class="logo-img">
        </a>
    </div>
</header>

<div class="payment-wrapper">

    <!-- PAYMENT SUMMARY -->
    <div class="payment-summary">
        <h2>Confirm Payment</h2>

        <div class="summary-box">
            <p><strong>Membership:</strong> <?= htmlspecialchars($membershipName) ?></p>
            <p><strong>Payment Method:</strong> <?= htmlspecialchars($paymentMethod) ?></p>
            <p><strong>Payment Date:</strong> <?= $paymentDate ?></p>
            <p><strong>Amount:</strong> RM<?= number_format($amount, 2) ?></p>
        </div>

        <div class="total">
            Total: <span>RM<?= number_format($amount, 2) ?></span>
        </div>
    </div>

    <!-- CONFIRM ACTION -->
    <div class="payment-method">
        <h2>Confirmation</h2>

        <form action="payment_process.php" method="POST">
            <!-- ONLY paymentMethod is posted, membership & amount from session -->
            <input type="hidden" name="paymentMethod" value="<?= htmlspecialchars($paymentMethod) ?>">

            <button type="submit" class="pay-btn">
                Confirm Payment
            </button>
        </form>

        <a href="payment.php" class="cancel-link">
            Cancel & Go Back
        </a>
    </div>

</div>

</body>
</html>
