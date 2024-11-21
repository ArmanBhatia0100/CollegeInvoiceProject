<?php
require_once '../database/db_connection.php';

var_dump("hello");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && is_numeric($_POST['id'])) {
    try {
        $stmt = $pdo->prepare("DELETE FROM invoices WHERE id = ?");
        $response = $stmt->execute([$_POST['id']]);

        if ($response) {
            http_response_code(200);
            echo "Success";
        } else {
            http_response_code(404);
            echo "Invoice not found";
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo "Error: " . $e->getMessage();
    }
} else {
    http_response_code(400);
    echo "Invalid request";
}

?>