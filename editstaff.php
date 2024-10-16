<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    $id = $_GET['cid']; // Variable from the URL
    $cmddisplay = "SELECT * FROM admin_info WHERE adid='$id'";
    $resultdisplay = $con->query($cmddisplay);
    $data = $resultdisplay->fetch_assoc();

    // If form is submitted, update the details
    if (isset($_POST['update'])) {
        $name = $_POST['name'];
        $ic = $_POST['ic'];
        $gender = $_POST['gender'];
        $email = $_POST['email'];
        $address = $_POST['address'];

        $cmdUpdate = "UPDATE admin_info SET adname='$name', adic='$ic', adgender='$gender', ademail='$email', address='$address' WHERE adid='$id'";
        if ($con->query($cmdUpdate) === TRUE) {
            echo "<script>
                alert('Staff details updated successfully.');
                window.location.href='viewstaff.php?cid=$id&edit=yes';
            </script>";
        } else {
            echo "<script>alert('Error updating record: " . $con->error . "');</script>";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff Details</title>
    <link rel="stylesheet" href="css/edit.css">
</head>
<body>
    <h1>Edit Staff Details</h1>
    <form action="" method="POST" class="edit-staff-form">
        <div class="edit-form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?= htmlspecialchars($data['adname']); ?>" required>
        </div>
        <div class="edit-form-group">
            <label for="ic">IC No</label>
            <input type="text" id="ic" name="ic" value="<?= htmlspecialchars($data['adic']); ?>" required>
        </div>
        <div class="edit-form-group">
            <label for="gender">Gender</label>
            <select id="gender" name="gender" required>
                <option value="M" <?= $data['adgender'] == 'M' ? 'selected' : ''; ?>>Male</option>
                <option value="F" <?= $data['adgender'] == 'F' ? 'selected' : ''; ?>>Female</option>
            </select>
        </div>
        <div class="edit-form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?= htmlspecialchars($data['ademail']); ?>" required>
        </div>
        <div class="edit-form-group">
            <label for="address">Address</label>
            <textarea id="address" name="address" rows="4" required><?= htmlspecialchars($data['address']); ?></textarea>
        </div>
        <div class="edit-form-actions">
            <button type="submit" name="update">Update</button>
            <a href="viewstaff.php?cid=<?= $id; ?>" class="edit-cancel-btn">Cancel</a>
        </div>
    </form>
</body>
</html>

<?php
} else {
    header('location:login.php');
}
?>
