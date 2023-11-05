<?php
session_start();
require "inc/connection.php";
//check if user is not logged in
if (!isset($_SESSION["username"])) {
    header("location: login.php");
} 

$dietary_preferences = isset($_SESSION['dietary_preferences']) ? $_SESSION['dietary_preferences'] : '';

// Query to retrieve menu items based on dietary preferences
$sql = "SELECT * FROM menu_items WHERE dietary_tags LIKE '%$dietary_preferences%'";
$result = $connection->query($sql);

// Close the database connection
$connection->close();



//header links
require "inc/header.php"; ?>

<div class="container">

    <?php
    //header content
    require './pages/header-home.php';
    include 'inc/process.php'; ?>

   
     <div class="container mt-5">
        <h2 class="mb-4">Menu Items</h2>
        <div class="row">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                 
                    echo '<div class="col-lg-4 mb-4">';
                    echo '<div class="card">';
                    echo '<img src="' . $row['image_url'] . '" class="card-img-top" alt="' . $row['dish_name'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['dish_name'] . '</h5>';
                    echo '<p class="card-text">' . $row['ingredients'] . '</p>';
                    echo '<p class="card-text">Dietary: ' . $row['dietary_tags'] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p>No menu items found based on your dietary preferences.</p>';
            }
            ?>
        </div>
    </div>



    <?php
    //footer content
    require './pages/footer-home.php'; ?>

</div>


<?php
//footer script
require "inc/footer.php";  ?>