<?php
$con = new mysqli("localhost", "root", "", "erp_system");
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    $sql = "DELETE FROM items WHERE id='$id'";
    if ($con->query($sql)) {
        echo " Item deleted successfully.";
    } else {
        echo " Error: " . $con->error;
    }
}
?>
