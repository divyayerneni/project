<?php

include "config.php";

$name   = $_POST['name'];
$email  = $_POST['email'];
$password = $_POST['password'];
$branch = $_POST['branch'];
$year   = $_POST['year'];

/* check if email already exists */

$check = mysqli_query($conn,"SELECT * FROM users WHERE email='$email'");

if(mysqli_num_rows($check) > 0){

header("Location: ../register.php?error=email");
exit();

}

/* insert new user */

$sql = "INSERT INTO users(name,email,password,branch,year)
VALUES('$name','$email','$password','$branch','$year')";

if(mysqli_query($conn,$sql)){

header("Location: ../login.php?success=registered");

}else{

echo "Database Error";

}
?>