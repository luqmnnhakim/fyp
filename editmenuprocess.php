<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    if (isset($_POST['edit'])) {
        $id = $_POST['menuid'];
        $type = $_POST['type'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description'];
        $image = $_FILES['image'];

        // Handle image upload if a new image is uploaded
        if ($image['size'] > 0) { // New image uploaded
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($image["name"]);
            $uploadOk = 1;

            // Check if image file is an actual image
            $check = getimagesize($image["tmp_name"]);
            if ($check === false) {
                echo "File is not an image.";
                $uploadOk = 0;
            }

            // If everything is ok, try to upload file
            if ($uploadOk == 1) {
                if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                    // Update menu item with new image
                    $sqlUpdate = "UPDATE menu SET category='$type', name='$name', price='$price', description='$description', image='$targetFile' WHERE id='$id'";
                } else {
                    echo "Maaf, Sila Cuba Lagi.";
                }
            }
        } else { // No new image, keep the old one
            $sqlUpdate = "UPDATE menu SET category='$type', name='$name', price='$price', description='$description' WHERE id='$id'";
        }

        if ($con->query($sqlUpdate) === TRUE) {
            header("Location: menudata.php?updated=yes"); // Redirect to menudata.php with 'updated' parameter
            exit; // Always use exit after a header redirect
        } else {
            echo "Error: " . $con->error;
        }
    }
} else {
    header('location:login.php');
}
?>