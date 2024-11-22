<?php
// save_user.php

header('Content-Type: application/json');

// Create database connection
require "./../db_connect.php";

try {
    // Get JSON data from the request
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);

    // Validate received data
    if (!isset($data['fullName']) || !isset($data['email']) || !isset($data['password'])) {
        throw new Exception('Missing required fields');
    }

    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = :email");
    $stmt->execute([':email' => $data['email']]);

    if ($stmt->rowCount() > 0) {
        throw new Exception('Email already exists');
    }

    // Hash the password
    $hashedPassword = password_hash($data['password'], PASSWORD_DEFAULT);

    // Prepare SQL statement
    $sql = "INSERT INTO users (full_name, email, password, created_at) 
            VALUES (:full_name, :email, :password, NOW())";

    $stmt = $pdo->prepare($sql);

    // Execute with parameters
    $success = $stmt->execute([
        ':full_name' => $data['fullName'],
        ':email' => $data['email'],
        ':password' => $hashedPassword
    ]);

    if ($success) {
        echo json_encode([
            'success' => true,
            'message' => 'User registered successfully'
        ]);
    } else {
        throw new Exception('Failed to register user');
    }

} catch (Exception $e) {
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}
?>