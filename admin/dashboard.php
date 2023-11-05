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
                            <li class="nav-item">
                                <a class="nav-link active text-dark" aria-current="page" href="">
                                    All Foods
                                </a>
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
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                            <label for="">Select Image</label>
                            <input type="file" name="thumbnail" id="" class="form-control" required>
                          </div>
                            </div>
                        <div class="col-6">
                        <div class="form-group">
                            <label for="">Dish name</label>
                            <input type="text" name="name" placeholder="Enter dish name" class="form-control" id="" required>
                        </div>
                         </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Ingredients</label>
                                    <input type="text" name="ingredients" placeholder="Enter ingredient" class="form-control" id="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Cafeteria</label>
                                    <select name="cafeteria_id" class="form-select" id="">
                                        <?php
                                        $sql = "SELECT * FROM cafeterias ORDER BY cafeteria_id DESC";
                                        $query = mysqli_query($connection, $sql);
                                        while ($result = mysqli_fetch_assoc($query)) {
                                        ?>
                                            <option value="<?php echo $result["cafeteria_id"] ?>">
                                                <?php echo $result["name"] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Portion Size</label>
                                    <select name="portion_size" class="form-select" id="">
                                            <option value="Medium">Medium</option>
                                            <option value="Medium">Large</option>
                                            <option value="Medium">Small</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Calories</label>
                                    <input type="text" name="calories" placeholder="E.g 200" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Carbohydrates</label>
                                    <input type="text" name="carbohydrates" placeholder="E.g 200" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Protein</label>
                                    <input type="text" name="protein" placeholder="E.g 450" class="form-control" id="" required>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <label for="">Fats</label>
                                    <input type="text" name="fats" placeholder="E.g 300" class="form-control" id="" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Dietary preferences</label>
                           
                            <select class="form-select" id="dietary_tags" name="dietary_tags[]" multiple>
                                <option value="low-carb">Low Carb</option>
                                <option value="high-protein">High Protein</option>
                                <option value="organic">Organic</option>
                                <option value="keto">Keto</option>
                                <option value="vegetarian">vegetarian</option>
                                <option value="vegan">vegan</option>
                                <!-- Add more dietary preferences as needed -->
                            </select>
                          </div>
                        <div class="form-group">
                            <button type="submit" name="add_food" style="background-color:#E57C23;" class="btn btn-mc text-white my-2">
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