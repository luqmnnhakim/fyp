<?php
include('database/connection.php'); // Connect to the database

$orderSuccess = false; // Variable to track if the order was successful

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process order submission
    if (isset($_POST['order_now'])) {
        $tableNumber = intval($_POST['table_number']); // Get table number from the form
        $menuItemId = intval($_POST['menu_item_id']); // Get the menu item ID from the form
        
        // Retrieve the menu item details to store
        $sqlMenuItem = "SELECT * FROM menu WHERE id = $menuItemId"; // SQL query to get menu item
        $resultMenuItem = $con->query($sqlMenuItem);

        if ($resultMenuItem->num_rows > 0) {
            $menuItem = $resultMenuItem->fetch_assoc();
            $orname = $menuItem['name']; // Get the menu item name
            $totalprice = $menuItem['price']; // Get the menu item price

            // Insert into staff table
            $sqlInsertOrder = "INSERT INTO staff (ortable, orname, totalprice, ordate) VALUES ($tableNumber, '$orname', $totalprice, NOW())"; // SQL to insert order

            if ($con->query($sqlInsertOrder) === TRUE) {
                $orderSuccess = true; // Set success to true if order is placed successfully
            } else {
                echo "Error: " . $con->error; // Handle SQL error
            }
        } else {
            echo "Menu item not found."; // Handle case when menu item is not found
        }
    }
}

// Fetch menu items
$sqlMenu = "SELECT * FROM menu"; // SQL query to fetch all menu items
$resultMenu = $con->query($sqlMenu);

// Fetch categories
$categories = ['Makanan', 'Minuman', 'Set']; // Define menu categories
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/menu.css"> <!-- Link to CSS file -->

    <script>
        function showPopup() {
            var popup = document.getElementById('order-popup');
            popup.style.display = 'block'; // Show the popup
            setTimeout(function() {
                popup.style.display = 'none'; // Hide after 3 seconds
            }, 3000);
        }

        function showModal(id) {
            var modal = document.getElementById('modal-' + id);
            modal.style.display = 'flex'; // Show the modal
        }

        function closeModal(id) {
            var modal = document.getElementById('modal-' + id);
            modal.style.display = 'none'; // Hide the modal
        }
    </script>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>SELAMAT DATANG KE AIDA STATION</h1>
            <br>
            <form method="GET" action="">
                <label for="table_number">Nombor Meja:</label>
                <input type="number" name="table_number" id="table_number" required>
                <button type="submit">Pilih</button>
            </form>
        </header>

        <div class="main-content">
            <?php if (isset($_GET['table_number'])): // Check if table number is set ?>
                <h2>Table <?php echo intval($_GET['table_number']); ?></h2>
                <?php foreach ($categories as $category): // Loop through each category ?>
                    <h3><?php echo $category; ?></h3>
                    <div class="menu-items">
                        <?php
                        // Query to get menu items by category
                        $sqlCategoryMenu = "SELECT * FROM menu WHERE category = '$category'";
                        $resultCategoryMenu = $con->query($sqlCategoryMenu);
                        
                        if ($resultCategoryMenu->num_rows > 0) {
                            while ($menuItem = $resultCategoryMenu->fetch_assoc()): // Loop through menu items
                        ?>
                                <div class="menu-item">
                                    <img src="<?php echo htmlspecialchars($menuItem['image']); ?>" alt="<?php echo htmlspecialchars($menuItem['name']); ?>">
                                    <p><strong><?php echo htmlspecialchars($menuItem['name']); ?></strong></p>
                                    <p>Price: RM<?php echo htmlspecialchars($menuItem['price']); ?></p>
                                    <br>
                                    <button class="detail-btn" onclick="showModal(<?php echo $menuItem['id']; ?>)">Detail</button>
                                    <form method="POST" action="">
                                        <input type="hidden" name="table_number" value="<?php echo intval($_GET['table_number']); ?>">
                                        <input type="hidden" name="menu_item_id" value="<?php echo $menuItem['id']; ?>">
                                        <button type="submit" name="order_now" class="order-btn">Order Now</button>
                                    </form>
                                </div>

                                <!-- Modal for showing menu details -->
                                <div id="modal-<?php echo $menuItem['id']; ?>" class="modal">
                                    <div class="modal-content">
                                        <button class="close-modal" onclick="closeModal(<?php echo $menuItem['id']; ?>)">×</button>
                                        <h2><?php echo htmlspecialchars($menuItem['name']); ?></h2>
                                        <img src="<?php echo htmlspecialchars($menuItem['image']); ?>" alt="<?php echo htmlspecialchars($menuItem['name']); ?>" style="width: 100%; height: auto;">
                                        <p><strong>Category:</strong> <?php echo htmlspecialchars($menuItem['category']); ?></p>
                                        <p><strong>Price:</strong> RM<?php echo htmlspecialchars($menuItem['price']); ?></p>
                                        <p><strong>Keterangan:</strong> <?php echo htmlspecialchars($menuItem['description']); ?></p>
                                    </div>
                                </div>
                        <?php
                            endwhile;
                        } else {
                            echo "<p>No items available in this category.</p>"; // Handle empty category
                        }
                        ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <!-- Popup Notification -->
    <div id="order-popup" class="popup" style="<?php echo $orderSuccess ? 'display: block;' : ''; ?>">
        Your order has been successfully added!
    </div>

    <script>
        // Show the popup if the order was successful
        <?php if ($orderSuccess): ?>
            showPopup();
        <?php endif; ?>
    </script>
</body>
</html>
