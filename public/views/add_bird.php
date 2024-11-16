<?php
    // Include the header
    include 'partials/header.php';
    include 'partials/sidebar.php';

?>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h1>Add New Bird</h1>

                <!-- Add Bird Form -->
                <form action="../../src/controllers/bird_controller.php" method="POST">
                    <input type="hidden" name="action" value="add">

                    <div class="mb-3">
                        <label for="species" class="form-label">Species</label>
                        <input type="text" class="form-control" id="species" name="species" required>
                    </div>

                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-control" id="gender" name="gender" required>
                            <option value="MALE">Male</option>
                            <option value="FEMALE">Female</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="purchase_date" class="form-label">Purchase Date</label>
                        <input type="date" class="form-control" id="purchase_date" name="purchase_date" required>
                    </div>

                    <div class="mb-3">
                        <label for="purchase_cost" class="form-label">Purchase Cost</label>
                        <input type="number" class="form-control" id="purchase_cost" name="purchase_cost" required>
                    </div>

                    <div class="mb-3">
                        <label for="purchased_from" class="form-label">Purchased From</label>
                        <input type="text" class="form-control" id="purchased_from" name="purchased_from" required>
                    </div>

                    <div class="mb-3">
                        <label for="weight_at_purchase" class="form-label">Weight at Purchase (kg)</label>
                        <input type="number" step="0.01" class="form-control" id="weight_at_purchase" name="weight_at_purchase" required>
                    </div>

                    <div class="mb-3">
                        <label for="age_at_purchase" class="form-label">Age at Purchase</label>
                        <input type="text" class="form-control" id="age_at_purchase" name="age_at_purchase" required>
                    </div>

                    <div class="mb-3">
                        <label for="hatched_date" class="form-label">Hatched Date</label>
                        <input type="date" class="form-control" id="hatched_date" name="hatched_date">
                    </div>

                    <div class="mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea class="form-control" id="remark" name="remark"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="breeding_at_purchase" class="form-label">Breeding at Purchase</label>
                        <input type="number" step="0.01" class="form-control" id="breeding_at_purchase" name="breeding_at_purchase" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Bird</button>
                </form>

            </div>
        </section>
    </div>


    <?php

    include 'partials/footer.php';

?>
