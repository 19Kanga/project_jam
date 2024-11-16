<?php
    include 'partials/header.php';
    include 'partials/sidebar.php';
    require_once '../../src/controllers/sales_controller.php';

    $controller = new SalesController();
    $sales = $controller->getAllSales();
?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1 class="text-center">Sales Report</h1>
            <table id="salesTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bird ID</th>
                        <th>Sale Date</th>
                        <th>Sale Price</th>
                        <th>Buyer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($sales as $sale) { ?>
                        <tr>
                            <td><?php echo $sale['id']; ?></td>
                            <td><?php echo $sale['bird_id']; ?></td>
                            <td><?php echo $sale['sale_date']; ?></td>
                            <td><?php echo $sale['sale_price']; ?></td>
                            <td><?php echo $sale['customer_name']; ?></td>
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
