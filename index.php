<?php
require_once './php/db_connect.php';
require_once "./php/feature/search.php";
require_once "./php/feature/initialFetch.php"
    ?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./styles/styles.css?v=1.3">
    <title>Invoice App</title>

</head>

<body>
    <div class="container">
        <div class="header">
            <div>
                <h1 class="title">Invoices</h1>
            </div>
            <?php include "./php/header.php"; ?>
        </div>

        <!-- Search and Filter Section -->
        <div class="search-container">
            <form id="searchForm" method="POST">
                <div class="search-row">
                    <div class="search-field">
                        <label for="invoice_id">Invoice ID</label>
                        <input type="text" id="invoice_id" name="invoice_id" placeholder="Search by Invoice ID">
                    </div>

                    <div class="search-field">
                        <label for="client_name">Client Name</label>
                        <input type="text" id="client_name" name="client_name" placeholder="Search by Client Name">
                    </div>

                    <div class="search-field">
                        <label for="status">Status</label>
                        <select id="status" name="status">
                            <option value="">All Statuses</option>
                            <option value="paid">Paid</option>
                            <option value="pending">Pending</option>
                            <option value="draft">Draft</option>
                        </select>
                    </div>
                </div>
                <div class="filter-buttons">
                    <button type="submit" class="filter-button">Search</button>
                    <button type="submit" class="filter-button reset-button" id="resetButton">Reset</button>
                </div>
            </form>
        </div>

        <div class="wrapper_container">
            <div class="users_container">
                <h2>User List</h2>
                <?php foreach ($users as $user): ?>
                    <div class="invoice-item userItem">
                        <h3><?php echo htmlspecialchars($user['full_name']); ?></h3>
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="invoice-list">
                <?php if (empty($invoices)): ?>
                    <div class="no-results">No invoices found matching your criteria.</div>
                <?php else: ?>
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
                <?php endif; ?>
            </div>
        </div>
    </div>

    <script src="./javascript/index.js"></script>
</body>

</html>