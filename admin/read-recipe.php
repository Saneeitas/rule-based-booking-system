<?php

session_start();

require "inc/process.php";
require "inc/header.php";
if (isset($_GET["recipe_id"]) && !empty($_GET["recipe_id"])) {
    $id = $_GET["recipe_id"];
    //sql & query
    $sql = "SELECT * FROM recipes WHERE id ='$id' ";
    $query = mysqli_query($connection, $sql);
    //result
    $result = mysqli_fetch_assoc($query);
} else {
    header("location: index.php");
}
//session to store url
$_SESSION["url"] = $_GET["recipe_id"];
?>

<div class="container">
    <?php require './pages/header-home.php'; ?>
    <div class="container-fluid my-3">
        <div class="row">
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
                <div class="row text-light" style="background-color:#E57C23; border-radius: 10px;">
                    <div class="col" style="font-weight:450;">Title:
                        <p>
                            <?php echo $result["title"] ?>
                        </p>
                    </div>
                    <div class="col" style="font-weight:450;">Yield:
                        <p>
                            <?php echo $result["yield"] ?>
                        </p>
                    </div>
                    <div class="col" style="font-weight:450;">Cooking Time:
                        <p>
                            <?php echo $result["cook_time"] ?>
                        </p>
                    </div>
                    <div class="col" style="font-weight:450;">Category:
                        <p>
                            <?php
                            $cid = $result["category_id"];
                            //sql & query to get category_id name
                            $sql2 = "SELECT * FROM category WHERE id='$cid' ";
                            $query2 = mysqli_query($connection, $sql2);
                            $result2 = mysqli_fetch_assoc($query2);
                            echo $result2["name"];
                            ?>
                        </p>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-3">
                        <div class="content">
                            <h5 style="font-weight:bold;">Ingredients</h5>
                            <p>
                                <?php echo $result["ingredient"] ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="content">
                            <h5 style="font-weight:bold;">Directions</h5>
                            <p>
                                <?php echo $result["direction"] ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="text-center">
                            <img style="width:250px; height:250px;" src="<?php echo $result["image"] ?>" alt="">
                        </div>

                    </div>
                </div>

                <hr>
                <div>
                    <h5 style="font-weight:bold;">Comments</h5>
                    <?php
                    $sql = "SELECT * FROM comments WHERE recipe_id='$id' ";
                    $query4 = mysqli_query($connection, $sql);
                    $result3 = mysqli_fetch_assoc($query4);
                    if ($result3) {
                        $query = mysqli_query($connection, $sql);
                        while ($result2 = mysqli_fetch_assoc($query)) {
                    ?>
                            <div class="row">
                                <div class="col-6">
                                    <?php
                                    $user_id = $result2["user_id"];
                                    $sql2 = "SELECT * FROM users WHERE id ='$user_id'";
                                    $query2 = mysqli_query($connection, $sql2);
                                    $result4 = mysqli_fetch_assoc($query2);
                                    ?>
                                    <p>
                                        <?php echo $result4["name"]; ?>
                                        <br>
                                        <small>
                                            <?php echo date("F j Y h:i:s a", strtotime($result2["timestamp"])); ?>
                                        </small>
                                    </p>
                                </div>
                                <div class="col-6">
                                    <?php echo $result2["message"]; ?>
                                </div>
                            </div>

                    <?php
                        }
                    } else {
                        echo "No comment yet!";
                    }
                    ?>
                    <hr>
                    
                        <form action="" method="post">
                            <div class="form-group">
                                <label for="">New comment</label>
                                <textarea name="comment" id="" class="form-control" cols="10" rows="2" placeholder="Enter your comment here" required> </textarea>
                            </div>
                            <div class="mt-2">
                                <button type="submit" name="comment_new" class="btn text-light" style="background-color:#E57C23;">
                                    Comment</button>
                            </div>
                        </form>
                </div>
            </div>

        </div>
    </div>
    <?php require './pages/footer-home.php'; ?>
</div>



<?php
require "inc/footer.php";


?>