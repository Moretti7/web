<!DOCTYPE html>
<html lang="en">

<?php
require_once 'head.php';
require_once 'user.php';
require_once 'navbar.php';
require_once './controllers/userPageController.php';
?>

<body>
    <div class="container d-flex justify-content-center mt-3">
        <div class="container col-3">
            <img class="avatar" src="<?php echo $user->getPhoto();?>">
        </div>
        <div class="container d-flex justify-content-center col-9">
            <form class="w-50" method="POST" action="./controllers/updateController.php" enctype="multipart/form-data">
                <div class="form-group">
                    <label>Email</label>
                    <input name="email" value="<?php echo $user->getEmail();?>" type="email" class="form-control" placeholder="Email">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input name="password" type="password" class="form-control" pattern="\w+" title="Letters, numbers and '_' are allowed" placeholder="Password">
                </div>
                <div class="form-group">
                    <label>Name</label>
                    <input name="name" value="<?php echo $user->getFirstname();?>" type="text" class="form-control" pattern="[^\W\d]+" title="Only letters" placeholder="Name">
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input name="surname" value="<?php echo $user->getLastname();?>" type="text" class="form-control" pattern="[^\W\d]+" title="Only letters" placeholder="Surname">
                    <input type="hidden" name="user" value="<?php echo $_GET['user']?>">
                </div>
                <?php
                if(isset($_SESSION["user"]) && $_SESSION["user"]->getId() == $_GET['user']) {
                    echo '<div class="form-group">';
                    echo '<label>Photo</label>';
                    echo '<input name="avatar" type="file" class="form-control">';
                    echo '</div>';
                }
                if(isset($_SESSION["user"]) && $_SESSION["user"]->getRole() == 'admin') {
                    echo '<div class="form-group">';
                        echo '<label>Role</label>';
                        echo '<select name="role" class="form-control">';
                            echo '<option selected value="user">User</option>';
                            echo '<option value="admin">Admin</option>';
                        echo '</select>';
                    echo '</div>';
                }

                if(isset($_SESSION["user"]) && $_SESSION["user"]->getId() == $_GET['user'] || $_SESSION["user"]->getRole() == 'admin') {
                    echo '<button type="submit" class="btn btn-primary ml-3">Save</button>';
                }
                ?>
            </form>
                <?php 
                if(isset($_SESSION["user"]) && $_SESSION["user"]->getRole() == 'admin') {
                    echo '<form action="./controllers/deleteUser.php" method="POST">';
                    echo '<input type="hidden" name="user" value="' . $_GET['user'].'">';
                    echo '<input type="submit" class="btn btn-danger" value="Delete">';
                    echo '</form>';
                }
                ?>
        </div>
    </div>
</body>
<?php
require_once 'scripts.php';
?>
</html>