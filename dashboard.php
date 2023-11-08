<?php
session_start();

//check if user is not logged in
if (!isset($_SESSION["username"])) {
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
            <div class="col">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="position-sticky pt-3 sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link" href="menu.php" style="color:#E57C23;">
                                    <span data-feather="file" class="align-text-bottom"></span>
                                    <i class="fas fa-backward"></i>  Back
                                </a>
                            </li>
                            </li>
                        </ul>
                    </div>

            </div>

            <div class="col">
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
                <h3>My Bookings</h3>
        
            </div>

            <table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Image</th>
            <th scope="col">Name</th>
            <th scope="col">Time</th>
            <th scope="col">Date</th>
            <th scope="col">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $id = $_SESSION["user_id"];
        $sql = "SELECT * FROM bookings WHERE user_id='$id' ";
        $query = mysqli_query($connection, $sql);
        $counter = 1;

        if (mysqli_num_rows($query) == 0) {
            echo '<tr><td colspan="6">No bookings available</td></tr>';
        } else {
            while ($result = mysqli_fetch_assoc($query)) {
                ?>
                <tr class="table-active">
                    <td scope="row"><?php echo $counter; ?></td>
                    <?php
                    $id = $result["menu_item_id"];
                    $sql2 = "SELECT * FROM menu_items WHERE menu_item_id='$id'";
                    $query2 = mysqli_query($connection, $sql2);

                    if ($query2) {
                        $result2 = mysqli_fetch_assoc($query2);
                        if ($result2) {
                            echo "<td>" . $result2["dish_name"] . "</td>";
                            ?>
                            <td scope="row">
                                <img height="50" src="admin/<?php echo $result2["image_url"]; ?>" alt=""
                                     style="width:50px; height:50px; object-fit:cover; object-position:center;">
                            </td>
                            <td><?php echo date("h:i a", strtotime($result["booking_time"])); ?></td>
                            <td><?php echo date("Y-m-d", strtotime($result["booking_date"])); ?></td>
                            <td><?php echo $result["status"] == 0 ? "Not Accepted" : "Booking Accepted"; ?></td>
                            <td>
                                <a href="?delete_booking=<?php echo $result["booking_id"]; ?>">
                                    <i class="fas fa-trash-alt text-danger"></i>
                                </a>
                            </td>
                            <?php
                        } else {
                            echo "<td>No data found</td>";
                        }
                    } else {
                        echo "<td>Query execution failed: " . mysqli_error($connection) . "</td>";
                    }
                    ?>
                </tr>
                <?php
                $counter++;
            }
        }
        ?>
    </tbody>
</table>

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