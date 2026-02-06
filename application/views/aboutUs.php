<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>About Us - Student Management</title>
  <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style >
      .card-img-top{
        width: 100%  !important;
      }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('StudentController') ?>">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link active" href="<?php echo site_url('StudentController/aboutUs')?>">About Us</a></li>
            <li class="nav-item"><a class="nav-link " href="<?php echo site_url('StudentController/contactUs')?>">Contact Us</a></li>
        </ul>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

  <!-- Hero Section -->
  <section class="py-5 bg-light text-center">
    <div class="container">
      <h1 class="display-4 fw-bold">About Us</h1>
      <p class="lead text-muted">student management crud app using php codeigniter and bootstrap.</p>
    </div>
  </section>

  <!-- About Content -->
  <section class="py-5">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-6">
          <img src="https://img.freepik.com/premium-photo/business-people-working-project-office_255667-32815.jpg?w=2000" class="img-fluid rounded shadow" alt="About Student Management">
        </div>
        <div class="col-md-6">
          <h2 class="fw-bold">Who We Are</h2>
          <p class="text-muted">
            Our Student Management CRUD Project is designed to streamline academic administration. 
            From adding new students to updating records and managing performance, our system ensures 
            that institutions can focus on education rather than paperwork.
          </p>
          <h2 class="fw-bold mt-4">Our Mission</h2>
          <p class="text-muted">
            We aim to provide a user-friendly platform that simplifies student data handling, 
            enhances transparency, and supports educators in building a smarter learning environment.
          </p>
        </div>
      </div>
    </div>
  </section>

  <!-- Team Section -->
  <section class="py-5 bg-light">
    <div class="container text-center">
      <h2 class="fw-bold mb-4">Meet Our Team</h2>
      <div class="row">
        <div class="col-md-4">
          <div class="card shadow-sm py-2">
            <div>
            <img src="https://www.slashrtc.com/wp-content/uploads/2025/10/Hamza-Shaikh-e1760626416858.jpeg" class="card-img-top " alt="Team Member" height="350px" >
            </div>
            <div class="card-body">
              <h5 class="card-title">hamza</h5>
              <p class="card-text text-muted">Project Lead</p>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card shadow-sm py-2">
             <img src="http://localhost/student/assets/images/chandu.jpg" class="card-img-top " alt="Team Member" height="350px">
            <div class="card-body">
              <h5 class="card-title">chandu </h5>
              <p class="card-text text-muted">Backend Developer</p>
            </div>
          </div>
        </div>
        <div class="col-md-4 py-2">
          <div class="card shadow-sm">
            <img src="http://localhost/student/assets/images/prajwal.jpg" class="card-img-top" alt="Team Member" height="350px">
            <div class="card-body">
              <h5 class="card-title">prajwal dhumale</h5>
              <p class="card-text text-muted">UI/UX developer</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="bg-primary text-white text-center py-3">
    <p class="mb-0">&copy; 2025 Student Management CRUD Project. All rights reserved.</p>
  </footer>

  <!-- Bootstrap 5 JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
