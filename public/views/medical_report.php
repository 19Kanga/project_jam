<?php
    include 'partials/header.php';
    include 'partials/sidebar.php';
    require_once '../../src/controllers/medical_controller.php';

    $controller = new MedicalController();
    $medicalRecords = $controller->getAllMedical();
?>

<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1 class="text-center">Medical Report</h1>
            <table id="medicalTable" class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Bird ID</th>
                        <th>Checkup Date</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($medicalRecords as $record) { ?>
                        <tr>
                            <td><?php echo $record['id']; ?></td>
                            <td><?php echo $record['bird_id']; ?></td>
                            <td><?php echo $record['checkup_date']; ?></td>
                            <td><?php echo $record['notes']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <!-- Export Buttons -->
            <button id="exportCSV" class="btn btn-success">Export to CSV</button>
            <button id="exportPDF" class="btn btn-danger">Export to PDF</button>
        </div>
    </section>
</div>

<?php
    include 'partials/footer.php';
?>
