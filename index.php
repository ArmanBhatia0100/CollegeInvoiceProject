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
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css?v=1.1">
    <title>Invoice App</title>
</head>


<!-- TODO Add the name of the user at the top invoice button -->
<!-- TODO Change the invoice count at the top -->

<body>
    <div class="container">


        <div class="header">
            <div>
                <h1 class="title">Invoices</h1>
                <p class="subtitle">There are <?php echo $invoice_count; ?> total invoices</p>
            </div>
            <?php
            include "./php/header.php";
            ?>
            <!-- <div class="actions">
                <a href="/jobBoard/php/addUser.php" class="addUser-button">
                    Add User
                </a>
                <a href="/jobBoard/php/addInvoice.php" class="new-invoice-button">
                    <span>+</span> New Invoice
                </a>
            </div> -->
        </div>

        <div class="invoice-list">
            <?php foreach ($invoices as $invoice): ?>
                <div class="invoice-item">
                    <div class="invoice-id">#<?php echo htmlspecialchars($invoice['invoice_id']); ?></div>
                    <div class="invoice-date">Due <?php echo date('d M Y', strtotime($invoice['due_date'])); ?></div>
                    <div class="invoice-name"><?php echo htmlspecialchars($invoice['client_name']); ?></div>
                    <div class="invoice-amount">£<?php echo number_format($invoice['amount'], 2); ?></div>
                    <div class="status <?php echo $invoice['status']; ?>"><?php echo ucfirst($invoice['status']); ?></div>
                    <button type="button" class="remove-invoice-btn" data-id="<?php echo $invoice['id']; ?>">Remove</button>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
    <script src="./javascript/index.js"></script>
</body>

</html>