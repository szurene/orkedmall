<?php
session_start();
include 'db.php';

if (!isset($_SESSION['memberID'])) {
    header("Location: index.php");
    exit();
}

$memberID = $_SESSION['memberID'];

// 1. Updated SQL to select fullName instead of firstName, lastName
$sql = "
SELECT 
    m.fullName, m.email, m.phoneNum,
    m.street, m.city, m.postcode, m.state, m.birthDate,
    mt.mTypeName,
    ms.endDate
FROM member m
JOIN membership ms ON m.memberID = ms.memberID
JOIN membership_type mt ON ms.mTypeID = mt.mTypeID
WHERE m.memberID = ?
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $memberID);
$stmt->execute();
$result = $stmt->get_result();
$member = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile - Orked Mall</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/memberProfile.css">
</head>
<body>

<header class="topbar">
    <div class="logo">
        <img src="images/orked.png" class="logo-img">
    </div>
</header>

<div class="sub-nav">
    <a href="memberDashboard.php" class="dashboard-btn">
        ← Back to Dashboard
    </a>
</div>

<hr>

<div class="profile-container">

    <div class="membership-card">
        <div class="avatar">👤</div>
        <h2><?= htmlspecialchars($member['mTypeName']) ?> Membership</h2>
        <p class="expiry">
            Membership Expiry:<br>
            <strong><?= date("d M Y", strtotime($member['endDate'])) ?></strong>
        </p>
    </div>

    <form class="profile-form" action="profile_update.php" method="POST" id="profileForm">

        <label>Full Name</label>
        <input type="text" name="fullName" value="<?= htmlspecialchars($member['fullName']) ?>" disabled required>

        <label>Phone Number</label>
        <input type="text" name="phoneNum" value="<?= htmlspecialchars($member['phoneNum']) ?>" disabled required>

        <label>Email Address</label>
        <input type="email" name="email" value="<?= htmlspecialchars($member['email']) ?>" disabled required>

        <label>Birth Date</label>
        <input type="date" name="birthDate" value="<?= htmlspecialchars($member['birthDate']) ?>" disabled required>

        <label>Street</label>
        <input type="text" name="street" value="<?= htmlspecialchars($member['street']) ?>" disabled required>

        <div class="form-row">
            <input type="text" name="city" placeholder="City" value="<?= htmlspecialchars($member['city']) ?>" disabled required>
            <input type="text" name="postcode" placeholder="Postcode" value="<?= htmlspecialchars($member['postcode']) ?>" disabled required>
        </div>

        <label>State</label>
        <input type="text" name="state" value="<?= htmlspecialchars($member['state']) ?>" disabled required>

        <div class="profile-actions">
            <button type="button" id="editBtn" class="edit-btn">Edit</button>
            <button type="submit" id="saveBtn" class="save-btn" style="display:none;">Save</button>
        </div>
    </form>

</div>

<script>
document.getElementById("editBtn").addEventListener("click", function () {
    document.querySelectorAll("#profileForm input").forEach(input => {
        input.disabled = false;
    });

    document.getElementById("editBtn").style.display = "none";
    document.getElementById("saveBtn").style.display = "inline-block";
});
</script>

</body>
</html>