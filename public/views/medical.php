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
                <h1 class="m-0">Medical Record List</h1>
                <button type="button"
                    class="btn btn-primary btn-lg"
                    data-bs-toggle="modal"
                    data-bs-target="#modalBreading" class="btn btn-primary py-2 px-4 font-weight-bold" style="font-size: .8rem;">New Medical record</button>
            </div>
            <!-- Breeding Table -->
            <table id="feeding_table" class="table bg-white table-bordered table-responsive-md table-striped table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bird ID</th>
                        <th>Checkup Date</th>
                        <th>Treatment</th>
                        <th>Notes</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the MedicalController to fetch all medical records
                    require_once '../../src/controllers/medical_controller.php';
                    $controller = new MedicalController();
                    $medical_records = $controller->getAllMedical();

                    foreach ($medical_records as $record) {
                        echo "<tr>";
                        echo "<td>{$record['id']}</td>";
                        echo "<td>{$record['bird_id']}</td>";
                        echo "<td>{$record['checkup_date']}</td>";
                        echo "<td>{$record['treatment']}</td>";
                        echo "<td>{$record['notes']}</td>";
                        echo "<td>
                            <a href='edit_medical.php?id={$record['id']}' class='btn alert alert-info m-0 py-1 px-2 border-0 text-info btn-sm'><i class='fas fa-edit'></i></a>
                            <a href='delete_medical.php?id={$record['id']}' class='btn alert alert-danger m-0 border-0 py-1 px-2 text-danger btn-sm'><i class='fas fa-trash'></i></a>
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
                    New Medical Record
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
                <form action="../../src/controllers/medical_controller.php" method="POST">
                    <input type="hidden" name="action" value="add">
                    <div class="mb-3">
                        <label for="bird_id" class="form-label">Bird ID</label>
                        <input type="number" class="form-control" name="bird_id" required>
                    </div>
                    <div class="mb-3">
                        <label for="checkup_date" class="form-label">Checkup Date</label>
                        <input type="date" class="form-control" name="checkup_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="treatment" class="form-label">Treatment</label>
                        <input type="text" class="form-control" name="treatment" required>
                    </div>
                    <div class="">
                        <label for="notes" class="form-label">Notes</label>
                        <textarea class="form-control" name="notes" required></textarea>
                    </div>
                    <!-- <button type="submit" class="btn btn-primary">Add Medical Record</button> -->
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
>