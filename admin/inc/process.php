<?php

require "connection.php";

if (isset($_POST["register"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $encrypt_password = md5($password);

    //check if user exist
    $sql_check = "SELECT * FROM admin WHERE username = '$username'";
    $query_check = mysqli_query($connection,$sql_check);
    if(mysqli_fetch_assoc($query_check)){
        //user exists
        $error = "User already exist";
    }else{
         //insert into DB
        $sql = "INSERT INTO admin(username,password) 
               VALUES('$username','$encrypt_password')";
        $query = mysqli_query($connection,$sql) or die("Cant save data");
        $success = "Registration successfully";
    }  
    $connection->close();
}


if (isset($_POST["login"])) {

    $username = $_POST["username"];
    $password = $_POST["password"];
    $encrypt_password = md5($password);

    //check if user exist
    $sql_check2 = "SELECT * FROM admin WHERE username = '$username'";
    $query_check2 = mysqli_query($connection,$sql_check2);
    if(mysqli_fetch_assoc($query_check2)){
       //check if username and password exist
       $sql_check = "SELECT * FROM admin WHERE username = '$username' AND password = '$encrypt_password'";
       $query_check = mysqli_query($connection,$sql_check);
       if($result = mysqli_fetch_assoc($query_check)){
       //Login to dashboard
       $_SESSION["user"] = $result;
       if($result["role"] == "admin"){
        header("location: dashboard.php");
       }else{
        header("location: index.php");
       } 
       $success = "User logged in";       
     }else{ 
    //user password wrong
    $error = "User password wrong";
}  
       }else{
        //user not found
        $error = "User username not found";
  } 
    $connection->close();
}


if (isset($_POST["add_food"])) {
    // Uploading to the upload folder
    $target_dir = "uploads/";
    $basename = basename($_FILES["thumbnail"]["name"]);
    $upload_file = $target_dir . $basename;

    // Move uploaded file
    $move = move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $upload_file);

    if ($move) {
        $url = $upload_file;
        $cafeteria_id = $_POST["cafeteria_id"];
        $dish_name = $_POST["name"];
        $ingredients = $_POST["ingredients"];
        $portion_size = $_POST["portion_size"];
        $calories = $_POST["calories"];
        $carbohydrates = $_POST["carbohydrates"];
        $protein = $_POST["protein"];
        $dietary_tags = implode(",", $_POST["dietary_tags"]);
        $fats = $_POST["fats"];
        $image = $url;

        // Create a prepared statement
        $stmt = $connection->prepare("INSERT INTO menu_items (cafeteria_id, dish_name, ingredients, portion_size, calories, carbohydrates, protein, fats, dietary_tags, image_url) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        
        // Bind parameters
        $stmt->bind_param("isssssssss", $cafeteria_id, $dish_name, $ingredients, $portion_size, $calories, $carbohydrates, $protein, $fats, $dietary_tags, $image);

        if ($stmt->execute()) {
            // Success message
            $success = "Added Successfully";
        } else {
            $error = "Unable to add new food";
        }
    } else {
        $error = "Unable to upload image";
    }
}


if (isset($_POST["update_food"])) {
    $id = $_GET["edit_food_id"];
    
    // Check if a new image file is provided
    if ($_FILES["thumbnail"]["name"] != "") {
        // Upload the new image
        $target_dir = "uploads/";
        $url = $target_dir . basename($_FILES["thumbnail"]["name"]);
        
        if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $url)) {
            // If the image is uploaded successfully, update the database with the new image.
            $image = $url;
        } else {
            $error = "Unable to update food";
        }
    }
    
    // Parameters
    $name = $_POST["name"];
    $ingredients = $_POST["ingredients"];
    $cafeteria_id = $_POST["cafeteria_id"];
    $portion_size = $_POST["portion_size"];
    $calories = $_POST["calories"];
    $carbohydrates = $_POST["carbohydrates"];
    $protein = $_POST["protein"];
    $fats = $_POST["fats"];
    
    // Check if dietary_tags is set and not empty, then implode it; otherwise, set it to an empty string
    $dietary_tags = !empty($_POST["dietary_tags"]) ? implode(",", $_POST["dietary_tags"]) : "";
    
    // SQL query
    $sql = "UPDATE menu_items 
            SET dish_name = '$name',
                ingredients = '$ingredients',
                cafeteria_id = '$cafeteria_id',
                portion_size = '$portion_size',
                calories = '$calories',
                carbohydrates = '$carbohydrates',
                protein = '$protein',
                fats = '$fats'";
    
    // If dietary_tags is not empty, update the dietary_tags column
    if (!empty($dietary_tags)) {
        $sql .= ", dietary_tags = '$dietary_tags'";
    }
    
    // If a new image is provided, update the image field
    if (isset($image)) {
        $sql .= ", image_url = '$image'";
    }
    
    $sql .= " WHERE menu_item_id = '$id'";
    
    // Execute the SQL query
    $query = mysqli_query($connection, $sql);
    
    // Check if the query was successful
    if ($query) {
        $success = "Food updated";
    } else {
        $error = "Unable to update food";
    }
}




