<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Locate Us</title>
    <link rel="stylesheet" href="css/mainpage.css"> <!-- Link to existing CSS -->
</head>
<body>

<header>
    <div class="container">
        <img src="images/logo.png" alt="Logo" class="logo" />
        <h1>Aida Station</h1>
        <div class="hamburger" id="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </div>
        <nav id="nav-menu">
            <ul>
                <li><a href="mainpage.php">Home</a></li>
                <li><a href="locate.php">Locate Us</a></li>
                <li><a href="contact.php">Contact Us</a></li>
                <li><a href="menu.php">Order Here</a></li>
            </ul>
        </nav>
        <button class="login-button" onclick="window.location.href='login.php';">Login</button>
    </div>
</header>

<main>
    <h2>Locate Us</h2>
    <p>We are located at:</p>
    
    <address>
        No 42B, Jalan Ulu Pauh KG,<br>
        Tengah Ulu Pauh, Pauh,<br>
        02600 Ulu Pauh, Perlis
    </address><br>

    <div class="map-container">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3964.5370509949475!2d100.33340697437845!3d6.453422493538054!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x304ca38e24758fcb%3A0xd88c8bd79cc7f49e!2sAA%20Aida%20Station%20Restaurant!5e0!3m2!1sen!2sus!4v1729523163305!5m2!1sen!2sus" 
            width="350"
            height="250"
            style="border:0;"
            allowfullscreen=""
            loading="lazy"></iframe>
    </div>
    <div class="map-links">
    <a href="https://waze.com/ul?q=Aida+Station" target="_blank" class="map-button waze-button">Open in Waze</a>
    <a href="https://www.google.com/maps/search/?api=1&query=Aida+Station" target="_blank" class="map-button google-button">Open in Google Maps</a>
</div>

</main>

<footer>
    <p>&copy; 2024 Aida Station. Customer Always Right.</p>
</footer>

<!-- JavaScript code added directly to the page -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const hamburger = document.getElementById('hamburger');
    const navMenu = document.getElementById('nav-menu');

    hamburger.addEventListener('click', function() {
        // Toggle class 'active' pada kedua elemen: hamburger dan navMenu
        navMenu.classList.toggle('active');
        hamburger.classList.toggle('active');
    });
});

</script>

</body>
</html>
