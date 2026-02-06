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

    <!-- 🌐 Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">

            <!-- Left side: Logo + Links -->
            <div class="d-flex align-items-center">
                <!-- Links (show in large screens) -->
                <ul class="navbar-nav d-none d-lg-flex">
                    <li class="nav-item">
                        <a class="nav-link active"
                           href="<?php echo site_url('StudentController/') ?>">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Add Student</a>
                    </li>
                </ul>
            </div>

            <!-- Toggler for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSearch">
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

    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-6">

                <div class="card p-4">
                    <h4 class="text-center mb-4 text-success">
                        update <?= $student->name ?>'s details
                    </h4>

                    <form action="<?php echo site_url('StudentController/update/'.$student->id) ?>"
                          method="POST">

                        <div class="mb-3">
                            <label for="roll_no" class="form-label">Roll Number</label>
                            <input type="text"
                                   class="bg-light form-control"
                                   id="roll_no"
                                   name="roll_no"
                                   placeholder="Enter roll number"
                                   value="<?= $student->roll_no ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Full Name</label>
                            <input type="text"
                                   class="form-control"
                                   id="name"
                                   name="name"
                                   placeholder="Enter full name"
                                   value="<?= $student->name ?>"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact Number</label>
                            <input type="tel"
                                   class="form-control"
                                   id="contact"
                                   name="contact"
                                   value="<?= $student->contact ?>"
                                   placeholder="Enter 10-digit contact number"
                                   required
                                   pattern="[0-9]{10}"
                                   maxlength="10"
                                   oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                            <div class="form-text">Enter a valid 10-digit mobile number.</div>
                        </div>

                        <a href="<?php echo site_url('StudentController/') ?>"
                           class="btn btn-danger w-100">
                            Cancel
                        </a>

                        <button type="submit"
                                class="btn btn-success w-100 mt-2">
                            update Student
                        </button>

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
