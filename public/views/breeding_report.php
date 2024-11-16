<?php
    // Include header and sidebar
    include 'partials/header.php';
    include 'partials/sidebar.php';
    
    // Import the bird controller to fetch the data
    require_once '../../src/controllers/bird_population_report_controller.php';

    $controller = new BirdPopulationReportController();
    
    // Fetching the data for the report
    $speciesData = $controller->getBirdsBySpecies();
    $genderData = $controller->getBirdsByGender();
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1 class="text-center">Bird Population Report</h1>

            <!-- Filters -->
            <form method="POST" action="">
                <div class="row">
                    <div class="col-md-4">
                        <label for="species">Species</label>
                        <select name="species" class="form-control">
                            <option value="">All Species</option>
                            <?php foreach ($speciesData as $species) { ?>
                                <option value="<?php echo $species['species']; ?>"><?php echo $species['species']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="gender">Gender</label>
                        <select name="gender" class="form-control">
                            <option value="">All Genders</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="unknown">Unknown</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label for="age_range">Age Range</label>
                        <input type="text" name="age_range" class="form-control" placeholder="e.g. 1-5 years">
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-12">
                        <button type="submit" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <!-- Bird Population Table -->
            <h2 class="mt-5">Bird Population Overview</h2>
            <table id="birdPopulationTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Species</th>
                        <th>Total Birds</th>
                        <th>Male</th>
                        <th>Female</th>
                        <th>Unknown</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($speciesData as $species) { ?>
                        <tr>
                            <td><?php echo $species['species']; ?></td>
                            <td><?php echo $species['total_birds']; ?></td>
                            <td><?php echo $genderData[$species['species']]['male']; ?></td>
                            <td><?php echo $genderData[$species['species']]['female']; ?></td>
                            <td><?php echo $genderData[$species['species']]['unknown']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <!-- Export Buttons -->
            <button id="exportCSV" class="btn btn-success mt-3">Export to CSV</button>
            <button id="exportPDF" class="btn btn-danger mt-3">Export to PDF</button>
        </div>
    </section>
</div>

<?php
    include 'partials/footer.php';
?>

<!-- Include DataTables and jQuery -->
<script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
<script>
    $(document).ready(function() {
        $('#birdPopulationTable').DataTable({
            "paging": true,
            "ordering": true,
            "searching": true
        });

        // Export to CSV
        $('#exportCSV').click(function() {
            window.location.href = '../../src/controllers/export_population_report_controller.php?format=csv';
        });

        // Export to PDF
        $('#exportPDF').click(function() {
            window.location.href = '../../src/controllers/export_population_report_controller.php?format=pdf';
        });
    });
</script>
