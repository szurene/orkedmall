<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ----------------------
    // MEMBER DATA
    // ----------------------
    $firstname = $_POST['firstName'];
    $lastname  = $_POST['lastName'];
    $email     = $_POST['email'];
    $phoneNum  = $_POST['phoneNum'];
    $street    = $_POST['street'];
    $city      = $_POST['city'];
    $postcode  = $_POST['postcode'];
    $state     = $_POST['state'];

    $password  = $_POST['password'];
    $confirm   = $_POST['confirm'];

    // ----------------------
    // MEMBERSHIP TYPE
    // ----------------------
    if (!isset($_POST['membershipType'])) {
        echo "<script>
                alert('Please select a membership type!');
                window.history.back();
              </script>";
        exit;
    }
    $mTypeID = intval($_POST['membershipType']);

    // ----------------------
    // PASSWORD CHECK
    // ----------------------
    if ($password !== $confirm) {
        echo "<script>
                alert('Password and Confirm Password do not match!');
                window.history.back();
              </script>";
        exit;
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // ----------------------
    // INSERT MEMBER
    // ----------------------
    $sqlMember = "INSERT INTO member 
                  (firstName, lastName, email, phoneNum, street, city, postcode, state, password)
                  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmtMember = $conn->prepare($sqlMember);
    $stmtMember->bind_param(
        "sssssssss",
        $firstname, $lastname, $email, $phoneNum, $street, $city, $postcode, $state, $hashedPassword
    );

    if (!$stmtMember->execute()) {
        die("Member insert error: " . $stmtMember->error);
    }

    $memberID = $conn->insert_id;

    // ----------------------
    // DEBUG: Check Member ID
    // ----------------------
    if ($memberID <= 0) {
        die("Error: Member ID is invalid. Check insert.");
    }

    // ----------------------
    // GET MEMBERSHIP DURATION
    // ----------------------
    $sqlDur = "SELECT duration, mTypeName FROM membership_type WHERE mTypeID = ?";
    $stmtDur = $conn->prepare($sqlDur);
    $stmtDur->bind_param("i", $mTypeID);
    $stmtDur->execute();
    $resultDur = $stmtDur->get_result();

    if ($resultDur->num_rows == 0) {
        die("Error: Selected membership type does not exist.");
    }

    $rowDur = $resultDur->fetch_assoc();
    $durationMonths = intval($rowDur['duration']);
    $membershipName = $rowDur['mTypeName'];

    // ----------------------
    // DEBUG: Check duration
    // ----------------------
    if ($durationMonths <= 0) {
        die("Error: Duration for '$membershipName' is invalid: $durationMonths months.");
    }

    // ----------------------
    // CALCULATE START AND END DATE
    // ----------------------
    $startDate = date('Y-m-d'); // today
    $endDate   = date('Y-m-d', strtotime("+$durationMonths months"));

    // ----------------------
    // DEBUG: Check dates
    // ----------------------
    echo "<pre>";
    echo "MemberID: $memberID\n";
    echo "Membership Type: $membershipName ($mTypeID)\n";
    echo "Duration: $durationMonths months\n";
    echo "Start Date: $startDate\n";
    echo "End Date: $endDate\n";
    echo "</pre>";
    // exit; // <-- Uncomment to test before inserting

    // ----------------------
    // INSERT MEMBERSHIP
    // ----------------------
    $sqlMembership = "INSERT INTO membership (startDate, endDate, memberID, mTypeID)
                      VALUES (?, ?, ?, ?)";
    $stmtMembership = $conn->prepare($sqlMembership);
    $stmtMembership->bind_param("ssii", $startDate, $endDate, $memberID, $mTypeID);

    if (!$stmtMembership->execute()) {
        die("Membership insert error: " . $stmtMembership->error);
    }

    // Redirect to payment page with membershipID
$membershipID = $stmtMembership->insert_id;

echo "<script>
        alert('Registration successful!\\nMembership: $membershipName\\nStart: $startDate\\nEnd: $endDate');
        window.location.href='payment.php?membershipID=$membershipID';
      </script>";


    // ----------------------
    // CLOSE STATEMENTS & CONNECTION
    // ----------------------
    $stmtMember->close();
    $stmtDur->close();
    $stmtMembership->close();
    $conn->close();
}
?>
