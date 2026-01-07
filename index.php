<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Orked Mall Membership System</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        :root {
            --brand-sand: #e5dcd6;
            --brand-rose: #e19bb1;
            --text-dark: #333333;
            --border-light: #e0e0e0;
            --white: #ffffff;
            --gray-bg: #f9f9f9;
        }

        body {
            font-family: 'Poppins', sans-serif;
            margin: 0;
            background: var(--white);
            color: var(--text-dark);
        }

        /* ================= NAVBAR ================= */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 60px;
            background: linear-gradient(135deg, var(--brand-sand), #c5b9ac);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .logo-img { height: 50px; }

        .right-controls {
            display: flex;
            gap: 20px;
        }

        .icon-btn {
            font-size: 24px;
            background: none;
            border: none;
            cursor: pointer;
        }

        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            background: white;
            border-radius: 8px;
            width: 220px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }

        .dropdown-menu a {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: var(--text-dark);
        }

        .dropdown-menu a:hover { background: #f5f5f5; }

        .show { display: block; }

        .login-box { padding: 20px; }

        .login-box input {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
        }

        .login-box button {
            width: 100%;
            padding: 10px;
            background: var(--text-dark);
            color: white;
            border: none;
            cursor: pointer;
        }

        /* ================= HERO ================= */
        .content {
            padding: 100px 5%;
            text-align: center;
        }

        .content h3 {
            letter-spacing: 4px;
            color: #888;
            font-weight: 300;
        }

        .content h2 {
            font-size: 42px;
            margin: 15px 0;
        }

        .join-btn {
            margin-top: 30px;
            padding: 15px 40px;
            border: none;
            background: var(--text-dark);
            color: white;
            cursor: pointer;
            letter-spacing: 2px;
        }

        .join-btn:hover { background: var(--brand-rose); }

        /* ================= PROMOTIONS ================= */
        .promo-section {
            background: var(--gray-bg);
            padding: 80px 5%;
        }

        .section-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-header h2 {
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 400;
        }

        .section-header p {
            font-size: 14px;
            color: #777;
        }

        .featured-layout {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: 2fr 1fr;
            grid-template-rows: auto auto;
            gap: 30px;
        }

        .promo-card {
            background: white;
            border-radius: 12px;
            padding: 40px;
            border: 1px solid var(--border-light);
            text-align: center;
            position: relative;
            transition: 0.3s;
        }

        .promo-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0,0,0,0.08);
        }

        .promo-featured {
            grid-row: span 2;
            background: linear-gradient(135deg, var(--brand-sand), #f1e9e4);
            border: none;
            text-align: left;
            padding: 60px;
        }

        .promo-icon {
            font-size: 48px;
        }

        .promo-featured h4 {
            font-size: 22px;
            margin-top: 20px;
        }

        .promo-divider {
            width: 50px;
            height: 3px;
            background: var(--brand-rose);
            margin: 20px 0;
        }

        .promo-badge {
            position: absolute;
            top: 25px;
            right: 25px;
            background: var(--brand-rose);
            color: white;
            font-size: 11px;
            padding: 6px 14px;
            border-radius: 30px;
            letter-spacing: 1px;
        }

        /* ================= POLICIES ================= */
        .info-card {
            max-width: 1000px;
            margin: 80px auto;
            padding: 60px 5%;
            background: var(--brand-sand);
            border-radius: 12px;
        }

        .info-card ul {
            list-style: none;
            padding: 0;
        }

        .info-card li {
            margin-bottom: 15px;
        }

        /* ================= RESPONSIVE ================= */
        @media (max-width: 900px) {
            .featured-layout {
                grid-template-columns: 1fr;
            }

            .promo-featured {
                grid-row: auto;
                text-align: center;
            }

            .promo-divider {
                margin: 20px auto;
            }
        }
    </style>
</head>

<body>

<header class="topbar">
    <div class="logo">
        <a href="index.php">
            <img src="images/orked.png" class="logo-img">
        </a>
    </div>

    <nav class="right-controls">
        <button class="icon-btn" onclick="toggleDrop('menuList')">☰</button>
        <button class="icon-btn" onclick="toggleDrop('loginBox')">👤</button>

        <div id="menuList" class="dropdown-menu">
            <a href="about.html">About Us</a>
            <a href="membership_info.php">Membership Info</a>
        </div>

        <div id="loginBox" class="dropdown-menu login-box">
            <input type="text" placeholder="Email">
            <input type="password" placeholder="Password">
            <button>Login</button>
        </div>
    </nav>
</header>

<main>

<section class="content">
    <h3>WELCOME</h3>
    <h2>Join our Mall Membership<br>and enjoy exclusive discounts</h2>
    <p>Shop, dine and discover exclusive rewards.</p>
    <button class="join-btn" onclick="location.href='memberRegister.php'">Join Now</button>
</section>

<section class="promo-section">
    <div class="section-header">
        <h2>Latest Promotions</h2>
        <p>Exclusive deals for Orked Mall members</p>
    </div>

    <div class="featured-layout">
        <div class="promo-card promo-featured">
            <span class="promo-badge">Featured</span>
            <span class="promo-icon">🎁</span>
            <h4>New Member Bonus</h4>
            <div class="promo-divider"></div>
            <p>Sign up today and receive a <strong>RM30 Shopping Voucher</strong> exclusively for members.</p>
        </div>

        <div class="promo-card">
            <span class="promo-icon">💳</span>
            <h4>Cashback Weekend</h4>
            <div class="promo-divider"></div>
            <p>Spend <strong>RM300</strong> and earn <strong>10% cashback</strong>.</p>
        </div>

        <div class="promo-card">
            <span class="promo-icon">🍽️</span>
            <h4>Dining Privileges</h4>
            <div class="promo-divider"></div>
            <p>Enjoy <strong>Buy 1 Free 1</strong> deals every Wednesday.</p>
        </div>
    </div>
</section>

<section class="info-card">
    <h2>Policies</h2>
    <ul>
        <li>Members must register online.</li>
        <li>Membership validity varies by tier.</li>
        <li>Discounts apply to active members only.</li>
        <li>The Orked Mall reserves all rights.</li>
    </ul>
</section>

</main>

<script>
function toggleDrop(id) {
    document.querySelectorAll('.dropdown-menu').forEach(el => el.classList.remove('show'));
    document.getElementById(id).classList.toggle('show');
}

window.onclick = function(e) {
    if (!e.target.matches('.icon-btn')) {
        document.querySelectorAll('.dropdown-menu').forEach(el => el.classList.remove('show'));
    }
}
</script>

</body>
</html>
