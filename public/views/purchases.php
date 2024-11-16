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
            <h1 class="text-center">Purchases Management</h1>

            <!-- Purchases Table -->
            <table id="purchasesTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bird ID</th>
                        <th>Purchase Date</th>
                        <th>Purchase Cost</th>
                        <th>Purchased From</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../src/controllers/purchases_controller.php';
                    $controller = new PurchasesController();
                    $purchases = $controller->getAllPurchases();

                    foreach ($purchases as $purchase) {
                        echo "<tr>";
                        echo "<td>{$purchase['id']}</td>";
                        echo "<td>{$purchase['bird_id']}</td>";
                        echo "<td>{$purchase['purchase_date']}</td>";
                        echo "<td>{$purchase['purchase_cost']}</td>";
                        echo "<td>{$purchase['purchased_from']}</td>";
                        echo "<td>
                            <a href='edit_purchase.php?id={$purchase['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_purchase.php?id={$purchase['id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>

            <!-- Add Purchase Form -->
            <h2 class="mt-5">Add Purchase</h2>
            <form action="../../src/controllers/purchases_controller.php" method="POST">
                <input type="hidden" name="action" value="add">
                <div class="mb-3">
                    <label for="bird_id" class="form-label">Bird ID</label>
                    <input type="number" class="form-control" name="bird_id" required>
                </div>
                <div class="mb-3">
                    <label for="purchase_date" class="form-label">Purchase Date</label>
                    <input type="date" class="form-control" name="purchase_date" required>
                </div>
                <div class="mb-3">
                    <label for="purchase_cost" class="form-label">Purchase Cost</label>
                    <input type="number" step="0.01" class="form-control" name="purchase_cost" required>
                </div>
                <div class="mb-3">
                    <label for="purchased_from" class="form-label">Purchased From</label>
                    <input type="text" class="form-control" name="purchased_from" required>
                </div>
                <button type="submit" class="btn btn-primary">Add Purchase</button>
            </form>
        </div>
    </section>
</div>

<?php
    // Include the footer
    include 'partials/footer.php';
?>

