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

    //if user click edit
    if (isset($_GET["edit_food_id"]) && !empty($_GET["edit_food_id"])) {
        $edit_food_id = $_GET["edit_food_id"];
        //sql
        $sql = "SELECT * FROM menu_items WHERE menu_item_id = '$edit_food_id'";
        $query = mysqli_query($connection, $sql);
        $result = mysqli_fetch_assoc($query);
    } else {
        header("location: food.php");
    }
    ?>

    <div class="container p-3">
        <div class="row">

            <div class="col-2">
                <nav id="sidebarMenu" class="d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3 sidebar-sticky">
                        <ul class="nav flex-column">
                        <li class="list-group-item" style="color:#E57C23;">
                            <a href="food.php" class="btn">
                                <i class="fas fa-grip-vertical"style="color:#E57C23;" ></i> Back </a>
                        </li>  
                           
                            </li>
                        </ul>
                    </div>
            </div>
            <div class="col-9">
                <div class="container">
                    <h6>Edit Food</h6>
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
                            <input type="file" name="thumbnail" id="" class="form-control">
                          </div>
                            </div>
                        <div class="col-6">
                        <div class="form-group">
                            <label for="">Dish name</label>
                            <input type="text" name="name" value="<?php echo $result["dish_name"] ?>" placeholder="Enter dish name" class="form-control" id="" required>
                        </div>
                         </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="form-group">
                                    <label for="">Ingredients</label>
                                    <input type="text" name="ingredients" value="<?php echo $result["ingredients"] ?>" placeholder="Enter ingredient" class="form-control" id="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="">Cafeteria</label>
                                    <select name="cafeteria_id" class="form-select" id="">
                                        <?php
                                        $sql2 = "SELECT * FROM cafeterias ORDER BY cafeteria_id";
                                        $query2 = mysqli_query($connection, $sql2);
                                        while ($result2 = mysqli_fetch_assoc($query2)) {
                                        ?>
                                             <option value="<?php echo $result2["cafeteria_id"] ?>" <?php echo $result["cafeteria_id"] == $result2["cafeteria_id"] ? "selected" : "" ?>>
                                                <?php echo $result2["name"] ?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Dietary preferences</label>
                           
                            <select class="form-select" id="dietary_tags" name="dietary_tags[]" multiple>
                            <?php echo $result["dietary"] ?>
                            <option value="low-carb">Low Carb</option>
                                <option value="high-protein">High Protein</option>
                                <option value="organic">Organic</option>
                                <option value="keto">Keto</option>
                                <option value="vegetarian">Vegetarian</option>
                                <option value="vegan">Vegan</option>
                                <option value="Gluten-free">Gluten-free</option>
                                <option value="halal">Halal</option>
                                <option value="Diary-free">Diary-free</option>
                                <!-- Add more dietary preferences as needed -->
                            </select>
                          </div>  

                        <div class="form-group">
                            <button type="submit" name="update_food" style="background-color:#E57C23;" class="btn btn-sm text-white my-2">
                                Update</button>
                        </div>
                </div>
                </form>
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