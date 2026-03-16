<?php

session_start();
include "config.php";

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$branch = $_POST['branch'];
$year = $_POST['year'];

/* check if email already registered */

$check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check) > 0){

$_SESSION['error'] = "You are already registered. Please login.";

header("Location: ../register.php");
exit();

}

/* insert new user */

$sql = "INSERT INTO users(name,email,password,branch,year)
VALUES('$name','$email','$password','$branch','$year')";

if(mysqli_query($conn,$sql)){

header("Location: ../login.php");

}else{

$_SESSION['error'] = "Registration failed. Try again.";

header("Location: ../register.php");

}

?>