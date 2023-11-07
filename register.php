<?php
//header links
require "inc/header.php"; ?>

<div class="container">

    <?php
    //header content
    require './pages/header-home.php';
    include 'inc/process.php'; ?>

    <div class="d-flex aligns-items-center justify-content-center py-3">
        <form action="" method="post">

            <div class="form-group">
                <h4 class="text-center">Create Account</h4>
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
            </div>

            
            <form action="register.php" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" placeholder="Enter username" class="form-control" id="username" name="username" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" placeholder="Enter email" class="form-control" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" placeholder="Enter password" class="form-control" id="password" name="password" required>
            </div>

            <div class="form-group">
            <label for="dietary_preferences">Dietary Preferences:</label>
            <select class="form-control" id="dietary_preferences" name="dietary_preferences[]" multiple>
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

            <button type="submit" name="register" class="btn text-white my-3" style="background-color:#E57C23;">  <i class="fas fa-sign-in-alt"></i> Register</button>
            <p>If already registered <a href="login.php">Login</a></p>
        </form>
           

        </form>

    </div>



    <?php
    //footer content
    require './pages/footer-home.php'; ?>

</div>


<?php
//footer script
require "inc/footer.php";  ?>