<?php
include('database/connection.php'); // Connect to the database

$orderSuccess = false; // Variable to track if the order was successful

// Initialize the cart if it's not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Clear the cart functionality when the back button is clicked
if (isset($_GET['clear_cart'])) {
    $_SESSION['cart'] = []; // Clear the cart
}

// Add to cart functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_to_cart'])) {
    $menuItemId = intval($_POST['menu_item_id']);
    $tableNumber = intval($_POST['table_number']);

    // Check if the item already exists in the cart
    if (isset($_SESSION['cart'][$menuItemId])) {
        $_SESSION['cart'][$menuItemId]['quantity'] += 1; // Increase quantity if already in the cart
    } else {
        // Fetch menu item details
        $sqlMenuItem = "SELECT * FROM menu WHERE id = $menuItemId";
        $resultMenuItem = $con->query($sqlMenuItem);
        if ($resultMenuItem->num_rows > 0) {
            $menuItem = $resultMenuItem->fetch_assoc();
            // Add the item to the cart
            $_SESSION['cart'][$menuItemId] = [
                'name' => $menuItem['name'],
                'price' => $menuItem['price'],
                'quantity' => 1
            ];
        }
    }
}

// Adjust quantity functionality
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['decrease_quantity'])) {
        $removeItemId = intval($_POST['remove_item_id']);
        // Decrease quantity or remove item if quantity is 1
        if (isset($_SESSION['cart'][$removeItemId])) {
            if ($_SESSION['cart'][$removeItemId]['quantity'] > 1) {
                $_SESSION['cart'][$removeItemId]['quantity'] -= 1; // Decrease quantity
            } else {
                unset($_SESSION['cart'][$removeItemId]); // Remove item if quantity is 1
            }
        }
    }

    if (isset($_POST['increase_quantity'])) {
        $increaseItemId = intval($_POST['remove_item_id']);
        // Increase quantity
        if (isset($_SESSION['cart'][$increaseItemId])) {
            $_SESSION['cart'][$increaseItemId]['quantity'] += 1; // Increase quantity
        }
    }
}

// Fetch menu items
$sqlMenu = "SELECT * FROM menu"; // SQL query to fetch all menu items
$resultMenu = $con->query($sqlMenu);

// Fetch categories
$categories = ['Makanan', 'Minuman', 'Set']; // Define menu categories

