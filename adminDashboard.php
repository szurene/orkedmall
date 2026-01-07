<?php
include 'db.php';

/* Total members */
$totalMembers = $conn->query("SELECT COUNT(*) total FROM member")->fetch_assoc()['total'];

/* Active members */
$activeMembers = $conn->query("
    SELECT COUNT(DISTINCT m.memberID) total
    FROM membership m
    WHERE m.endDate >= CURDATE()
")->fetch_assoc()['total'];

/* Pending payments */
$pendingPayments = $conn->query("
    SELECT COUNT(*) total FROM payment WHERE paymentStatus='Pending'
")->fetch_assoc()['total'];

/* Monthly registration (membership start date) */
$monthlyData = [];
$monthlyQuery = $conn->query("
    SELECT MONTH(startDate) month, COUNT(*) total
    FROM membership
    WHERE YEAR(startDate)=YEAR(CURDATE())
    GROUP BY MONTH(startDate)
");
while ($row = $monthlyQuery->fetch_assoc()) {
    $monthlyData[$row['month']] = $row['total'];
}

/* Membership type distribution */
$typeData = [];
$typeQuery = $conn->query("
    SELECT mt.mTypeName, COUNT(*) total
    FROM membership m
    JOIN membership_type mt ON m.mTypeID = mt.mTypeID
    GROUP BY mt.mTypeName
");
while ($row = $typeQuery->fetch_assoc()) {
    $typeData[$row['mTypeName']] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/styleAdminDashboard.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<div class="sidebar">
    <h2>Mall Registry</h2>
    <a href="admin_dashboard.php" class="nav-link active">Dashboard Overview</a>
    <a href="registered_member.php" class="nav-link">Member Database</a>
</div>

<div class="content-wrapper">
    <div class="top-bar">
        <a href="logout.php" class="logout-btn-top">Logout</a>
    </div>

    <div class="main">
        <h1>Dashboard</h1>

        <div class="summary">
            <div class="summary-card">
                <h2><?= $totalMembers ?></h2>
                <p>Total Members</p>
            </div>
            <div class="summary-card">
                <h2><?= $activeMembers ?></h2>
                <p>Active Members</p>
            </div>
            <div class="summary-card">
                <h2><?= $pendingPayments ?></h2>
                <p>Pending Payments</p>
            </div>
        </div>

        <div class="charts">
            <div class="chart-box">
                <h3>Monthly Registered Members</h3>
                <canvas id="monthlyChart"></canvas>
            </div>

            <div class="chart-box">
                <h3>Membership Type Distribution</h3>
                <canvas id="typeChart"></canvas>
            </div>
        </div>
        <div id="footer-placeholder"></div>
        <script>
        fetch("footer.html")
            .then(res => res.text())
            .then(data => {
                document.getElementById("footer-placeholder").innerHTML = data;
        });
        </script>

        </div>
    </div>
</div>

<script>
const monthlyData = <?= json_encode($monthlyData) ?>;
const typeData = <?= json_encode($typeData) ?>;
</script>
<script src="js/dashboard.js"></script>

</body>
</html>
<?php $conn->close(); ?>
