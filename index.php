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
          <h3 style="color:#E57C23"> 🍽️ Rule Based Booking System for Healthy food</h3>
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
       
      </div>

    </div>
  </div>
 
  <div class="container-fluid my-3">
   
  </div>
  <?php require './pages/footer-home.php'; ?>
</div>

<?php
require "inc/footer.php";
?>