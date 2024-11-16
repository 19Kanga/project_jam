<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Breeding Pair</title>
    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/css/adminlte.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
</head>
<body class="hold-transition sidebar-mini layout-fixed">

<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </nav>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="dashboard.php" class="brand-link">
            <img src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-light">AMS</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="dashboard.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="birds.php" class="nav-link">
                            <i class="nav-icon fas fa-dove"></i>
                            <p>Birds</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="breeding.php" class="nav-link">
                            <i class="nav-icon fas fa-heart"></i>
                            <p>Breeding</p>
                        </a>
                    </li>
                    <!-- Add more items here -->
                </ul>
            </nav>
        </div>
    </aside>

    <!-- Content Wrapper -->
    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h1>Add New Breeding Pair</h1>

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

                    <div class="mb-3">
                        <label for="success_rate" class="form-label">Success Rate (%)</label>
                        <input type="number" class="form-control" id="success_rate" name="success_rate" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Add Breeding Pair</button>
                </form>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer class="main-footer">
        <strong>&copy; 2024 <a href="#">AMS</a>.</strong> All rights reserved.
    </footer>
</div>

<!-- AdminLTE Scripts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
