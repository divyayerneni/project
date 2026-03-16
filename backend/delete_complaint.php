<?php

session_start();
include "config.php";

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM complaints WHERE id='$id'");

header("Location: ../dashboard.php");

?>