<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "erp_system";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$item_code = $_POST['item_code'];
$item_name = $_POST['item_name'];
$category = $_POST['category'];
$sub_category = $_POST['sub_category'];
$quantity = $_POST['quantity'];
$unit_price = $_POST['unit_price'];

// Insert data into the table
$sql = "INSERT INTO items (item_code, item_name, category, sub_category, quantity, unit_price)
        VALUES ('$item_code', '$item_name', '$category', '$sub_category', '$quantity', '$unit_price')";

if ($conn->query($sql) === TRUE) {
    echo "Item added successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>

