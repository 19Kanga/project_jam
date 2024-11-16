<?php
    // Include the header
    include 'partials/header.php';
    // Include the sidebar
    include 'partials/sidebar.php';
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1 class="text-center">Sales Management</h1>

            <!-- Sales Records Table -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bird ID</th>
                        <th>Sale Date</th>
                        <th>Sale Price</th>
                        <th>Customer Name</th>
                        <th>Customer Contact</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../src/controllers/sales_controller.php';
                    $controller = new SalesController();
                    $sales = $controller->getAllSales();

                    foreach ($sales as $sale) {
                        echo "<tr>";
                        echo "<td>{$sale['id']}</td>";
                        echo "<td>{$sale['bird_id']}</td>";
                        echo "<td>{$sale['sale_date']}</td>";
                        echo "<td>{$sale['sale_price']}</td>";
                        echo "<td>{$sale['customer_name']}</td>";
                        echo "<td>{$sale['customer_contact']}</td>";
                        echo "<td>
                            <a href='edit_sale.php?id={$sale['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_sale.php?id={$sale['id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Add Sale Record Form -->
            <h2 class="mt-5">Add Sale Record</h2>
            <form action="../../src/controllers/sales_controller.php" method="POST">
                <input type="hidden" name="action" value="add">
                <div class="mb-3">
                    <label for="bird_id" class="form-label">Bird ID</label>
                    <input type="number" class="form-control" name="bird_id" required>
                </div>
                <div class="mb-3">
                    <label for="sale_date" class="form-label">Sale Date</label>
                    <input type="date" class="form-control" name="sale_date" required>
                </div>
                <div class="mb-3">
                    <label for="sale_price" class="form-label">Sale Price</label>
                    <input type="number" class="form-control" name="sale_price" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Customer Name</label>
                    <input type="text" class="form-control" name="customer_name" required>
                </div>
                <div class="mb-3">
                    <label for="customer_contact" class="form-label">Customer Contact</label>
                    <input type="text" class="form-control" name="customer_contact" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Sale Record</button>
            </form>
        </div>
    </section>
</div>

<?php
    // Include the footer
    include 'partials/footer.php';
?>
