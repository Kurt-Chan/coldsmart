<?php include "includes/head.php";
include "includes/config.php";
include "includes/check_session.php";
?>

<div class="wrapper">
    <?php include "includes/navbar.php"; ?>


    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a href="../../index3.html" class="brand-link">
            <img src="../../dist/img/AdminLTELogo.png" alt="Coldsmart Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Coldsmart</span>
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
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

            <!-- Sidebar Menu -->
            <?php
            $page = "models";
            include "includes/sidebar_menu.php";
            ?>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Models</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Models</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">

                                    <h3 class="card-title">Models</h3>
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addApplianceModal">New</button>
                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>Brand</th>
                                            <th>Model</th>
                                            <th>Ave. Consumption/hr</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $cnt = 1;
                                        $types_query = mysqli_query($conn, "SELECT m.id, m.model, m.average_consumption, b.name as brand, t.name as device_type from model as m inner join brand as b on b.id = m.brand inner join device_type as t on t.id = m.device_type");
                                        while ($row = mysqli_fetch_assoc($types_query)) {
                                        ?>
                                            <tr>
                                                <td><?= $cnt++ ?></td>
                                                <td><?= $row['device_type'] ?></td>
                                                <td><?= $row['brand'] ?></td>
                                                <td><?= $row['model'] ?></td>
                                                <td><?= $row['average_consumption'] ?></td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>Brand</th>
                                            <th>Model</th>
                                            <th>Ave. Consumption/hr</th>
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
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>

        <!-- Modal -->
        <div class="modal fade" id="addApplianceModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add Model</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="functions/add_model.php" method="post">

                        <div class="modal-body">
                            <div class="form-group">
                                <label for="device_type">Device Type</label>
                                <select class="form-control" name="device_type" id="select_device_type" required>
                                    <option value="" selected disabled>--select a type--</option>
                                    <?php
                                    $type_query = mysqli_query($conn, "select * from device_type");
                                    while ($row = mysqli_fetch_assoc($type_query)) {
                                    ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['name'] ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="brand">Brand</label>
                                <select class="form-control" name="brand" id="select_brand" required>
                                    <option value="" selected disabled>--select a type first--</option>

                                </select>
                            </div>
                            <div class="form-group">
                                <label for="model">Model</label>
                                <input required type="text" name="model" id="name" class="form-control" placeholder="ex: FHSJXXXXX">
                            </div>
                            <div class="form-group">
                                <label for="average_consumption">Average Consumption per hour</label>
                                <input required type="text" name="average_consumption" id="average_consumption" class="form-control" placeholder="0.456">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" name="add_model" class="btn btn-primary">Add</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
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
        $("#example1").DataTable({
            "searching": true,
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "paging": true,
            "ordering": true,
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });

    $('#select_device_type').on('change', () => {
        const device_type = $('#select_device_type').val();
        $.post("functions/get_brands.php", {
            device_type: device_type
        }, (data) => {
            $("#select_brand").html(data);
        })
    })
</script>