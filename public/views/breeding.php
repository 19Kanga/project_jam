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
                <h1 class="m-0">Breeding List</h1>
                <button type="button"
                    class="btn btn-primary btn-lg"
                    data-bs-toggle="modal"
                    data-bs-target="#modalBreading" class="btn btn-primary py-2 px-4 font-weight-bold" style="font-size: .8rem;">Add New Bird</button>
            </div>
            <!-- Breeding Table -->
            <table id="breading_table" class="table bg-white table-bordered table-responsive-md table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bird ID</th>
                        <th>Partner ID</th>
                        <th>Breeding Date</th>
                        <th>Success Rate</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once '../../src/controllers/breeding_controller.php';
                    $controller = new BreedingController();
                    $breedingPairs = $controller->getAllBreeding();

                    foreach ($breedingPairs as $pair) {
                        echo "<tr>";
                        echo "<td>{$pair['id']}</td>";
                        // echo "<td>{$pair['uid']}</td>";
                        echo "<td>{$pair['bird_id']}</td>";
                        echo "<td>{$pair['partner_id']}</td>";
                        echo "<td>{$pair['breeding_date']}</td>";
                        echo "<td>{$pair['success_rate']}</td>";
                        echo "<td>
                            <a href='edit_breeding.php?id={$pair['id']}' class='btn alert alert-info m-0 py-1 px-2 border-0 text-info btn-sm'><i class='fas fa-edit'></i></a>
                            <a href='delete_breeding.php?id={$pair['id']}' class='btn alert alert-danger m-0 border-0 py-1 px-2 text-danger btn-sm'><i class='fas fa-trash'></i></a>
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
                    New Breeding Pair
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
                <form action="../../src/controllers/breeding_controller.php" method="POST">
                    <input type="hidden" name="action" value="add">

                    <div class="mb-3">
                        <label for="bird_id" class="form-label">Bird ID</label>
                        <input type="number" class="form-control" id="bird_id" name="bird_id" required>
                    </div>

                    <div class="mb-3">
                        <label for="partner_id" class="form-label">Partner ID</label>
                        <input type="number" class="form-control" id="partner_id" name="partner_id" required>
                    </div>

                    <div class="mb-3">
                        <label for="breeding_date" class="form-label">Breeding Date</label>
                        <input type="date" class="form-control" id="breeding_date" name="breeding_date" required>
                    </div>

                    <div class="">
                        <label for="success_rate" class="form-label">Success Rate (%)</label>
                        <input type="number" class="form-control" id="success_rate" name="success_rate" required>
                    </div>

                    <!-- <button type="submit" class="btn btn-primary">Add Breeding Pair</button> -->
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