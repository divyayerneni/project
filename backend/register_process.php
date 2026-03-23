<?php

session_start();
include "config.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$branch = $_POST['branch'];
$year = $_POST['year'];

/* ✅ EMAIL FORMAT VALIDATION (RGUKT only) */

if(!preg_match("/^[n][0-9]{6}@rguktn\.ac\.in$/", $email)){
    $_SESSION['error'] = "Use valid RGUKT email (example: nxxxxxx@rguktn.ac.in)";
    header("Location: ../register.php");
    exit();
}

/* ✅ CHECK IF ALREADY REGISTERED */

$check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check) > 0){

    $_SESSION['error'] = "You are already registered. Please login.";
    header("Location: ../register.php");
    exit();

}

/* ✅ SECURE PASSWORD (HASH) */

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

/* ✅ INSERT USER */

$sql = "INSERT INTO users(name,email,password,branch,year)
VALUES('$name','$email','$hashed_password','$branch','$year')";

if(mysqli_query($conn,$sql)){

    $_SESSION['success'] = "Registration successful. Please login.";
    header("Location: ../login.php");

}else{

    $_SESSION['error'] = "Registration failed. Try again.";
    header("Location: ../register.php");

}

?>