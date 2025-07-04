<?php
$con = new mysqli("localhost", "root", "", "erp_system");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $category = $_POST['category'];
    $sub_category = $_POST['sub_category'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    $sql = "UPDATE items SET item_code='$item_code', item_name='$item_name', category='$category', sub_category='$sub_category', quantity='$quantity', unit_price='$unit_price' WHERE id='$id'";

    if ($con->query($sql)) {
        echo " Item updated successfully.";
    } else {
        echo " Error: " . $con->error;
    }
}
?>