// if (isset($_POST["update_food"])) {
//     $id = $_GET["edit_food_id"];
//     if ($_FILES["thumbnail"]["name"] != "") {
//         //upload image
//         $target_dir = "uploads/";
//         $url = $target_dir . basename($_FILES["thumbnail"]["name"]);
//         //move uploaded file
//         if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $url)) {
//             //update to database
//             //parameters 
//             $title = $_POST["title"];
//             $ingredient = $_POST["ingredient"];
//             $calories = $_POST["cook_time"];
//             $direction = $_POST["direction"];
//             $yield = $_POST["yield"];
//             $category_id = $_POST["category_id"];
//             $image = $url;
//             //sql
//             $sql = "UPDATE recipes SET title ='$title', ingredient='$ingredient', 
//                     cook_time='$cook_time',direction='$direction',yield='$yield', 
//                     category_id='$category_id', image='$image' WHERE id='$id' ";
//             $query = mysqli_query($connection, $sql);
//             //check if
//             if ($query) {
//                 $success = "Recipe updated";
//             } else {
//                 $error = "Unable to update recipe";
//             }
//         }
//     } else {
//         //leave the upload image and
//         //update to database
//         //parameters 
//         $title = $_POST["title"];
//         $ingredient = $_POST["ingredient"];
//         $cook_time = $_POST["cook_time"];
//         $direction = $_POST["direction"];
//         $yield = $_POST["yield"];
//         $category_id = $_POST["category_id"];
//         //sql
//         $sql = "UPDATE recipes SET title ='$title', ingredient='$ingredient', 
//             cook_time='$cook_time',direction='$direction',yield='$yield', 
//             category_id='$category_id' WHERE id='$id' ";
//         $query = mysqli_query($connection, $sql);
//         //check if
//         if ($query) {
//             $success = "recipe updated";
//         } else {
//             $error = "Unable to update recipe";
//         }
//     }
// }

if (isset($_GET["delete_food"]) && !empty($_GET["delete_food"])) {
    $id = $_GET["delete_food"];
    //sql
    $sql = "DELETE FROM menu_items WHERE menu_item_id = '$id'";
    $query = mysqli_query($connection, $sql);
    //check if
    if ($query) {
        $success = "food deleted successfully";
    } else {
        $error = "Unable to delete food";
    }
}


if (isset($_GET["approve_booking"]) && !empty($_GET["approve_booking"])) {
    $booking_id = $_GET["approve_booking"];
    //sql query
    $sql = "UPDATE bookings SET status = 1 WHERE booking_id = '$booking_id'";
    $query = mysqli_query($connection, $sql);
    //check if
    if ($query) {
        $success = "Booking approved";
    } else {
        $error = "Unable to approved Recipe";
    }
}

