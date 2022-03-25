<?php
include "../includes/config.php";
include "../includes/check_session.php";

if (isset($_POST['add_model'])) {
    $device_type = $_POST['device_type'];
    $brand = $_POST['brand'];
    $model = $_POST['model'];
    $average_consumption = $_POST['average_consumption'];

    $add_query = mysqli_query($conn, "INSERT INTO model VALUES(NULL,'$device_type', '$brand', '$model', '$average_consumption')");

    if ($add_query) {
        // success
        $_SESSION['success'] = "Successfully added model.";
    } else {
        // failure
        $_SESSION['error'] = "Error adding model.";
        echo  "failure" . mysqli_error($conn);
    }
    header("location: ../models.php");
}
