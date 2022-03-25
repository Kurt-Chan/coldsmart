<?php
include "../includes/config.php";
session_start();

if (isset($_POST['off'])) {
    $device_id = $_POST['device_id'];
    echo "power_off";
    $off_query = mysqli_query($conn, "INSERT INTO action VALUES(NULL, '$device_id', 'OFF', NOW());");
    if ($off_query) {
        $_SESSION['success'] = "Device as marked as turned OFF.";
        header("location: ../index.php");
    } else {
        $_SESSION['error'] = "Error while marking device as turned OFF.";
    }
} else if (isset($_POST['on'])) {
    $device_id = $_POST['device_id'];
    echo "power_on";
    $on_query = mysqli_query($conn, "INSERT INTO action VALUES(NULL, '$device_id', 'ON', NOW());");
    if ($on_query) {
        header("location: ../index.php");
        $_SESSION['success'] = "Device as marked as turned ON.";
    } else {
        $_SESSION['error'] = "Error while marking device as turned ON.";
    }
}
