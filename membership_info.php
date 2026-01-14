<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Membership Info - Orked Mall</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/info.css">
</head>
<body>

<header class="topbar">
    <div class="logo">
        <a href="index.html">
            <img src="images/orked.png" class="logo-img">
        </a>
    </div>

    <nav class="right-controls">
        <div class="dropdown">
            <button class="icon-btn" onclick="toggleDrop()">☰</button>
            <div id="menuList" class="dropdown-menu">
                <a href="index.php">Home</a>
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
        <li>Free Valet & Full-Day Parking</li>
        <li>Priority Queue for All Services</li>
        <li>Monthly Free Gifts & Vouchers</li>
        <li>VIP Event & Party Invitations</li>
        <li>RM160 for 1 year</li>
      </ul>
      <button class="subscribe-btn" onclick="location.href='memberRegister.php'">Join Platinum</button>
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
        <li>3 Hours Free Parking Daily</li>
        <li>Special Discounts at Select Shops</li>
        <li>Early Festive Gift Redemptions</li>
        <li>Early Access to Mall Sales</li>
        <li>RM240 for 2 years</li>
      </ul>
      <button class="subscribe-btn" onclick="location.href='memberRegister.php'">Join Gold</button>
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
    
    const cards = document.querySelectorAll('.flip-card');

    cards.forEach(card => {
        card.addEventListener('click', function() {
        this.classList.toggle('flipped');
        });
    });

    fetch("footer.html")
        .then(res => res.text())
        .then(data => {
            document.getElementById("footer-placeholder").innerHTML = data;
        });
</script>

</body>
</html>