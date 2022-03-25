<?php
include '../includes/config.php';
session_start();

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];


    $pw = md5($password);
    $login_query = mysqli_query($conn, "SELECT * FROM user WHERE email='$email' AND password='$pw'");
    if (mysqli_num_rows($login_query) == 1) { // Correct credentials
        // successful login
        $reset_retry_query = mysqli_query($conn, "UPDATE patient_account SET retry = 3, locked_until=null WHERE id='$id'");
        $match = mysqli_fetch_array($login_query);
        $_SESSION['id'] = $match['id'];
        $_SESSION['email'] = $match['email'];
        $_SESSION['name'] = $match['first_name'] . " " . $match['last_name'];
        header("location: ../index.php");
    } else {
        $_SESSION['error'] = "Invalid username or password";
        header("location: ../login.php");
    }
}
