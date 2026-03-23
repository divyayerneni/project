<?php
session_start();
include "../backend/config.php";

if(!isset($_SESSION['admin'])){
header("Location: login.php");
exit();
}

/* complaints list */
$result=mysqli_query($conn,"SELECT * FROM complaints ORDER BY created_at DESC");

/* analytics */
$total = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM complaints"))['total'];
$pending = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM complaints WHERE status='Pending'"))['total'];
$progress = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM complaints WHERE status='In Progress'"))['total'];
$resolved = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) AS total FROM complaints WHERE status='Resolved'"))['total'];
?>

<!DOCTYPE html>
<html>

<head>

<title>Admin Dashboard</title>

<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body{
background:#f4f6fb;
}
.header{
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:30px;
}
</style>

</head>

<body>

<div class="container mt-5">

<div class="header">
<h3>Admin Complaint Dashboard</h3>
<a href="../backend/logout.php" class="btn btn-danger">Logout</a>
</div>

<!-- Analytics Chart -->

<h5 class="mb-3">Complaint Analytics</h5>
<canvas id="complaintChart" height="90"></canvas>

<br><br>

<!-- Complaints Table -->

<h5>All Complaints</h5>

<table class="table table-bordered table-hover">

<tr class="table-dark">
<th>ID</th>
<th>User</th>
<th>Category</th>
<th>Title</th>
<th>Photo</th>
<th>Status</th>
<th>Date</th> <!-- ✅ ADDED -->
<th>Action</th>
</tr>

<?php

while($row=mysqli_fetch_assoc($result)){

$image = $row['image'] ? "<img src='../uploads/".$row['image']."' width='70'>" : "No Image";

/* status color */
$status_badge="badge bg-secondary";

if($row['status']=="Pending") $status_badge="badge bg-warning";
if($row['status']=="In Progress") $status_badge="badge bg-primary";
if($row['status']=="Resolved") $status_badge="badge bg-success";

echo "<tr>

<td>".$row['id']."</td>

<td>".$row['user_id']."</td>

<td>".$row['category']."</td>

<td>".$row['title']."</td>

<td>".$image."</td>

<td><span class='$status_badge'>".$row['status']."</span></td>

<td>".date("d-m-Y h:i A", strtotime($row['created_at']))."</td> <!-- ✅ DATE -->

<td>

<a href='update_status.php?id=".$row['id']."&status=In Progress' class='btn btn-warning btn-sm'>Progress</a>

<a href='update_status.php?id=".$row['id']."&status=Resolved' class='btn btn-success btn-sm'>Resolve</a>

<!-- ✅ DELETE BUTTON -->
<a href='delete_complaint.php?id=".$row['id']."' 
class='btn btn-danger btn-sm'
onclick=\"return confirm('Are you sure to delete this complaint?')\">
Delete
</a>

</td>

</tr>";

}

?>

</table>

</div>

<script>

const ctx = document.getElementById('complaintChart');

new Chart(ctx, {

type: 'bar',

data: {

labels: ['Total','Pending','In Progress','Resolved'],

datasets: [{

label:'Complaints',

data:[
<?php echo $total; ?>,
<?php echo $pending; ?>,
<?php echo $progress; ?>,
<?php echo $resolved; ?>
],

backgroundColor:[
'#4e73df',
'#f6c23e',
'#36b9cc',
'#1cc88a'
]

}]

},

options:{
responsive:true,
plugins:{
legend:{display:false}
}
}

});

</script>

</body>

</html>