<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/jobBoard/styles/addInvoiceStyles.css">
    <title>Invoice App</title>
</head>
<!-- TODO Add Naviagtion -->

<body>

    <div class="container">
        <?php
        include "./header.php";
        ?>
        <div class="form-header">
            <h1 class="title">Invoice Details</h1>
            <div class="invoice-number"><span>#</span>RT3080</div>
        </div>

        <form>
            <div class="form-group">
                <label for="invoice-id">Invoice ID</label>
                <input type="text" id="invoice-id" class="input-field" value="">
            </div>

            <div class="form-group">
                <label for="due-date">Due Date</label>
                <input type="date" id="due-date" class="date-picker" value="2021-08-19">
            </div>

            <div class="form-group">
                <label for="client-name">Client Name</label>
                <input type="text" id="client-name" class="input-field" value="">
            </div>

            <div class="form-group">
                <label for="amount">Amount</label>
                <div class="amount-field">
                    <input type="number" id="amount" class="input-field" value="" step="0.01">
                </div>
            </div>

            <div class="form-group">
                <label for="status">Status</label>
                <select id="status" class="status-select">
                    <option value="paid" selected>Paid</option>
                    <option value="pending">Pending</option>
                    <option value="draft">Draft</option>
                </select>
            </div>

            <div class="form-group">
                <label>Current Status</label>
                <div class="status-pill paid">Paid</div>
            </div>

            <div class="button-group">
                <button type="button" class="button button-secondary">Cancel</button>
                <button type="submit" class="button button-primary">Save Changes</button>
            </div>
        </form>
    </div>
</body>

</html>