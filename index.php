<?php
session_start();
require "inc/process.php";
require "inc/header.php";
?>

<div class="container">
    <?php require './pages/header-home.php'; ?>

    <div class="container-fluid my-3">
        <div class="row">
            <div id="image-slider" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#image-slider" data-slide-to="0" class="active"></li>
                    <li data-target="#image-slider" data-slide-to="1"></li>
                    <li data-target="#image-slider" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="./images/dietary.jpg" alt="Healthy Food 1">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="./images/dietary.jpg" alt="Healthy Food 2">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="./images/Plateshare.PNG" alt="Healthy Food 3">
                    </div>
                </div>
                <a class="carousel-control-prev" href="#image-slider" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#image-slider" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <div class="px-4 py-1 my-5 text-center">
                <div class="col-lg-6 mx-auto">
                    <h3 style="color:#E57C23">🍽️ Rule-Based Booking System for Healthy Food</h3>
                    <p class="lead mb-4">Welcome to Rule-Based Booking System for Healthy Food. Our mission is to promote wellness and healthy eating habits. We believe that food has the incredible power to bring people together, ignite creativity, and nourish both body and soul.</p>

                    <h3 style="color:#E57C23">✨ Explore a World of Flavors ✨</h3>
                    <p class="lead mb-4">Discover a wide range of delicious and nutritious recipes that cater to a variety of dietary preferences. Dive into our extensive recipe collection, where you'll find an array of culinary treasures from every corner of the globe. From mouthwatering main courses to decadent desserts, our recipes are carefully curated to suit all tastes and skill levels.</p>

        
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid my-3">
    </div>
    <?php require './pages/footer-home.php'; ?>
</div>

<script>
    $(document).ready(function () {
        // Auto start the carousel
        $('#image-slider').carousel();
    });
</script>

<?php
require "inc/footer.php";
?>
