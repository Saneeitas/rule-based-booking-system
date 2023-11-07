<nav class="navbar rounded navbar-light sticky-top" style="background-color:white">
  <div class=" container-fluid">
    <a class="navbar-brand" style="color:#E57C23" href="#">
      <h4> <i class="fas fa-bars"></i> RBBS</h4>
    </a>
    <div class="d-flex">
      <?php
      if (isset($_SESSION["user"])) {
      ?>
        <a href="dashboard.php" class="nav-link text-dark">Dashboard 👨‍🍳 </a><span></span>
        <a href="logout.php" class="nav-link text-danger">
          <i class="fas fa-sign-out-alt"></i> Logout</a>
      <?php
      } else {
      ?>
        <a href="index.php" class="nav-link text-dark">
          <i class="fas fa-sign-in-alt"></i> Login </a><span></span>
      <?php
      }
      ?>
    </div>
  </div>
</nav>