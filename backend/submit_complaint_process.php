<?php

session_start();
include "config.php";

/* user login check */

if(!isset($_SESSION['user_id'])){
header("Location: ../login.php");
exit();
}

$user_id = $_SESSION['user_id'];
$category = $_POST['category'];
$title = $_POST['title'];
$description = $_POST['description'];

$image_name = "";

/* image upload */

if(isset($_FILES['image']) && $_FILES['image']['name'] != ""){

$image_name = time()."_".$_FILES['image']['name'];
$tmp_name = $_FILES['image']['tmp_name'];

move_uploaded_file($tmp_name,"../uploads/".$image_name);

}

/* insert complaint */

$sql = "INSERT INTO complaints (user_id, category, title, description, image, status)
VALUES ('$user_id','$category','$title','$description','$image_name','Pending')";

if(mysqli_query($conn,$sql)){

header("Location: ../dashboard.php");

}else{

echo "Error: ".mysqli_error($conn);

}

?>