<?php

session_start();

require "inc/process.php";
require "inc/header.php";
// require "body.php"; 

?>
<div class="container">
  <?php require './pages/header-home.php'; ?>
  <div class="container-fluid my-3">
    <div class="row">
      <img class="d-block mx-auto mb-4" src="./images/plateshare.png" alt="" width="1050" height="450" style="border-radius: 30px;">

      <div class="px-4 py-1 my-5 text-center">
        <!-- <img class="d-block mx-auto mb-4" src="./images/plateshare.png" alt="" width="1050" height="450"> -->
        <div class="col-lg-6 mx-auto">
          <h3 style="color:#E57C23"> 🍽️ PlateShare! Discover Delicious Recipes</h3>
          <p class="lead mb-4">At PlateShare, we believe that food has the incredible power to bring people together,
            ignite creativity, and nourish both body and soul. Our platform is dedicated
            to celebrating the joy of cooking and the art of sharing recipes.</p>

          <h3 style="color:#E57C23">✨ Explore a World of Flavors ✨</h3>
          <p class="lead mb-4">Dive into our extensive recipe collection,
            where you'll find an array of culinary treasures from every corner of the globe.
            From mouthwatering main courses to decadent desserts,
            our recipes are carefully curated to suit all tastes and skill levels..</p>

          <h3 style="color:#E57C23">👨‍🍳 Unleash Your Inner Chef 👩‍🍳</h3>
          <p class="lead mb-4">PlateShare isn't just a place to find recipes;
            it's a platform that empowers you to become a culinary maestro in your own kitchen.
            With our user-friendly recipe creator, you can unleash your creativity and share your
            own masterpieces with the world</p>
        </div>
        <P>
          <hr>
        </p>
      </div>

    </div>
  </div>
  </hr>
  <div class="container-fluid my-3">
    <div class="row">
      <div class="col-8">
        <div class="row">
          <?php
          //displ+aying the recipes from database
          $sql = "SELECT * FROM recipes  WHERE status = 1 ORDER BY id DESC ";
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
      <div class="col-4">
        <!--Side bar--->
        <div class="border p-3">
          <form action="search.php" method="post">
            <div class="form-group">
              <h4 style="color:gray">Search</h4>
              <input type="text" class="form-control" name="search" placeholder="Enter Search term" id="" required>
            </div>
            <button type="submit" class="btn text-light mt-2" style="background-color:#E57C23;">Search</button>

          </form>
        </div>

        <div class="border p-3">
          <h4 style="color:gray">Categories</h4>
          <ul>
            <?php
            $sql_c = "SELECT * FROM category ORDER BY id DESC";
            $query_c = mysqli_query($connection, $sql_c);
            while ($result_c = mysqli_fetch_assoc($query_c)) {
            ?>
              <li style="color:#E57C23">
                <a style="color:#E57C23" href="recipe-category.php?recipe_category_id=<?php echo $result_c["id"]; ?>">
                  <?php echo $result_c["name"] ?></a>
              </li>
            <?php
            }
            ?>

          </ul>
        </div>
      </div>
    </div>
  </div>
  <?php require './pages/footer-home.php'; ?>
</div>

<?php
require "inc/footer.php";
?>