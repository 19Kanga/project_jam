<?php
    // Include the controller for feed purchases
    require_once '../../src/controllers/feed_purchase_controller.php';
    $controller = new FeedPurchaseController();

    // Check if ID is provided in the URL
    if (isset($_GET['id'])) {
        $controller->deleteFeedPurchase($_GET['id']);
    }

    // Redirect to the feed purchases page after deletion
    header('Location: feed_purchases.php');
    exit;
?>
