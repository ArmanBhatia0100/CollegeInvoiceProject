<?php

// Fetch invoices
try {
    $stmt = $pdo->prepare($query);
    $stmt->execute($params);
    $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $invoice_count = count($invoices);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

// Fetch users
try {
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();
}

?>