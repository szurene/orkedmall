<?php
session_start();
include 'db.php';

if (!isset($_SESSION['memberID'])) {
    header("Location: index.php");
    exit();
}

$memberID = $_SESSION['memberID'];

/* GET LATEST MEMBERSHIP TYPE */
$sql = "
SELECT mt.mTypeName
FROM membership ms
JOIN membership_type mt ON ms.mTypeID = mt.mTypeID
WHERE ms.memberID = ?
ORDER BY ms.membershipID DESC
LIMIT 1
";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $memberID);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

$membershipType = $row['mTypeName']; // Gold / Platinum
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Member Dashboard - Orked Mall</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

<style>
body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    background: #f6f6f6;
}

/* HEADER */
.topbar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 15px 50px;
    background: #e5dcd6;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.logo img { height: 45px; }

.header-actions {
    display: flex;
    align-items: center;
    gap: 15px;
}

.header-actions strong {
    font-size: 14px;
}

.header-actions a {
    text-decoration: none;
    padding: 8px 18px;
    border-radius: 25px;
    font-size: 13px;
    color: #fff;
    background: #333;
    transition: 0.3s;
}

.header-actions a:hover { background: #e19bb1; }

/* CATEGORY BAR */
.category-nav {
    display: flex;
    gap: 15px;
    padding: 20px 40px;
    overflow-x: auto;
    background: #fff;
    border-bottom: 1px solid #ddd;
}

.category-nav button {
    border: none;
    background: #eee;
    padding: 10px 22px;
    border-radius: 25px;
    cursor: pointer;
    font-size: 13px;
    transition: 0.3s;
}

.category-nav button.active,
.category-nav button:hover {
    background: #333;
    color: #fff;
}

/* VOUCHER AREA */
.voucher-section {
    padding: 40px;
    min-height: 70vh;
}

.voucher-row {
    display: flex;
    gap: 25px;
    flex-wrap: wrap;
}

.voucher-card {
    width: 260px;
    background: #fff;
    border-radius: 18px;
    padding: 25px;
    box-shadow: 0 10px 25px rgba(0,0,0,0.08);
    transition: 0.3s;
}

.voucher-card:hover {
    transform: translateY(-6px);
}

.voucher-card h3 {
    margin: 0;
    font-size: 18px;
}

.discount {
    font-size: 34px;
    font-weight: 600;
    color: #e19bb1;
    margin: 10px 0;
}

.store {
    font-size: 14px;
    color: #777;
}

.badge {
    display: inline-block;
    margin-top: 12px;
    padding: 6px 14px;
    background: #333;
    color: #fff;
    border-radius: 20px;
    font-size: 12px;
}
</style>
</head>

<body>

<?php if (isset($_SESSION['success_message'])): ?>
<script>
alert("<?= $_SESSION['success_message'] ?>");
</script>
<?php unset($_SESSION['success_message']); endif; ?>

<!-- HEADER -->
<header class="topbar">
    <div class="logo">
        <img src="images/orked.png">
    </div>

    <div class="header-actions">
        <strong><?= htmlspecialchars($membershipType) ?> Member</strong>
        <a href="memberProfile.php">Profile</a>
        <a href="logout.php">Logout</a>
    </div>
</header>

<!-- CATEGORY NAV -->
<div class="category-nav">
    <button class="active" onclick="filterVoucher('all', this)">All</button>
    <button onclick="filterVoucher('shoes', this)">Shoes</button>
    <button onclick="filterVoucher('food', this)">Food</button>
    <button onclick="filterVoucher('beauty', this)">Beauty</button>
    <button onclick="filterVoucher('electronics', this)">Electronics</button>
    <button onclick="filterVoucher('fashion', this)">Fashion</button>
    <button onclick="filterVoucher('sports', this)">Sports</button>
    <button onclick="filterVoucher('kids', this)">Kids</button>
    <button onclick="filterVoucher('home', this)">Home</button>
</div>

<!-- VOUCHERS -->
<section class="voucher-section">
<div class="voucher-row">

<?php
$vouchers = [
    ["shoes","Adidas", $membershipType=="Platinum"?50:30],
    ["shoes","Puma", $membershipType=="Platinum"?45:25],
    ["shoes","Nike", $membershipType=="Platinum"?40:20],
    ["shoes","Skechers", $membershipType=="Platinum"?35:15],
    ["shoes","New Balance", $membershipType=="Platinum"?30:15],

    ["food","KFC", $membershipType=="Platinum"?35:15],
    ["food","Starbucks", $membershipType=="Platinum"?30:10],
    ["food","McDonald's", $membershipType=="Platinum"?25:10],
    ["food","Pizza Hut", $membershipType=="Platinum"?30:15],
    ["food","Sushi King", $membershipType=="Platinum"?40:20],

    ["beauty","Sephora", $membershipType=="Platinum"?45:25],
    ["beauty","Watsons", $membershipType=="Platinum"?35:15],
    ["beauty","Guardian", $membershipType=="Platinum"?30:15],

    ["electronics","Samsung", $membershipType=="Platinum"?40:20],
    ["electronics","Apple Store", $membershipType=="Platinum"?25:10],
    ["electronics","Sony", $membershipType=="Platinum"?35:15],
    ["electronics","Huawei", $membershipType=="Platinum"?30:15],

    ["fashion","ZARA", $membershipType=="Platinum"?35:15],
    ["fashion","H&M", $membershipType=="Platinum"?30:15],
    ["fashion","Uniqlo", $membershipType=="Platinum"?25:10],

    ["sports","Decathlon", $membershipType=="Platinum"?30:15],
    ["sports","Under Armour", $membershipType=="Platinum"?35:20],

    ["kids","ToysRUs", $membershipType=="Platinum"?30:15],
    ["kids","Mothercare", $membershipType=="Platinum"?25:10],

    ["home","IKEA", $membershipType=="Platinum"?35:20],
    ["home","MR DIY", $membershipType=="Platinum"?25:10],
    ["home","Harvey Norman", $membershipType=="Platinum"?30:15],
];

foreach ($vouchers as $v) {
    echo "
    <div class='voucher-card {$v[0]}'>
        <h3>{$v[1]}</h3>
        <div class='discount'>{$v[2]}% OFF</div>
        <div class='store'>{$membershipType} Exclusive</div>
        <div class='badge'>Limited Time</div>
    </div>
    ";
}
?>

</div>
</section>

<script>
function filterVoucher(category, btn) {
    document.querySelectorAll('.category-nav button')
        .forEach(b => b.classList.remove('active'));
    btn.classList.add('active');

    document.querySelectorAll('.voucher-card').forEach(card => {
        if (category === 'all' || card.classList.contains(category)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
}
</script>

</body>
</html>
