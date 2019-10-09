<!DOCTYPE html>
<html lang="en">
<?php
require_once './head.php';
?>
<body>
<?php
require_once './navbar.php';
?>

<div class="container d-flex justify-content-center">
    <form class="w-50" id="form" method="POST" action="./controllers/loginController.php">
        <div class="form-group">
            <label for="email">Email</label>
            <input name="email" type="email" class="form-control email"placeholder="Email">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input name="password" type="password" class="form-control password" placeholder="Password">
        </div>
        <button type="submit" class="btn btn-primary ml-3">Sign in</button>
    </form>
</div>
</body>
<?php
require_once './scripts.php';
?>
</html>