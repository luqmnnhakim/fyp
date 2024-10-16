<?php
include('database/connection.php');

if (isset($_POST['edit'])) {
    // Declare variables
    $id = $_POST['menuid']; // Hidden input
    $menutyp = $_POST['type'];
    $menunam = $_POST['name'];
    $menupric = $_POST['price'];

    // Input validation
    if (empty($menutyp) || empty($menunam) || empty($menupric)) {
        ?>
        <script>
            alert("Please insert all required info");
            window.location = 'editmenu.php?cid=<?= $id ?>';
        </script>
        <?php
    } else {
        // Update record in the menu_info table
        $sqledit = "UPDATE menu_info SET
            mentype = '$menutyp',
            menname = '$menunam',
            menprice = '$menupric'
            WHERE menuid = '$id'";
        $resultedit = $con->query($sqledit);

        if ($resultedit) {
            ?>
            <script>
                alert("Menu has been updated");
                window.location = 'menudata.php?edit=yes&menuid=<?= $id ?>';
            </script>
            <?php
        } else {
            echo "Error: " . $con->error;
        }
    }
} else {
    echo "error";
}
?>
