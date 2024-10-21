<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    // Prepare the SQL query to fetch sales records
    $sqldisplay = "SELECT * FROM sales ORDER BY salesdate DESC";
    $resultdisplay = $con->query($sqldisplay);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rekod Jualan</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="body-sales">
    <div class="sales-container">
        <h2 class="h2-sales">Rekod Jualan</h2>
        <table class="table-sales">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tarikh</th>
                    <th>Jumlah Jualan</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($resultdisplay->num_rows > 0) {
                    $count = 1;
                    while ($value = $resultdisplay->fetch_assoc()) {
                ?>
                <tr>
                    <td><?= $count; ?></td>
                    <td><?= htmlspecialchars($value['salesdate']); ?></td>
                    <td><?= htmlspecialchars($value['salestotal']); ?></td>
                    <td>
                        <div class="button-container">
                            <button class="view-btnSales" onclick="window.location.href='viewsales.php?cid=<?= $value['salesid']; ?>';">Lihat</button>
                            <button class="remove-btnSales" onclick="if(confirm('Adakah Anda Pasti Dengan Pilihan Anda?')) { window.location.href='removesales.php?cid=<?= $value['salesid']; ?>'; }">Buang</button>
                        </div>
                    </td>
                </tr>
                <?php
                    $count++;
                    }
                } else {
                    echo "<tr><td colspan='4'>No record found in the table</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php
} else {
    header('location:login.php');
}
?>
