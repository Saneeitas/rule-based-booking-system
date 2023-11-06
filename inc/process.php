<?php

require "connection.php";

if (isset($_POST["register"])) {

    $dietary_preferences = '';

     // Collect user registration data
     $username = $_POST['username'];
     $email = $_POST['email'];
 
     // Check if the user with the same email already exists
     $checkQuery = "SELECT user_id FROM users WHERE email = ?";
     $checkStmt = $connection->prepare($checkQuery);
     $checkStmt->bind_param("s", $email);
     $checkStmt->execute();
     $checkResult = $checkStmt->get_result();
 
     if ($checkResult->num_rows > 0) {
        $error = "User with this email already exist Try again";
     } else {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $role = $_POST['role'];

        // Check if dietary preferences is an array before using implode
        if (is_array($_POST['dietary_preferences'])) {
            $dietary_preferences = implode(',', $_POST['dietary_preferences']);
        }

        // Prepare and execute the SQL query to insert user data
        $sql = "INSERT INTO users (username, email, password, role, dietary_preferences)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("sssss", $username, $email, $password, $role, $dietary_preferences);
         
         if ($stmt->execute()) {
            $success = "User registration successfully";
         } else {
            $error = "Error: " . $sql . "<br>" . $connection->error;
         }
     }
 
     // Close the database connection
     $connection->close();
}


if (isset($_POST["login"])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the SQL query to retrieve user data by username
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            // Login successful, store user data in the session
            $_SESSION['user_id'] = $user['user_id'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['email'];

            $_SESSION['dietary_preferences'] = $user['dietary_preferences'];
            $_SESSION['dietary_restrictions'] = $user['dietary_restrictions'];

            header("location: menu.php");
                        //exit();

                        $success = "User logged in";
        } else {
            $error = "Incorrect password, Try again";
        }
    } else {
        $error = "User not found, Try again";
    }

    // Close the database connection
    $connection->close();
}


if (isset($_POST["new_recipe"])) {
    //uploading to upload folder
    $target_dir = "uploads/";
    $basename = basename($_FILES["thumbnail"]["name"]);
    $upload_file = $target_dir . $basename;
    //move uploaded file
    $move = move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $upload_file);
    if ($move) {
        $url = $upload_file;
        $title = $_POST["title"];
        $ingredient = $_POST["ingredient"];
        $cook_time = $_POST["cook_time"];
        $direction = $_POST["direction"];
        $yield = $_POST["yield"];
        $category_id = $_POST["category_id"];
        $image = $url;
        //sql
        $sql = "INSERT INTO recipes(title,ingredient,direction,cook_time,yield,category_id,image) VALUES
                ('$title','$ingredient','$direction','$cook_time','$yield','$category_id','$image')";
        $query = mysqli_query($connection, $sql);
        if ($query) {
            //success message
            $success = "New Recipe added";
        } else {
            $error = "Unable to add new recipe";
        }
    } else {
        $error = "Unable to upload image";
    }
}

if (isset($_POST["update_recipe"])) {
    $id = $_GET["edit_recipe_id"];
    if ($_FILES["thumbnail"]["name"] != "") {
        //upload image
        $target_dir = "uploads/";
        $url = $target_dir . basename($_FILES["thumbnail"]["name"]);
        //move uploaded file
        if (move_uploaded_file($_FILES["thumbnail"]["tmp_name"], $url)) {
            //update to database
            //parameters 
            $title = $_POST["title"];
            $ingredient = $_POST["ingredient"];
            $cook_time = $_POST["cook_time"];
            $direction = $_POST["direction"];
            $yield = $_POST["yield"];
            $category_id = $_POST["category_id"];
            $image = $url;
            //sql
            $sql = "UPDATE recipes SET title ='$title', ingredient='$ingredient', 
                    cook_time='$cook_time',direction='$direction',yield='$yield', 
                    category_id='$category_id', image='$image' WHERE id='$id' ";
            $query = mysqli_query($connection, $sql);
            //check if
            if ($query) {
                $success = "Recipe updated";
            } else {
                $error = "Unable to update recipe";
            }
        }
    } else {
        //leave the upload image and
        //update to database
        //parameters 
        $title = $_POST["title"];
        $ingredient = $_POST["ingredient"];
        $cook_time = $_POST["cook_time"];
        $direction = $_POST["direction"];
        $yield = $_POST["yield"];
        $category_id = $_POST["category_id"];
        //sql
        $sql = "UPDATE recipes SET title ='$title', ingredient='$ingredient', 
            cook_time='$cook_time',direction='$direction',yield='$yield', 
            category_id='$category_id' WHERE id='$id' ";
        $query = mysqli_query($connection, $sql);
        //check if
        if ($query) {
            $success = "recipe updated";
        } else {
            $error = "Unable to update recipe";
        }
    }
}

if (isset($_GET["delete_recipe"]) && !empty($_GET["delete_recipe"])) {
    $id = $_GET["delete_recipe"];
    //sql
    $sql = "DELETE FROM recipes WHERE id = '$id'";
    $query = mysqli_query($connection, $sql);
    //check if
    if ($query) {
        $success = "recipe deleted successfully";
    } else {
        $error = "Unable to delete recipe";
    }
}


if (isset($_POST["comment_new"])) {
    $comment = $_POST["comment"];
    $user_id = $_SESSION["user"]["id"];
    $recipe_id = $_GET["recipe_id"];

    if (empty($_POST["comment"])) {
        $error = "Your comment is required!";
    } else {

        //sql & query
        $sql = "INSERT INTO comments(user_id,message,recipe_id) VALUES('$user_id','$comment','$recipe_id')";
        $query = mysqli_query($connection, $sql);
        //check if
        if ($query) {
            $success = "Comment added";
        } else {
            $error = "Unable to add comment";
        }
    }
}

if (isset($_GET["approve_recipe"]) && !empty($_GET["approve_recipe"])) {
    $recipe_id = $_GET["approve_recipe"];
    //sql query
    $sql = "UPDATE recipes SET status = 1 WHERE id = '$recipe_id'";
    $query = mysqli_query($connection, $sql);
    //check if
    if ($query) {
        $success = "Recipe approved";
    } else {
        $error = "Unable to approved Recipe";
    }
}

