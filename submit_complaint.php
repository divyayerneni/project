<?php
session_start();
include "backend/config.php";

if(!isset($_SESSION['user_id'])){
    header("Location: login.php");
    exit();
}

/* GET CATEGORY FROM URL */
$category = isset($_GET['category']) ? $_GET['category'] : "";

/* FETCH SAME CATEGORY COMPLAINTS */
$complaints = mysqli_query($conn,"
SELECT * FROM complaints 
WHERE category='$category'
ORDER BY created_at DESC
LIMIT 5
");
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
background:white;
padding:30px;
border-radius:12px;
box-shadow:0 10px 30px rgba(0,0,0,0.1);
margin-bottom:20px;
}

.section-title{
font-weight:600;
margin-bottom:15px;
color:#0d3b66;
}

</style>

</head>

<body>

<div class="container mt-5">

<div class="row">

<!-- LEFT SIDE FORM -->
<div class="col-md-6">

<div class="form-box">

<h3 class="mb-4">Submit a Complaint</h3>

<form action="backend/submit_complaint_process.php" method="POST" enctype="multipart/form-data">

<!-- CATEGORY AUTO -->
<input type="hidden" name="category" value="<?php echo $category; ?>">

<div class="mb-3">
<label class="form-label">Category</label>
<input type="text" class="form-control" value="<?php echo ucfirst($category); ?>" readonly>
</div>

<!-- TITLE -->
<div class="mb-3">
<label class="form-label">Complaint Title</label>

<input type="text" name="title" id="title" class="form-control"
placeholder="Enter complaint title" required>

</div>

<!-- DESCRIPTION -->
<div class="mb-3">
<label class="form-label">Detailed Description</label>
<textarea name="description" class="form-control" rows="4" placeholder="Explain the issue clearly..." required></textarea>
</div>

<!-- IMAGE -->
<div class="mb-3">
<label class="form-label">Upload Photo (Optional)</label>
<input type="file" name="image" class="form-control">
</div>

<button class="btn btn-primary w-100">Submit Complaint</button>

</form>

</div>

</div>

<?php if(strtolower($category) != "personal"){ ?>

<!-- RIGHT SIDE TABLE -->
<div class="col-md-6">

<div class="form-box">

<h4 class="mb-3"><?php echo ucfirst($category); ?> Complaints</h4>

<table class="table table-bordered table-hover text-center">

<tr class="table-dark">
<th>ID</th>
<th>Issue</th>
<th>Status</th>
<th>Date</th>
</tr>

<?php
if(mysqli_num_rows($complaints)>0){
while($row=mysqli_fetch_assoc($complaints)){

$status_badge = "badge bg-secondary";

if($row['status']=="Pending") $status_badge="badge bg-warning";
if($row['status']=="In Progress") $status_badge="badge bg-primary";
if($row['status']=="Resolved") $status_badge="badge bg-success";
?>

<tr>
<td>#<?php echo $row['id']; ?></td>
<td><?php echo $row['title']; ?></td>

<td>
<span class="<?php echo $status_badge; ?>">
<?php echo $row['status']; ?>
</span>
</td>

<td>
<?php echo date("d-m-Y", strtotime($row['created_at'])); ?>
</td>
</tr>

<?php
}
}else{
echo "<tr><td colspan='4'>No complaints found</td></tr>";
}
?>

</table>

</div>

</div>

<?php } ?>

</div>

</div>

</body>
<script>

window.onload = function(){

let category = "<?php echo strtolower($category); ?>";
let title = document.getElementById("title");

if(category === "hostel"){
title.placeholder = "Example: Water leakage / Fan not working";
}
else if(category === "mess"){
title.placeholder = "Example: Food quality issue / Unhygienic food";
}
else if(category === "academic"){
title.placeholder = "Example: Faculty issue / Class not conducted";
}
else if(category === "library"){
title.placeholder = "Example: Books not available / AC not working";
}
else if(category === "hospital"){
title.placeholder = "Example: No doctor available / Medicine issue";
}
else if(category === "infrastructure"){
title.placeholder = "Example: Classroom damage / Projector issue";
}
else if(category === "personal"){
title.placeholder = "Example: Personal issue (confidential)";
}
else if(category === "auditorium"){
title.placeholder = "Example: Mic not working / Event issue";
}

}

</script>
</html>
