<!DOCTYPE html>
<html>
<head>
    <title>Student Management</title>

    <!-- Bootstrap & DataTables -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        input { margin: 5px !important; margin-right: 15px !important; }
        /*#myTable_length {
         margin: 5px !important;
         z-index: 1 !important;
        }
        */
        .toast{
            position: absolute !important;
            z-index: 9999!important;
            top: 0px;
            left: 35%;
            height:50px;
            text-align: center;
        }
        /* Make checkbox bigger */
        #selectAll , .studentCheckbox{
        transform: scale(1.3);   increases size 
        cursor: pointer;
        z-index: 999 !important;
        }
        


        /* Reduce the width of the checkbox column */
        .checkboxCol {
        width: 55px !important;       /* adjust as you want */
        text-align: center;
        }

       /* #selectAll{
            margin-left: 20px !important;
        }*/

    </style>
</head>
<body>

<!-- 🌐 Navbar -->
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">

    <div class="container">
        <ul class="navbar-nav d-none d-lg-flex">
            <li class="nav-item"><a class="nav-link active" href="#">Dashboard</a></li>
            <li class="nav-item"><a class="nav-link " href="<?php echo site_url('StudentController/aboutUs')?>">About Us</a></li>
            <li class="nav-item"><a class="nav-link " href="<?php echo site_url('StudentController/contactUs')?>">Contact Us</a></li>
        </ul>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSearch">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarSearch">
            <button type="button" class="btn btn-success mx-2" data-bs-toggle="modal" data-bs-target="#addModal">Add Student</button>
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addMultipleModal">Add Students <i class="fa-regular fa-file"></i></button>
            
        </div>
    </div>
</nav>

