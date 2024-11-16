<!-- header.php -->
<?php
// Include the header
// session_start();
?>

<!-- <body class="hold-transition sidebar-mini layout-fixed"> -->
<div class="wrapper">
    <!-- Navbar -->
    <nav class="navbar px-4 shadow-sm elevation-0 justify-content-between navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <div class="" id="pushmenu" role="button"><i class="fas fa-bars"></i></div>
            </li>
        </ul>
        <div class="d-flex align-items-center gap-4">
            <div class="d-flex align-items-center justify-content-center text-gray"><i class="fas fa-bell navbar-icon"></i></div>
            <a href="../../../logout.php" class="d-flex align-items-center gap-2">
                <div class="profile-user">
                    <img class="position-absolute w-100 h-100 object-fit-cover" src='../../../image/logo.webp' alt='#' />
                </div>
                <div class="flex-column d-md-none d-xl-flex d-flex ">
                    <span class="username font-monospace"><?php echo $_SESSION['username'] ?></span>
                    <span class="role-user"><?php echo $_SESSION['role'] ?></span>
                </div>
            </a>
        </div>
    </nav>
    <!-- </div> -->
    <!-- Sidebar and content will be loaded below -->