<?php include "includes/head.php";
include "includes/config.php";
include "includes/check_session.php";

?>

<div class="wrapper">

    <!-- Preloader -->
    <div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
    </div>

    <?php include "includes/navbar.php"; ?>

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="index3.html" class="brand-link">
            <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">AdminLTE 3</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block"><?= $_SESSION['name'] ?></a>
                </div>
            </div>

            <!-- SidebarSearch Form -->
            <div class="form-inline">
                <div class="input-group" data-widget="sidebar-search">
                    <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                    <div class="input-group-append">
                        <button class="btn btn-sidebar">
                            <i class="fas fa-search fa-fw"></i>
                        </button>
                    </div>
                </div>
            </div>

            <?php
            $page = "dashboard";
            include "includes/sidebar_menu.php" ?>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">

                        <h2 class=" font-weight-bold m-0">
                            <div class="mainText">
                                DASHBOARD
                            </div>
                        </h2>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard v1</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="secondaryText">
                    <div class="h5 font-weight-bold">
                        MY DEVICES
                    </div>
                </div>
                <div class="row">
                    <?php
                    // get all devices from database owned by the user
                    $device_query = mysqli_query($conn, "SELECT * FROM device WHERE owner_id='$user_id'");
                    while ($device = mysqli_fetch_assoc($device_query)) {
                        $device_id = $device['id'];
                        // get last command for the device
                        $last_command_query = mysqli_query($conn, "SELECT action from action WHERE id = (SELECT max(id) FROM action WHERE device='$device_id')");
                        $last_command = mysqli_fetch_assoc($last_command_query)['action'];
                    ?>
                        <div class="card mx-2" style="width: 22rem">
                            <!-- <div class="card-body cardBody"> -->
                            <!-- small box -->
                            <div>
                                <div class="card-header cardHeader">
                                    <div class="row">
                                        <div class="col-sm d-inline">
                                            <p class="h4 text-wrap font-weight-bold lightText"><?= $device['name'] ?></p>
                                        </div>
                                        <div class="col-sm">
                                            <!-- buttons -->
                                            <div class="btn-group btn-group-toggle d-inline " data-toggle="buttons">
                                                <label class="btn btn-success btn-m">
                                                    <form action="functions/appliance_switch.php" method="post">
                                                        <input type="hidden" name="device_id" value="<?= $device['id'] ?>">
                                                        <input type="submit" <?= $last_command == "ON" ? "disabled" : "" ?> name="on" class="bg-transparent border-0 text-white" value="ON">
                                                    </form>
                                                </label>
                                                <label class="btn btn-danger btn-m">
                                                    <form action="functions/appliance_switch.php" method="post">
                                                        <input type="hidden" name="device_id" value="<?= $device['id'] ?>">
                                                        <input type="submit" <?= $last_command == "OFF" ? "disabled" : "" ?> class="bg-transparent border-0 text-white" name="off" value='OFF'>
                                                    </form>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm">

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body cardBody">
                                    <div id="myChart<?= $device_id ?>"></div>
                                </div>

                            </div>
                        </div>
                        <!-- script for Chart -->
                        <script>
                            <?php
                            echo "let data$device_id=[];";
                            echo "let labels$device_id=[];";
                            // get actions of device for today
                            $data_query = mysqli_query($conn, "SELECT * FROM action WHERE device='$device_id' and cast(datetime as date)=  cast(CURRENT_TIMESTAMP as date)");
                            while ($row = mysqli_fetch_assoc($data_query)) {
                                $action = $row['action'] == "ON" ? 1 : 0;
                                $label = date('H:i', strtotime($row['datetime']));
                                echo "data$device_id.push($action);";
                                echo "labels$device_id.push('$label');";
                            }
                            echo "console.log('data:', data$device_id, 'labels:', labels$device_id);";
                            ?>
                            window.chartColors = {
                                red: 'rgb(255, 99, 132)',
                                orange: 'rgb(255, 159, 64)',
                                yellow: 'rgb(255, 205, 86)',
                                green: 'rgb(75, 192, 192)',
                                blue: 'rgb(3, 101, 140)',
                                purple: 'rgb(153, 102, 255)',
                                grey: 'rgb(201, 203, 207)'
                            };

                            function createConfig(details, data, labels) {
                                console.log("Data createConfig():", data);
                                console.log("Labels createConfig():", labels);
                                return {
                                    type: 'line',
                                    data: {
                                        labels: labels,
                                        datasets: [{
                                            label: 'steppedLine: ' + ((typeof(details.steppedLine) === 'boolean') ? details.steppedLine : `'${details.steppedLine}'`),
                                            steppedLine: details.steppedLine,
                                            data: data,
                                            borderColor: details.color,
                                            fill: false,
                                            stepped: true
                                        }]
                                    },
                                    options: {
                                        responsive: true,
                                        title: {
                                            display: false,
                                            text: details.label,
                                        }
                                    }
                                };
                            }
                            $(function() {
                                var container = document.querySelector('#myChart<?= $device_id ?>');
                                var <?= "data0$device_id" ?> = <?= "data$device_id" ?>;
                                var steppedLineSettings = [{
                                    steppedLine: true,
                                    label: 'Usage',
                                    color: window.chartColors.blue
                                }];
                                steppedLineSettings.forEach(function(details) {
                                    var div = document.createElement('div');
                                    div.classList.add('chart-container');
                                    var canvas = document.createElement('canvas');
                                    div.appendChild(canvas);
                                    container.appendChild(div);
                                    var ctx = canvas.getContext('2d');
                                    var config = createConfig(details, <?= "data0$device_id" ?>, <?= "labels$device_id" ?>);
                                    new Chart(ctx, config);
                                });

                            });
                        </script>
                    <?php } ?>

                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-12">

                    </section>
                    <!-- /.Left col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->

        <div class="container-fluid">

            <div class="row">
                <div class="col-12">


                    <div class="card ">
                        <div class="card-header cardHeader">

                            <h4 class="font-weight-bold text-center lightText">DAILY CONSUMPTION</h4>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body cardBody">
                            <table id="table1" class="table table-bordered table-striped cardBody">
                                <thead>
                                    <tr>
                                        <th>Appliance</th>
                                        <th>Total Time Used</th>
                                        <th>Total Kilowatts Used</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Get all devices owned by user
                                    $total_time = 0;
                                    $total_kilowatts = 0;
                                    $total_amount = 0;
                                    $devices = mysqli_query($conn, "SELECT d.id, m.average_consumption, d.name FROM device as d inner join model as m on m.id = d.model WHERE d.owner_id='$user_id'");
                                    while ($device = mysqli_fetch_assoc($devices)) {
                                        // get all actions for device
                                        $device_id = $device['id'];
                                        // get actions of device for today
                                        $actions = mysqli_query($conn, "SELECT * FROM action where device = '$device_id' and cast(datetime as date)=  cast(CURRENT_TIMESTAMP as date)");
                                        $i = 0;
                                        $timeFirst = "";
                                        $total = 0;
                                        while ($row = mysqli_fetch_assoc($actions)) {
                                            if ($i == 0 && $row['action'] == "ON") {
                                                $timeFirst = strtotime($row['datetime']);
                                                $i++;
                                            } else if ($i == 1) {
                                                $timeSecond = strtotime($row['datetime']);
                                                $differenceInSeconds = $timeSecond - $timeFirst;
                                                $total += $differenceInSeconds;
                                                $i = 0;
                                            }
                                        }

                                        // if appliance is ON, compute consumption till present
                                        if ($i == 1) {
                                            $time_query = mysqli_query($conn, "SELECT NOW() as now");
                                            $time = mysqli_fetch_assoc($time_query)['now'];

                                            $timeSecond = strtotime($time);
                                            $differenceInSeconds = $timeSecond - $timeFirst;
                                            // echo $differenceInSeconds;
                                            $total += $differenceInSeconds;
                                            $i = 0;
                                        }

                                        $hours = $total / 60 / 60;
                                        $average_consumption = $device['average_consumption'];
                                        $utility_rate = 14.95;
                                        $price = $hours * $average_consumption * $utility_rate;
                                        $kilowatts_used = $hours * $average_consumption;

                                        $total_time += $hours;
                                        $total_kilowatts += $kilowatts_used;
                                        $total_amount += $price;
                                    ?>
                                        <tr>
                                            <td><?= $device['name'] ?> </td>
                                            <td><?= round($hours, 3) ?> hr</td>
                                            <td><?= round($kilowatts_used, 3) ?> kWh</td>
                                            <td>₱<?= round($price, 2) ?></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr class="bg-primary">
                                        <th>Today's Total</th>
                                        <th><?= round($total_time, 3) ?> hr</th>
                                        <th><?= round($total_kilowatts, 3) ?> kWh</th>
                                        <th>₱<?= round($total_amount, 2) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>

            <div class="row">
                <div class="col-12">


                    <div class="card">
                        <div class="card-header">

                            <h4 class="font-weight-bold text-center">WEEKLY CONSUMPTION</h4>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table2" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Appliance</th>
                                        <th>Total Time Used</th>
                                        <th>Total Kilowatts Used</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Get all devices owned by user
                                    $total_time = 0;
                                    $total_kilowatts = 0;
                                    $total_amount = 0;
                                    $devices = mysqli_query($conn, "SELECT d.id, m.average_consumption, d.name FROM device as d inner join model as m on m.id = d.model WHERE d.owner_id='$user_id'");
                                    while ($device = mysqli_fetch_assoc($devices)) {
                                        // get all actions for device, this week
                                        $device_id = $device['id'];
                                        $actions = mysqli_query($conn, "SELECT * FROM action where device = '$device_id' and week(datetime) = week(now())");
                                        $i = 0;
                                        $timeFirst = "";
                                        $total = 0;
                                        while ($row = mysqli_fetch_assoc($actions)) {
                                            if ($i == 0 && $row['action'] == "ON") {
                                                $timeFirst = strtotime($row['datetime']);
                                                $i++;
                                            } else if ($i == 1) {
                                                $timeSecond = strtotime($row['datetime']);
                                                $differenceInSeconds = $timeSecond - $timeFirst;
                                                $total += $differenceInSeconds;
                                                $i = 0;
                                            }
                                        }
                                        $hours = $total / 60 / 60;
                                        $average_consumption = $device['average_consumption'];
                                        $utility_rate = 14.95;
                                        $price = $hours * $average_consumption * $utility_rate;
                                        $kilowatts_used = $hours * $average_consumption;

                                        $total_time += $hours;
                                        $total_kilowatts += $kilowatts_used;
                                        $total_amount += $price;
                                    ?>
                                        <tr>
                                            <td><?= $device['name'] ?> </td>
                                            <td><?= round($hours, 3) ?> hr</td>
                                            <td><?= round($kilowatts_used, 3) ?> kWh</td>
                                            <td>₱<?= round($price, 2) ?></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr class="bg-primary">
                                        <th>This Week's Total</th>
                                        <th><?= round($total_time, 3) ?> hr</th>
                                        <th><?= round($total_kilowatts, 3) ?> kWh</th>
                                        <th>₱<?= round($total_amount, 2) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <div class="row">
                <div class="col-12">


                    <div class="card">
                        <div class="card-header">

                            <h4 class="font-weight-bold text-center">MONTHLY CONSUMPTION</h4>

                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="table3" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>Appliance</th>
                                        <th>Total Time Used</th>
                                        <th>Total Kilowatts Used</th>
                                        <th>Total Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // Get all devices owned by user
                                    $total_time = 0;
                                    $total_kilowatts = 0;
                                    $total_amount = 0;
                                    $devices = mysqli_query($conn, "SELECT d.id, m.average_consumption, d.name FROM device as d inner join model as m on m.id = d.model WHERE d.owner_id='$user_id'");
                                    while ($device = mysqli_fetch_assoc($devices)) {
                                        // get all actions for device, this month
                                        $device_id = $device['id'];
                                        $actions = mysqli_query($conn, "SELECT * FROM action where device = '$device_id' and month(datetime) = month(now())");
                                        $i = 0;
                                        $timeFirst = "";
                                        $total = 0;
                                        while ($row = mysqli_fetch_assoc($actions)) {
                                            if ($i == 0 && $row['action'] == "ON") {
                                                $timeFirst = strtotime($row['datetime']);
                                                $i++;
                                            } else if ($i == 1) {
                                                $timeSecond = strtotime($row['datetime']);
                                                $differenceInSeconds = $timeSecond - $timeFirst;
                                                $total += $differenceInSeconds;
                                                $i = 0;
                                            }
                                        }
                                        $hours = $total / 60 / 60;
                                        $average_consumption = $device['average_consumption'];
                                        $utility_rate = 14.95;
                                        $price = $hours * $average_consumption * $utility_rate;
                                        $kilowatts_used = $hours * $average_consumption;

                                        $total_time += $hours;
                                        $total_kilowatts += $kilowatts_used;
                                        $total_amount += $price;
                                    ?>
                                        <tr>
                                            <td><?= $device['name'] ?> </td>
                                            <td><?= round($hours, 3) ?> hr</td>
                                            <td><?= round($kilowatts_used, 3) ?> kWh</td>
                                            <td>₱<?= round($price, 2) ?></td>
                                        </tr>
                                    <?php } ?>

                                </tbody>
                                <tfoot>
                                    <tr class="bg-primary">
                                        <th>This Month's Total</th>
                                        <th><?= round($total_time, 3) ?> hr</th>
                                        <th><?= round($total_kilowatts, 3) ?> kWh</th>
                                        <th>₱<?= round($total_amount, 2) ?></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
        </div>
    </div>
    <!-- /.content-wrapper -->


    <footer class="main-footer">
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
        All rights reserved.
        <div class="float-right d-none d-sm-inline-block">
            <b>Version</b> 3.2.0
        </div>
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php include "includes/foot.php"; ?>
<script>
    $(function() {
        $("#table1").DataTable({
            "searching": true,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": true,
            "ordering": true,
            "buttons": ["csv", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $("#table2").DataTable({
            "searching": true,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": true,
            "ordering": true,
            "buttons": ["csv", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $("#table3").DataTable({
            "searching": true,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": true,
            "ordering": true,
            "buttons": ["csv", "pdf", "print"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>