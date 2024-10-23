<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    // Prepare the SQL query to fetch all orders
    $sqldisplay = "SELECT * FROM staff";
    $resultdisplay = $con->query($sqldisplay);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aida Station</title>
    <link rel="stylesheet" href="css/orderdetail.css">
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>ORDER DETAILS</h1>
        </header>

        <div class="main-content">
            <div class="orders-container">
                <?php
                // Check if there are any orders
                if ($resultdisplay->num_rows > 0) {
                    // Loop through each order and display the order card
                    while ($data = $resultdisplay->fetch_assoc()) {
                        ?>
                        <div class="order-card" onclick="selectOrder(<?= $data['orid']; ?>)">
                            <p>Meja: <?= htmlspecialchars($data['ortable']); ?></p>
                            <p>Nama Pesanan: <?= htmlspecialchars($data['orname']); ?></p>
                            <p>Tarikh Pesanan: <?= htmlspecialchars($data['ordate']); ?></p>
                            <!-- Removed the update button here -->
                        </div>
                        <?php
                    }
                } else {
                    echo "<p>Tiada Sebarang Pesanan Yang Masuk.</p>";
                }
                ?>
            </div>
        </div>

        <div class="buttons">
            <a href="removeorder.php?cid=" id="removeLink">
                <button class="btnCancel">BATAL</button>
            </a>
            <a href="staff.php" class="btnLink">
                <button class="btnBack-order">KEMBALI</button>
            </a>
            <a href="recent-order.php" class="btnLink">
                <button class="btnRecent-order">PESANAN LEPAS</button>
            </a>
        </div>

    </div>

    <script>
        let selectedOrderId = null;

        function selectOrder(orderId) {
            selectedOrderId = orderId;
            document.getElementById('removeLink').href = 'removeorder.php?cid=' + selectedOrderId;
        }
    </script>

</body>
</html>
<?php
} else {
    header('location:login.php');
}
?>
