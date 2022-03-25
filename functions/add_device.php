<?php
include "../includes/config.php";
session_start();

if (isset($_POST['add_device'])) {
    $owner_id = $_SESSION['id'];
    $name = $_POST['name'];
    $device_type = $_POST['device_type'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];

    $add_query = mysqli_query($conn, "INSERT INTO device VALUES(NULL, '$owner_id','$name', '$device_type', '$brand', '$model')");

    if ($add_query) {
        // success
        $_SESSION['success'] = "Successfully added device.";
    } else {
        // failure
        $_SESSION['error'] = "Error adding device.";
        echo  "failure" . mysqli_error($conn);
    }
    header("location: ../my_devices.php");
}
