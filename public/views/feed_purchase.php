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
            'feed_type' => $_POST['feed_type'],
            'purchase_date' => $_POST['purchase_date'],
            'supplier' => $_POST['supplier'],
            'quantity' => $_POST['quantity'],
            'cost' => $_POST['cost']
        ];
        $controller->addFeedPurchase($data);
        header('Location: feed_purchases.php'); // Redirect to avoid re-submission on refresh
        exit;
    }
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1 class="text-center">Feed Purchase Management</h1>

            <!-- Add Feed Purchase Form -->
            
            <!-- Feed Purchases Table -->
            <h2 class="mt-5">Feed Purchases</h2>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Feed Type</th>
                        <th>Purchase Date</th>
                        <th>Supplier</th>
                        <th>Quantity</th>
                        <th>Cost</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch and display feed purchases
                    require_once '../../src/controllers/feed_purchase_controller.php';
                    $controller = new FeedPurchaseController();
                    $feed_purchases = $controller->getAllFeedPurchases();

                    foreach ($feed_purchases as $purchase) {
                        echo "<tr>";
                        echo "<td>{$purchase['id']}</td>";
                        echo "<td>{$purchase['feed_type']}</td>";
                        echo "<td>{$purchase['purchase_date']}</td>";
                        echo "<td>{$purchase['supplier']}</td>";
                        echo "<td>{$purchase['quantity']}</td>";
                        echo "<td>{$purchase['cost']}</td>";
                        echo "<td>
                            <a href='edit_feed_purchase.php?id={$purchase['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_feed_purchase.php?id={$purchase['id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php
    // Include the footer
    include 'partials/footer.php';
?>
