<?php
include 'db.php';
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
    <a href="adminDashboard.php" class="nav-link active">Dashboard Overview</a>
    <a href="registered_member.php" class="nav-link">Member Database</a>
</div>

<div class="content-wrapper">
    <div class="top-bar">
        <a href="logout.php" class="logout-btn-top">Logout</a>
    </div>

    <div class="main">
        <h1>Dashboard</h1>

        <!-- SUMMARY CARDS -->
        <div class="summary">
            <div class="summary-card">
                <h2 id="totalMembers">0</h2>
                <p>Total Members</p>
            </div>
            <div class="summary-card">
                <h2 id="activeMembers">0</h2>
                <p>Active Members</p>
            </div>
            <div class="summary-card">
                <h2 id="pendingPayments">0</h2>
                <p>Pending Payments</p>
            </div>
        </div>

    <!-- CHARTS -->
    <div class="charts">

        <!-- Row 1 -->
        <div class="chart-box">
            <h3>Monthly Registered Members</h3>
            <canvas id="monthlyChart"></canvas>
        </div>

        <div class="chart-box">
            <h3>Membership Type Distribution</h3>
            <canvas id="typeChart"></canvas>
        </div>

        <!-- Row 2 (full width) -->
        <div class="chart-box chart-full">
            <h3>Member Age Demographics</h3>
            <canvas id="ageChart"></canvas>
        </div>
    </div>

        <!-- FOOTER -->
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

<!-- adminDashboard.js (AJAX + getChartData.js) -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js/dashboard.js"></script>
</body>
</html>
