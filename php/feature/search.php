<?php // Initialize search/filter parameters
$where_conditions = [];
$params = [];

// Handle search and filter parameters
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['invoice_id'])) {
        $where_conditions[] = "invoice_id LIKE ?";
        $params[] = '%' . $_POST['invoice_id'] . '%';
    }
    if (!empty($_POST['client_name'])) {
        $where_conditions[] = "client_name LIKE ?";
        $params[] = '%' . $_POST['client_name'] . '%';
    }
    if (!empty($_POST['status'])) {
        $where_conditions[] = "status = ?";
        $params[] = $_POST['status'];
    }

}

// Build the query
$query = "SELECT * FROM invoices";
if (!empty($where_conditions)) {
    $query .= " WHERE " . implode(" AND ", $where_conditions);
}
$query .= " ORDER BY due_date DESC";
?>