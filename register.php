<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Register - Smart Campus</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
height:100vh;
display:flex;
justify-content:center;
align-items:center;
background:#f4f6fb;
}

.form-box{
width:420px;
background:white;
padding:35px;
border-radius:10px;
box-shadow:0 10px 25px rgba(0,0,0,0.1);
}

.form-box h2{
text-align:center;
margin-bottom:20px;
}

.error{
color:red;
text-align:center;
margin-bottom:15px;
font-size:14px;
}

.form-box input,
.form-box select{
width:100%;
padding:10px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:5px;
}

.password-box{
position:relative;
}

.password-box span{
position:absolute;
right:10px;
top:50%;
transform:translateY(-50%);
cursor:pointer;
}

.form-box button{
width:100%;
padding:10px;
background:#0d3b66;
border:none;
color:white;
border-radius:5px;
cursor:pointer;
}

.form-box button:hover{
background:#0a2c4c;
}

.form-box p{
text-align:center;
margin-top:15px;
}

.form-box a{
color:#0d3b66;
text-decoration:none;
}

</style>

</head>

<body>

<div class="form-box">

<h2>Create Account</h2>

<?php
if(isset($_SESSION['error'])){
echo "<p class='error'>".$_SESSION['error']."</p>";
unset($_SESSION['error']);
}
?>

<form action="backend/register_process.php" method="POST">

<input type="text" name="name" placeholder="Full Name" required>

<input type="email" name="email" placeholder="Email Address" required>

<div class="password-box">
<input type="password" name="password" id="password" placeholder="Password" required>
<span onclick="togglePassword()">👁</span>
</div>

<select name="branch" required>
<option value="">Select Branch</option>
<option value="PUC">PUC</option>
<option value="CSE">CSE</option>
<option value="ECE">ECE</option>
<option value="EEE">EEE</option>
<option value="MECH">MECH</option>
<option value="CIVIL">CIVIL</option>
<option value="MME">MME</option>
<option value="CHEMICAL">CHEMICAL</option>
</select>

<input type="text" name="year" placeholder="Year (PUC1 / PUC2 / 1st / 2nd / 3rd / 4th)" required>

<button type="submit">Register</button>

</form>

<p>Already have an account? <a href="login.php">Login</a></p>

</div>

<script>

function togglePassword(){

var pass=document.getElementById("password");

if(pass.type==="password"){
pass.type="text";
}else{
pass.type="password";
}

}

</script>

</body>
</html>