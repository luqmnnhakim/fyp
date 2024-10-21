<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/mainpage.css"> <!-- Link to existing CSS -->
</head>
<body>

<header>
    <div class="container">
        <img src="images/logo.png" alt="Logo" class="logo"> <!-- Adjust the logo path -->
        <h1>Aida Station</h1>
        <nav>
        <div class="hamburger" id="hamburger">
    <div></div>
    <div></div>
    <div></div>
</div>
<nav id="nav">
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
    <h2>Contact Us</h2>
    <p>If you have any questions, feel free to reach out to us through any of the platforms below:</p>

    <div class="social-links">
        <a href="https://wa.me/+60183249852" target="_blank">WhatsApp</a>
        <a href="https://www.instagram.com/aa_aidastation?igsh=cjhlMTF0ZWQzc2Vh" target="_blank">Instagram</a>
        <a href="https://www.facebook.com/aaaidastationrestaurantarau?mibextid=LQQJ4d" target="_blank">Facebook</a>
        <a href="https://www.google.com/search?si=ACC90nwjPmqJHrCEt6ewASzksVFQDX8zco_7MgBaIawvaF4-7i8vvR0AtTXzMS2E97sej3YsBczz8hwHGCmueTAdWmseXFKQ415YDPni9lS5lkmDBnGRBmpGq9bzhG3yBdCnQhRHsNiqnvbCMV-QtV6mENhP1KSFpQ%3D%3D&hl=en-MY&q=aa%20aida%20station%20restaurant%20reviews&shndl=30&source=sh%2Fx%2Floc%2Fosrp%2Fm5%2F3&kgs=5fe52a64047befcc" target="_blank">Google Review</a>
    </div>
</main>

<footer>
    <p>&copy; 2024 Aida Station. Customer Always Right.</p>
</footer>

<!-- JavaScript code added directly to the page -->
<script>
    const hamburger = document.getElementById('hamburger');
const nav = document.getElementById('nav');

hamburger.addEventListener('click', () => {
    nav.classList.toggle('active');
});

</script>

</body>
</html>
