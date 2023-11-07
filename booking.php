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
    include 'inc/process.php'; 
    
    if (isset($_GET["menu_item_id"]) && !empty($_GET["menu_item_id"])) {
        $id = $_GET["menu_item_id"];
        //sql & query
        $sql = "SELECT * FROM menu_items WHERE menu_item_id ='$id' ";
        $query = mysqli_query($connection, $sql);
        //result
        $result = mysqli_fetch_assoc($query);
    } else {
        header("location: index.php");
    }
    //session to store url
    $_SESSION["url"] = $_GET["menu_item_id"];
    
?>

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

                       
                    </ul>
                </div>

        </div>

        <div class="col-12">
                <?php
                if (isset($error)) {
                ?>
                    <div class="alert alert-danger">
                        <strong><?php echo $error ?></strong>
                    </div>
                <?php
                } elseif (isset($success)) {
                ?>
                    <div class="alert alert-success">
                        <strong><?php echo $success ?></strong>
                    </div>
                <?php
                }
                ?>
               
                <div class="row mt-3">
                    <div class="col-3">
                        <div class="content">
                            <h5 style="font-weight:bold;">Dish name</h5>
                            <p>
                                <?php echo $result["dish_name"] ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="content">
                            <h5 style="font-weight:bold;">ingredients</h5>
                            <p>
                                <?php echo $result["ingredients"] ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center">
                            <img style="width:250px; height:250px;" src="<?php echo $result["image_url"] ?>" alt="">
                        </div>

                    </div>
                </div>

                <hr>
                <div>
                    <h5 style="font-weight:bold;">Bookings Details</h5>
                            <div class="row">
                                <div class="col-6">
                                <form action="" method="post">
                                <div class="form-group">
                                    <label for="">New comment</label>
                                    <input type="text" name="comment" id="" class="form-control" placeholder="Enter your comment here" required> </textarea>
                                </div>
                                <div class="mt-2">
                                    <button type="submit" name="comment_new" class="btn text-light" style="background-color:#E57C23;">
                                        Book</button>
                                </div>
                                </form>
                                </div>
                                <div class="col-6">
                                   
                                </div>
                            </div>
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