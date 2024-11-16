<?php
    include 'partials/header.php';
    include 'partials/sidebar.php';
    require_once '../../src/controllers/feed_purchase_controller.php';

    $controller = new FeedPurchaseController();
    $purchases = $controller->getAllFeedPurchases();
?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1 class="text-center">Feed Purchase Report</h1>
            <!-- Date Filter -->
            <form method="GET">
                <div class="row">
                    <div class="col-md-4">
                        <input type="date" name="start_date" class="form-control" placeholder="Start Date">
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="end_date" class="form-control" placeholder="End Date">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <!-- DataTable with Export Options -->
            <table id="feedPurchaseTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Feed Type</th>
                        <th>Purchase Date</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Cost</th>
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
                            <td><?php echo $purchase['cost']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- Export Buttons -->
            <button id="exportCSV" class="btn btn-success">Export to CSV</button>
            <button id="exportPDF" class="btn btn-danger">Export to PDF</button>
        </div>
    </section>
</div>

<?php
    include 'partials/footer.php';
?>
