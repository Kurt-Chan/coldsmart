<?php
include '../includes/config.php';
session_start();

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $pw = md5($password);
    $login_query = mysqli_query($conn, "SELECT * FROM admin WHERE username='$username' AND password='$pw'");
    if (mysqli_num_rows($login_query) == 1) { // Correct credentials
        // successful login
        $match = mysqli_fetch_array($login_query);
        $_SESSION['id'] = $match['id'];
        $_SESSION['username'] = $match['username'];
        $_SESSION['name'] = $match['first_name'] . " " . $match['last_name'];
        header("location: ../index.php");
    } else {
        $_SESSION['error'] = "Invalid username or password";
        header("location: ../login.php");
    }
}
