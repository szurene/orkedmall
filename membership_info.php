<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Membership Info - Orked Mall</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --brand-sand: #ada192;
      --brand-rose: #e19bb1;
      --text-dark: #333333;
      --border-light: #e0e0e0;
      --white: #ffffff;
    }

    body {
      margin: 0;
      font-family: 'Poppins', sans-serif;
      background-color: #ffffff;
      color: var(--text-dark);
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .topbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 15px 60px;
        background-color: var(--brand-sand);
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
    }

    .logo span {
        font-size: 18px;
        letter-spacing: 2px;
        text-transform: uppercase;
        font-weight: 600;
    }

    .logo-img {
        height: 40px;
        width: auto;
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

    .dropdown { position: relative; }

    .dropdown-menu {
        display: none;
        position: absolute;
        right: 0;
        top: 50px;
        background: var(--white);
        border: 1px solid var(--border-light);
        width: 200px;
        border-radius: 8px;
        box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        overflow: hidden;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .dropdown-menu.show { display: block; }

    .dropdown-menu a {
        display: block;
        padding: 12px 20px;
        text-decoration: none;
        color: var(--text-dark);
        font-size: 14px;
        border-bottom: 1px solid #f5f5f5;
    }

    .dropdown-menu a:hover { background: #f5f5f5; color: var(--brand-rose); }

    .page-title {
      text-align: center;
      font-size: 32px;
      font-weight: 300;
      margin: 80px 0 50px 0;
      letter-spacing: 1px;
      text-transform: uppercase;
    }

    .membership-section {
      max-width: 900px;
      margin: 0 auto 60px auto;
      display: flex;
      gap: 60px;
      align-items: center;
      padding: 20px;
    }

    .flip-card {
      width: 437px;
      height: 310px;
      perspective: 1000px;
      flex-shrink: 0;
    }

    .flip-card-inner {
      position: relative;
      width: 100%;
      height: 100%;
      transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
      transform-style: preserve-3d;
    }

    .flip-card:hover .flip-card-inner { transform: rotateY(180deg); }

    .flip-card-front, .flip-card-back {
      position: absolute;
      width: 100%;
      height: 100%;
      border-radius: 12px;
      padding: 35px;
      box-sizing: border-box;
      backface-visibility: hidden;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      background-size: cover;
      background-position: center;
      overflow: hidden;
    }

    /* Front Faces */
    .flip-card-front.platinum {
      background-image: url('images/platinum-front.png');
      color: white;
    }

    .flip-card-front.gold {
      background-image: url('images/gold-front.png');
      color: white;
    }

    /* Back Faces */
    .flip-card-back {
      transform: rotateY(180deg);
      text-align: center;
      justify-content: center;
      color: #ffffff;
    }

    .flip-card-back.platinum-back {
      background-image: url('images/platinum-back.png');
    }

    .flip-card-back.gold-back {
      background-image: url('images/gold-back.png');
    }

    .membership-title {
      font-size: 20px;
      font-weight: 600;
      letter-spacing: 2px;
      text-transform: uppercase;
      text-shadow: 0 2px 4px rgba(0,0,0,0.3);
    }

    .benefits h3 {
      font-size: 18px;
      font-weight: 600;
      margin-bottom: 20px;
      border-bottom: 2px solid var(--brand-rose);
      display: inline-block;
      padding-bottom: 5px;
    }

    .benefits ul {
      margin: 0 0 30px 0;
      padding: 0;
      list-style: none;
    }

    .benefits li {
      margin-bottom: 12px;
      font-size: 14px;
      color: #666;
    }

    .subscribe-btn {
      background-color: var(--text-dark);
      color: white;
      border: none;
      width: 200px;
      height: 45px;
      border-radius: 4px;
      font-size: 12px;
      letter-spacing: 2px;
      text-transform: uppercase;
      cursor: pointer;
      transition: 0.3s;
    }

    .subscribe-btn:hover {
      background-color: var(--brand-rose);
      transform: translateY(-2px);
    }

    #footer-placeholder { margin-top: auto; }

    @media (max-width: 850px) {
      .topbar { padding: 15px 30px; }
      .membership-section { flex-direction: column; text-align: center; }
      .subscribe-btn { margin: 0 auto; }
    }
  </style>
</head>
<body>

<header class="topbar">
    <div class="logo">
        <a href="index.html">
            <img src="images/logo.png" class="logo-img">
            <span>Orked Mall</span>
        </a>
    </div>

    <nav class="right-controls">
        <div class="dropdown">
            <button class="icon-btn" onclick="toggleDrop()">☰</button>
            <div id="menuList" class="dropdown-menu">
                <a href="index.html">Home</a>
                <a href="about.html">About Us</a>
            </div>
        </div>
    </nav>
</header>

<div class="page-title">Curated Membership</div>

<div class="membership-section">
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front platinum"></div>
        <div class="flip-card-back platinum-back"></div>
      </div>
    </div>
    <div class="benefits">
      <h3>Platinum Tier</h3>
      <ul>
        <li>30% Storeside Reductions</li>
        <li>Priority Event Access</li>
        <li>Valet Parking Benefits</li>
        <li>Bespoke Seasonal Gifts</li>
      </ul>
      <button class="subscribe-btn" onclick="location.href='register.html'">Join Platinum</button>
    </div>
</div>

<div class="membership-section">
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front gold"></div>
        <div class="flip-card-back gold-back"></div>
      </div>
    </div>
    <div class="benefits">
      <h3>Gold Tier</h3>
      <ul>
        <li>15% Selected Discounts</li>
        <li>Monthly Reward Multipliers</li>
        <li>1-Hour Complimentary Parking</li>
        <li>Early Sale Notifications</li>
      </ul>
      <button class="subscribe-btn" onclick="location.href='register.html'">Join Gold</button>
    </div>
</div>

<div id="footer-placeholder"></div>

<script>
    function toggleDrop() {
        document.getElementById('menuList').classList.toggle('show');
    }

    window.onclick = function(e) {
        if (!e.target.matches('.icon-btn')) {
            const menu = document.getElementById('menuList');
            if (menu.classList.contains('show')) menu.classList.remove('show');
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