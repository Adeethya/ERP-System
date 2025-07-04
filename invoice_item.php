<?php
if(!isset($_GET['start_date']) || !isset($_GET['end_date'])) {
    echo '<tr><td colspan="7">Please select a date range and search.</td></tr>';
    return;
}

$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

$host = "localhost";
$username = "root";
$password = "";
$dbname = "erp_system";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: ".$conn->connect_error);
}

$sql = "
SELECT
  invoices.invoice_number,
  invoices.date,
  customers.first_name,
  customers.last_name,
  items.item_name,
  items.item_code,
  items.category,
  invoice_items.unit_price
FROM invoice_items
JOIN invoices ON invoice_items.invoice_id = invoices.id
JOIN customers ON invoices.customer_id = customers.id
JOIN items ON invoice_items.item_id = items.id
WHERE invoices.date BETWEEN ? AND ?
ORDER BY invoices.date DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

if($result->num_rows === 0) {
    echo '<tr><td colspan="7">No records found for selected date range.</td></tr>';
} else {
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".htmlspecialchars($row['invoice_number'])."</td>";
        echo "<td>".htmlspecialchars($row['date'])."</td>";
        echo "<td>".htmlspecialchars($row['first_name']." ".$row['last_name'])."</td>";
        echo "<td>".htmlspecialchars($row['item_name'])."</td>";
        echo "<td>".htmlspecialchars($row['item_code'])."</td>";
        echo "<td>".htmlspecialchars($row['category'])."</td>";
        echo "<td>".number_format($row['unit_price'], 2)."</td>";
        echo "</tr>";
    }
}

$stmt->close();
$conn->close();
?>
