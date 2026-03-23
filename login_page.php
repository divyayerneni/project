<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Select Login</title>

<meta name="viewport" content="width=device-width, initial-scale=1.0">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

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
background:linear-gradient(120deg,#e0ecff,#f4f6fb);
}

/* Card */

.box{
background:white;
padding:50px 40px;
border-radius:16px;
box-shadow:0 12px 30px rgba(0,0,0,0.12);
text-align:center;
width:420px;
}

/* Heading */

.box h2{
margin-bottom:35px;
color:#0d3b66;
font-weight:600;
}

/* Button container */

.btn-group{
display:flex;
gap:20px;
}

/* Buttons */

.btn{
flex:1;
padding:16px;
border-radius:10px;
text-decoration:none;
color:white;
font-size:16px;
font-weight:500;
display:flex;
justify-content:center;
align-items:center;
gap:8px;
transition:0.3s;
}

/* Student button */

.student{
background:#4e73df;
}

/* Admin button */

.admin{
background:#e74c3c;
}

/* Hover effect */

.btn:hover{
transform:translateY(-4px);
box-shadow:0 10px 20px rgba(0,0,0,0.15);
}

/* Mobile responsive */

@media(max-width:500px){
.btn-group{
flex-direction:column;
}
}

</style>

</head>

<body>

<div class="box">

<h2>Select Login</h2>

<div class="btn-group">

<a href="login.php" class="btn student">
<i class="bi bi-person"></i> Student
</a>

<a href="admin/login.php" class="btn admin">
<i class="bi bi-shield-lock"></i> Admin
</a>

</div>

</div>

</body>
</html>