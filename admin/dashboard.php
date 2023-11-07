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
                                <h5 class="nav-link active text-dark" aria-current="page" href="#">
                                    <span data-feather="home" class="align-text-bottom"></span>
                                    Admin Dashboard
                                </h5>
                            </li>
                        </ul>
                <div class="col">
                    <ul class="list-group">
                        <div>    
                        <li  class="list-group-item">
                            <a href="food.php" class="btn text-danger">
                                <i class="fas fa-boxes" style="color:#E57C23;"></i> All Foods</a>
                        </li  class="list-group-item">
                        <li  class="list-group-item">
                            <a href="bookings.php" class="btn text-danger">
                                <i class="fas fa-boxes" style="color:#E57C23;"></i> Bookings</a>
                        </li  class="list-group-item">
                        <li  class="list-group-item">
                        <a href="javascript:;" class="btn border btn-sm text-white" style="background-color:#E57C23;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fas fa-plus" ></i> New Cafeteria</a>
                        </li  class="list-group-item">
                        </div>
                    </ul>
                </div>
                        
                    </div>
            </div>
            <div class="col-9">
                <div class="container">
                    <h6 class="text-center">Add New Food</h6>
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
                            <div class="col">
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
                            
                        </div>
                        <div class="form-group">
                            <label for="">Dietary preferences</label>
                           
                            <select class="form-select" id="dietary_tags" name="dietary_tags[]" multiple>
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
                            <button type="submit" name="add_food" style="background-color:#E57C23;" class="btn btn-mc text-white my-2">
                                Add Food</button>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New Cafeteria</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="" method="post">
              <label for="">Name</label>
              <div class="form-group">
                  <input type="text" class="form-control" name="name" placeholder="Enter cafeteria name" id="" required>
              </div>
              <label for="">Location</label>
              <div class="form-group">
                  <input type="text" class="form-control" name="location" placeholder="Enter cafeteria location" id="" required>
              </div>
              <label for="">Contact Phone</label>
              <input type="text" class="form-control" name="contact_phone" placeholder="Enter contact" id="" required>
              <div class="my-3">
                  <button type="submit" class="btn" style="background-color:#E57C23;" name="add_cafeteria"><i class="fas fa-plus text-light"></i></button>
              </div>
          </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn text-white" style="background-color: #E57C23"  data-bs-dismiss="modal">Close</button>
      </div>
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