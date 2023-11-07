<?php
session_start();

//check if user is not logged in
if (!isset($_SESSION["username"])) {
    header("location: login.php");
}

//header links
require "inc/header.php"; ?>

<div class="container">

    <?php
    //header content
    require './pages/header-home.php';
    include 'inc/process.php'; ?>

    <div class="container p-3">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3 sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active text-dark" aria-current="page" href="menu.php">
                                <span data-feather="home" class="align-text-bottom"></span>
                                Back
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="recipe.php" style="color:#E57C23;">
                                <span data-feather="file" class="align-text-bottom"></span>
                                🍽️ Recipes
                            </a>
                        </li>
                       

                        </li>
                    </ul>
                </div>

        </div>

    </div>
</div>



<?php
//footer content
require './pages/footer-home.php'; ?>

</div>


<?php
//footer script
require "inc/footer.php";  ?>