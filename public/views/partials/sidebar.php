<!-- sidebar.php -->

<?php
$sidebare = [
    [
        "icon" => "nav-icon fas fa-tachometer-alt",
        "titre" => "dashboard",
        "link" => "dashboard.php",
        "children" => []
    ],
    [
        "icon" => "nav-icon fas fa-dove",
        "titre" => "Birds",
        "link" => "#",
        "children" => [
            [
                "icon" => "far fa-circle nav-icon",
                "titre" => "List",
                "link" => "birds.php",
            ],
            [
                "icon" => "far fa-circle nav-icon",
                "titre" => "BIRD STATS",
                "link" => "bird_stats.php",
            ]
        ]
    ],
    [
        "icon" => "nav-icon fas fa-heart",
        "titre" => "Breeding",
        "link" => "breeding.php",
        "children" => [
            // [
            //     "icon" => "far fa-circle nav-icon",
            //     "titre" => "Breeding Records",
            //     "link" => "breeding.php",
            // ],
            // [
            //     "icon" => "far fa-circle nav-icon",
            //     "titre" => "Add Breeding Pair",
            //     "link" => "add_breeding.php",
            // ]
        ]
    ],
    [
        "icon" => "nav-icon fas fa-utensils",
        "titre" => "Feeding",
        "link" => "feeding.php",
        "children" => [
            // [
            //     "icon" => "far fa-circle nav-icon",
            //     "titre" => "Feeding Schedule",
            //     "link" => "feeding.php",
            // ],
            // [
            //     "icon" => "far fa-circle nav-icon",
            //     "titre" => "Add Feeding Record",
            //     "link" => "add_feeding.php",
            // ]
        ]
    ],
    [
        "icon" => "nav-icon fas fa-notes-medical",
        "titre" => "Medical Records",
        "link" => "medical.php",
        "children" => [
            // [
            //     "icon" => "far fa-circle nav-icon",
            //     "titre" => "View Medical Records",
            //     "link" => "medical.php",
            // ],
            // [
            //     "icon" => "far fa-circle nav-icon",
            //     "titre" => "Add Medical Record",
            //     "link" => "add_medical.php",
            // ]
        ]
    ],
    // [
    //     "icon" => "nav-icon fas fa-dollar-sign",
    //     "titre" => "Sales",
    //     "link" => "#",
    //     "children" => [
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "View Sales",
    //             "link" => "sales.php",
    //         ],
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "Add New Sale",
    //             "link" => "add_sale.php",
    //         ]
    //     ]
    // ],
    // [
    //     "icon" => "nav-icon fas fa-dollar-sign",
    //     "titre" => "Purchases",
    //     "link" => "#",
    //     "children" => [
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "View Purchases",
    //             "link" => "purchases.php",
    //         ],
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "Add New Purchase",
    //             "link" => "add_purchase.php",
    //         ]
    //     ]
    // ],
    // [
    //     "icon" => "nav-icon fas fa-cloud-sun",
    //     "titre" => "Environmental",
    //     "link" => "#",
    //     "children" => [
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "View Environmental",
    //             "link" => "environment.php",
    //         ],
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "Add Environmental",
    //             "link" => "add_environment.php",
    //         ]
    //     ]
    // ],
    // [
    //     "icon" => "nav-icon fas fa-shopping-basket",
    //     "titre" => "Feed Purchase",
    //     "link" => "#",
    //     "children" => [
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "View Feed Purchases",
    //             "link" => "feed_purchase.php",
    //         ],
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "Add New",
    //             "link" => "add_feed_purchase.php",
    //         ],
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "View Feed Inventory",
    //             "link" => "feed_inventory.php",
    //         ]
    //     ]
    // ],
    // [
    //     "icon" => "nav-icon fas fa-chart-line",
    //     "titre" => "Reports & Analytics",
    //     "link" => "reports.php",
    //     "children" => []
    // ],
    // [
    //     "icon" => "nav-icon fas fa-users",
    //     "titre" => "User",
    //     "link" => "#",
    //     "children" => [
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "View Users",
    //             "link" => "users.php",
    //         ],
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "Add New User",
    //             "link" => "add_user.php",
    //         ]
    //     ]
    // ],
    // [
    //     "icon" => "nav-icon fas fa-users",
    //     "titre" => "Random stuff",
    //     "link" => "#",
    //     "children" => [
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "Species Facts Users",
    //             "link" => "species_info.php",
    //         ],
    //         [
    //             "icon" => "far fa-circle nav-icon",
    //             "titre" => "Add New User",
    //             "link" => "add_user.php",
    //         ]
    //     ]
    // ],
]
?>
<aside class="sidebar-dark-primary position-fixed h-100 z-3 top-0 p-0 dt-left sideb">
    <!-- Brand Logo -->
    <a href="dashboard.php" class="brand-link d-flex w-100 justify-content-center align-items-center text-decoration-none">
        <!-- <img src="https://cdn.jsdelivr.net/npm/admin-lte@3.1/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"> -->
        <span class="brand-text font-font-weight-bold">AMS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar p-0 px-2 pb-3">
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column overflow-y-auto" data-widget="treeview" role="menu" data-accordion="false">
                <?php
                    foreach($sidebare as $side){
                        if(count($side['children'])===0){
                            echo "<li class='nav-item'>";
                            echo "<a href={$side['link']} class='nav-link d-flex align-items-center gap-2 text-capitalize'>";
                            echo "<i class='{$side['icon']}'></i>";
                            echo "<p>{$side['titre']}</p>";
                            echo "</a>";
                            echo "</li>";
                        }else{
                            echo "<li class='nav-item has-treeview'>";
                                echo "<a href='{$side['link']}' class='nav-link d-flex align-items-center justify-content-between'>";
                                    echo "<div class='d-flex align-items-center gap-2'>";
                                                echo"<i class='{$side['icon']}'></i>";
                                                echo"<p>{$side['titre']}</p>";
                                    echo "</div>";
                                    echo "<i class='fas fa-angle-right iconr'></i>";
                                echo "</a>";
                                echo "<ul class='nav nav-treeview'>";
                                foreach($side['children'] as $key){
                                    echo "<li class='nav-item'>";
                                        echo"<a href={$key['link']} class='nav-link py-2 d-flex align-items-center gap-2 text-capitalize'>";
                                            echo "<i class='far fa-circle nav-icon'></i>";
                                            echo "<p>{$key['titre']}</p>";
                                        echo "</a>";
                                    echo "</li>";
                                }
                                echo "</ul>";
                            echo "</li>";  
                        }
                    }?>
            </ul>
        </nav>
    </div>
</aside>