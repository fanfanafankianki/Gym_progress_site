<!-- All images on this site are generated from https://www.midjourney.com/ They use CC BY-NC 4.0 license. More information: https://creativecommons.org/licenses/by-nc/4.0/ -->

<?php
session_start();

require('php_functions/db.php');
require('php_functions/selectProfileTrainingInfo.php');
require('php_functions/insertUserProfile.php');
?>

<!DOCTYPE html>
<html>
<head>
<title>PowerTrckr</title>
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
<nav class="sidebar css-bar-block css-sidebarcolor css-collapse css-top " style="z-index:3;width:250px; text-align: center; align-items: center;" id="mySidebar">
  <div>
    <i onclick="sidebar_close()" class="fa fa-remove css-hide-large css-button css-display-topright"></i>
    <h4 onclick="reloadSite()" class="css-wide css-button"><b>
      <div style="width: 140; height: 130; border: 10px solid black;">
        <img id="logo" src="images/Gym_icon_rdy.png" alt="Gym icon" width="140" height="130">
      </div>
    </b></h4>
  </div>

  <div id='target' class="css-padding-16 css-large css-text-grey" style="font-weight:bold;">
    <?= $sidebar_target; ?>
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="css-bar css-top css-hide-large css-black css-xlarge">
  <div onclick="reloadSite()" class="css-bar-item css-padding-24 css-wide css-black">PowerTrckr</div>
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

      <?php if (isset($error_login)) {
         ?>
        <p><?php echo $error_login; ?></p>
      <?php } ?>
      <?php if (empty($_SESSION['profile_id'])) :?>
        <div style="float: left; text-align: left;  align-items: center;">
        Log in and track your progress!
        </div>
        <div style="float: right; text-align: right; align-items: center; line-height: 25px;">
          <form action="php_functions/login.php" method="post" class="css-right">
            <label for="text" style="width: 100px; height: 20px; font-size: 15px; padding: 5px;">Username:</label>
            <input id="login_login" type="text" name="login" style="width: 100px; height: 20px; font-size: 15px; padding: 5px;"/> 
            <label for="password" style="width: 100px; height: 20px; font-size: 15px; padding: 5px;">Password:</label>
            <input id="login_password" type="password" name="password" style="width: 100px; height: 20px; font-size: 15px; padding: 5px;"/>
            <button id="login_submit" type="submit" style="width: 100px; height: 35px; font-size: 15px; padding: 5px;">Log in</button>
          </form>
          <script> var error_registration = <?php echo json_encode($_SESSION['error_registration'] ?? ''); ?>; </script>
          <script>document.addEventListener('DOMContentLoaded', function() {createRegisterElement();});</script>
        <?php if (!empty($_SESSION['error_login'])) : ?><br><div id="login_error" style="font-size: 12px; color: #F08080;">
          <?php
          echo $_SESSION['error_login'];
          ?>...        
          </div>       
        <?php endif; ?>
        </div>
      <?php else : ?>
      <div style="float: right; text-align: right; align-items: center; line-height: 25px;">
      <p>Hi, <?=$_SESSION['profile_id']?> <a id=logout href="php_functions/logout.php">logout</a> </p>
      <?php 
        $counter = 0;
        echo "<script>document.addEventListener('DOMContentLoaded', function() {createAddUserElement();});</script>";
        for($i = 0; $i < $_SESSION['profiles']; $i++){ 
            $counter++;
      ?>
      <?php if (isset($_SESSION['profile_id_0']))
        echo select_profile_training_info($_SESSION['profile_id_'.$i]);
        } 
      ?>        
      <?php endif; ?>

      </p>
    </div>

  </header>

  <div class="parent" style="word-wrap: break-word; padding: 0 2px">
    <?= $main_target; ?>
  </div> 

  <!-- Footer -->
  <footer class="css-padding-16 css-footercolor css-small css-center" id="footer">
    <div class="css-row-padding" style="align-items: center; margin: 0 auto; display: flex;">
      <div class="css-col s4">
        <h4>Contact</h4>
        <p>Do you have a question? Ask it here!</p>
        
        <form action="php_functions/sendEmail.php" method="POST">
          <p><input class="css-input css-border" type="text" placeholder="Name" id="Name_footer" name="Name" required></p>
          <p><input class="css-input css-border" type="email" placeholder="Email" id="Email_footer" name="Email" required></p>
          <p><input class="css-input css-border" type="text" placeholder="Subject" id="Subject_footer" name="Subject" required></p>
          <p><textarea class="css-input css-border" placeholder="Message" id="Message_footer" name="Message" required></textarea></p>
          <button id="Submit_footer" type="submit" name="submitEmail" class="css-button css-block css-black">Wyślij</button>
        </form>

      </div>
    </div>
  </footer>

  <div class="css-black css-center css-padding-24">Powered by <a href="https://github.com/fanfanafankianki" id="github" title="fanfanafankianki" target="_blank" class="css-hover-opacity">fanfanafankianki</a></div>

</div>
<script> 
document.getElementById("myOverlay").click();
document.getElementById("open").click();
</script>
</body>
</html>