<?php
session_start();

if(!isset($_SESSION['user_id'])){
header("Location: login.php");
exit();
}
?>

<!DOCTYPE html>
<html>
<head>

<title>File Complaint</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

body{
font-family:'Poppins',sans-serif;
background:#f4f6fb;
}

.form-box{
max-width:750px;
margin:auto;
margin-top:50px;
background:white;
padding:40px;
border-radius:12px;
box-shadow:0 10px 30px rgba(0,0,0,0.1);
}

.section-title{
font-weight:600;
margin-top:20px;
margin-bottom:10px;
color:#0d3b66;
}

</style>

</head>

<body>

<div class="container">

<div class="form-box">

<h3 class="mb-4">Submit a Complaint</h3>

<form action="backend/submit_complaint_process.php" method="POST" enctype="multipart/form-data">

<!-- Complaint Info -->

<h5 class="section-title">Complaint Information</h5>

<div class="mb-3">

<label class="form-label">Category</label>

<select name="category" class="form-control" required>
<option value="Hostel">Hostel</option>
<option value="Mess">Mess</option>
<option value="Academic">Academic</option>
<option value="library">library</option>
<option value="hospital">hospital</option>
<option value="Infrastructure">Infrastructure</option>
<option value="personal">personal</option>
<option value="Auditorium">Auditorium</option>

</select>

</div>

<div class="mb-3">

<label class="form-label">Complaint Title</label>

<input type="text" name="title" class="form-control" placeholder="Example: Water leakage in hostel room" required>

</div>

<div class="mb-3">

<label class="form-label">Detailed Description</label>

<textarea name="description" class="form-control" rows="4" placeholder="Explain the issue clearly..." required></textarea>

</div>

<!-- Evidence -->

<h5 class="section-title">Evidence</h5>

<div class="mb-3">

<label class="form-label">Upload Photo (Optional)</label>

<input type="file" name="image" class="form-control">

</div>

<button class="btn btn-primary w-100">Submit Complaint</button>

</form>

</div>

</div>

</body>
</html>