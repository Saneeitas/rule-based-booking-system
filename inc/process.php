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
        // Check if dietary preferences is an array before using implode
        if (is_array($_POST['dietary_preferences'])) {
            $dietary_preferences = implode(',', $_POST['dietary_preferences']);
        }

        // Prepare and execute the SQL query to insert user data
        $sql = "INSERT INTO users (username, email, password, dietary_preferences)
                VALUES (?, ?, ?, ?)";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssss", $username, $email, $password, $dietary_preferences);
         
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


if (isset($_POST["booking"])) {
   
        $user_id = $_SESSION["user_id"];
        $menu_item_id = $_SESSION["menu_item_id"];
        $booking_date = $_POST["booking_date"];
        $booking_time = $_POST["booking_time"];
        //sql
        $sql = "INSERT INTO bookings(user_id,menu_item_id,booking_time,booking_date) VALUES
                ('$user_id','$menu_item_id','$booking_time','$booking_date')";
        $query = mysqli_query($connection, $sql);
        if ($query) {
            //success message
            $success = "Booking Succeefully";
        } else {
            $error = "Booking not successfully";
        }
   
}

if (isset($_GET["delete_booking"]) && !empty($_GET["delete_booking"])) {
    $id = $_GET["delete_booking"];
    //sql
    $sql = "DELETE FROM bookings WHERE booking_id = '$id'";
    $query = mysqli_query($connection, $sql);
    //check if
    if ($query) {
        $success = "Booking deleted successfully";
    } else {
        $error = "Unable to delete booking";
    }
}



