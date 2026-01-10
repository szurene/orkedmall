<?php
include 'db.php';

$search = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

$sql = "SELECT m.memberID, m.firstName, m.lastName, m.phoneNum,
               IFNULL(mt.mTypeName, 'No Plan') AS tier, 
               IFNULL(p.paymentStatus, 'Pending') AS payStatus,
               ms.endDate
        FROM member m
        LEFT JOIN membership ms ON m.memberID = ms.memberID
        LEFT JOIN membership_type mt ON ms.mTypeID = mt.mTypeID
        LEFT JOIN payment p ON ms.membershipID = p.membershipID";

if ($search !== '') {
    $sql .= " WHERE m.firstName LIKE '%$search%'
              OR m.lastName LIKE '%$search%'
              OR m.phoneNum LIKE '%$search%'
              OR m.memberID LIKE '%$search%'";
}

$sql .= " GROUP BY m.memberID ORDER BY m.memberID ASC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mall Membership Admin</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/admin.css">
</head>
<body>

<div class="sidebar">
    <h2>Mall Registry</h2>
    <a href="adminDashboard.php" class="nav-link">Dashboard Overview</a>
    <a href="registered_member.php" class="nav-link active">Member Database</a>
</div>

<div class="content-wrapper">
    <div class="top-bar">
        <a href="logout.php" class="logout-btn-top">Logout</a>
    </div>

    <div class="main">
        <h1>Registered Members</h1>

        <div class="search-bar">
            <form method="GET">
                <input type="text" name="search" placeholder="Search members..." value="<?= htmlspecialchars($search) ?>">
            </form>
        </div>

        <table id="membersTable">
            <thead>
            <tr>
                <th onclick="sortTable(0, this)">ID</th>
                <th onclick="sortTable(1, this)">Member Name</th>
                <th onclick="sortTable(2, this)">Tier</th>
                <th onclick="sortTable(3, this)">Phone</th>
                <th onclick="sortTable(4, this)">Payment</th>
                <th onclick="sortTable(5, this)">Status</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <?php if ($result && $result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()):
                    $isActive = (!empty($row['endDate']) && $row['endDate'] >= date('Y-m-d'));
                    $statusClass = $isActive ? 'status-active' : 'status-inactive';
                    $payClass = strtolower($row['payStatus']) === 'completed' ? 'status-paid' : 'status-pending';
                ?>
                <tr>
                    <td>#OM-M<?= $row['memberID'] ?></td>
                    <td><?= htmlspecialchars($row['firstName'].' '.$row['lastName']) ?></td>
                    <td><?= htmlspecialchars($row['tier']) ?></td>
                    <td><?= htmlspecialchars($row['phoneNum'] ?? 'N/A') ?></td>
                    <td><span class="status-badge <?= $payClass ?>"><?= $row['payStatus'] ?></span></td>
                    <td><span class="status-badge <?= $statusClass ?>"><?= $isActive ? 'Active' : 'Inactive' ?></span></td>
                    <td class="action-buttons">
                        <button class="view-btn" onclick="openModal('view', <?= $row['memberID'] ?>)">View</button>
                    </td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7" style="text-align:center">No members found</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="footer">&copy; 2026 Orked Mall Management System</div>
</div>

<div id="memberModal" class="modal">
    <div class="modal-content">
        <span class="close-modal" onclick="closeModal()">&times;</span>
        <h2 id="modalTitle"></h2>

        <form id="modalForm">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" id="editFirstName">
            </div>
            <div class="form-group">
                <label>Last Name</label>
                <input type="text" id="editLastName">
            </div>
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" id="editPhone">
            </div>
            <div id="modalFooter">
                <button type="button" class="save-btn">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script src="js/registeredmember.js"></script>
</body>
</html>
<?php $conn->close(); ?>