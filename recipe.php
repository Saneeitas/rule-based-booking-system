<?php
session_start();

//check if user is not logged in
if (!isset($_SESSION["user"])) {
    header("location: login.php");
} //check if logged in as user
if ($_SESSION["user"]["role"] == "user") {
    header("location: index.php");
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
            <div class="col-12">
                <div class="container">
                    <h6>All Recipes</h6>
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
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Title</th>
                                <th scope="col">Ingredient</th>
                                <th scope="col">Cook Time</th>
                                <th scope="col">Direction</th>
                                <th scope="col">Yield</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM recipes";
                            $query = mysqli_query($connection, $sql);
                            $counter = 1;
                            while ($result = mysqli_fetch_assoc($query)) {
                            ?>
                                <tr class="table-active">
                                    <td scope="row"><?php echo $counter; ?></td>
                                    <td scope="row">
                                        <img height="50" src=<?php echo $result["image"]; ?> alt="">
                                    </td>
                                    <td><?php echo $result["title"]; ?></td>
                                    <td><?php echo $result["ingredient"]; ?></td>
                                    <td><?php echo $result["cook_time"]; ?></td>
                                    <td><?php echo $result["direction"]; ?></td>
                                    <td><?php echo $result["yield"]; ?></td>
                                    <td><?php
                                        if ($result["status"]) {
                                        ?>
                                            Approved
                                        <?php
                                        } else {
                                        ?>
                                            Not Approved

                                        <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                    <?php
                                      if (!$result["status"]) {
                                        ?>
                                            <a href="?approve_recipe=<?php echo $result["id"] ?>">Approve</a>
                                            <?php
                                        } 
                                     ?>
                                        <a href="edit-recipe.php? edit_recipe_id=<?php echo $result["id"] ?>">Edit</a>
                                        
                                        <a href="?delete_recipe=<?php echo $result["id"]; ?>">
                                            Delete</a>
                                           
                                    </td>
                                </tr>
                            <?php
                                $counter++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <label for="">Title</label>
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" placeholder="Enter title" id="" required>
                        </div>
                        <div class="my-3">
                            <button type="submit" class="btn btn-primary" name="category">Submit</button>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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