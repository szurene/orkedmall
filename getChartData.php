<?php
include 'db.php';

$response = [];

/* =======================
   SUMMARY DATA
======================= */
$response['totalMembers'] = $conn->query(
    "SELECT COUNT(*) total FROM member"
)->fetch_assoc()['total'];

$response['activeMembers'] = $conn->query(
    "SELECT COUNT(DISTINCT memberID) total
     FROM membership
     WHERE endDate >= CURDATE()"
)->fetch_assoc()['total']; /*AJAX*/

$response['pendingPayments'] = $conn->query(
    "SELECT COUNT(*) total
     FROM payment
     WHERE paymentStatus='Pending'"
)->fetch_assoc()['total'];

/* =======================
   MONTHLY REGISTRATION
======================= */
$monthly = array_fill(1, 12, 0);

$q = $conn->query("
    SELECT MONTH(startDate) m, COUNT(*) total
    FROM membership
    WHERE YEAR(startDate) = YEAR(CURDATE())
    GROUP BY MONTH(startDate)
");

while ($row = $q->fetch_assoc()) {
    $monthly[(int)$row['m']] = (int)$row['total'];
}

$response['monthly'] = array_values($monthly);

/* =======================
   MEMBERSHIP TYPE
======================= */
$typeLabels = [];
$typeValues = [];

$q = $conn->query("
    SELECT mt.mTypeName, COUNT(*) total
    FROM membership m
    JOIN membership_type mt ON m.mTypeID = mt.mTypeID
    GROUP BY mt.mTypeName
");

while ($row = $q->fetch_assoc()) {
    $typeLabels[] = $row['mTypeName'];
    $typeValues[] = (int)$row['total'];
}

$response['type'] = [
    'labels' => $typeLabels,
    'values' => $typeValues
];

/* =======================
   AGE DEMOGRAPHIC
======================= */
$ageGroups = [
    '18-25' => 0,
    '26-35' => 0,
    '36-45' => 0,
    '46-60' => 0,
    '60+' => 0
];

$q = $conn->query("SELECT birthDate FROM member WHERE birthDate IS NOT NULL");

while ($row = $q->fetch_assoc()) {
    $age = date_diff(date_create($row['birthDate']), date_create())->y;

    if ($age <= 25) $ageGroups['18-25']++;
    else if ($age <= 35) $ageGroups['26-35']++;
    else if ($age <= 45) $ageGroups['36-45']++;
    else if ($age <= 60) $ageGroups['46-60']++;
    else $ageGroups['60+']++;
}

$response['age'] = [
    'labels' => array_keys($ageGroups),
    'values' => array_values($ageGroups)
];
/* return JSON for AJAX */
echo json_encode($response);
