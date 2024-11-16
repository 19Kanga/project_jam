<?php
// Include the header
session_start();
include 'partials/headers.php';
?>

<div class="row mx-0">
    <?php include 'partials/sidebar.php'; ?>
    <div class="container-avs">
        <?php include 'partials/header.php'; ?>
        <!-- <section class="content"> -->
        <div class="py-2 pt-4 px-4">

            <div class="d-flex justify-content-between align-items-center">
                <h1 class="m-0">Birds List</h1>
                <button type="button"
                    class="btn btn-primary btn-lg"
                    data-bs-toggle="modal"
                    data-bs-target="#modalId" class="btn btn-primary py-2 px-4 font-weight-bold" style="font-size: .8rem;">Add New Bird</button>
            </div>
            <!-- Add Bird Button -->

            <!-- Birds Table -->
            <div class="py-3 mt-4">
                <!-- <h2 class="fw-bold mb-3 text-center" style="font-size: 1.4rem;">Birds List</h2> -->
                <table id="birdsTable" class="table my-3 bg-white table-responsive-md table-striped table-bordered table-hover">
                    <thead style="white-space: nowrap;">
                        <tr style="font-size:.9rem">
                            <th class="py-3">N0</th>
                            <th class="py-3">UID</th>
                            <th class="py-3">Species</th>
                            <th class="py-3">Gender</th>
                            <th class="py-3">Purchase Date</th>
                            <th class="py-3">Purchase Cost</th>
                            <th class="py-3">Actions</th>
                        </tr>
                    </thead>
                    <tbody style="font-size: .9rem;white-space: nowrap;">
                        <?php
                        require_once '../../src/controllers/bird_controller.php';
                        $controller = new BirdController();
                        $birds = $controller->getAllBirds();

                        foreach ($birds as $bird) {
                            echo "<tr>
                                <td>{$bird['id']}</td>
                                <td>{$bird['bird_identifier']}</td>
                                <td>{$bird['species']}</td>
                                <td>{$bird['gender']}</td>
                                <td>{$bird['purchase_date']}</td>
                                <td>{$bird['purchase_cost']}</td>
                                <td class='d-flex gap-2 justify-content-center text-white align-items-center'>
                                        <a href='#' class='btn alert alert-success m-0 py-1 px-2 border-0 text-success btn-sm'><i class='fas fa-eye'></i></a>
                                        <a href='edit_bird.php?id={$bird['id']}' class='btn alert alert-info m-0 py-1 px-2 border-0 text-info btn-sm'><i class='fas fa-edit'></i></a>
                                        <a href='delete_bird.php?id={$bird['id']}' class='btn alert alert-danger m-0 border-0 py-1 px-2 text-danger btn-sm'><i class='fas fa-trash'></i></a>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <!-- </section> -->
        <?php include 'partials/footer.php'; ?>
    </div>
</div>
<!-- Content Wrapper -->
<div
    class="modal fade"
    id="modalId"
    tabindex="-1"
    data-bs-backdrop="static"
    data-bs-keyboard="false"

    role="dialog"
    aria-labelledby="modalTitleId"
    aria-hidden="true">
    <div
        class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg"
        role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title text-center" id="modalTitleId">
                    New Bird
                </h5>
                <button
                    type="button"
                    class="btn-close"
                    data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Add Bird Form -->
                <div class="row">
                    <input type="hidden" name="action" id="action" value="add">
                    <div class="col-md-6 mb-3">
                        <label for="bird_id" class="form-label">bird_id</label>
                        <input type="text" class="form-control" id="bird_id" name="bird_id">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="species" class="form-label">Species</label>
                        <input type="text" class="form-control" id="species" name="species" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                        </select>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="purchase_date" class="form-label">Purchase Date</label>
                        <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="purchase_cost" class="form-label">Purchase Cost</label>
                        <input type="number" class="form-control" id="purchase_cost" name="purchase_cost" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="purchased_from" class="form-label">Purchased From</label>
                        <input type="text" class="form-control" id="purchased_from" name="purchased_from" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="weight_at_purchase" class="form-label">Weight at Purchase (kg)</label>
                        <input type="number" step="0.01" class="form-control" id="weight_at_purchase" name="weight_at_purchase" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="age_at_purchase" class="form-label">Age at Purchase</label>
                        <input type="text" class="form-control" id="age_at_purchase" name="age_at_purchase" required>
                    </div>

                    <div class="col-md-6 mb-3">
                        <label for="hatched_date" class="form-label">Hatched Date</label>
                        <input type="date" class="form-control" id="hatched_date" name="hatched_date">
                    </div>


                    <div class="col-md-6 mb-3">
                        <label for="breeding_at_purchase" class="form-label">Breeding at Purchase</label>
                        <input type="number" step="0.01" class="form-control" id="breeding_at_purchase" name="breeding_at_purchase" required>
                    </div>
                    <div class="col-md-12">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea class="form-control" id="remark" name="remark"></textarea>
                    </div>
                </div>
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
<script>
    $(document).ready(function() {
        $('#add-bird-modal').on('click', function(e) {
            e.preventDefault();
            var bird_id = $('#bird_id').val();
            var species = $('#species').val();
            var gender = $('#gender').val();
            var purchase_date = $('#purchase_date').val();
            var purchase_cost = $('#purchase_cost').val();
            var purchased_from = $('#purchased_from').val();
            var age_at_purchase = $('#age_at_purchase').val();
            var hatched_date = $('#hatched_date').val();
            var breeding_at_purchase = $('#breeding_at_purchase').val();
            var remark = $('#remark').val();
            var weight_at_purchase = $('#weight_at_purchase').val();
            var action = $('#action').val();

            $('.spinner-border').removeClass('d-none')
            $.ajax({
                url: `../../src/controllers/birds_controller.php`,
                method: "POST",
                data: {
                    bird_id: bird_id,
                    species: species,
                    gender: gender,
                    purchase_date: purchase_date,
                    purchase_cost: purchase_cost,
                    purchased_from: purchased_from,
                    age_at_purchase: age_at_purchase,
                    weight_at_purchase: weight_at_purchase,
                    hatched_date: hatched_date,
                    breeding_at_purchase: breeding_at_purchase,
                    remark: remark
                },
                success: function(response) {
                    $('.spinner-border').addClass('d-none');
                    console.log(response)
                    const result = JSON.parse(response);
                    // alert(result)
                    console.log(result)
                    if (result.success) {
                        toastr.success(result.message, "Success");
                        location.href = './public/views/dashboard.php';
                    } else {
                        toastr.error(result.message, "Error");
                        // location.href = './index.php';
                    }
                },
                error: function() {
                    toastr.error("error", "Error");
                }
            }, )
        })
    })
</script>

</body>

</html>

<!-- if you want to close by clicking outside the modal, delete the last endpoint:data-bs-backdrop and data-bs-keyboard -->


<!-- Optional: Place to the bottom of scripts -->
<!-- <script>
    const myModal = new bootstrap.Modal(
        document.getElementById("modalId"),
        options,
    );
</script> -->