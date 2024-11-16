<?php
    // Include the header and sidebar
    include 'partials/header.php';
    include 'partials/sidebar.php';
    
    // Import controllers to gather data for the report
    require_once '../../src/controllers/feed_purchase_controller.php';
    require_once '../../src/controllers/medical_controller.php';
    require_once '../../src/controllers/purchases_controller.php';

    // Date filtering logic (optional for custom date ranges)
    $startDate = isset($_POST['start_date']) ? $_POST['start_date'] : null;
    $endDate = isset($_POST['end_date']) ? $_POST['end_date'] : null;

    // Fetch data based on date range
    $feedController = new FeedPurchaseController();
    $feedExpenses = $feedController->getTotalFeedExpenses($startDate, $endDate);
    $feedExpenseDetails = $feedController->getFeedPurchasesByDate($startDate, $endDate);

    $medicalController = new MedicalController();
    $medicalExpenses = $medicalController->getTotalMedicalExpenses($startDate, $endDate);
    $medicalExpenseDetails = $medicalController->getMedicalExpensesByDate($startDate, $endDate);

    $purchaseController = new PurchasesController();
    $birdPurchases = $purchaseController->getTotalBirdPurchases($startDate, $endDate);
    $birdPurchaseDetails = $purchaseController->getBirdPurchasesByDate($startDate, $endDate);

    // Calculate total overall expenses
    $totalExpenses = $feedExpenses['total_cost'] + $medicalExpenses['total_cost'] + $birdPurchases['total_cost'];
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1 class="text-center">Detailed Expense Report</h1>

            <!-- Date Filters -->
            <form method="POST" action="">
                <div class="row">
                    <div class="col-md-4">
                        <label for="start_date">Start Date</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date">End Date</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary mt-4">Filter</button>
                    </div>
                </div>
            </form>

            <!-- Feed Expense Section -->
            <h2 class="mt-5">Total Feed Expenses</h2>
            <p>Total Cost: ₹<?php echo number_format($feedExpenses['total_cost'], 2); ?></p>

            <!-- Detailed Feed Purchases -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Feed Type</th>
                        <th>Purchase Date</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Cost (INR)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($feedExpenseDetails as $feed) { ?>
                        <tr>
                            <td><?php echo $feed['feed_type']; ?></td>
                            <td><?php echo $feed['purchase_date']; ?></td>
                            <td><?php echo $feed['supplier']; ?></td>
                            <td><?php echo $feed['quantity']; ?></td>
                            <td>₹<?php echo number_format($feed['cost'], 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Medical Expense Section -->
            <h2 class="mt-5">Total Medical Expenses</h2>
            <p>Total Cost: ₹<?php echo number_format($medicalExpenses['total_cost'], 2); ?></p>

            <!-- Detailed Medical Expenses -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Bird ID</th>
                        <th>Checkup Date</th>
                        <th>Treatment</th>
                        <th>Notes</th>
                        <th>Cost (INR)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($medicalExpenseDetails as $medical) { ?>
                        <tr>
                            <td><?php echo $medical['bird_id']; ?></td>
                            <td><?php echo $medical['checkup_date']; ?></td>
                            <td><?php echo $medical['treatment']; ?></td>
                            <td><?php echo $medical['notes']; ?></td>
                            <td>₹<?php echo number_format($medical['cost'], 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Bird Purchases Section -->
            <h2 class="mt-5">Total Bird Purchases</h2>
            <p>Total Cost: ₹<?php echo number_format($birdPurchases['total_cost'], 2); ?></p>

            <!-- Detailed Bird Purchases -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Species</th>
                        <th>Purchase Date</th>
                        <th>Supplier</th>
                        <th>Cost (INR)</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($birdPurchaseDetails as $purchase) { ?>
                        <tr>
                            <td><?php echo $purchase['species']; ?></td>
                            <td><?php echo $purchase['purchase_date']; ?></td>
                            <td><?php echo $purchase['purchased_from']; ?></td>
                            <td>₹<?php echo number_format($purchase['purchase_cost'], 2); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Total Expenses Section -->
            <h2 class="mt-5">Total Expenses Summary</h2>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Category</th>
                        <th>Total Cost (INR)</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Feed Purchases</td>
                        <td>₹<?php echo number_format($feedExpenses['total_cost'], 2); ?></td>
                    </tr>
                    <tr>
                        <td>Medical Expenses</td>
                        <td>₹<?php echo number_format($medicalExpenses['total_cost'], 2); ?></td>
                    </tr>
                    <tr>
                        <td>Bird Purchases</td>
                        <td>₹<?php echo number_format($birdPurchases['total_cost'], 2); ?></td>
                    </tr>
                    <tr>
                        <th>Total Combined Expenses</th>
                        <th>₹<?php echo number_format($totalExpenses, 2); ?></th>
                    </tr>
                </tbody>
            </table>

            <!-- Export Buttons -->
            <button id="exportCSV" class="btn btn-success mt-3">Export to CSV</button>
            <button id="exportPDF" class="btn btn-danger mt-3">Export to PDF</button>
        </div>
    </section>
</div>

<?php
    include 'partials/footer.php';
?>

<!-- Include DataTables and jQuery -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#expenseTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true
        });

        // Export to CSV
        $('#exportCSV').click(function() {
            window.location.href = '../../src/controllers/export_expense_report.php?format=csv';
        });

        // Export to PDF
        $('#exportPDF').click(function() {
            window.location.href = '../../src/controllers/export_expense_report.php?format=pdf';
        });
    });
</script>
