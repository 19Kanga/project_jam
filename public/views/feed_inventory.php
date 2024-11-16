<?php
    include 'partials/header.php';
    include 'partials/sidebar.php';

    require_once '../../src/controllers/feed_inventory_controller.php';
    $controller = new FeedInventoryController();
    $feedInventory = $controller->getAllFeedInventory();
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1>Feed Inventory Management</h1>

            <!-- Feed Inventory Table -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Feed Type</th>
                        <th>Quantity</th>
                        <th>Last Updated</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($feedInventory as $inventory) {
                        echo "<tr>";
                        echo "<td>{$inventory['id']}</td>";
                        echo "<td>{$inventory['feed_type']}</td>"; // Correctly displaying feed_type from the joined table
                        echo "<td>{$inventory['quantity']}</td>";
                        echo "<td>{$inventory['last_updated']}</td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>
</div>

<?php
    include 'partials/footer.php';
?>
