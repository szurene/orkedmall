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
    cursor: pointer;
    user-select: none;
}

.badge:hover {
    background: #e19bb1;
    color: #333;
}

/* ============ MODAL (POPUP) ============ */
.modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.55);
    z-index: 999;
    align-items: center;
    justify-content: center;
    padding: 20px;
}

.modal-box {
    width: 100%;
    max-width: 520px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.2);
    overflow: hidden;
    animation: popIn 0.2s ease;
}

@keyframes popIn {
    from { transform: scale(0.96); opacity: 0; }
    to   { transform: scale(1); opacity: 1; }
}

.modal-header {
    background: #e5dcd6;
    padding: 18px 22px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-header h3 {
    margin: 0;
    font-size: 16px;
    font-weight: 600;
}

.modal-close {
    border: none;
    background: transparent;
    font-size: 22px;
    cursor: pointer;
    line-height: 1;
}

.modal-body {
    padding: 22px;
}

.modal-body p {
    margin: 10px 0;
    font-size: 14px;
    color: #444;
}

.modal-body .big-discount {
    font-size: 36px;
    font-weight: 700;
    color: #e19bb1;
    margin: 8px 0 15px;
}

.modal-body ul {
    margin: 12px 0 0;
    padding-left: 18px;
    color: #444;
    font-size: 14px;
}

.modal-footer {
    padding: 18px 22px;
    border-top: 1px solid #eee;
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.modal-btn {
    border: none;
    padding: 10px 16px;
    border-radius: 10px;
    cursor: pointer;
    font-size: 13px;
}

.modal-btn.primary {
    background: #333;
    color: #fff;
}

.modal-btn.primary:hover {
    background: #e19bb1;
    color: #333;
}

.modal-btn.secondary {
    background: #f1f1f1;
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
/* Helper: generate expiry date (dummy but realistic) */
function expiryDateByCategory($category) {
    $mapDays = [
        "shoes" => 10,
        "food" => 5,
        "beauty" => 14,
        "electronics" => 7,
        "fashion" => 12,
        "sports" => 9,
        "kids" => 11,
        "home" => 15
    ];
    $days = $mapDays[$category] ?? 7;
    return date("d M Y", strtotime("+$days days"));
}

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
    $category = $v[0];
    $store = $v[1];
    $discount = $v[2];
    $expiry = expiryDateByCategory($category);

    echo "
    <div class='voucher-card {$category}'>
        <h3>".htmlspecialchars($store)."</h3>
        <div class='discount'>{$discount}% OFF</div>
        <div class='store'>".htmlspecialchars($membershipType)." Exclusive</div>

        <div class='badge'
            data-store=\"".htmlspecialchars($store, ENT_QUOTES)."\"
            data-category=\"{$category}\"
            data-discount=\"{$discount}\"
            data-expiry=\"{$expiry}\"
            data-membership=\"".htmlspecialchars($membershipType, ENT_QUOTES)."\"
            onclick='openVoucher(this)'>
            Limited Time
        </div>
    </div>
    ";
}
?>

</div>
</section>

<!-- ============ MODAL HTML ============ -->
<div class="modal-overlay" id="voucherModal" onclick="closeModal(event)">
    <div class="modal-box">
        <div class="modal-header">
            <h3 id="modalTitle">Voucher Details</h3>
            <button class="modal-close" onclick="closeModal()">×</button>
        </div>

        <div class="modal-body">
            <p><strong>Store:</strong> <span id="modalStore"></span></p>
            <p><strong>Category:</strong> <span id="modalCategory"></span></p>
            <div class="big-discount" id="modalDiscount"></div>
            <p><strong>Membership:</strong> <span id="modalMembership"></span></p>
            <p><strong>Valid Until:</strong> <span id="modalExpiry"></span></p>

            <p><strong>How to claim:</strong></p>
            <ul>
                <li>Go to the store counter / cashier.</li>
                <li>Show this voucher on your Member Dashboard.</li>
                <li>Show your Membership (Gold/Platinum) status.</li>
                <li>Voucher is valid for 1 transaction only.</li>
            </ul>
        </div>

        <div class="modal-footer">
            <button class="modal-btn secondary" onclick="closeModal()">Close</button>
            <button class="modal-btn primary" onclick="closeModal()">Okay</button>
        </div>
    </div>
</div>

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

/* ============ MODAL LOGIC ============ */
function openVoucher(el) {
    const modal = document.getElementById('voucherModal');

    document.getElementById('modalTitle').innerText = "Voucher Details";
    document.getElementById('modalStore').innerText = el.dataset.store;
    document.getElementById('modalCategory').innerText = el.dataset.category.toUpperCase();
    document.getElementById('modalDiscount').innerText = el.dataset.discount + "% OFF";
    document.getElementById('modalExpiry').innerText = el.dataset.expiry;
    document.getElementById('modalMembership').innerText = el.dataset.membership;

    modal.style.display = "flex";
}

function closeModal(e) {
    const modal = document.getElementById('voucherModal');

    // If user clicks overlay (outside box), close
    if (e && e.target !== modal) return;

    modal.style.display = "none";
}

/* Close modal by ESC key */
document.addEventListener("keydown", function(e) {
    if (e.key === "Escape") {
        document.getElementById('voucherModal').style.display = "none";
    }
});
</script>

</body>
</html>
