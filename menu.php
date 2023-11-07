<?php
session_start();
require "inc/connection.php";
//check if user is not logged in
if (!isset($_SESSION["username"])) {
    header("location: login.php");
} 

// Retrieve user's dietary preferences from the session
$dietary_preferences = isset($_SESSION['dietary_preferences']) ? $_SESSION['dietary_preferences'] : '';

// Split the dietary preferences into an array
$userDietaryPreferences = explode(',', $dietary_preferences);

// Initialize an array to store SQL conditions
$conditions = [];

// Build SQL conditions for each dietary preference
foreach ($userDietaryPreferences as $preference) {
    $conditions[] = "FIND_IN_SET('$preference', dietary_tags)";
}

// Combine the conditions using OR
$conditionString = implode(' OR ', $conditions);

// Query to retrieve menu items based on dietary preferences
$sql = "SELECT * FROM menu_items WHERE $conditionString";

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
        <h2 class="mb-4">Your Dietary Preferences:</h2>
        <p class="mb-4"><?php echo $_SESSION["dietary_preferences"] ?></p>
        <h2 class="mb-4">Menu Items</h2>
        <div class="row">
        <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="col-lg-4 mb-4">';
                    echo '<div class="card">';
                    echo '<img src="admin/' . $row['image_url'] . '" class="card-img-top" alt="' . $row['dish_name'] . '">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title">' . $row['dish_name'] . '</h5>';
                    echo '<p class="card-text">' . $row['ingredients'] . '</p>';
                    echo '<p class="card-text"> Calories: ' . $row['calories']. ', Carbohydrates: ' . $row['carbohydrates']. ', Protein: '.$row['protein']. ', Fats: '.$row['fats'].'</p>';
                    echo '<p class="card-text">Dietary: ' . $row['dietary_tags'] . '</p>';

                    // Add a "Book Now" button with a link to a booking page
                    echo '<a href="booking.php?menu_item_id=' . $row['menu_item_id'] . '" class="btn btn-primary">Book Now</a>';

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