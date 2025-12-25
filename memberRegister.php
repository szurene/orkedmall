<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Member Registration - Orked Mall</title>
    <link rel="stylesheet" href="css/styleRegister.css">
</head>
<body>

<header class="topbar">
    <div class="logo">
        <a href="index.html">
            <img src="images/logo.jpg" class="logo-img">
            <span>Orked Mall</span>
        </a>
    </div>

    <div class="right-controls">
        <!-- Hamburger Menu -->
        <div class="dropdown">
            <button class="menu-btn" onclick="toggleMenu('menuList')">☰</button>
            <div id="menuList" class="menu-list">
                <a href="index.html">Home</a>
                <a href="about.html">About Us</a>
                <a href="membership_info.php">Membership Info</a>
            </div>
        </div>
    </div>
</header>

<div class="register-container">
    <h2>Member Registration</h2>
    <form action="memberRegisterProcess.php" method="POST" id="registerForm" onsubmit="return validateRegister();">
        
        <label>First Name <span class="required-label">*Required</span></label>
        <input type="text" name="firstName" required>

        <label>Last Name <span class="required-label">*Required</span></label>
        <input type="text" name="lastName" required>

        <label>Email <span class="required-label">*Required</span></label>
        <input type="email" name="email" required>

        <label>Phone Number <span class="required-label">*Required</span></label>
        <input type="text" name="phoneNum" required>

        <!-- Address Section -->
        <label>Address <span class="required-label">*Required</span></label>

        <div class="address-box">
        <input type="text" name="street" placeholder="Street" class="street" required>

        <div class="address-row">
            <input type="text" name="postcode" placeholder="Postcode" required>
            <input type="text" name="city" placeholder="City" required>
            <input type="text" name="state" placeholder="State" required>
        </div>
        </div>

        <label>Password <span class="required-label">*Required</span></label>

        <div class="password-row">
            <input type="password" id="password" name="password" placeholder="Password" required>
            <input type="password" id="confirm" name="confirm" placeholder="Confirm Password" required>
        </div>

        <p id="passwordError" class="error-text"></p>
        <p id="confirmError" class="error-text"></p>

        <button type="submit">Register</button>
    </form>
</div>

<script src="js/register.js"></script>
<div id="footer"></div>

</body>
</html>
