<?php
    // Include the header and sidebar
    include 'partials/header.php';
    include 'partials/sidebar.php';

    // Include the controller for feed purchases
    require_once '../../src/controllers/feed_purchase_controller.php';
    $controller = new FeedPurchaseController();

    // Handle form submission to update the feed purchase
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $id = $_POST['id'];
        $data = [
            'feed_type' => $_POST['feed_type'],
            'purchase_date' => $_POST['purchase_date'],
            'supplier' => $_POST['supplier'],
            'quantity' => $_POST['quantity'],
            'cost' => $_POST['cost']
        ];
        $controller->updateFeedPurchase($id, $data);
        header('Location: feed_purchases.php'); // Redirect to the feed purchases page
        exit;
    }

    // Fetch the existing feed purchase data to pre-fill the form
    if (isset($_GET['id'])) {
        $purchase = $controller->getFeedPurchaseById($_GET['id']);
    }
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1>Edit Feed Purchase</h1>

            <form method="POST">
                <input type="hidden" name="id" value="<?php echo $purchase['id']; ?>">
                <div class="mb-3">
                    <label for="feed_type" class="form-label">Feed Type</label>
                    <input type="text" class="form-control" id="feed_type" name="feed_type" value="<?php echo $purchase['feed_type']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="purchase_date" class="form-label">Purchase Date</label>
                    <input type="date" class="form-control" id="purchase_date" name="purchase_date" value="<?php echo $purchase['purchase_date']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="supplier" class="form-label">Supplier</label>
                    <input type="text" class="form-control" id="supplier" name="supplier" value="<?php echo $purchase['supplier']; ?>">
                </div>
                <div class="mb-3">
                    <label for="quantity" class="form-label">Quantity (kg/lbs)</label>
                    <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo $purchase['quantity']; ?>" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="cost" class="form-label">Cost (in currency)</label>
                    <input type="number" class="form-control" id="cost" name="cost" value="<?php echo $purchase['cost']; ?>" step="0.01" required>
                </div>
                <button type="submit" class="btn btn-primary">Update Feed Purchase</button>
            </form>
        </div>
    </section>
</div>

<?php
    // Include the footer
    include 'partials/footer.php';
?>
