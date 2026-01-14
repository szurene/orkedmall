<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Orked Mall Membership System</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/index.css">
</head>
<body>

<header class="topbar">
    <div class="logo">
        <a href="index.php">
            <img src="images/orked.png" class="logo-img">
        </a>
    </div>

    <nav class="right-controls">
        <div class="dropdown">
            <button class="icon-btn" onclick="toggleDrop('menuList')">☰</button>
            <div id="menuList" class="dropdown-menu">
                <a href="about.html">About Us</a>
                <a href="membership_info.php">Membership Info</a>
            </div>
        </div>

        <div class="dropdown">
            <button class="icon-btn" onclick="toggleDrop('loginBox')">👤</button>
            <div id="loginBox" class="dropdown-menu login-box">
                <h4>MEMBER LOGIN</h4>
                <form action="memberLoginProcess.php" method="POST">

    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>

    <button type="submit">Login</button>
</form>

            </div>
        </div>
    </nav>
</header>

<main>
    <section class="content">
        <h3>WELCOME</h3>
        <h2>Join our Mall Membership <br>and enjoy exclusive discount</h2>
        <p style="font-size: 18px; color: #777; margin-bottom: 40px;">Shop, dine and discover exclusive rewards.<br> Stop thinking and click the button now!<br></p>
        <button class="join-btn" onclick="location.href='memberRegister.php'">Join Now</button>
    </section>

    <section style="background-color: var(--gray-bg); padding: 80px 0;">
        <h2 style="text-align:center; font-weight: 400; letter-spacing: 2px; text-transform: uppercase;">Latest Promotions</h2>
        
        <div class="promo-grid">
            <div class="promo-card">
                <span class="promo-icon">🎉</span>
                <h4>Year-End Sale</h4>
                <p>Get up to <strong>50% off</strong> at participating stores. Exclusive to mall members only.</p>
            </div>

            <div class="promo-card">
                <span class="promo-icon">🛍️</span>
                <h4>Lucky Draw</h4>
                <p>Spend <strong>RM1500</strong> in a single receipt to stand a chance to win a brand new car!</p>
            </div>

            <div class="promo-card">
                <span class="promo-icon">🍽️</span>
                <h4>Dining Week</h4>
                <p>Enjoy <strong>Buy 1 Free 1</strong> deals at all F&B outlets only on Wednesday.</p>
            </div>
        </div>
    </section>

    <! --MEMBER PRIVILEGES SECTION -->
    <!-- MEMBER PRIVILEGES -->
<section class="section member-privileges">
    <div class="section-inner">
        <h2>Member Privileges</h2>

        <div class="benefits-grid">
            <div class="benefit-card">
                <h4>Tiered Excellence</h4>
                <p>
                    Choose between Platinum & Gold memberships designed to match
                    your lifestyle and shopping habits.
                </p>
            </div>

            <div class="benefit-card">
                <h4>Digital Portal</h4>
                <p>
                    Access your membership, rewards, and exclusive offers anytime
                    through our online system.
                </p>
            </div>

            <div class="benefit-card">
                <h4>Exclusive Access</h4>
                <p>
                    Receive early notifications for private events, promotions,
                    and members-only privileges.
                </p>
            </div>
        </div>
    </div>
</section>



    <section class="info-card">
        <h2>Policies</h2>
        <ul>
            <li>All members must register online to view benefits.</li>
            <li>Validity varies by membership tier (1 or 2 years).</li>
            <li>Discounts apply only to active members.</li>
            <li>The Orked Mall reserves the right to update policies.</li>
        </ul>
    </section>

    <div class="admin-link">
        <a href="admin_login.php" class="admin-btn">Admin Access</a>
    </div>
</main>

<div id="footer-placeholder"></div>

<script>
    function toggleDrop(id) {
        const target = document.getElementById(id);
        const isOpen = target.classList.contains('show');
        document.querySelectorAll('.dropdown-menu').forEach(el => el.classList.remove('show'));
        if (!isOpen) target.classList.add('show');
    }

    window.onclick = function(e) {
        if (!e.target.matches('.icon-btn') && !e.target.closest('.dropdown-menu')) {
            document.querySelectorAll('.dropdown-menu').forEach(el => el.classList.remove('show'));
        }
    }

    fetch("footer.html")
        .then(res => res.text())
        .then(data => {
            document.getElementById("footer-placeholder").innerHTML = data;
        });
</script>

</body>
</html>