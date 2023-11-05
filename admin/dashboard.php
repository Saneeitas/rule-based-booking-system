<?php
session_start();

//check if user is not logged in
if (!isset($_SESSION["user"])) {
    header("location: login.php");
} //check if logged in as user


//header links
require "inc/header.php"; ?>

<div class="container">

    <?php
    //header content
    require './pages/header-home.php';
    include 'inc/process.php';
    ?>

    <div class="container p-3">
        <div class="row">
            <div class="col-2">
                <nav id="sidebarMenu" class="d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3 sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link active text-dark" aria-current="page" href="#">
                                    <span data-feather="home" class="align-text-bottom"></span>
                                    Welcome <?php echo $_SESSION["user"]["username"]; ?> 
                                </a>
                            </li>

                            </li>
                        </ul>
                    </div>
            </div>
            <div class="col-9">
                <div class="container">
                    <h6 class="text-center">Add New Recipes</h6>
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
                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="">Select Image</label>
                            <input type="file" name="thumbnail" id="" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" name="title" placeholder="Enter title" class="form-control" id="" required>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Ingredients</label>
                                    <textarea name="ingredient" id="" placeholder="Enter Ingredients" cols="30" rows="5" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Cook Time</label>
                                    <textarea name="cook_time" id="" placeholder="Enter Cook Time" cols="30" rows="5" class="form-control" required></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Yield</label>
                                    <input type="text" name="yield" placeholder="Enter yield" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Category</label>
                                    <select name="category_id" class="form-control" id="">
                                        <?php
                                        $sql = "SELECT * FROM category ORDER BY id DESC";
                                        $query = mysqli_query($connection, $sql);
                                        while ($result = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <option value="<?php echo $result["id"] ?>">
                                                <?php echo $result["name"] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="">Direction</label>
                            <textarea name="direction" id="" placeholder="Enter recipes direction" cols="30" rows="5" class="form-control" required></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" name="new_recipe" style="background-color:#E57C23;" class="btn btn-mc text-white my-2">
                                New Recipe</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <?php
    //footer content
    require './pages/footer-home.php';
    //footer script
    require "inc/footer.php";
    ?>
</div>
</div>