<?php
// save_invoice.php


// Set headers for JSON response
header('Content-Type: application/json');

// Database configuration
require "../db_connect.php";
try {
    // Get JSON data from the request
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);

    // Validate received data
    if (
        !isset($data['invoiceId']) || !isset($data['dueDate']) ||
        !isset($data['clientName']) || !isset($data['amount']) ||
        !isset($data['status'])
    ) {
        throw new Exception('Missing required fields');
    }
    // Prepare SQL statement
    $sql = "INSERT INTO invoices (invoice_id, due_date, client_name, amount, status) 
            VALUES (:invoice_id, :due_date, :client_name, :amount, :status)";

    $stmt = $pdo->prepare($sql);

    // Execute with parameters
    $success = $stmt->execute([
        ':invoice_id' => $data['invoiceId'],
        ':due_date' => $data['dueDate'],
        ':client_name' => $data['clientName'],
        ':amount' => $data['amount'],
        ':status' => $data['status']
    ]);

    if ($success) {
        echo json_encode(['success' => true, 'message' => 'Invoice saved successfully']);
    } else {
        throw new Exception('Failed to save invoice');
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>