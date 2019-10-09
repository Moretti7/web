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
  <tbody>
    <?php
      for ($i=0; $i < count($users); $i++) { 
        echo '<tr>';
          echo '<td>'.$users[$i]->getId().'</td>';
          echo '<td>'.$users[$i]->getFirstName().'</td>';
          echo '<td>'.$users[$i]->getLastName().'</td>';
          echo '<td>'.$users[$i]->getEmail().'</td>';
          echo '<td>'.$users[$i]->getRole().'</td>';
        echo '</tr>';
      }
    ?>
  </tbody>
</table>
<?php
require_once './scripts.php';
?>
</body>
</html>