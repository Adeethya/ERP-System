<?php
$con = new mysqli("localhost", "root", "", "erp_system");
$result = $con->query("SELECT * FROM items");
while ($row = $result->fetch_assoc()) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['item_code']}</td>
            <td>{$row['item_name']}</td>
            <td>{$row['category']}</td>
            <td>{$row['sub_category']}</td>
            <td>{$row['quantity']}</td>
            <td>{$row['unit_price']}</td>
            <td><button onclick=\"alert('Viewing Item ID: {$row['id']}')\">View</button></td>
          </tr>";
}
$con->close();
?>
