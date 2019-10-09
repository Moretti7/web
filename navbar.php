<nav class="navbar-expand-lg navbar navbar-dark bg-dark">
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
              <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
          </li>
      </ul>
      <div class="user-name">
          <?php
          require_once 'user.php';
          session_start();
          if (isset($_SESSION['user'])) {
            $user = $_SESSION['user'];
            echo $user->getFirstname().' '.$user->getLastname();
          }
          ?>
      </div>

      <?php
        if (isset($_SESSION['user'])) {
            echo '<a href="./controllers/logoutController.php" class="btn btn-primary">Logout</a>';
        } else {
            echo '<a href="./register.php" class="btn btn-primary mr-3">Register</a>';
            echo '<a href="./login.php" class="btn btn-primary">Login</a>';
        }
      ?>
  </div>
</nav>