<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    if (isset($_POST['add'])) {
        // Get form data
        $type = $_POST['type'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $description = $_POST['description']; // Get description from form
        $image = $_FILES['image'];

        // Handle the image upload
        $targetDir = "uploads/"; // Ensure this directory exists
        $targetFile = $targetDir . basename($image["name"]);
        $uploadOk = 1;

        // Check if image file is an actual image
        $check = getimagesize($image["tmp_name"]);
        if ($check === false) {
            echo "Ini Bukan Gambar.";
            $uploadOk = 0;
        }

        // Additional validations can go here...

        // If everything is ok, try to upload file
        if ($uploadOk == 0) {
            echo "Sorry, Please try again.";
        } else {
            if (move_uploaded_file($image["tmp_name"], $targetFile)) {
                // Insert into menu table, including the description
                $sqlInsert = "INSERT INTO menu (category, name, price, description, image) VALUES ('$type', '$name', '$price', '$description', '$targetFile')";
                
                if ($con->query($sqlInsert) === TRUE) {
                    header("Location: menudata.php?added=yes"); // Redirect to menudata.php with 'added' parameter
                    exit; // Always use exit after a header redirect
                } else {
                    echo "Error: " . $con->error;
                }
            } else {
                echo "Sorry, Please try again.";
            }
        }
    }
} else {
    header('location:login.php');
}
?>
