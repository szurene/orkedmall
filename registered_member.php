<?php
include 'db.php';

$search = isset($_GET['search']) ? trim($_GET['search']) : '';

$sql = "
SELECT m.memberID, m.fullName, m.phoneNum,
    IFNULL(mt.mTypeName, 'No Plan') AS tier,
    IFNULL(p.paymentStatus, 'Pending') AS payStatus,
    ms.endDate
FROM member m
LEFT JOIN membership ms ON m.memberID = ms.memberID
LEFT JOIN membership_type mt ON ms.mTypeID = mt.mTypeID
LEFT JOIN payment p ON ms.paymentID = p.paymentID
";

if ($search !== '') {
    $sql .= "
    WHERE
        m.fullName LIKE '%$search%' OR
        m.phoneNum LIKE '%$search%' OR
        mt.mTypeName LIKE '%$search%' OR
        p.paymentStatus LIKE '%$search%' OR
        (
            '$search' = 'active' AND ms.endDate >= CURDATE()
        ) OR
        (
            '$search' = 'inactive' AND ms.endDate < CURDATE()
        )
    ";
}

$sql .= " GROUP BY m.memberID ORDER BY m.memberID ASC";

$result = $conn->query($sql);
?>

<?php
include 'db.php';

/* ==========================
   AJAX REQUEST HANDLER
========================== */
if (isset($_GET['ajax']) && $_GET['ajax'] === 'members') {

    $search = isset($_GET['search']) ? trim($_GET['search']) : '';

    $sql = "
    SELECT 
        m.memberID,
        m.fullName,
        m.phoneNum,
        IFNULL(mt.mTypeName, 'No Plan') AS tier,
        IFNULL(p.paymentStatus, 'Pending') AS payStatus,
        ms.endDate
    FROM member m
    LEFT JOIN membership ms ON m.memberID = ms.memberID
    LEFT JOIN membership_type mt ON ms.mTypeID = mt.mTypeID
    LEFT JOIN payment p ON ms.paymentID = p.paymentID
    ";

    if ($search !== '') {
        $search = $conn->real_escape_string($search);
        $sql .= "
        WHERE
            m.fullName LIKE '%$search%' OR
            m.phoneNum LIKE '%$search%' OR
            mt.mTypeName LIKE '%$search%' OR
            p.paymentStatus LIKE '%$search%' OR
            (
                '$search' = 'active' AND ms.endDate >= CURDATE()
            ) OR
            (
                '$search' = 'inactive' AND ms.endDate < CURDATE()
            )
        ";
    }

    $sql .= " GROUP BY m.memberID ORDER BY m.memberID ASC";

    $result = $conn->query($sql);
    $data = [];

    while ($row = $result->fetch_assoc()) {
        $row['isActive'] = (!empty($row['endDate']) && $row['endDate'] >= date('Y-m-d'));
        $data[] = $row;
    }

    header('Content-Type: application/json');
    echo json_encode($data);
    exit; // IMPORTANT
}
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
    <form method="GET" id="searchForm">
        <div class="search-wrapper">
            <input 
                type="text" 
                name="search" 
                id="searchInput"
                placeholder="Search name, tier, status..."
                value="<?= htmlspecialchars($search) ?>"
            >
        </div>
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
                    $payStatus = $row['payStatus'] ?? 'Pending';
                    $payClass  = strtolower($payStatus) === 'completed' ? 'status-paid' : 'status-pending';

                ?>
                <tr>
                    <td>#OM-M<?= $row['memberID'] ?></td>
                    <td><?= htmlspecialchars($row['fullName']) ?></td>
                    <td><?= htmlspecialchars($row['tier']) ?></td>
                    <td><?= htmlspecialchars($row['phoneNum'] ?? 'N/A') ?></td>
                    <td>
                        <span class="status-badge <?= $payClass ?>">
                            <?= htmlspecialchars($payStatus) ?>
                        </span>
                    </td>

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
                <label>Full Name</label>
                <input type="text" id="editFullName">
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