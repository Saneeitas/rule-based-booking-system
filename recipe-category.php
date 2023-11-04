<?php
session_start();
require "inc/process.php";
require "inc/header.php";

if (isset($_GET["recipe_category_id"]) && !empty($_GET["recipe_category_id"])) {
    $id = $_GET["recipe_category_id"];
} else {
    header("location: index.php");
}

?>

<div class="container">
    <?php require './pages/header-home.php'; ?>
    <div class="container-fluid my-3">
        <div class="row justify-content-center">
            <div class="col-8">
                <div class="border p-3">
                    <ul style="display:flex; list-style-type:none;">
                        <?php
                        $sql_c = "SELECT * FROM category ORDER BY id DESC";
                        $query_c = mysqli_query($connection, $sql_c);
                        $count = 0;
                        while ($result_c = mysqli_fetch_assoc($query_c)) {
                        ?>
                            <li style="<?php echo $count > 0 ? 'margin-left:10px;' : '' ?>">
                                <a href="recipe-category.php?recipe_category_id=<?php echo $result_c["id"]; ?>" class="<?php echo $result_c["id"] == $id ? 'text-danger' : '' ?>">
                                    <?php echo $result_c["name"]; ?></a>
                            </li>
                        <?php
                            $count++;
                        }
                        ?>
                    </ul>
                </div>
            </div>
            <div class="col-8">
                <div class="row">
                    <?php
                    $sql = "SELECT * FROM recipes WHERE category_id ='$id'  AND status = 1 ORDER BY id DESC";
                    $query = mysqli_query($connection, $sql);
                    while ($result = mysqli_fetch_assoc($query)) {
                        //Looping through the col for multiples recipe
                    ?>
                        <div class="col-4 mt-2">
                            <div class="card">
                                <img src="<?php echo $result["image"]; ?>" style="height:200px; width:100%" class="card-img-top">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo $result["title"]; ?></h5>
                                    <p class="card-text">Cook Time: <?php echo $result["cook_time"] ?>
                                    <p class="card-text">Yield: <?php echo $result["yield"] ?>
                                    </p>
                                    <a href="read-recipe.php?recipe_id=<?php echo $result["id"]; ?>" class="btn text-light" style="background-color:#E57C23;">View recipe</a>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
    <?php require './pages/footer-home.php'; ?>
</div>

<?php
require "inc/footer.php";
?>