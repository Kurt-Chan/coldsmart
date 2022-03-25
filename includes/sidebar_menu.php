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
            <a href="my_devices.php" class="nav-link <?= $page == "my_devices" ? "active" : "" ?>">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    My Devices
                    <?php
                    $user_id = $_SESSION["id"];
                    $device_count_query = mysqli_query($conn, "SELECT count(*) as count FROM device WHERE owner_id='$user_id'");
                    $device_count = mysqli_fetch_assoc($device_count_query)['count'];
                    ?>
                    <span class="right badge badge-danger"><?= $device_count ?></span>
                </p>
            </a>
        </li>

    </ul>
</nav>