<?php
session_start();
include "../backend/config.php";

$error = "";

if(isset($_POST['login'])){

$admin_id = trim($_POST['admin_id']);
$email = trim($_POST['email']);
$password = $_POST['password']; // 🔥 no md5

/* VALIDATION */
if(!preg_match("/^RGUKT-ADM-[0-9]{2}$/", $admin_id)){
    $error = "Admin ID must be like RGUKT-ADM-01";
}else{

$query = "SELECT * FROM admin 
WHERE admin_id='$admin_id' 
AND email='$email' 
AND password='$password'";

$result = mysqli_query($conn,$query);

if(!$result){
    die("Query Error: ".mysqli_error($conn));
}

if(mysqli_num_rows($result)>0){

$_SESSION['admin'] = $email;
header("Location: dashboard.php");
exit();

}else{
$error = "Invalid Admin Credentials";
}

}
}
?>

<!DOCTYPE html>
<html>

<head>
<title>Admin Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<style>

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#f4f6fb;
font-family:'Poppins',sans-serif;
}

.card{
width:380px;
padding:25px;
border-radius:12px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

/* password box */

.password-box{
position:relative;
}

.password-box i{
position:absolute;
right:10px;
top:50%;
transform:translateY(-50%);
cursor:pointer;
font-size:18px;
color:#666;
}

</style>

</head>

<body>

<div class="card">

<h4 class="text-center mb-3">Admin Login</h4>

<?php if($error!=""){ ?>
<div class="alert alert-danger text-center"><?php echo $error; ?></div>
<?php } ?>

<form method="POST">

<input type="text" name="admin_id" class="form-control mb-3"
placeholder="Admin id"
pattern="RGUKT-ADM-[0-9]{2}"
title="Format: RGUKT-ADM-01"
required>

<input type="email" name="email" class="form-control mb-3" placeholder="Email" required>

<!-- PASSWORD WITH EYE ICON -->

<div class="password-box mb-3">
<input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
<i class="bi bi-eye" onclick="togglePassword()"></i>
</div>

<button name="login" class="btn btn-primary w-100">Login</button>

</form>

</div>

<script>

function togglePassword(){
var pass = document.getElementById("password");
var icon = document.querySelector(".password-box i");

if(pass.type === "password"){
pass.type = "text";
icon.classList.remove("bi-eye");
icon.classList.add("bi-eye-slash");
}else{
pass.type = "password";
icon.classList.remove("bi-eye-slash");
icon.classList.add("bi-eye");
}
}

</script>

</body>
</html>