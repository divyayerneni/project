<?php
include "backend/config.php";

/* check connection */
if (!$conn) {
    die("Database connection failed");
}

/* latest complaints */
$recent = mysqli_query($conn, "
SELECT id, category, title, status, created_at 
FROM complaints 
WHERE category != 'personal'
ORDER BY created_at DESC
LIMIT 4
");
if (!$recent) {
    die("Query Error: " . mysqli_error($conn));
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Smart Campus Management System</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <!-- Google Font -->

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: #f4f6fb;
        }

        /* NAVBAR */

        .navbar {
            background: #0d3b66;
        }

        .navbar-brand {
            color: white;
            font-weight: 600;
            display: flex;
            align-items: center;
        }

        .navbar-brand img {
            margin-right: 10px;
        }

        .nav-link {
            color: white !important;
            margin-left: 20px;
        }

        /* HERO SECTION */

        .hero {
            height: 70vh;
            position: relative;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
        }

        .slide {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            top: 0;
            left: 0;
            opacity: 0;
            transition: opacity 1s ease-in-out;
        }

        .slide.active {
            opacity: 1;
        }

        /* overlay fix */
        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        .hero h1 {
            font-size: 34px;
            font-weight: 700;
            max-width: 900px;
            margin: auto;
        }

        .hero p {
            font-size: 18px;
            margin-top: 10px;
        }

        /* DASHBOARD */

        .dashboard {
            padding: 60px 20px;
        }

        .service-box {
            background: white;
            border-radius: 12px;
            padding: 30px;
            text-align: center;
            height: 100%;
            min-height: 200px;

            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;

            transition: all 0.35s ease;

            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .service-box:hover {
            transform: translateY(-10px) scale(1.03);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.18);
        }

        .service-box i {
            font-size: 30px;
            color: white;
            background: #0d3b66;
            padding: 15px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .service-box h5 {
            font-weight: 600;
        }

        .service-box p {
            font-size: 14px;
        }

        /* TABLE */

        .table {
            background: white;
        }

        /* FOOTER */

        .footer-section {
            background: #0d3b66;
            color: white;
            padding: 40px 0;
            margin-top: 60px;
        }

        .footer-section h5 {
            margin-bottom: 15px;
            font-weight: 600;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: 8px;
        }

        .footer-links a {
            color: white;
            text-decoration: none;
        }

        .footer-links a:hover {
            text-decoration: underline;
        }

        .social-icons a {
            color: white;
            font-size: 22px;
            margin-right: 15px;
            transition: 0.3s;
        }

        .social-icons a:hover {
            color: #ffc107;
        }

        .footer-section hr {
            background: white;
        }

        /* ANIMATION */

        .fade-in {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s ease forwards;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

</head>

<body>

    <!-- NAVBAR -->

    <nav class="navbar navbar-expand-lg">
        <div class="container">

            <a class="navbar-brand" href="#">
                <img src="college_logo.png" width="40">
                RGUKT Nuzvid
            </a>

            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="menu">

                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="#">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="login_page.php">Login</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="register.php">Register</a>
                    </li>

                </ul>

            </div>
        </div>
    </nav>

    <!-- HERO SECTION -->

    <section class="hero">

        <img src="college.jpg" class="slide active">
        <img src="block.png" class="slide">
        <img src="night.jpg" class="slide">
        <img src="entrance1.png" class="slide">

        <div class="hero-overlay"></div>

        <div class="hero-content">
            <h1>RAJIV GANDHI UNIVERSITY OF KNOWLEDGE AND TECHNOLOGIES - NUZVID</h1>
            <p>Smart Campus Complaint Management System</p>
        </div>

    </section>

    <!-- DASHBOARD -->

    <section class="dashboard fade-in">

        <div class="container">

            <h2 class="text-center mb-5">Campus Complaint Categories</h2>

            <div class="row g-4 justify-content-center">

                <!-- Hostel -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="submit_complaint.php?category=hostel" class="text-decoration-none text-dark">
                        <div class="service-box">
                            <i class="bi bi-house-door"></i>
                            <h5>Hostel Issues</h5>
                            <p>Maintenance and hostel problems</p>
                        </div>
                    </a>
                </div>

                <!-- Library -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="submit_complaint.php?category=library" class="text-decoration-none text-dark">
                        <div class="service-box">
                            <i class="bi bi-book"></i>
                            <h5>Library</h5>
                            <p>Library related complaints</p>
                        </div>
                    </a>
                </div>

                <!-- Mess -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="submit_complaint.php?category=mess" class="text-decoration-none text-dark">
                        <div class="service-box">
                            <i class="bi bi-cup-hot"></i>
                            <h5>Mess</h5>
                            <p>Food and mess facility issues</p>
                        </div>
                    </a>
                </div>

                <!-- Hospital -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="submit_complaint.php?category=hospital" class="text-decoration-none text-dark">
                        <div class="service-box">
                            <i class="bi bi-hospital"></i>
                            <h5>Hospital</h5>
                            <p>Medical support complaints</p>
                        </div>
                    </a>
                </div>

                <!-- Academic Blocks -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="submit_complaint.php?category=academic_block" class="text-decoration-none text-dark">
                        <div class="service-box">
                            <i class="bi bi-building"></i>
                            <h5>Academic Blocks</h5>
                            <p>Infrastructure problems</p>
                        </div>
                    </a>
                </div>

                <!-- Personal Problems -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="submit_complaint.php?category=personal" class="text-decoration-none text-dark">
                        <div class="service-box">
                            <i class="bi bi-person-heart"></i>
                            <h5>Personal Problems</h5>
                            <p>Confidential student issues</p>
                        </div>
                    </a>
                </div>

                <!-- Auditorium -->

                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a href="submit_complaint.php?category=auditorium" class="text-decoration-none text-dark">
                        <div class="service-box">
                            <i class="bi bi-mic"></i>
                            <h5>Auditorium</h5>
                            <p>Events and auditorium related issues</p>
                        </div>
                    </a>
                </div>

            </div>

        </div>

    </section>

    <!-- ✅ FIXED HERE -->
    <section class="container mt-5 fade-in">

        <h2 class="text-center mb-4">Recent Complaints</h2>

        <div class="table-responsive">

            <table class="table table-striped table-hover shadow text-center">

                <thead class="table-dark">
                    <tr>
                        <th>Complaint ID</th>
                        <th>Category</th>
                        <th>Issue</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>

                <tbody>

                    <?php
                    if (mysqli_num_rows($recent) > 0) {
                        while ($row = mysqli_fetch_assoc($recent)) {
                            ?>

                            <tr>
                                <td>#<?php echo $row['id']; ?></td>
                                <td><?php echo ucfirst($row['category']); ?></td>
                                <td><?php echo $row['title']; ?></td>

                                <td>
                                    <?php
                                    if ($row['status'] == "Pending") {
                                        echo "<span class='badge bg-warning'>Pending</span>";
                                    } else if ($row['status'] == "In Progress") {
                                        echo "<span class='badge bg-primary'>In Progress</span>";
                                    } else {
                                        echo "<span class='badge bg-success'>Resolved</span>";
                                    }
                                    ?>
                                </td>

                                <td>
                                    <?php echo date("d-m-Y h:i A", strtotime($row['created_at'])); ?>
                                </td>

                            </tr>

                            <?php
                        }
                    } else {
                        ?>

                        <tr>
                            <td colspan="5">No complaints found</td>
                        </tr>

                        <?php
                    }
                    ?>

                </tbody>

            </table>

        </div>

    </section>

    <!-- FOOTER -->
    <footer class="footer-section">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>About RGUKT Nuzvid</h5>
                    <p> Rajiv Gandhi University of Knowledge Technologies – Nuzvid is committed to providing quality
                        education and technological innovation for students. </p>
                </div>
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="#">Home</a></li>
                        <li><a href="login.php">Login</a></li>
                        <li><a href="register.php">Register</a></li>
                        <li><a href="#">File Complaint</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Us</h5>
                    <p><i class="bi bi-geo-alt"></i> RGUKT Nuzvid, Eluru District, Andhra Pradesh</p>
                    <p><i class="bi bi-envelope"></i> support@rgukt.ac.in</p>
                    <p><i class="bi bi-telephone"></i> +91 XXXXX XXXXX</p>
                    <div class="social-icons mt-3"> <a href="#"><i class="bi bi-facebook"></i></a> <a href="#"><i
                                class="bi bi-instagram"></i></a> <a href="#"><i class="bi bi-twitter"></i></a> <a
                            href="#"><i class="bi bi-linkedin"></i></a> </div>
                </div>
            </div>
            <hr>
            <p class="text-center mt-3"> © 2026 RAJIV GANDHI UNIVERSITY OF KNOWLEDGE AND TECHNOLOGY - NUZVID </p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<script>

    let slides = document.querySelectorAll(".slide");
    let current = 0;

    function showNextSlide() {

        slides[current].classList.remove("active");

        current = (current + 1) % slides.length;

        slides[current].classList.add("active");

    }

    /* AUTO LOOP */
    setInterval(showNextSlide, 3000);

</script>

</html>