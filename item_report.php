<?php
$host = "localhost";
$username = "root";
$password = "";
$dbname = "erp_system";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "
SELECT item_name, category, sub_category, SUM(quantity) AS total_quantity
FROM items
GROUP BY item_name, category, sub_category
ORDER BY item_name ASC
";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['item_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['category']) . "</td>";
        echo "<td>" . htmlspecialchars($row['sub_category']) . "</td>";
        echo "<td>" . intval($row['total_quantity']) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No items found</td></tr>";
}

$conn->close();
?>
