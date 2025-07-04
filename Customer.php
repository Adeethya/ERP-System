<?php

if ($con->query($sql) === TRUE) {
    header("Location: success.php");
    exit(); //  Stop further code
}
// Enable detailed error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Only handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    // Step 1: Connect to the database
    $con = new mysqli('localhost', 'root', '', 'erp_system');

    if ($con->connect_error) {
        die('Connection failed: ' . $con->connect_error);
    }

    // Step 2: Collect input values (sanitization not needed with prepared statements)
    $title          = $_POST['title'] ?? '';
    $first_name     = $_POST['first_name'] ?? '';
    $last_name      = $_POST['last_name'] ?? '';
    $contact_number = $_POST['contact_number'] ?? '';
    $district       = $_POST['district'] ?? '';

    // Step 3: Prepare the SQL statement
    $stmt = $con->prepare(
        "INSERT INTO customers (title, first_name, last_name, contact_number, district)
         VALUES (?, ?, ?, ?, ?)"
    );

    if (!$stmt) {
        die('Prepare failed: ' . $con->error);
    }

    // Step 4: Bind the form values
    $stmt->bind_param('sssss', $title, $first_name, $last_name, $contact_number, $district);

    // Step 5: Execute and check result
    if ($stmt->execute()) {
        echo "Customer registered successfully!<br>";
        echo '<a href="Customer_form.html">Add Another Customer</a>';
    } else {
        echo " Insert failed: " . $stmt->error;
    }

    // Step 6: Close the statement and connection
    $stmt->close();
    $con->close();
}
?>