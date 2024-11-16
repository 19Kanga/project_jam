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
            <h1>Dashboard</h1>

            <!-- Dashboard Content Here -->
            <div class="row">
                <!-- Total Birds -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>
                                <?php
                                require_once '../../src/controllers/bird_controller.php';
                                $controller = new BirdController();
                                $birds = $controller->getAllBirds();
                                echo count($birds);
                                ?>
                            </h3>
                            <p>Total Birds</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dove"></i>
                        </div>
                        <a href="birds.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Male Birds -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-primary">
                        <div class="inner">
                            <h3>
                                <?php
                                $maleBirds = array_filter($birds, fn($bird) => strtoupper($bird['gender']) === 'MALE');
                                echo count($maleBirds);
                                ?>
                            </h3>
                            <p>Total Male Birds</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-mars"></i>
                        </div>
                        <a href="birds.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Female Birds -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-pink">
                        <div class="inner">
                            <h3>
                                <?php
                                $femaleBirds = array_filter($birds, fn($bird) => strtoupper($bird['gender']) === 'FEMALE');
                                echo count($femaleBirds);
                                ?>
                            </h3>
                            <p>Total Female Birds</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-venus"></i>
                        </div>
                        <a href="birds.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Breeding Pairs -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>
                                <?php
                                require_once '../../src/controllers/breeding_controller.php';
                                $breedingController = new BreedingController();
                                $breedingPairs = $breedingController->getAllBreeding();
                                echo count($breedingPairs);
                                ?>
                            </h3>
                            <p>Breeding Pairs</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-heart"></i>
                        </div>
                        <a href="breeding.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Subspecies Male and Female Counts -->
                <div class="col-lg-12">
                    <h4>Subspecies Stats</h4>
                    <div class="row">
                        <?php
                        // Group birds by subspecies and gender
                        $subspeciesStats = [];
                        foreach ($birds as $bird) {
                            $subspecies = $bird['subspecies'];
                            $gender = strtoupper($bird['gender']);

                            if (!isset($subspeciesStats[$subspecies])) {
                                $subspeciesStats[$subspecies] = ['MALE' => 0, 'FEMALE' => 0];
                            }

                            if ($gender === 'MALE' || $gender === 'FEMALE') {
                                $subspeciesStats[$subspecies][$gender]++;
                            }
                        }

                        // Display stats for each subspecies
                        foreach ($subspeciesStats as $subspecies => $genders) {
                            echo "
                            <div class='col-lg-3 col-6'>
                                <div class='small-box bg-white flex justify-content-center align-content-center py-1 px-4'>
                                    <div class='inner d-flex flex-column gap-2'>
                                        <h4 class='m-0' style='font-size:1.3rem'>$subspecies</h4>
                                        <p class='m-0'>Males: {$genders['MALE']}</p>
                                        <p class='m-0'>Females: {$genders['FEMALE']}</p>
                                    </div>
                                </div>
                            </div>";
                        }
                        ?>
                    </div>
                </div>

                <!-- Total Purchase Cost -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-warning">
                        <div class="inner py-4 px-4">
                            <h3 class="font-bold text-white" style="font-size: 1.6rem;">
                                <?php
                                require_once '../../src/controllers/purchases_controller.php';
                                $purchasesController = new PurchasesController();
                                $purchases = $purchasesController->getAllPurchases();
                                $totalPurchaseCost = array_sum(array_column($purchases, 'purchase_cost'));
                                echo '₹' . number_format($totalPurchaseCost, 0);

                                ?>
                            </h3>
                            <p style="font-size: .9rem;">Total Purchase Cost</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <a href="purchases.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>

                <!-- Total Sales Revenue -->
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner py-4 px-4">
                            <h3 class="font-bold text-white" style="font-size: 1.6rem;">
                                <?php
                                require_once '../../src/controllers/sales_controller.php';
                                $salesController = new SalesController();
                                $sales = $salesController->getAllSales();
                                $totalSalesRevenue = array_sum(array_column($sales, 'sale_price'));
                                echo '₹' . number_format($totalSalesRevenue, 2);
                                ?>
                            </h3>
                            <p style="font-size: .9rem;">Total Sales Revenue</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <a href="sales.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="bg-white col-lg-12 py-4">
                    <div id="chart"></div>
                </div>
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
<script>
    // Données du graphique
    const options = {
        chart: {
            type: 'bubble', // Type de graphique principal
            height: 400,
            toolbar: {
                show: true // Affiche la barre d'outils pour les options de téléchargement
            },
            zoom: {
                enabled: true // Permet le zoom
            }
        },
        series: [{
                name: 'Sales',
                type: 'column', // Série en barres pour les ventes
                data: [1200, 1500, 1800, 1700, 1900, 2200, 2400, 2500, 2700, 3000, 3200, 3400]
            },
            {
                name: 'Spent',
                type: 'line', // Série en lignes pour les dépenses
                data: [900, 1100, 1200, 1300, 1250, 1350, 1450, 1600, 1800, 2100, 2200, 2300]
            }
        ],
        colors: ['#1E90FF', '#FF6347'], // Couleurs personnalisées pour chaque série
        stroke: {
            width: [0, 4] // Largeur des lignes, avec la série en colonne à 0
        },
        dataLabels: {
            enabled: true,
            enabledOnSeries: [1] // Afficher les étiquettes pour la série des dépenses uniquement
        },
        markers: {
            size: 5 // Taille des marqueurs sur la ligne
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            title: {
                text: 'Month'
            }
        },
        yaxis: [{
                title: {
                    text: 'Sale (en USD)'
                },
                labels: {
                    formatter: function(val) {
                        return "$" + val.toFixed(0); // Formatte les labels en dollars
                    }
                }
            },
            {
                opposite: true,
                title: {
                    text: 'Spent (en USD)'
                },
                labels: {
                    formatter: function(val) {
                        return "$" + val.toFixed(0);
                    }
                }
            }
        ],
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function(val) {
                    return "$" + val.toFixed(2); // Formate le tooltip en dollars avec 2 décimales
                }
            }
        },
        legend: {
            position: 'bottom', // Position de la légende
            horizontalAlign: 'center'
        },
        annotations: {
            yaxis: [{
                y: 2500,
                borderColor: '#FF6347',
                label: {
                    borderColor: '#FF6347',
                    style: {
                        color: '#fff',
                        background: '#FF6347'
                    },
                    text: 'Objectif of spent'
                }
            }],
            xaxis: [{
                x: 'Jul',
                borderColor: '#1E90FF',
                label: {
                    style: {
                        color: '#fff',
                        background: '#1E90FF'
                    },
                    text: 'Pic of Sales'
                }
            }]
        }
    };

    // Créer et afficher le graphique
    const chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
</body>

</html>