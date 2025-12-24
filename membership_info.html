<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Shopping Mall Membership</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <style>
    :root {
      --brand-sand: #e5dcd6;
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

    /* Navigation Bar - Added Sandstone Color */
    .navbar {
      background-color: var(--brand-sand);
      color: var(--text-dark);
      padding: 15px 60px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: relative;
      z-index: 1000;
      box-shadow: 0 2px 10px rgba(0,0,0,0.05);
    }

    .navbar h1 {
      margin: 0;
      font-size: 18px;
      letter-spacing: 2px;
      text-transform: uppercase;
      font-weight: 600;
    }

    /* Hamburger Menu Icon */
    .hamburger {
      cursor: pointer;
      display: flex;
      flex-direction: column;
      gap: 5px;
      padding: 10px;
    }

    .hamburger div {
      width: 22px;
      height: 2px;
      background-color: var(--text-dark);
      transition: 0.3s;
    }

    /* Dropdown Menu */
    .nav-dropdown {
      position: absolute;
      top: 100%;
      right: 60px;
      background: var(--white);
      border: 1px solid var(--border-light);
      width: 200px;
      display: none;
      box-shadow: 0 10px 20px rgba(0,0,0,0.1);
      border-radius: 0 0 8px 8px;
      overflow: hidden;
    }

    .nav-dropdown.active {
      display: block;
      animation: fadeIn 0.3s ease;
    }

    .nav-dropdown a {
      display: block;
      padding: 15px 20px;
      text-decoration: none;
      color: var(--text-dark);
      font-size: 14px;
      transition: background 0.2s;
    }

    .nav-dropdown a:hover {
      background-color: #f5f5f5;
      color: var(--brand-rose);
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-10px); }
      to { opacity: 1; transform: translateY(0); }
    }

    /* Page Title */
    .page-title {
      text-align: center;
      font-size: 32px;
      font-weight: 300;
      margin: 80px 0 50px 0;
      letter-spacing: 1px;
    }

    /* Membership Section */
    .membership-section {
      max-width: 900px;
      margin: 0 auto 60px auto;
      display: flex;
      gap: 60px;
      align-items: center;
      padding: 20px;
    }

    /* Card Styling */
    .flip-card {
      width: 350px;
      height: 220px;
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

    .flip-card:hover .flip-card-inner {
      transform: rotateY(180deg);
    }

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
    }

    .flip-card-front.platinum {
      background-color: var(--brand-sand);
      color: var(--text-dark);
      box-shadow: 0 10px 25px rgba(0,0,0,0.05);
    }

    .flip-card-front.gold {
      background-color: #f9f9f9;
      color: var(--text-dark);
      border: 1px solid var(--border-light);
    }

    .flip-card-back {
      background-color: var(--text-dark);
      color: #ffffff;
      transform: rotateY(180deg);
      text-align: center;
      justify-content: center;
    }

    .membership-title {
      font-size: 22px;
      font-weight: 600;
      letter-spacing: 2px;
      text-transform: uppercase;
    }

    .price {
      font-size: 16px;
      opacity: 0.8;
      font-weight: 400;
    }

    /* Benefits List */
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
      color: #555;
    }

    /* Fixed Size Buttons */
    .subscribe-btn {
      background-color: var(--text-dark);
      color: white;
      border: none;
      width: 200px; /* Standardized width */
      height: 45px; /* Standardized height */
      border-radius: 4px;
      font-size: 12px;
      letter-spacing: 2px;
      text-transform: uppercase;
      cursor: pointer;
      transition: 0.3s;
      display: block;
    }

    .subscribe-btn:hover {
      background-color: var(--brand-rose);
      transform: translateY(-2px);
    }

    .footer {
      color: #bbbbbb;
      text-align: center;
      padding: 60px;
      font-size: 11px;
      letter-spacing: 1px;
      margin-top: auto;
    }

    @media (max-width: 850px) {
      .navbar { padding: 15px 30px; }
      .nav-dropdown { right: 30px; }
      .membership-section { flex-direction: column; text-align: center; }
      .subscribe-btn { margin: 0 auto; }
    }
  </style>
</head>
<body>

  <nav class="navbar">
    <h1>Orked Mall</h1>
    <div class="hamburger" onclick="toggleMenu()">
      <div></div>
      <div></div>
      <div></div>
    </div>
    <div class="nav-dropdown" id="navDropdown">
      <a href="#">Home</a>
      <a href="#">About Us</a>
      <a href="#">Membership Info</a>
    </div>
  </nav>

  <div class="page-title">Curated Membership</div>

  <div class="membership-section">
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front platinum">
          <div class="membership-title">Platinum</div>
          <div class="price">RM 60.00 / 2 Years</div>
        </div>
        <div class="flip-card-back">
          <p>Exclusive privileges for our most valued guests.</p>
        </div>
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
      <button class="subscribe-btn">Join Platinum</button>
    </div>
  </div>

  <div class="membership-section">
    <div class="flip-card">
      <div class="flip-card-inner">
        <div class="flip-card-front gold">
          <div class="membership-title">Gold</div>
          <div class="price">RM 30.00 / 1 Year</div>
        </div>
        <div class="flip-card-back">
          <p>Elevate your lifestyle with our premium rewards.</p>
        </div>
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
      <button class="subscribe-btn">Join Gold</button>
    </div>
  </div>

  <div class="footer">
    &copy; 2025 ORKED SHOPPING MALL. ALL RIGHTS RESERVED.
  </div>

  <script>
    function toggleMenu() {
      const menu = document.getElementById('navDropdown');
      menu.classList.toggle('active');
    }

    window.onclick = function(event) {
      if (!event.target.closest('.hamburger')) {
        const menu = document.getElementById('navDropdown');
        if (menu && menu.classList.contains('active')) {
          menu.classList.remove('active');
        }
      }
    }
  </script>

</body>
</html>