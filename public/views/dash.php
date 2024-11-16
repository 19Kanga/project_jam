<?php include './partials/headers.php' ?>
<div class="container-fluid">
    <div class="row">
        <!-- Menu latéral -->
        <div class="col-md-2 sidebar">
            <h2 class="text-center">Admin Oiseaux</h2>
            <a href="#dashboard"><i class="fas fa-chart-line"></i> Dashboard</a>
            <a href="#species"><i class="fas fa-dove"></i> Espèces d'oiseaux</a>
            <a href="#observations"><i class="fas fa-binoculars"></i> Observations</a>
            <a href="#settings"><i class="fas fa-cog"></i> Paramètres</a>
        </div>

        <!-- Contenu principal -->
        <div class="col-md-10 content">
            <!-- Cartes statistiques -->
            <div class="row g-3">
                <div class="col-md-4">
                    <div class="stat-card d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Total d'Oiseaux</h5>
                            <h3>2,345</h3>
                        </div>
                        <div><i class="fas fa-dove stat-icon"></i></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Espèces</h5>
                            <h3>150</h3>
                        </div>
                        <div><i class="fas fa-feather-alt stat-icon"></i></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Observations</h5>
                            <h3>7,234</h3>
                        </div>
                        <div><i class="fas fa-binoculars stat-icon"></i></div>
                    </div>
                </div>
            </div>

            <!-- Section des graphiques -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Population des Oiseaux par Mois</h5>
                            <div id="birdPopulationChart"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tableau des observations récentes -->
            <div class="row mt-4">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Observations Récentes</h5>
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Espèce</th>
                                        <th>Lieu</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Rouge-gorge</td>
                                        <td>Parc National</td>
                                        <td>2023-11-10</td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Moineau</td>
                                        <td>Forêt Noire</td>
                                        <td>2023-11-08</td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Héron</td>
                                        <td>Lac Ontario</td>
                                        <td>2023-11-07</td>
                                    </tr>
                                    <!-- Ajouter d'autres observations ici -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include './partials/footers.php' ?>
<!-- Script pour le graphique avec ApexCharts -->
<script>
    $(document).ready(function() {
        var options = {
            chart: {
                type: 'line',
                height: 350
            },
            series: [{
                name: 'Population',
                data: [200, 250, 300, 350, 400, 450, 470, 500, 530, 550, 580, 600]
            }],
            xaxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                title: {
                    text: 'Mois'
                }
            },
            yaxis: {
                title: {
                    text: 'Population'
                }
            },
            colors: ['#f0a500'],
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'smooth',
                width: 2
            }
        };

        var chart = new ApexCharts(document.querySelector("#birdPopulationChart"), options);
        chart.render();
    });
</script>