<?php  
session_start();

//check if user is not logged in
if(!isset($_SESSION["user"])){
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
        
         <div class="col-2">
    <ul class="list-group">
        <div> 
        <li class="list-group-item" style="color:#E57C23;">
            <a href="dashboard.php" class="btn">
            <i class="fas fa-backward" style="color:#E57C23;"></i> 
              Back </a>
        </li>    
        
        </div>
    </ul>
</div>
         <div class="col-12">
             <div class="container">
                <?php 
                    if(isset($error)) {
                    ?>
                    <div class="alert alert-danger">
                        <strong><?php echo $error ?></strong>
                    </div>
                    <?php
                         }elseif (isset($success)) {
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
                         <th scope="col">Cafeteria</th>
                        <th scope="col">Dish name</th>
                        <th scope="col">Ingredient</th>
                        <th scope="col">Dietary</th>
                        <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT * FROM menu_items";
                        $query = mysqli_query($connection,$sql);
                        $counter =1;
                        while($result = mysqli_fetch_assoc($query)){
                            ?>
                            <tr class="table-active">
                              <td scope="row"><?php echo $counter; ?></td>
                              <td scope="row">
                                  <img height="50" src=<?php echo $result["image_url"]; ?> alt=""
                                  style="width:50px; height:50px; object-fit:cover; object-position:center;">
                              </td>
                              <?php 
                                     $id = $result["cafeteria_id"];
                                     $sql2 = "SELECT * FROM cafeterias WHERE cafeteria_id='$id'";
                                     $query2 = mysqli_query($connection, $sql2);
                                     
                                     if ($query2) {
                                         $result2 = mysqli_fetch_assoc($query2);
                                         if ($result2) {
                                             echo "<td>" . $result2["name"] . "</td>";
                                         } else {
                                             echo "<td>No data found</td>";
                                         }
                                     } else {
                                         echo "<td>Query execution failed: " . mysqli_error($connection) . "</td>";
                                     }
                                  ?>
                                <td><?php echo $result["dish_name"]; ?></td>
                                <td><?php echo $result["ingredients"]; ?></td>
                                <td><?php echo $result["dietary_tags"]; ?></td>
                                <td>
                                  <a href="edit-food.php? edit_food_id=<?php echo $result["menu_item_id"] ?>">
                                  <i class="fas fa-edit"></i></a>
                                   |
                                  <a href="?delete_food=<?php echo $result["menu_item_id"]; ?>">
                                  <i class="fas fa-trash-alt text-danger"></i></a>
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




<?php  
//footer content
require './pages/footer-home.php'; ?>

 </div>


 <?php
 //footer script
  require "inc/footer.php";  ?>