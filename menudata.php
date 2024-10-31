<?php
include('database/connection.php');
if ($_SESSION['user'] != '') {
    // Execute command at this page
    $sqldisplay = "SELECT * FROM menu";
    $resultdisplay = $con->query($sqldisplay);

    if ($resultdisplay->num_rows > 0) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Data</title>
    <link rel="stylesheet" href="css/admin.css">
    <style>
        /* Popup styles */
        .popup {
            display: none;
            position: fixed;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
            padding: 20px;
            background-color: #28a745;
            color: white;
            border-radius: 5px;
            z-index: 1000;
        }
    </style>
    <script>
        function showPopup(message) {
            var popup = document.getElementById('update-popup');
            popup.innerText = message; // Set the message
            popup.style.display = 'block'; // Show the popup
            setTimeout(function() {
                popup.style.display = 'none'; // Hide after 3 seconds
            }, 3000);
        }
    </script>
</head>
<body class="body-menudata">

    <div class="menu-data-container">
        <h2 class="h2-menudata">Menu Data</h2>
        <table class="table-menudata">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Category</th>
                    <th>Name</th>
                    <th>Price (RM)</th>
                    <th></th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            $count = 1;
            while ($value = $resultdisplay->fetch_assoc()) {
            ?>
            <tbody>
                <tr>
                    <td><?= $count; ?></td>
                    <td><?= $value['category']; ?></td>
                    <td><?= $value['name']; ?></td>
                    <td><?= $value['price']; ?></td>
                    <td></td>
                    <td>
                        <button class="edit-btn" onclick="window.location.href='editmenu.php?cid=<?= $value['id']; ?>';">Edit</button>
                        <button class="remove-btn" onclick="if(confirm('Are you sure you want to proceed?')) { window.location.href='removemenu.php?cid=<?= $value['id']; ?>'; }">Delete</button>
                    </td>
                </tr>
            </tbody>
            <?php
                $count++;
            }
            ?>
        </table>
    </div>

    <!-- Popup Notification -->
    <div id="update-popup" class="popup" style="<?php echo (isset($_GET['added']) || isset($_GET['updated'])) ? 'display: block;' : 'display: none;'; ?>">
        <?php
            if (isset($_GET['added'])) {
                echo 'Menu has been added!';
            } elseif (isset($_GET['updated'])) {
                echo 'Menu has been updated!';
            }
        ?>
    </div>

    <script>
        // Show the popup based on the action
        <?php if (isset($_GET['added'])): ?>
            showPopup('Menu has been added!');
        <?php elseif (isset($_GET['updated'])): ?>
            showPopup('Menu has been updated!');
        <?php endif; ?>
    </script>

</body>
</html>
<?php
    } else {
        echo "No orders have been made.";
    }
} else {
    header('location:login.php');
}
?>
