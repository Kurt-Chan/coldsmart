<?php
include "../includes/config.php";


session_start();


if (isset($_POST['register'])) {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];


    // Regex for password
    $pattern = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[A-Za-z\d@$!%*?&]{8,}$/";
    $symbol = "/(?=.*[@$!%*?&])/";
    if (
        $first_name == '' || $last_name == '' || $email == ''
    ) {
        $error = "Please complete the form.";
    } else if ($password == '') {
        $error = "Please enter a password.";
    } else if ($password != $confirm_password) {
        $error = "Password does not match";
    } else if (strlen($password) < 8) {
        $error = "Password is too short.";
    } else if (!preg_match($symbol, $password)) {
        $error = "Password must include at least one symbol (like !@#$%^)!";
    } else if (!preg_match($pattern, $password)) {
        // $error = preg_match($pattern, $password);
        $error = "Password should have at least 8 characters, 1 upper-case, 1 lower-case, 1 number ";
    } else {
        // check if user email exists
        $email_check = mysqli_query($conn, "select id, email from user where email='$email'");
        if ($checkEmail && mysqli_num_rows($checkEmail) > 0) { // Email already in use
            $error = "Email already registered.";
        } else {
            // Form is VALID and email not in use
            $pw = md5($password);
            $insert_user = mysqli_query($conn, "INSERT INTO user VALUES(NULL, '$first_name', '$last_name', '$email', '$pw');");

            if ($insert_user) {
                $_SESSION['success'] = "Registration successful!";
            } else {
                $_SESSION['error'] = "Registration failed!";
            }
            header("Location: ../login.php");
        }
    }
}
