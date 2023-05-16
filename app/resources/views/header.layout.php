<?php
    include("../admin/config.php");
?>
    <!-- Theme style -->
    <link rel="stylesheet" href=<?php echo Page::asset("/public/dist/css/adminlte.min.css");?>>
</head>
<body class="hold-transition sidebar-mini" style="height: auto;">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>                
            </li>
            <li class="nav-item">
                <a class="nav-link" href=<?php echo Page::asset('/index.php')?> role="button">Home</a>                
            </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
            <?php
                        if(isset($_SESSION['user_token'])){
                            echo '<li class="nav-item">                            
                            <form action="../app/includes/auth/logout.inc.php" method="POST">
                            <input type="submit" name="submit" value="Logout" class="btn">
                        </form>
                    </li>';
                        }else{
                            echo '<li class="nav-item">
                            <a href= '.Page::asset('/login.php').' class="nav-link">Login</a>
                    </li>
                    <li class="nav-item">
                        <a href='.Page::asset('/register.php').' class="nav-link">Register</a>
                    </li>';
                    }
                    ?>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.php" class="brand-link">
            <img src=<?php echo Page::asset("/public/assets/img/logo.png");?> alt="ProTech Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">LGTMS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['user_name']?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <!-- Add icons to the links using the .nav-icon class
                        with font-awesome or any other icon font library -->
                    <li class="nav-item">
                        <a href="index.php" class="nav-link">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="chart.php" class="nav-link">
                            <i class="nav-icon fas fa-chart-bar"></i>
                            <p>Charts</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" onclick="alert('<?php echo $datas[0]['ip']?>')" class="nav-link">
                            <i class="nav-icon fas fa-cog"></i>
                            <p>Configure</p>
                        </a>
                    </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>