<?php
include('database/connection.php');
if($_SESSION['user']!=''){
    //execute command at this page

$sqldisplay="SELECT * FROM admin_info";
$resultdisplay=$con->query($sqldisplay);

if($resultdisplay->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Staff</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="body-sales">

    <div class="sales-container">
        <h2 class="h2-sales">Maklumat Staff </h2>
        <table class="table-sales">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Pengguna</th>
                    <th>KataLaluan</th>
                    <th>Kategori</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            $count = 1;
            while($value=$resultdisplay->fetch_assoc()) {
            ?>
            <tbody>
                <tr>
                    <td><?= $count; ?></td>
                    <td><?= $value['adusername']; ?></td>
                    <td><?= $value['adpassword']; ?></td>
                    <td><?= $value['usercat']; ?></td>
                    <td>
                    <div class="button-container">
        <button class="view-btnSales" onclick="window.location.href='viewstaff.php?cid=<?= $value['adid']; ?>';">Lihat</button>
        <button class="remove-btnSales" onclick="if(confirm('Adakah Anda Pasti Dengan Pilihan Anda?')) { window.location.href='removestaff.php?cid=<?= $value['adid']; ?>'; }">Buang</button>

    </div>
 </td>

                </tr>
                <!-- More rows can be added here -->
            </tbody>
    <?php
    $count++;
       }
}   else{
    echo "No record found in the table";
}
?>
        </table>
    </div>

</body>
</html>
<?php
}
else{
    header('location:login.php');
}
?>