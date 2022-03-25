<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="./index.php" class="nav-link <?= $page == "dashboard" ? "active" : "" ?>">
                <i class="fas fa-tachometer-alt nav-icon"></i>
                <p>Dashboard</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="device_types.php" class="nav-link <?= $page == "device_types" ? "active" : "" ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Device Types
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="brands.php" class="nav-link <?= $page == "brands" ? "active" : "" ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Brands
                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="models.php" class="nav-link <?= $page == "models" ? "active" : "" ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Models

                </p>
            </a>
        </li>
    </ul>
</nav>