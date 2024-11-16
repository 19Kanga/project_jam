<?php
    // Include the header
    include 'partials/header.php';
    // Include the sidebar
    include 'partials/sidebar.php';
    require_once '../../src/controllers/feed_purchase_controller.php';

    $controller = new FeedPurchaseController();

    // Default purchases load
    $startDate = isset($_GET['start_date']) ? $_GET['start_date'] : null;
    $endDate = isset($_GET['end_date']) ? $_GET['end_date'] : null;
    $purchases = $controller->getFeedPurchasesByDate($startDate, $endDate);
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1 class="text-center">Feed Purchase Management</h1>

            <!-- Date Filter Form -->
            <form method="GET" class="mb-3">
                <div class="form-row">
                    <div class="col">
                        <input type="date" name="start_date" class="form-control" value="<?php echo $startDate; ?>">
                    </div>
                    <div class="col">
                        <input type="date" name="end_date" class="form-control" value="<?php echo $endDate; ?>">
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                    <div class="col">
                        <button type="button" id="lastWeek" class="btn btn-secondary">Last 7 Days</button>
                        <button type="button" id="thisMonth" class="btn btn-secondary">This Month</button>
                        <button type="button" id="lastMonth" class="btn btn-secondary">Last Month</button>
                    </div>
                </div>
            </form>

            <!-- Feed Purchase Table with DataTables -->
            <table id="feedPurchaseTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Feed Type</th>
                        <th>Purchase Date</th>
                        <th>Supplier</th>
                        <th>Quantity (kg/lbs)</th>
                        <th>Cost (INR)</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($purchases as $purchase) { ?>
                        <tr>
                            <td><?php echo $purchase['id']; ?></td>
                            <td><?php echo $purchase['feed_type']; ?></td>
                            <td><?php echo $purchase['purchase_date']; ?></td>
                            <td><?php echo $purchase['supplier']; ?></td>
                            <td><?php echo $purchase['quantity']; ?></td>
                            <td><?php echo "₹" . $purchase['cost']; ?></td>
                            <td>
                                <a href='edit_feed_purchase.php?id=<?php echo $purchase['id']; ?>' class='btn btn-warning btn-sm'>Edit</a>
                                <a href='delete_feed_purchase.php?id=<?php echo $purchase['id']; ?>' class='btn btn-danger btn-sm'>Delete</a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            
            <!-- Buttons to Export CSV/PDF -->
            <button id="exportCSV" class="btn btn-success">Export to CSV</button>
            <button id="exportPDF" class="btn btn-danger">Export to PDF</button>
        </div>
    </section>
</div>

<?php
    // Include the footer
    include 'partials/footer.php';
?>

<!-- Include DataTables and jQuery -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#feedPurchaseTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true
        });

        // Export to CSV
        $('#exportCSV').click(function() {
            window.location.href = '../../src/controllers/feed_purchase_report_controller.php?format=csv&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>';
        });

        // Export to PDF
        $('#exportPDF').click(function() {
            window.location.href = '../../src/controllers/feed_purchase_report_controller.php?format=pdf&start_date=<?php echo $startDate; ?>&end_date=<?php echo $endDate; ?>';
        });

        // Date Filter Buttons
        $('#lastWeek').click(function() {
            var now = new Date();
            var lastWeek = new Date(now.getFullYear(), now.getMonth(), now.getDate() - 7);
            $('input[name="start_date"]').val(lastWeek.toISOString().split('T')[0]);
            $('input[name="end_date"]').val(now.toISOString().split('T')[0]);
        });

        $('#thisMonth').click(function() {
            var now = new Date();
            var firstDay = new Date(now.getFullYear(), now.getMonth(), 1);
            $('input[name="start_date"]').val(firstDay.toISOString().split('T')[0]);
            $('input[name="end_date"]').val(now.toISOString().split('T')[0]);
        });

        $('#lastMonth').click(function() {
            var now = new Date();
            var firstDayLastMonth = new Date(now.getFullYear(), now.getMonth() - 1, 1);
            var lastDayLastMonth = new Date(now.getFullYear(), now.getMonth(), 0);
            $('input[name="start_date"]').val(firstDayLastMonth.toISOString().split('T')[0]);
            $('input[name="end_date"]').val(lastDayLastMonth.toISOString().split('T')[0]);
        });
    });
</script>
