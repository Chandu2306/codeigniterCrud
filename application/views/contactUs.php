<!DOCTYPE html>
<html>
<head>
    <title></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
          rel="stylesheet" 
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" 
          crossorigin="anonymous">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" 
          rel="stylesheet">
</head>

<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
    <div class="container">
        <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item"><a class="nav-link" href="<?php echo site_url('StudentController')?>">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link " href="<?php echo site_url('StudentController/aboutUs')?>">About Us</a></li>
            <li class="nav-item"><a class="nav-link active" href="<?php echo site_url('StudentController/contactUs')?>">Contact Us</a></li>
        </ul>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch">
            <span class="navbar-toggler-icon"></span>
        </button>
    </div>
</nav>

            <!-- Toggler for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch">
                <span class="navbar-toggler-icon"></span>
            </button>

            <!-- Links visible only in mobile view -->
            <ul class="navbar-nav d-lg-none mt-3">
                <li class="nav-item">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Add Student</a>
                </li>
            </ul>

        </div>
    </nav>

    <div class="container mt-1">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card p-3">
                    <h4 class="text-center mb-2 text-success">leave your query</h4>

                    <form action="<?php echo site_url('StudentController/saveQuery'); ?>" method="POST">

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text" 
                                   class="form-control" 
                                   id="name" 
                                   name="name" 
                                   placeholder="Enter full name" 
                                   pattern="^[a-zA-Z ]+"
                                   required>
                        </div>
                                   <div class="mb-3">
                                   <label for="email" class="form-label">Email address</label>
                                   <input type="email" 
                                   class="form-control" 
                                   id="email" 
                                   name="email" 
                                   placeholder="name@example.com"
                                   required
                                   pattern="^[^@]+@[^@]+\.[^@]+$"
                                       title="Please enter a valid email address (e.g. user@example.com)">
                        </div>




                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="tel" 
                                   class="form-control" 
                                   id="contact" 
                                   name="contact" 
                                   placeholder="enter contact number"
                                   maxlength="10" 
                                   oninput="this.value=this.value.replace(/[^0-9]/g,'');"
                                   pattern=[0-9]{10}
                                   required 
                                   >

                            <div class="form-text">Enter a valid 10-digit mobile number.</div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Your query</label>
                            <textarea class="form-control" 
                                      id="exampleFormControlTextarea1" 
                                      name="query" 
                                      rows="2"
                                      required 
                                      ></textarea>
                        </div>

                        <button type="submit" class="btn btn-success w-100">Submit</button>

                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
            crossorigin="anonymous"></script>

</body>
</html>

<!-- Latest compiled and minified CSS & JS -->
