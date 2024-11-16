<?php
// Include the header
include 'partials/header.php';
// Include the sidebar
include 'partials/sidebar.php';

require_once '../../src/controllers/species_info_controller.php';
$controller = new SpeciesInfoController();
$species = $controller->getAllSpeciesInfo();
?>

<!-- Content Wrapper -->
<div class="content-wrapper">
    <section class="content">
        <div class="container-fluid">
            <h1 class="text-center">Species Information</h1>

            <!-- Add Species Info Button -->
            <a href="add_species_info.php" class="btn btn-primary mb-3">Add New Species</a>

            <!-- Species Info Table -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Species Name</th>
                        <th>Lifespan (Years)</th>
                        <th>Clutch Size</th>
                        <th>Average Weight (kg)</th>
                        <th>CITES Status</th>
                        <th>Endangered Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($species as $info) {
                        echo "<tr>";
                        echo "<td>{$info['id']}</td>";
                        echo "<td>{$info['species_name']}</td>";
                        echo "<td>{$info['lifespan_years']}</td>";
                        echo "<td>{$info['clutch_size']}</td>";
                        echo "<td>{$info['avg_weight_kg']}</td>";
                        echo "<td>{$info['cites_status']}</td>";
                        echo "<td>{$info['endangered_status']}</td>";
                        echo "<td>
                            <a href='edit_species_info.php?id={$info['id']}' class='btn btn-warning btn-sm'>Edit</a>
                            <a href='delete_species_info.php?id={$info['id']}' class='btn btn-danger btn-sm'>Delete</a>
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
