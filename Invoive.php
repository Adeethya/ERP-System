<?php
// DB connection
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "erp_system";

$conn = new mysqli($host, $user, $pass, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get dates from GET params, sanitize
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

if (!$start_date || !$end_date) {
    echo "<tr><td colspan='6'>Please select date range and click Search.</td></tr>";
    exit;
}

// Prepare SQL to fetch invoices with joined customer & item count & invoice amount
$sql = "
SELECT
  invoices.invoice_number,
  invoices.date,
  CONCAT(customers.title, ' ', customers.first_name, ' ', customers.last_name) AS customer_name,
  customers.district,
  COUNT(invoice_items.id) AS item_count,
  SUM(invoice_items.quantity * invoice_items.unit_price) AS invoice_amount
FROM invoices
JOIN customers ON invoices.customer_id = customers.id
LEFT JOIN invoice_items ON invoices.id = invoice_items.invoice_id
WHERE invoices.date BETWEEN ? AND ?
GROUP BY invoices.id
ORDER BY invoices.date DESC
";

$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $start_date, $end_date);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 0) {
    echo "<tr><td colspan='6'>No invoices found in this date range.</td></tr>";
} else {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>" . htmlspecialchars($row['invoice_number']) . "</td>
            <td>" . htmlspecialchars($row['date']) . "</td>
            <td>" . htmlspecialchars($row['customer_name']) . "</td>
            <td>" . htmlspecialchars($row['district']) . "</td>
            <td>" . $row['item_count'] . "</td>
            <td>$" . number_format($row['invoice_amount'], 2) . "</td>
        </tr>";
    }
}

$stmt->close();
$conn->close();
?>
