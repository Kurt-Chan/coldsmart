<?php
include "../includes/config.php";
include "../includes/check_session.php";

if (isset($_POST['add_device_type'])) {
    $name = $_POST['name'];

    $add_query = mysqli_query($conn, "INSERT INTO device_type VALUES(NULL,'$name')");

    if ($add_query) {
        // success
        $_SESSION['success'] = "Successfully added device type.";
    } else {
        // failure
        $_SESSION['error'] = "Error adding device type.";
        echo  "failure" . mysqli_error($conn);
    }
    header("location: ../device_types.php");
}
