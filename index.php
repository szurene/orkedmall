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
            background: var(--white);
            margin: 0;
            color: var(--text-dark);
            line-height: 1.6;
        }

        /* NAVIGATION */
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 60px;
            background: linear-gradient(135deg, var(--brand-sand) 0%, #c5b9ac 100%);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .logo a {
            text-decoration: none;
            color: var(--text-dark);
            display: flex;
            align-items: center;
            gap: 12px;
            height: 50px; 
        }

        .logo span {
            font-size: 18px;
            letter-spacing: 2px;
            text-transform: uppercase;
            font-weight: 600;
            line-height: 1;
        }

        .logo-img {
            height: 50px;       
            width: auto;
            display: block;
            image-rendering: -webkit-optimize-contrast; 
        }

        .right-controls {
            display: flex;
            gap: 20px;
        }

        .icon-btn {
            font-size: 24px;
            cursor: pointer;
            border: none;
            background: none;
            color: var(--text-dark);
            transition: 0.3s;
        }

        .icon-btn:hover { color: var(--brand-rose); }

        /* DROPDOWNS */
        .dropdown-menu {
            display: none;
            position: absolute;
            right: 0;
            top: 50px;
            background: var(--white);
            border: 1px solid var(--border-light);
            width: 220px;
            border-radius: 8px;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: fadeIn 0.3s ease;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .show { display: block; }

        .dropdown-menu a {
            display: block;
            padding: 12px 20px;
            text-decoration: none;
            color: var(--text-dark);
            font-size: 14px;
            border-bottom: 1px solid #f5f5f5;
        }

        .dropdown-menu a:hover { background: #f5f5f5; color: var(--brand-rose); }

        /* LOGIN BOX */
        .login-box { padding: 20px; }
        .login-box h4 { 
            margin: 0 0 15px; 
            font-size: 14px; 
            letter-spacing: 1px; 
            color: var(--brand-rose); 
            text-align: center;
        }

        .login-box input {
            width: 100%;
            margin-bottom: 10px;
            padding: 10px;
            box-sizing: border-box;
            border: 1px solid var(--border-light);
            border-radius: 4px;
            font-family: 'Poppins', sans-serif;
        }

        .login-box button {
            width: 100%;
            padding: 10px;
            background: var(--text-dark);
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-transform: uppercase;
            font-size: 12px;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .login-box button:hover { background: var(--brand-rose); }

        /* HERO CONTENT */
        .content {
            padding: 100px 5%;
            text-align: center;
            background: var(--white);
        }

        .content h3 { font-weight: 300; letter-spacing: 4px; color: #888; margin-bottom: 0; }
        .content h2 { font-size: 42px; font-weight: 500; margin: 10px 0 30px; letter-spacing: 1px; }

        .join-btn {
            background-color: var(--text-dark);
            color: white;
            border: none;
            padding: 15px 40px;
            font-size: 13px;
            letter-spacing: 2px;
            text-transform: uppercase;
            border-radius: 4px;
            cursor: pointer;
            transition: 0.3s;
        }

        .join-btn:hover {
            background-color: var(--brand-rose);
            transform: translateY(-2px);
        }

        /* PROMOTIONS GRID */
        .promo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
            padding: 40px 5%;
            max-width: 1100px;
            margin: 0 auto;
        }

        .promo-card {
            background: var(--white);
            border-radius: 12px;
            padding: 40px;
            text-align: center;
            border: 1px solid var(--border-light);
            transition: 0.3s;
        }

        .promo-card:hover {
            border-color: var(--brand-rose);
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
        }

        .promo-icon { font-size: 40px; margin-bottom: 20px; display: block; }
        .promo-card h4 { text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 15px; }
        .promo-card p { font-size: 14px; color: #666; }

        /* POLICIES SECTION */
        .info-card {
            padding: 60px 5%;
            background: var(--brand-sand);
            max-width: 1000px;
            margin: 60px auto;
            border-radius: 12px;
        }

        .info-card h2 { text-align: center; font-weight: 500; text-transform: uppercase; letter-spacing: 2px; }
        .info-card ul { list-style: none; padding: 0; max-width: 600px; margin: 0 auto; }
        .info-card li { margin-bottom: 15px; font-size: 15px; position: relative; padding-left: 25px; }
        .info-card li::before { content: "•"; color: var(--brand-rose); position: absolute; left: 0; font-weight: bold; }

        .admin-link { text-align: center; padding-bottom: 80px; }
        .admin-btn {
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #999;
            text-decoration: none;
            transition: 0.3s;
        }
        .admin-btn:hover { color: var(--brand-rose); }

        /* RESPONSIVE */
        @media (max-width: 768px) {
            .topbar { padding: 15px 30px; }
            .content h2 { font-size: 28px; }
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

    <section class="info-card">
        <h2>Policies</h2>
        <ul>
            <li>All members must register online to access benefits.</li>
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