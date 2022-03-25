<?php

include "includes/config.php";
session_start();

// check if there is a session
if ($_SESSION['id'] ?? null) {
    // there is a session, check if valid
    $id = $_SESSION['id'];
    $check_user = mysqli_query($conn, "SELECT id, email FROM user where id='$id'");
    if (mysqli_num_rows($check_user) == 1) {
        // valid

    } else {
        // invalid
        // there is no session, no access
        session_destroy();
        header("location: ../login.php");
        exit();
    }
} else {
    // there is no session, no access
    session_destroy();
    header("location: ../login.php");
    exit();
}