<!-- Student Table -->
<div class="container my-3 border border-1 border-dark rounded p-2">
    <table id="myTable" class="table table-bordered table-striped table-hover text-center">
        <thead>
            <tr>
                <th class="bg-dark text-light checkboxCol text-center "><input type="checkbox" id="selectAll"class="p-5"></th>
                <th class="bg-dark text-light text-center">Roll No</th>
                <th class="bg-dark text-light text-center">Name</th>
                <th class="bg-dark text-light text-center">Contact</th>
                <th class="bg-dark text-light text-center">Action</th>
                <th class="bg-dark text-light text-center">Resume</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($students as $student) { ?>
            <tr>
                <td><input type="checkbox" class="studentCheckbox p-5" value="<?= $student->id ?>"></td>
                <td><?= $student->roll_no ?></td>
                <td><?= $student->name ?></td>
                <td><?= $student->contact ?></td>
                <td>
                    <button class="btn btn-success editBtn"
                            data-bs-toggle="modal"
                            data-bs-target="#updateModal"
                            data-id="<?= $student->id ?>"
                            data-roll_no="<?= $student->roll_no ?>"
                            data-name="<?= $student->name ?>"
                            data-contact="<?= $student->contact ?>">
                        <i class="fa-solid fa-pen-to-square"></i>
                    </button>
                 <!--    <a class="btn btn-danger" href="<?php echo site_url('StudentController/delete/'.$student->id) ?>" >Delete</a>
                  -->
                <a  class="btn btn-danger deleteBtn" 
                    href="<?php echo site_url('StudentController/delete/'.$student->id) ?>" 
                    onclick="return confirm('Are you sure you want to delete this student?');">
                        <i class="fa-solid fa-trash"></i>

                </a>

                </td>
                <td>
                    <?php if ($student->resume_name != null): ?>
                        <a href="<?= site_url('StudentController/viewResume/'.$student->id); ?>" target="_blank" class="btn btn-primary"><i class="fa-solid fa-file"></i></a>
                    <?php else: ?>
                    <button class="btn btn-secondary addResumeBtn"
                            data-bs-toggle="modal"
                            data-bs-target="#addResumeModal"
                            data-id="<?= $student->id ?>"
                            >
                        <i class="fa-solid fa-plus"></i>
                    </button>                    
                  <?php endif; ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <button id="bulkDeleteBtn" class="btn btn-danger mt-2">Delete Selected</button>


    <div class="text-end mt-2">
       <!--  <a href="<?php echo site_url('StudentController/downloadCSV'); ?>" class="btn btn-primary">Download CSV</a> -->
        <a href="<?php echo site_url('StudentController/downloadExcel'); ?>" class="btn btn-success">Download Excel</a>
    </div>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo site_url('StudentController/save'); ?>" method="POST" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title">Add New Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="number" class="form-control mb-2" name="roll_no" placeholder="Roll Number" required>
          <input type="text" class="form-control mb-2" name="name" placeholder="Full Name" required>
          <input type="tel" class="form-control mb-2" name="contact" placeholder="Contact Number" maxlength="10" pattern=[0-9]{10} required>

          <input type="file" name="resume" class="form-control" accept=".pdf,.doc,.docx" >
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success w-100">Add Student</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- add modal -->

<!-- Add multiple Modal -->
<div class="modal fade" id="addMultipleModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo site_url('StudentController/importCSV'); ?>" method="POST" enctype="multipart/form-data">
    <div class="modal-body">
        <input type="file" name="csvfile" accept=".csv" required>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success w-100">Upload document</button>
    </div>
  </form>
    </div>
  </div>
</div>
<!-- add multiple modal -->

<!-- Add resume Modal -->
<div class="modal fade" id="addResumeModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h5 class="modal-title">add resume</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
      <form action="<?php echo site_url('StudentController/addResume'); ?>" method="POST" enctype="multipart/form-data">
    <div class="modal-body">
      <input type="hidden" id="add_resume_id" name="id"><br>
        <input type="file" name="resume" accept=".pdf,.doc,.docx," required>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success w-100">Upload Students</button>
    </div>
</form>
    </div>
  </div>
</div>
<!-- add resume modal -->


<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <form action="<?php echo site_url('StudentController/update'); ?>" method="POST">
        <div class="modal-header">
          <h5 class="modal-title">Update Student</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="update_id" name="id">
          <input type="text" id="update_roll_no" class="form-control mb-2" name="roll_no" placeholder="Roll Number" required>
          <input type="text" id="update_name" class="form-control mb-2" name="name" placeholder="Full Name" required>
          <input type="tel" id="update_contact" class="form-control mb-2" name="contact" placeholder="Contact Number" maxlength="10" pattern=[0-9]{10} required>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-success w-100">Update Student</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- Update Modal -->


<!-- toast for add -->
<div class="toast align-items-center text-white bg-success border-0 position-fixed bottom-0 end-0 m-3"
     id="successToast"
     role="alert"
     aria-live="assertive"
     aria-atomic="true">
  <div class="d-flex">
    <div class="toast-body">
<?php if($this->session->flashdata('success')): ?>
      <?= $this->session->flashdata('success'); ?>
      <?php elseif ($this->session->flashdata('delete')): ?>
      <?= $this->session->flashdata('delete'); ?>
      <?php elseif ($this->session->flashdata('update')): ?>
      <?= $this->session->flashdata('update'); ?>
      <?php elseif ($this->session->flashdata('bulkDelete')): ?>
      <?= $this->session->flashdata('bulkDelete'); ?>
      <?php elseif ($this->session->flashdata('checkStudent')): ?>
      <?= $this->session->flashdata('checkStudent'); ?>
      <?php elseif ($this->session->flashdata('query')): ?>
      <?= $this->session->flashdata('query'); ?>
      <?php elseif ($this->session->flashdata('checkContact')): ?>
      <?= $this->session->flashdata('checkContact'); ?>
      <?php elseif ($this->session->flashdata('checkRollNo')): ?>
      <?= $this->session->flashdata('checkRollNo'); ?>
      
      
      
<?php endif; ?>
    </div>
    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
  </div>
</div>
<!-- toast for add -->

<!-- Scripts -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
$(document).ready(function() {
    $('#myTable').DataTable({
        "pageLength": 10,
        "lengthMenu": [5, 10, 20,50,100,500,1000],
        "scrollY": "350px",
        "scrollCollapse": true,

        columnDefs:[
        {orderable:false,target:0}
        ]
        
    });

    $(document).on("click", ".editBtn", function() {
        $("#update_id").val($(this).data('id'));
        $("#update_roll_no").val($(this).data('roll_no'));
        $("#update_name").val($(this).data('name'));
        $("#update_contact").val($(this).data('contact'));
    });

    $(document).on("click", ".addResumeBtn", function() {
        $("#add_resume_id").val($(this).data('id'));
    });

    

    // ✅ Show toast if flashdata exists
   var toastEl = document.getElementById('successToast');
    if (toastEl.querySelector('.toast-body').innerText.trim()!=='') {
        var toast = new bootstrap.Toast(toastEl, {delay: 3000 });
        toast.show();
    }
});

// Select All
$("#selectAll").on("click", function () {
    $(".studentCheckbox").prop("checked", this.checked);
});

// Bulk Delete
$("#bulkDeleteBtn").on("click", function () {
    let ids = [];

    $(".studentCheckbox:checked").each(function () {
        ids.push($(this).val());
    });

    if (ids.length === 0) {
        alert("Please select at least one student!");
        return;
    }

    if (!confirm("Are you sure you want to delete selected students?")) {
        return;
    }

    $.ajax({
        url: "<?= site_url('StudentController/bulkDelete'); ?>",
        type: "POST",
        data: { ids: ids },
        success: function (response) {
            location.reload(); // reload table
        }
    });
});


</script>


</body>
</html>
