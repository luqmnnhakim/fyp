<?php
include('database/connection.php');
//$_POST -super global variable
//if method(form)=post-> receive using $_POST[]
//if method(form)

if(isset($_POST['add']))
{
    
    //declare variable
    $menutyp = $_POST['type'];
    $menunam = $_POST['name'];
    $menupric = $_POST['price'];

    //input validation
    if(empty($menutyp) || empty($menunam) || empty($menupric))
    {
    ?>
    <script>
        alert("Please insert all required info");
        window.location='menuform.php';
    </script>
    <?php
    }
    else
    {
        //add record to the menu_info table
        $sqladd = "INSERT INTO menu_info (mentype, menname, menprice) VALUES ('$menutyp', '$menunam', '$menupric')";
        $resultadd = $con->query($sqladd);

        if($resultadd) {
            ?>
    <script>
        alert("Menu has been added");
    </script>
    <?php
            header('Location: menudata.php');
        } else {
            echo "Error: " . $con->error;
        }
    }
}
else
{
    echo "Please register first";
}
?>
