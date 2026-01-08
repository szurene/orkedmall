<?php
session_start();
include 'db.php';

if (!isset($_SESSION['membershipID']) || !isset($_SESSION['amount'])) {
    die("Invalid payment request");
}

$membershipID = $_SESSION['membershipID'];
$amount       = $_SESSION['amount'];
$paymentDate  = date("d M Y");

/* GET MEMBERSHIP NAME */
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

$data = $result->fetch_assoc();
$membershipName = $data['mTypeName'];
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Payment - Orked Mall</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/payment.css">
</head>
<body>

<header class="topbar">
    <div class="logo">
        <a href="index.php">
            <img src="images/orked.png" class="logo-img">
        </a>
    </div>
</header>

<div class="payment-wrapper">

    <!-- LEFT SUMMARY -->
    <div class="payment-summary">
        <h2>Membership Payment</h2>

        <div class="summary-box">
            <p><strong>Membership:</strong> <?= htmlspecialchars($membershipName) ?></p>
            <p><strong>Date:</strong> <?= $paymentDate ?></p>
            <p><strong>Price:</strong> RM<?= number_format($amount,2) ?></p>
        </div>

        <div class="total">
            Total: <span>RM<?= number_format($amount,2) ?></span>
        </div>
    </div>

    <!-- RIGHT PAYMENT METHOD -->
    <div class="payment-method">
        <h2>Choose Payment Method</h2>

        <form action="payment_confirmation.php" method="POST">
            <input type="hidden" name="membershipID" value="<?= $membershipID ?>">
            <input type="hidden" name="amount" value="<?= $amount ?>">

            <label class="method-card">
                <input type="radio" name="paymentMethod" value="Card" required>
                💳 Credit / Debit Card
            </label>

            <label class="method-card">
                <input type="radio" name="paymentMethod" value="FPX">
                🏦 FPX Online Banking
            </label>

            <label class="method-card">
                <input type="radio" name="paymentMethod" value="Touch n Go">
                📱 Touch ’n Go eWallet
            </label>

            <label class="method-card">
                <input type="radio" name="paymentMethod" value="GrabPay">
                🛵 GrabPay
            </label>

            <label class="method-card">
                <input type="radio" name="paymentMethod" value="ShopeePay">
                🛒 ShopeePay
            </label>

            <label class="method-card">
                <input type="radio" name="paymentMethod" value="Boost">
                ⚡ Boost
            </label>

            <button class="pay-btn">
                Continue
            </button>
        </form>
    </div>

</div>

</body>
</html>
