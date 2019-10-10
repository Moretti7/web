<!DOCTYPE html>
<html lang="en">

<?php
require_once 'head.php';
require_once 'user.php';
require_once 'navbar.php';
$user = $_SESSION['user'];
?>

<body>
    <div class="container d-flex justify-content-center">
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
                    <label>Photo</label>
                    <input name="avatar" type="file" class="form-control">
                    <input type="hidden" name="user" value="<?php echo $_SESSION['user']->getId()?>">
                    <input type="hidden" name="role" value="<?php echo $_SESSION['user']->getRole()?>">
                </div>
                <div class="form-group">
                    <label>Surname</label>
                    <input name="surname" value="<?php echo $user->getLastname();?>" type="text" class="form-control" pattern="[^\W\d]+" title="Only letters" placeholder="Surname">
                </div>
                <button type="submit" class="btn btn-primary ml-3">Save</button>
            </form>
        </div>
    </div>
</body>
<?php
require_once 'scripts.php';
?>
</html>