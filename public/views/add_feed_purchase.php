<?php
    // Include the header
    include 'partials/header.php';
    // Include the sidebar
    include 'partials/sidebar.php';

    // Handle form submission
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once '../../src/controllers/feed_purchase_controller.php';
        $controller = new FeedPurchaseController();
        $data = [
            'feed_type_id' => $_POST['feed_type_id'],
            'purchase_date' => $_POST['purchase_date'],
            'supplier' => $_POST['supplier'],
            'quantity' => $_POST['quantity'],
            'cost' => $_POST['cost']
        ];
        $controller->addFeedPurchase($data);
        header('Location: feed_purchase.php'); // Redirect to avoid re-submission on refresh
        exit;
    }
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1 class="text-center">Feed Purchase Management</h1>

            <!-- Add Feed Purchase Form -->
            <h2 class="mt-5">Add Feed Purchase</h2>
            <form action="" method="POST">
                <input type="hidden" name="action" value="add">
    
                <div class="mb-3">
                    <label for="feed_type" class="form-label">Feed Type</label>
                    <select class="form-control" name="feed_type_id" required>
                        <?php
                        require_once '../../src/controllers/feed_type_controller.php';
                        $feedTypeController = new FeedTypeController();
                        $feedTypes = $feedTypeController->getAllFeedTypes();

                        foreach ($feedTypes as $feedType) {
                            echo "<option value='{$feedType['id']}'>{$feedType['feed_type']}</option>";
                        }
                        ?>
                    </select>
                </div>
                
                <div class="mb-3">
                    <label for="purchase_date" class="form-label">Purchase Date</label>
                    <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
                </div>
                
                <div class="mb-3">
                    <label for="supplier" class="form-label">Supplier</label>
                    <input type="text" class="form-control" id="supplier" name="supplier">
                </div>
                
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity (kg/lbs)</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" step="0.01" required>
                </div>
                
                <div class="mb-3">
                    <label for="cost" class="form-label">Cost (in currency)</label>
                    <input type="number" class="form-control" id="cost" name="cost" step="0.01" required>
                </div>
                
                <button type="submit" class="btn btn-primary">Add Feed Purchase</button>
            </form>

        </div>
    </section>
</div>

<?php
    // Include the footer
    include 'partials/footer.php';
?>
