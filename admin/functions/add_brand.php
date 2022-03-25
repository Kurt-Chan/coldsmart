<?php
include "../includes/config.php";
include "../includes/check_session.php";

if (isset($_POST['add_brand'])) {
    $device_type = $_POST['device_type'];
    $name = $_POST['name'];

    $add_query = mysqli_query($conn, "INSERT INTO brand VALUES(NULL,'$name', '$device_type')");

    if ($add_query) {
        // success
        $_SESSION['success'] = "Successfully added brand.";
    } else {
        // failure
        $_SESSION['error'] = "Error adding brand.";
        echo  "failure" . mysqli_error($conn);
    }
    header("location: ../brands.php");
}
