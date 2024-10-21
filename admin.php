<?php
include('database/connection.php');


if($_SESSION['user']!=''){
  
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
        <link rel="stylesheet" href="css/admin.css">
    </head>
    <body class="body-admin">
        <div class="admin-container">
            <div class="sidebar">
                <img src="images/logo.png" alt="Admin Logo" class="logo">
                <h2>Admin</h2>
                <nav>
                    <ul>
                        <li><a href="sales.php" target="content-frame">Jualan</a></li>
                        <li><a href="menudata.php" target="content-frame">Info Menu</a></li>
                        <li><a href="menuform.php" target="content-frame">Tambah Menu</a></li>
                        <li><a href="staffinfo.php" target="content-frame">Info Staff</a></li>
                    </ul>
                </nav>
            </div>

            <div class="main-content">
                <header>
                    <h1>Hai, <?php echo $_SESSION['user'];?></h1>
                    <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
                </header>
                <iframe name="content-frame" class="content-frame" src="sales.php"></iframe>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    header('Location: login.php');
}
?>
