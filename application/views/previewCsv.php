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

<div class="container" style="border: 1px solid #337ab7; width: 500px; margin-top: 130px; ">
        <legend class="text-center">PREVIEW OF CSV DATA</legend>
        <table class="table table-striped table-hover">
          <thead>
            <tr>
              <th>roll_no</th>
              <th>name</th>
              <th>contact</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach($students as $student) {
            ?>
            <tr>
              <td> <?= $student['roll_no'] ?> </td>
              <td> <?= $student['name'] ?> </td>
              <td> <?= $student['contact'] ?> </td>
            </tr>
            <?php
            }
            ?>
          </tbody>
        </table>
        <form action="<?= site_url('Sagarcontroller/insertMultiple') ?>" method="POST">
          <h3 class="text-center">Confirm Insertion ? </h3>
          <div class="text-center">
            <?php foreach ($students as $i => $student): ?>
            <input type="hidden" name="students[<?= $i ?>][roll_no]" value="<?= $student['roll_no'] ?>">
            <input type="hidden" name="students[<?= $i ?>][name]" value="<?= $student['name'] ?>">
            <input type="hidden" name="students[<?= $i ?>][contact]" value="<?= $student['contact'] ?>">
            <?php endforeach; ?>
            <button type="submit" class="btn btn-success">Insert</button>
            <button type="button" onclick="window.location.href='<?php echo site_url("studentController") ?>' " class="btn btn-danger">Cancel</button>
          </div>
        </form>
      </div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

</body>
</html>

<!-- Latest compiled and minified CSS & JS -->
