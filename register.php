<!DOCTYPE html>
<html lang="en">

<?php
require_once 'head.php';
?>

<body>
    <?php
    require_once 'navbar.php';
    ?>

    <div class="container d-flex justify-content-center">
        <form class="w-50" method="POST" action="./controllers/registerController.php" enctype="multipart/form-data">
            <div class="form-group">
                <label>Email</label>
                <input name="email" type="email" class="form-control" placeholder="Email">
            </div>
            <div class="form-group">
                <label>Password</label>
                <input name="password" type="password" class="form-control" pattern="\w+" title="Letters, numbers and '_' are allowed" placeholder="Password">
            </div>
            <div class="form-group">
                <label>Name</label>
                <input name="name" type="text" class="form-control" pattern="[^\W\d]+" title="Only letters" placeholder="Name">
            </div>
            <div class="form-group">
                <label>Surname</label>
                <input name="surname" type="text" class="form-control" pattern="[^\W\d]+" title="Only letters" placeholder="Surname">
            </div>
            <div class="form-group">
                <label>Photo</label>
                <input name="avatar" type="file" class="form-control">
            </div>
            <div class="form-group">
                <label>Role</label>
                <select name="role" class="form-control">
                    <option selected value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary ml-3">Register</button>
        </form>
    </div>
</body>
<?php
require_once 'scripts.php';
?>
</html>