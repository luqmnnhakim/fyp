<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    // Execute command at this page
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        /* Add your styles here */
    </style>
</head>
<body class="body-menuform">
    <div class="form-containerform">
        <h2 class="h2-menuform">Tambah Menu Baru</h2>
        <form method="post" action="menuformprocess.php" enctype="multipart/form-data">
            <div class="form-groupform">
                <label for="type">Kategori</label>
                <select name="type" required>
                    <option value="makanan">Makanan</option>
                    <option value="minuman">Minuman</option>
                    <option value="set">Set</option>
                </select>
            </div>

            <div class="form-groupform">
                <label for="name">Nama</label>
                <input type="text" name="name" placeholder="Enter menu name" required>
            </div>

            <div class="form-groupform">
                <label for="price">Harga</label>
                <input type="text" name="price" placeholder="Enter price" required>
            </div>

            <div class="form-groupform">
                <label for="description">Description</label>
                <textarea name="description" placeholder="Enter description" rows="4" required></textarea>
            </div>

            <div class="form-groupform">
                <label for="image">Gambar</label>
                <input type="file" name="image" accept="image/*" required>
            </div>

            <div class="form-groupform">
                <button type="submit" name="add">Kemaskini</button>
            </div>
        </form>
    </div>
    
    <?php
    // Error message if fields are empty
    if (isset($_GET['empty']) && $_GET['empty'] == 'yes') {
        echo "<script>alert('Please enter all required info');</script>";
    }
    ?>
</body>
</html>
<?php
} else {
    header('location:login.php');
}
?>
