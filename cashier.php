<?php
include('database/connection.php');

if (isset($_SESSION['user']) && $_SESSION['user'] != '') {
    // Execute command at this page
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Aida Station</title>
        <link rel="stylesheet" href="css/styles.css">
    </head>
    <body>
        <div class="container">
            <header class="header">
                <h1>Selamat Datang Ke Aida Station</h1>
                <nav>
                    <ul>
                        <li><a href="staff.php">Menu</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </nav>
            </header>

            <div class="main-content">
                <section class="table-selection">
                    <h2>Pilih Meja</h2>
                    <div class="table-grid">
                        <!-- Add table links from 1 to 27 -->
                        <a href="order.php?table=1" class="table-number">1</a>
                        <a href="order.php?table=2" class="table-number">2</a>
                        <a href="order.php?table=3" class="table-number">3</a>
                        <a href="order.php?table=4" class="table-number">4</a>
                        <a href="order.php?table=5" class="table-number">5</a>
                        <a href="order.php?table=6" class="table-number">6</a>
                        <a href="order.php?table=7" class="table-number">7</a>
                        <a href="order.php?table=8" class="table-number">8</a>
                        <a href="order.php?table=9" class="table-number">9</a>
                        <a href="order.php?table=10" class="table-number">10</a>
                        <a href="order.php?table=11" class="table-number">11</a>
                        <a href="order.php?table=12" class="table-number">12</a>
                        <a href="order.php?table=13" class="table-number">13</a>
                        <a href="order.php?table=14" class="table-number">14</a>
                        <a href="order.php?table=15" class="table-number">15</a>
                        <a href="order.php?table=16" class="table-number">16</a>
                        <a href="order.php?table=17" class="table-number">17</a>
                        <a href="order.php?table=18" class="table-number">18</a>
                        <a href="order.php?table=19" class="table-number">19</a>
                        <a href="order.php?table=20" class="table-number">20</a>
                        <a href="order.php?table=21" class="table-number">21</a>
                        <a href="order.php?table=22" class="table-number">22</a>
                        <a href="order.php?table=23" class="table-number">23</a>
                        <a href="order.php?table=24" class="table-number">24</a>
                        <a href="order.php?table=25" class="table-number">25</a>
                        <a href="order.php?table=26" class="table-number">26</a>
                        <a href="order.php?table=27" class="table-number">27</a>
                    </div>
                    <br>
                <br>
                <br>
                <br>
                <br>
                </section>
                <a href="staff.php" class="button">Kembali</a>
            </div>
        </div>
    </body>
    </html>
    <?php
} else {
    header('Location: login.php');
    exit();
}
?>