// Check if a table number is set and calculate cart count
$tableNumberSet = isset($_GET['table_number']);
$cartCount = count($_SESSION['cart']); // Count items in cart 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link rel="stylesheet" href="css/menu.css"> <!-- Link to CSS file -->
    <style>
        /* Add your CSS styles here */
        .header-container {
            display: flex; /* Use flexbox to align items */
            justify-content: center; /* Center the items horizontally */
            align-items: center; /* Center the items vertically */
            margin-bottom: 20px; /* Add some space below the header */
        }

        .header-container h2 {
            margin: 0; /* Remove default margin */
            margin-left: 250px;
        }

        .cart-button {
            background: none;
            border: none;
            cursor: pointer;
            position: relative;
            display: inline-block; /* Ensure it aligns with the heading */
            vertical-align: middle; /* Align vertically with the heading */
            margin-left: 200px; /* Add margin to the left to move the button to the right */
        }

        .cart-button img {
            width:  30px; /* Adjust the size as needed */
            height: auto;
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -10px;
            background-color: red;
            color: white;
            border-radius: 50%;
            padding: 2px 5px;
            font-size: 12px;
        }

        /* Modal styles */
        /* Modal overlay */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1000; /* Sit on top */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            background-color: rgba(0, 0, 0, 0.4); /* Black with opacity */
        }

        /* Modal content */
        .modal-content {
            position: absolute; /* Position it relative to the modal */
            top: 50%; /* Center vertically */
            left: 50%; /* Center horizontally */
            transform: translate(-50%, -50%); /* Adjust for centering */
            background-color: #fff; /* White background for the content */
            margin: 0; /* Remove default margin */
            padding: 20px; /* Add padding */
            border-radius: 8px; /* Rounded corners */
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2); /* Subtle shadow */
            max-width: 600px; /* Max width for larger screens */
            width: 80%; /* Responsive width */
            overflow-y: auto; /* Enable scrolling if content is too long */
            max-height: 80vh; /* Limit height to 80% of viewport height */
        }

        .modal img {
            width: 100%; /* Ensure images take full width of the modal */
            height: auto; /* Maintain aspect ratio */
            max-height: 300px; /* Optionally limit the height of the image */
            border-radius: 4px; /* Rounded corners */
        }

        .close-modal {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close-modal:hover,
        .close-modal:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
    </style>
    <script>
        function toggleCart() {
            const cartModal = document.getElementById('cart-modal');
            cartModal.style.display = cartModal.style.display === 'none' || cartModal.style.display === '' ? 'block' : 'none'; // Toggle visibility of cart modal
        }

        function showModal(menuItemId) {
            const modal = document.getElementById('modal-' + menuItemId);
            if (modal) {
                modal.style.display = 'block'; // Show the modal
            }
        }

        function closeModal(menuItemId) {
            const modal = document.getElementById('modal-' + menuItemId);
            if (modal) {
                modal.style.display = 'none'; // Hide the modal
            }
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const modals = document.querySelectorAll('.modal'); // Get all modals
            modals.forEach(modal => {
                if (event.target === modal) {
                    modal.style.display = "none"; // Hide the modal if clicked outside
                }
            });
        }

        // Adjust quantity functionality using AJAX
        document.querySelectorAll('.quantity-btn').forEach(button => {
            button.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default form submission
                const form = this.closest('form'); // Get the closest form
                const formData = new FormData(form); // Create FormData object

                // Use fetch to send the form data via AJAX
                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    // Update the cart modal content
                    document.getElementById('cart-modal').innerHTML = data; // Update cart modal content
                })
                .catch(error => console.error('Error:', error));
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>SELAMAT DATANG KE AIDA STATION</h1>
            <img src="images/logo.png" alt="Aida Station Logo" class="header-logo" style="width: 150px; margin-top: 10px;">

            <form method="GET" action="">
                <label for="table_number">  Table:</label>
                <input type="number" name="table_number" id="table_number" required>
                <button type="submit">Select</button>
            </form>

            <!-- Back button with clear cart -->
            <form method="GET" action="" style="display:inline;">
                <button type ="submit" name="clear_cart" class="back-btn">Back</button>
            </form>

            <br>

        </header>

       <!-- Cart Modal -->
       <div id="cart-modal" class="modal">
            <div class="modal-content">
                <span class="close-modal" onclick="toggleCart()">×</span>
                <h2>Your Cart</h2>
                <?php if ($cartCount > 0): ?>
                    <ul>
                        <?php foreach ($_SESSION['cart'] as $id => $item): ?>
                            <li class="cart-item">
                                <?php echo htmlspecialchars($item['name']); ?> - 
                                RM<?php echo htmlspecialchars($item['price']); ?> 
                                <form method="POST" action="" style="display:inline;">
                                    <input type="hidden" name="remove_item_id" value="<?php echo $id; ?>">
                                    <button type="submit" name="decrease_quantity" class="quantity-btn">-</button>
                                    <span class="quantity-display">x<?php echo htmlspecialchars($item['quantity']); ?></span>
                                    <button type="submit" name="increase_quantity" class="quantity-btn">+</button>
                                </form>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                   <!-- In menu.php, in the cart modal section -->
<form method="POST" action="receipt.php">
    <input type="hidden" name="table_number" value="<?php echo isset($_GET['table_number']) ? intval($_GET['table_number']) : 0; ?>">
    <button type="submit" name="checkout" class="checkout-btn">Checkout</button>
</form>
                <?php else: ?>
                    <p>Your cart is empty.</p>
                <?php endif; ?>
            </div>
        </div>

        <!-- Main Menu Content -->
        <div class="main-content">
            <?php if ($tableNumberSet): // Check if table number is set ?>
                <div class="header-container">
                    <h2>Table <?php echo intval($_GET['table_number']); ?></h2>

                    <!-- Cart Button -->
                    <button type="button" class="cart-button" onclick="toggleCart()">
                        <img src="images/cart-icon.png" alt="Cart Icon">
                        <span class="cart-count"><?php echo $cartCount > 0 ? $cartCount : '0'; ?></span> <!-- Show '0' if cart is empty -->
                    </button>
                </div>

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
                                    <button class="detail-btn" onclick="showModal(<?php echo $menuItem['id']; ?>)">Detail</button>
                                    <form method="POST" action="">
                                        <input type="hidden" name="menu_item_id" value="<?php echo $menuItem['id']; ?>">
                                        <input type="hidden" name="table_number" value="<?php echo intval($_GET['table_number']); ?>">
                                        <button type="submit" name="add_to_cart">Add to Cart</button>
                                    </form>
                                </div>

                                <!-- Modal for showing menu details -->
                                <div id="modal-<?php echo $menuItem['id']; ?>" class="modal">
                                    <div class="modal-content">
                                        <span class="close-modal" onclick="closeModal(<?php echo $menuItem['id']; ?>)">×</span>
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
                            echo "<p>No items available in this category.</p>";
                        }
                        ?>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <h2>Please select a table number to view the menu.</h2>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>