<nav class="navbar rounded navbar-light sticky-top" style="background-color:white">
  <div class=" container-fluid">
    <a class="navbar-brand" style="color:#E57C23" href="index.php">
      <h4> <i class="fas fa-bars"></i> RBBS</h4>
    </a>
    <div class="d-flex">
      <?php
      if (isset($_SESSION["username"])) {
      ?>
        <a href="dashboard.php" class="nav-link text-dark"><i class="fas fa-user-circle"></i> Dashboard </a><span></span>
        <a href="logout.php" class="nav-link text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout</a>
      <?php
      } else {
      ?>
        <a href="login.php" class="nav-link text-dark">
          <i class="fas fa-sign-in-alt"></i> Login </a><span></span>
        <a href="register.php" class="nav-link text-dark">
          <i class="fas fa-sign-in-alt"></i> Signup</a>
      <?php
      }
      ?>
    </div>
  </div>
</nav>