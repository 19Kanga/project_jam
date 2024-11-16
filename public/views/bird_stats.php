<?php
// Include the header
session_start();
include 'partials/headers.php';
if (!isset($_SESSION['status']) && $_SESSION['status'] !== 'online') {
    header("Location: /");
}

require_once '../../src/controllers/bird_stat_controller.php';

$controller = new BirdController();

$birdsPerYear = $controller->getBirdsBoughtPerYear();
$genderStats = $controller->getBirdCountByGender();
$speciesGenderStats = $controller->getSpeciesGenderStats();
$totalSpentPerYear = $controller->getTotalSpentPerYear();
$totalSpentPerSpecies = $controller->getTotalSpentPerSpecies();
?>

<div class="d-flex">
    <?php include 'partials/sidebar.php'; ?>
    <div class="container-avs">
        <?php include 'partials/header.php'; ?>
        <!-- <section class="content"> -->
        <div class="py-2 pt-4 px-4">
            <h1>Bird Statistics</h1>

            <div class="d-flex flex-column w-100 gap-4">
                <div class="bg-white p-4 shadow shadow-sm">
                    <h5 class="font-font-weight-bold text-gray">Birds Bought Per Year</h5>
                    <table id="birdsBoughtPerYear" class="table table-striped table-responsive-md table-bordered">
                        <thead>
                            <tr>
                                <th>Year</th>
                                <th>Total Birds Bought</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($birdsPerYear as $year) { ?>
                                <tr>
                                    <td><?php echo $year['year']; ?></td>
                                    <td><?php echo $year['total_birds_bought']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- Gender Stats -->
                <div class="bg-white p-4 shadow shadow-sm">
                    <h5 class="font-font-weight-bold text-gray">Bird Count by Gender</h5>
                    <table id="genderStats" class="table table-bordered table table-striped table-responsive-md table-bordered">
                        <thead>
                            <tr>
                                <th>Gender</th>
                                <th>Total Count</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($genderStats as $gender) { ?>
                                <tr>
                                    <td><?php echo $gender['gender']; ?></td>
                                    <td><?php echo $gender['total_gender']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- Species-Gender Stats -->
                <div class="bg-white p-4 shadow shadow-sm">
                    <h5 class="font-font-weight-bold text-gray">Species-Gender Stats</h5>
                    <table id="speciesGenderStats" class="table table-bordered table table-striped table-responsive-md table-bordered">
                        <thead>
                            <tr>
                                <th>Species</th>
                                <th>Gender</th>
                                <th>Total Birds</th>
                                <th>Total Spent</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($speciesGenderStats as $stat) { ?>
                                <tr>
                                    <td><?php echo $stat['species']; ?></td>
                                    <td><?php echo $stat['gender']; ?></td>
                                    <td><?php echo $stat['total_birds']; ?></td>
                                    <td><?php echo $stat['total_spent']; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <!-- Total Spent Per Year -->
                <!-- <h2>Total Spent Per Year</h2>
                <table id="totalSpentPerYear" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Year</th>
                            <th>Total Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($totalSpentPerYear as $year) { ?>
                            <tr>
                                <td><?php echo $year['year']; ?></td>
                                <td><?php echo $year['total_spent']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table> -->

                <!-- Total Spent Per Species -->
                <!-- <h2>Total Spent Per Species</h2>
                <table id="totalSpentPerSpecies" class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Species</th>
                            <th>Total Spent</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($totalSpentPerSpecies as $species) { ?>
                            <tr>
                                <td><?php echo $species['species']; ?></td>
                                <td><?php echo $species['total_spent']; ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table> -->
            </div>
        </div>
        <!-- </section> -->
        <?php include 'partials/footer.php'; ?>
    </div>
</div>
<!-- Content Wrapper -->


<?php
// Include the footers
include 'partials/footers.php';
?>