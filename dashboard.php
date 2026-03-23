<?php
session_start();
include "backend/config.php";

if(!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

/* complaint statistics */

$total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM complaints WHERE user_id='$user_id'"))['total'];

$pending = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM complaints WHERE user_id='$user_id' AND status='Pending'"))['total'];

$progress = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM complaints WHERE user_id='$user_id' AND status='In Progress'"))['total'];

$resolved = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM complaints WHERE user_id='$user_id' AND status='Resolved'"))['total'];

/* complaints list */

$result = mysqli_query($conn,"SELECT * FROM complaints WHERE user_id='$user_id' ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html>
<head>

<title>Student Dashboard</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

body{
font-family:'Poppins',sans-serif;
background:#f4f6fb;
}

/* sidebar */

.sidebar{
height:100vh;
background:#0d3b66;
color:white;
padding:25px;
}

.sidebar h4{
margin-bottom:30px;
}

.sidebar a{
display:block;
color:white;
text-decoration:none;
margin:15px 0;
}

.sidebar a:hover{
color:#ffc107;
}

/* main */

.main{
padding:30px;
}

/* stat cards */

.stat-card{
border-radius:14px;
padding:25px;
color:white;
display:flex;
align-items:center;
justify-content:space-between;
box-shadow:0 8px 20px rgba(0,0,0,0.15);
}

.stat-card i{
font-size:40px;
opacity:0.9;
}

.stat-text h3{
margin:0;
font-weight:600;
}

.stat-text p{
margin:0;
font-size:14px;
}

/* table */

.table-container{
background:white;
padding:20px;
border-radius:12px;
box-shadow:0 5px 15px rgba(0,0,0,0.08);
margin-top:30px;
}

.card-total{
background:linear-gradient(45deg,#4e73df,#224abe);
}

.card-pending{
background:linear-gradient(45deg,#f6c23e,#dda20a);
}

.card-progress{
background:linear-gradient(45deg,#36b9cc,#1c7c8c);
}

.card-resolved{
background:linear-gradient(45deg,#1cc88a,#13855c);
}

</style>

</head>

<body>

<div class="container-fluid">

<div class="row">

<!-- sidebar -->

<div class="col-md-2 sidebar">

<h4>Smart Campus</h4>

<a href="index.php"><i class="bi bi-house-door-fill"></i> Home</a>

<a href="submit_complaint.php"><i class="bi bi-pencil-square"></i> File Complaint</a>

<a href="#"><i class="bi bi-clock-history"></i> My Complaints</a>

<a href="backend/logout.php"><i class="bi bi-box-arrow-right"></i> Logout</a>

</div>

<!-- main content -->

<div class="col-md-10 main">

<h3>Welcome <?php echo $_SESSION['user_name']; ?> 👋</h3>

<br>

<!-- statistics -->

<div class="row g-4">

<div class="col-md-3">
<div class="stat-card card-total">
<div class="stat-text">
<h3><?php echo $total; ?></h3>
<p>Total Complaints</p>
</div>
<i class="bi bi-list-task"></i>
</div>
</div>

<div class="col-md-3">
<div class="stat-card card-pending">
<div class="stat-text">
<h3><?php echo $pending; ?></h3>
<p>Pending</p>
</div>
<i class="bi bi-exclamation-circle"></i>
</div>
</div>

<div class="col-md-3">
<div class="stat-card card-progress">
<div class="stat-text">
<h3><?php echo $progress; ?></h3>
<p>In Progress</p>
</div>
<i class="bi bi-tools"></i>
</div>
</div>

<div class="col-md-3">
<div class="stat-card card-resolved">
<div class="stat-text">
<h3><?php echo $resolved; ?></h3>
<p>Resolved</p>
</div>
<i class="bi bi-check-circle"></i>
</div>
</div>

</div>

<!-- complaints table -->

<div class="table-container">

<h4>My Complaints</h4>

<table class="table table-hover mt-3">

<thead class="table-dark">

<tr>
<th>ID</th>
<th>Category</th>
<th>Title</th>
<th>Photo</th>
<th>Status</th>
<th>Date</th>
<th>Action</th>
</tr>

</thead>

<tbody>

<?php
while($row=mysqli_fetch_assoc($result)){

$image = $row['image'] ? "<img src='uploads/".$row['image']."' width='60'>" : "No Image";

echo "<tr>
<td>".$row['id']."</td>
<td>".$row['category']."</td>
<td>".$row['title']."</td>
<td>".$image."</td>
<td>".$row['status']."</td>
<td>".$row['created_at']."</td>

<td>
<a href='backend/delete_complaint.php?id=".$row['id']."' 
class='btn btn-danger btn-sm'>
<i class='bi bi-trash'></i> Delete
</a>
</td>

</tr>";

}
?>

</tbody>

</table>

</div>

</div>

</div>

</div>

</body>

</html>