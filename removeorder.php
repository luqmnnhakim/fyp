<?php
include('database/connection.php');

if ($_SESSION['user'] != '') {
    if (isset($_GET['cid'])) {
        $orderId = intval($_GET['cid']); // Sanitize input
        $sqlDelete = "DELETE FROM staff WHERE orid = ?";
        
        if ($stmt = $con->prepare($sqlDelete)) {
            $stmt->bind_param("i", $orderId); // Bind the order ID
            if ($stmt->execute()) {
                // Successfully deleted
                header('Location: orderdetail.php'); // Redirect after successful deletion
                exit();
            } else {
                // Handle error
                echo "Error: Could not execute the delete query.";
            }
            $stmt->close();
        } else {
            echo "Error: Could not prepare the delete query.";
        }
    }
} else {
    header('location:login.php');
}
?>