<!DOCTYPE html>
<html lang="en">
<?php
require_once './head.php';
require_once './controllers/mainPageController.php';
?>
<body>
<?php
require_once './navbar.php';
?>
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">First Name</th>
      <th scope="col">Last Name</th>
      <th scope="col">Email</th>
      <th scope="col">Role</th>
    </tr>
  </thead>
  <tbody class="table-body">
  </tbody>
</table>
<?php
require_once './scripts.php';
?>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="./public/scripts/index.js"></script>
</body>
</html>