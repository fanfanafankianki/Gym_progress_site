<?php
session_start();
require('php_functions/db.php');
require('php_functions/selectUserTrainingInfo.php');
require('php_functions/addUser.php');
?>

<!DOCTYPE html>
<html>
<head>
<title>Gym progress site</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/styles.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
.css-sidebar a {font-family: "Montserrat", sans-serif}
body,h1,h2,h3,h4,h5,h6,.css-wide {font-family: "Roboto", sans-serif;}
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="js_functions/js_functions.js"></script>
</head>

<body class="css-content css-bodycolor" style="max-width:1200px">

<!-- Sidebar/menu -->
<nav class="sidebar css-bar-block css-bodycolor css-collapse css-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="css-container css-display-container css-padding-16">
    <i onclick="sidebar_close()" class="fa fa-remove css-hide-large css-button css-display-topright"></i>
    <h3 onclick="reloadSite()" class="css-wide css-button"><b>Gym Site</b></h3>
  </div>
  <div id='target' class="css-padding-64 css-large css-text-grey" style="font-weight:bold">
    <a onclick="loadBMICalculator()" href="javascript:void(0)" class="css-button css-block2 css-left-align" id="object_one">
        BMI Calculator
    </a>
    <a onclick="loadCaloriesCalculator()" href="javascript:void(0)" class="css-button css-block2 css-left-align" id="object_one">
        Calories Calculator
    </a>
    <a onclick="loadFFMICalculator()" href="javascript:void(0)" class="css-button css-block2 css-left-align" id="object_one">
        FFMI Calculator
    </a>
</nav>

<!-- Top menu on small screens -->
<header class="css-bar css-top css-hide-large css-black css-xlarge">
  <div onclick="reloadSite()" class="css-bar-item css-padding-24 css-wide css-black">Gym Site</div>
  <a href="javascript:void(0)" id="open" class="css-bar-item css-button css-padding-24 css-right" onclick="sidebar_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="css-overlay css-hide-large" onclick="sidebar_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="css-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="css-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
  <header class="css-container css-xlarge css-headercolor">

    <p class="css-right">
    <div style="display: flex; justify-content: space-between; line-height: 25px; padding: 5px; align-items: center;">

      <?php if (isset($error)) { ?>
        <p><?php echo $error; ?></p>
      <?php } ?>
      <?php if (empty($_SESSION['profile_id'])) : ?>
        <div style="float: left; text-align: left;  align-items: center;">
        Log in and track your progress!
        </div>
        <div style="float: right; text-align: right; align-items: center; line-height: 25px;">
          <form action="php_functions/login.php" method="post" class="css-right">
            <label for="text" style="width: 100px; height: 20px; font-size: 15px; padding: 5px;">Username:</label>
            <input type="text" name="login" style="width: 100px; height: 20px; font-size: 15px; padding: 5px;"/> 
            <label for="password" style="width: 100px; height: 20px; font-size: 15px; padding: 5px;">Password:</label>
            <input type="password" name="password" style="width: 100px; height: 20px; font-size: 15px; padding: 5px;"/>
            <button type="submit" style="width: 100px; height: 35px; font-size: 15px; padding: 5px;">Log in</button>
          </form>
          <script>document.addEventListener('DOMContentLoaded', function() {createRegisterElement();});</script>
        </div>
      <?php else : ?>
      <div style="float: right; text-align: right; align-items: center; line-height: 25px;">
      <p>Hi, <?=$_SESSION['profile_id']?> <a href="php_functions/logout.php">logout</a> </p>
      <?php 
        $counter = 0;
        echo "<script>document.addEventListener('DOMContentLoaded', function() {createAddUserElement();});</script>";
        for($i = 0; $i < $_SESSION['profiles']; $i++){ 
            $counter++;
      ?>
      <?php if (isset($_SESSION['profile_id_0']))
        echo select_user_training_info($_SESSION['profile_id_'.$i]);
        } 
      ?>        
      <?php endif; ?>

      </p>
    </div>

  </header>

  <div class="parent">
    <p></p>
    <div id="empty_place_for_divs" class="css-mainframecolor" style="text-align: center; align-items: center; min-height: 430px;">
      <div id="welcome_site" style="font-weight: bold; font-size: 17px; letter-spacing:3px;">
        <br><br>
        Welcome to Gym Site! <br><br>
        Here you can configure your training routine, track your trainings and your progress! <br><br>
        Add your everyday trainings and your exercise routine.<br><br>
        You can also use BMI, FFMI and Calorie calculator!<br><br>
        Register now and start tracking your progress.<br><br><br>
          <div id="welcome_site2" style="font-weight: bold; font-size: 17px; letter-spacing:3px; line-height: 35px;">
          </div>
      </div>
    </div>
    <p></p>
  </div> 

  <div id="klasa_on2" class="klasa_on2">
    <form method="post">
      <br><br>Add new profile: <br><br>
      <input type="text" name="text" class="css-input css-border" placeholder="Profile name"><br>
      <input type="submit" name="add_profile" class="css-button css-block css-black" value="Add profile">
    </form>
  </div>

  <!-- Footer -->
  <footer class="css-padding-16 css-footercolor css-small css-center" id="footer">
    <div class="css-row-padding" style="align-items: center; margin: 0 auto; display: flex;">
      <div class="css-col s4">
        <h4>Contact</h4>
        <p>Do you have a question? Ask it here!</p>
        <form action="/action_page.php" target="_blank">
          <p><input class="css-input css-border" type="text" placeholder="Name" name="Name" required></p>
          <p><input class="css-input css-border" type="text" placeholder="Email" name="Email" required></p>
          <p><input class="css-input css-border" type="text" placeholder="Subject" name="Subject" required></p>
          <p><input class="css-input css-border" type="text" placeholder="Message" name="Message" required></p>
          <button onclick="reloadSite()" type="submit" class="css-button css-block css-black">Wyślij</button>
        </form>
      </div>
    </div>
  </footer>

  <div class="css-black css-center css-padding-24">Powered by <a href="https://github.com/fanfanafankianki" title="fanfanafankianki" target="_blank" class="css-hover-opacity">fanfanafankianki</a></div>

</div>
<script> 
document.getElementById("myOverlay").click();
document.getElementById("open").click();
</script>
</body>
</html>