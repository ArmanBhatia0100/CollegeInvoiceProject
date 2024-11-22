<?php
require_once './php/db_connect.php';



// Fetch all invoices
try {
    $stmt = $pdo->query("SELECT * FROM invoices ORDER BY due_date DESC");
    $invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $invoice_count = count($invoices);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();

}

try {
    $stmt = $pdo->query("SELECT * FROM users");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    die();

}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css?v=1.2">
    <title>Invoice App</title>
</head>

<body>
    <div class="container">

        <div class="header">
            <div>
                <h1 class="title">Invoices</h1>
            </div>
            <?php
            include "./php/header.php";
            ?>
        </div>
        <div class="wrapper_container">
            <div class="users_container">
                <h2>User List</h2>
                <?php foreach ($users as $user): ?>
                    <div class="invoice-item userItem">
                        <h3><?php echo $user['full_name'] ?></h3>
                    </div>

                <?php endforeach; ?>
            </div>
            <div class="invoice-list">
                <?php foreach ($invoices as $invoice): ?>
                    <div class="invoice-item">
                        <div class="invoice-id">#<?php echo htmlspecialchars($invoice['invoice_id']); ?></div>
                        <div class="invoice-date">Due <?php echo date('d M Y', strtotime($invoice['due_date'])); ?></div>
                        <div class="invoice-name"><?php echo htmlspecialchars($invoice['client_name']); ?></div>
                        <div class="invoice-amount">£<?php echo number_format($invoice['amount'], 2); ?></div>
                        <div class="status <?php echo $invoice['status']; ?>"><?php echo ucfirst($invoice['status']); ?>
                        </div>
                        <button type="button" class="remove-invoice-btn"
                            data-id="<?php echo $invoice['id']; ?>">Remove</button>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

    </div>
    <script src="./javascript/index.js"></script>
</body>

</html>