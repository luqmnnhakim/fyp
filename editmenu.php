<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    $id = $_GET['cid']; // Variable from the URL
    $cmddisplay = "SELECT * FROM menu WHERE id='$id'";
    $resultdisplay = $con->query($cmddisplay);
    $data = $resultdisplay->fetch_assoc();

    // Check if the menu item has been updated
    $menuUpdated = isset($_GET['updated']) && $_GET['updated'] == 'yes';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Menu</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
<body class="body-menuform">
    <div class="form-containerform">
        <h2 class="h2-menuform">Edit Menu</h2>
        <form method="post" action="editmenuprocess.php" enctype="multipart/form-data">
            <input type="hidden" name="menuid" value="<?= $data['id']; ?>" />
            <div class="form-groupform">
                <label for="type">Category</label>
                <select name="type" required>
                    <option value="makanan" <?= $data['category'] == 'makanan' ? 'selected' : ''; ?>>Makanan</option>
                    <option value="minuman" <?= $data['category'] == 'minuman' ? 'selected' : ''; ?>>Minuman</option>
                    <option value="set" <?= $data['category'] == 'set' ? 'selected' : ''; ?>>Set</option>
                </select>
            </div>
            <div class="form-groupform">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Enter menu name" value="<?= $data['name']; ?>" required>
            </div>
            <div class="form-groupform">
                <label for="price">Price</label>
                <input type="text" name="price" placeholder="Enter price" value="<?= $data['price']; ?>" required>
            </div>
            <div class="form-groupform">
                <label for="description">Description</label>
                <textarea name="description" placeholder="Enter description" rows="4" required><?= htmlspecialchars($data['description']); ?></textarea>
            </div>
            <div class="form-groupform">
                <label for="image">Picture</label>
                <input type="file" name="image" accept="image/*">
            </div>
            <div class="form-groupform">
                <button type="submit" name="edit">Edit</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php
} else {
    header('location:login.php');
}
?>
