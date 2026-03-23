<?php
session_start();
include "../backend/config.php";

/* check admin login */
if(!isset($_SESSION['admin'])){
    header("Location: login.php");
    exit();
}

if(isset($_GET['id'])){

$id = $_GET['id'];

/* delete query */
mysqli_query($conn,"DELETE FROM complaints WHERE id='$id'");

/* redirect back */
header("Location: dashboard.php");

}else{
echo "Invalid Request";
}
?>