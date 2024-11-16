<?php
// Include the header
session_start();
include 'partials/headers.php';
if (!isset($_SESSION['status']) && $_SESSION['status'] !== 'online') {
    header("Location: /");
}

?>

<div class="d-flex">
    <?php include 'partials/sidebar.php'; ?>
    <div class="container-avs">
        <?php include 'partials/header.php'; ?>
        <!-- <section class="content"> -->
        <div class="py-2 pt-4 px-4">
            <div class="d-flex justify-content-between align-items-center mb-5">
                <h1 class="m-0">Feeding List</h1>
                <button type="button"
                    class="btn btn-primary btn-lg"
                    data-bs-toggle="modal"
                    data-bs-target="#modalBreading" class="btn btn-primary py-2 px-4 font-weight-bold" style="font-size: .8rem;">Add New Feeding</button>
            </div>
            <!-- Breeding Table -->
            <table id="feeding_table" class="table bg-white table-bordered table-responsive-md table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bird ID</th>
                        <th>Feeding Time</th>
                        <th>Food Type</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../src/controllers/feeding_controller.php';
                    $controller = new FeedingController();
                    $feeding_schedule = $controller->getAllFeeding();

                    foreach ($feeding_schedule as $feeding) {
                        echo "<tr>";
                        echo "<td>{$feeding['id']}</td>";
                        echo "<td>{$feeding['bird_id']}</td>";
                        echo "<td>{$feeding['feeding_time']}</td>";
                        echo "<td>{$feeding['food_type']}</td>";
                        echo "<td>{$feeding['quantity']}</td>";
                        echo "<td>
                            <a href='edit_feeding.php?id={$feeding['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_feeding.php?id={$feeding['id']}' class='btn btn-danger btn-sm'>Delete</a>
                        </td>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
        <!-- </section> -->
        <?php include 'partials/footer.php'; ?>
    </div>
</div>
<!-- Content Wrapper -->

<div
    class="modal fade"
    id="modalBreading"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"

    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div
        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="modalTitleId">
                    New Feeding Schedule
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add Bird Form -->

                <!-- Add Breeding Pair Form -->
                <form action="../../src/controllers/feeding_controller.php" method="POST">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label for="bird_id" class="form-label">Bird ID</label>
                        <input type="number" class="form-control" name="bird_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="feeding_time" class="form-label">Feeding Time</label>
                        <input type="time" class="form-control" name="feeding_time" required>
                    </div>
                    <div class="mb-3">
                        <label for="food_type" class="form-label">Food Type</label>
                        <input type="text" class="form-control" name="food_type" required>
                    </div>
                    <div class="">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" class="form-control" name="quantity" step="0.01" required>
                    </div>
                    <!-- <button type="submit" class="btn btn-primary">Add Feeding Schedule</button> -->
                </form>
            </div>
            <div class="modal-footer">
                <button
                    type="button"
                    class="btn btn-secondary  d-flex align-items-center justify-content-center gap-2"
                    data-bs-dismiss="modal">
                    <div class="spinner-border d-none spinner-border-sm text-white" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                    Close
                </button>
                <button type="button" id="add-bird-modal" class="btn btn-primary">Save</button>
            </div>
        </div>
    </div>
</div>
<?php
// Include the footers
include 'partials/footers.php';
?>