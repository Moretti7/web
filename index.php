<!DOCTYPE html>
<html lang="en">
<?php
require_once './head.php';
require_once './controllers/mainPageController.php';
?>
<body>
<div class="content">
  <?php
  require_once './navbar.php';
  ?>
  <table class="table table-boardered">
    <thead>
      <tr>
        <th scope="col" onclick="sort('id')">ID</th>
        <th scope="col" onclick="sort('first_name')">First Name</th>
        <th scope="col" onclick="sort('last_name')">Last Name</th>
        <th scope="col" onclick="sort('email')">Email</th>
        <th scope="col" onclick="sort('title')">Role</th>
      </tr>
    </thead>
    <tbody class="table-body">
    </tbody>
  </table>
</div>
<?php
require_once './scripts.php';
?>

  <div class="register-popup d-flex hide">
    <div class="container d-flex justify-content-center register">
      <div class="w-50">
          <div class="form-group">
              <label>Email</label>
              <input name="email" type="email" class="form-control register-email" placeholder="Email">
          </div>
          <div class="form-group">
              <label>Password</label>
              <input name="password" type="password" class="form-control register-password" pattern="\w+" title="Letters, numbers and '_' are allowed" placeholder="Password">
          </div>
          <div class="form-group">
              <label>Name</label>
              <input name="name" type="text" class="form-control name" pattern="[^\W\d]+" title="Only letters" placeholder="Name">
          </div>
          <div class="form-group">
              <label>Surname</label>
              <input name="surname" type="text" class="form-control surname" pattern="[^\W\d]+" title="Only letters" placeholder="Surname">
          </div>
          <div class="form-group">
              <label>Photo</label>
              <input name="avatar" type="file" class="form-control avatar">
          </div>
          <div class="form-group">
              <label>Role</label>
              <select name="role" class="form-control role">
                  <option selected value="user">User</option>
                  <option value="admin">Admin</option>
              </select>
          </div>
          <button type="submit" class="btn btn-primary ml-3 submit-register">Register</button>
      </div>
    </div>
  </div>

  <div class="login-popup d-flex hide">
    <div class="container d-flex justify-content-center">
      <div class="w-50">
          <div class="form-group">
              <label for="email">Email</label>
              <input name="email" type="email" class="form-control email-login"placeholder="Email">
          </div>
          <div class="form-group">
              <label for="password">Password</label>
              <input name="password" type="password" class="form-control password-login" placeholder="Password">
          </div>
          <button class="btn btn-primary ml-3 submit-login">Sign in</button>
      </div>
    </div>
  </div>

  <div class="user-popup hide">
    <div class="container d-flex justify-content-center mt-3">
        <div class="container col-3">
            <img class="user-avatar avatar" src="">
        </div>
        <div class="container d-flex justify-content-center col-9">
            <div class="w-50">
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" value="" type="email" class="form-control user-email" placeholder="Email">
                </div>
                <div class="form-group password-element">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control user-password" pattern="\w+" title="Letters, numbers and '_' are allowed" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" value="" type="text" class="form-control first-name" pattern="[^\W\d]+" title="Only letters" placeholder="Name">
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input name="surname" value="" type="text" class="form-control last-name" pattern="[^\W\d]+" title="Only letters" placeholder="Surname">
                </div>
                <div class="form-group photo-element">
                  <label>Photo</label>
                  <input name="avatar" type="file" class="form-control user-avatar">
                </div>
                <div class="form-group role-element">
                    <label>Role</label>
                    <select name="role" class="form-control user-role">
                        <option selected value="user">User</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>
                <input type="submit" class="btn btn-danger user-delete-button" value="Delete">
                <button type="submit" class="btn btn-primary ml-3 user-save-button">Save</button>
            </div>
        </div>
      </div>
    </div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="./public/scripts/index.js"></script>
<script src="./public/scripts/buttons.js"></script>
</body>
</html>