<!DOCTYPE html>
<html>
<head>
<title>Gym progress site</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style_second.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat">
<link rel="stylesheet" href="style.css">
<style>
.css-sidebar a {font-family: "Roboto", sans-serif}
body,h1,h2,h3,h4,h5,h6,.css-wide {font-family: "Montserrat", sans-serif;}
</style>
</head>
<body class="css-content" style="max-width:1200px">

<!-- Sidebar/menu -->
<nav class="sidebar css-bar-block css-white css-collapse css-top" style="z-index:3;width:250px" id="mySidebar">
  <div class="css-container css-display-container css-padding-16">
    <i onclick=sidebar()" class="fa fa-remove css-hide-large css-button css-display-topright"></i>
    <h3 onclick="reloadSite()" class="css-wide css-button"><b>Gym Site</b></h3>
  </div>
  <div class="css-padding-64 css-large css-text-grey" style="font-weight:bold">
    <a onclick="myAccFunc('object_one_items')" href="javascript:void(0)" class="css-button css-block2 css-white css-left-align" id="object_one">
      Dominika
    </a>
    <div id="object_one_items" class="css-bar-block css-hide css-padding-large css-medium">
      <a onclick="loadDiv('klasa1')" href="#" class="css-bar-item css-button css-light-grey"></i>Trening 1</a>
      <a onclick="loadDiv('klasa2')" href="#" class="css-bar-item css-button">Trening 2</a>
      <a onclick="loadDiv('klasa3')" href="#" class="css-bar-item css-button">Trening 3</a>
      <a onclick="loadDiv('klasa4')" href="#" class="css-bar-item css-button">Trening 4</a>
    </div>
    <a onclick="myAccFunc('object_two_items')" href="javascript:void(0)" class="css-button css-block2 css-white css-left-align" id="object_two">
      Bartek
    </a>
    <div id="object_two_items" class="css-bar-block css-hide css-padding-large css-medium">
      <a onclick="loadDiv('klasa5')" href="#" class="css-bar-item css-button css-light-grey">Trening 1</a>
      <a onclick="loadDiv('klasa6')" href="#" class="css-bar-item css-button">Trening 2</a>
      <a onclick="loadDiv('klasa7')" href="#" class="css-bar-item css-button">Trening 3</a>
      <a onclick="loadDiv('klasa8')" href="#" class="css-bar-item css-button">Trening 4</a>
    </div>

    <a onclick="myAccFunc('object_three_items')" href="javascript:void(0)" class="css-button css-block2 css-white css-left-align" id="object_three">
      Historia
    </a>
    <div id="object_three_items" class="css-bar-block css-hide css-padding-large css-medium">
      <a href="#" class="css-bar-item css-button">Historia</a>
      <a href="#" class="css-bar-item css-button">Wykresy</a>
    </div>
    <a href="#" class="css-bar-item css-button">Stwórz trening</a>
</nav>

<!-- Top menu on small screens -->
<header class="css-bar css-top css-hide-large css-black css-xlarge">
  <div class="css-bar-item css-padding-24 css-wide">Gym Site</div>
  <a href="javascript:void(0)" class="css-bar-item css-button css-padding-24 css-right" onclick="sidebar_open()"><i class="fa fa-bars"></i></a>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="css-overlay css-hide-large" onclick=sidebar()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="css-main" style="margin-left:250px">

  <!-- Push down content on small screens -->
  <div class="css-hide-large" style="margin-top:83px"></div>
  
  <!-- Top header -->
  <header class="css-container css-xlarge">
    <p class="css-left">Trening</p>
    <p class="css-right">
      <i class="fa fa-shopping-cart css-margin-right"></i>
      <i class="fa fa-search"></i>
    </p>
  </header>



  <div class="css-container css-text-grey" id="jeans">
    <p>8 items</p>
  </div>

  <!-- Product grid -->
  <div class="parent">
    <div id="empty_place_for_divs">
    </div>
  </div> 


  <div id="klasa1" class="klasa1">
    <div class="div1">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 1" name="Name" required></p>  
      </div>
      <div class="div2"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 2" name="Name" required></p>
      </div>
      <div class="div3">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 3" name="Name" required></p>
      </div>
      <div class="div4"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 4" name="Name" required></p>
      </div>
      <div class="div5"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 5" name="Name" required></p>
      </div>
      <div class="div6"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 6" name="Name" required></p>
      </div>
  </div>
  <div id="klasa2" class="klasa2">
      <div class="div1">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 21" name="Name" required></p>  
      </div>
      <div class="div2"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 22" name="Name" required></p>
      </div>
      <div class="div3">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 23" name="Name" required></p>
      </div>
      <div class="div4"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 24" name="Name" required></p>
      </div>
      <div class="div5"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 25" name="Name" required></p>
      </div>
      <div class="div6"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 26" name="Name" required></p>
      </div>
  </div>
  <div id="klasa3" class="klasa3">
    <div class="div1">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 31" name="Name" required></p>  
    </div>
    <div class="div2"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 32" name="Name" required></p>
    </div>
    <div class="div3">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 33" name="Name" required></p>
    </div>
    <div class="div4"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 34" name="Name" required></p>
    </div>
    <div class="div5"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 35" name="Name" required></p>
    </div>
    <div class="div6"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 36" name="Name" required></p>
    </div>
  </div>
  <div id="klasa4" class="klasa4">
    <div class="div1">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 41" name="Name" required></p>  
    </div>
    <div class="div2"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 42" name="Name" required></p>
    </div>
    <div class="div3">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 43" name="Name" required></p>
    </div>
    <div class="div4"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 44" name="Name" required></p>
    </div>
    <div class="div5"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 45" name="Name" required></p>
    </div>
    <div class="div6"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 46" name="Name" required></p>
    </div>
  </div>
  <div id="klasa5" class="klasa5">
    <div class="div1">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 51" name="Name" required></p>  
      </div>
      <div class="div2"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 52" name="Name" required></p>
      </div>
      <div class="div3">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 53" name="Name" required></p>
      </div>
      <div class="div4"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 54" name="Name" required></p>
      </div>
      <div class="div5"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 55" name="Name" required></p>
      </div>
      <div class="div6"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 56" name="Name" required></p>
      </div>
  </div>
  <div id="klasa6" class="klasa6">
      <div class="div1">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 61" name="Name" required></p>  
      </div>
      <div class="div2"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 62" name="Name" required></p>
      </div>
      <div class="div3">
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 63" name="Name" required></p>
      </div>
      <div class="div4"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 64" name="Name" required></p>
      </div>
      <div class="div5"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 65" name="Name" required></p>
      </div>
      <div class="div6"> 
        <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 66" name="Name" required></p>
      </div>
  </div>
  <div id="klasa7" class="klasa7">
    <div class="div1">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 71" name="Name" required></p>  
    </div>
    <div class="div2"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 72" name="Name" required></p>
    </div>
    <div class="div3">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 73" name="Name" required></p>
    </div>
    <div class="div4"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 74" name="Name" required></p>
    </div>
    <div class="div5"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 75" name="Name" required></p>
    </div>
    <div class="div6"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 76" name="Name" required></p>
    </div>
  </div>
  <div id="klasa8" class="klasa8">
    <div class="div1">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 81" name="Name" required></p>  
    </div>
    <div class="div2"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 82" name="Name" required></p>
    </div>
    <div class="div3">
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 83" name="Name" required></p>
    </div>
    <div class="div4"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 84" name="Name" required></p>
    </div>
    <div class="div5"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 85" name="Name" required></p>
    </div>
    <div class="div6"> 
      <p><input class="css-input css-border" style=“display:none” type="text" placeholder="Ćwiczenie 86" name="Name" required></p>
    </div>
  </div>
  
  <!-- Footer -->
  <footer class="css-padding-16 css-light-grey css-small css-center" id="footer">
    <div class="css-row-padding">
      <div class="css-col s4">
        <h4>Kontakt</h4>
        <p>Masz pytanie? Zadaj je tutaj!</p>
        <form action="/action_page.php" target="_blank">
          <p><input class="css-input css-border" type="text" placeholder="Imię" name="Name" required></p>
          <p><input class="css-input css-border" type="text" placeholder="Email" name="Email" required></p>
          <p><input class="css-input css-border" type="text" placeholder="Temat" name="Subject" required></p>
          <p><input class="css-input css-border" type="text" placeholder="Wiadomość" name="Message" required></p>
          <button type="submit" class="css-button css-block css-black">Wyślij</button>
        </form>
      </div>
    </div>
  </footer>

  <div class="css-black css-center css-padding-24">Powered by <a href="https://github.com/fanfanafankianki" title="fanfanafankianki" target="_blank" class="css-hover-opacity">fanfanafankianki</a</div>

  <!-- End page content -->
</div>

<script>
// Accordion 
function myAccFunc(arg) {
  var x = document.getElementById(arg);
  if (x.className.indexOf("css-show") == -1) {
    x.className += " css-show";
  } else {
    x.className = x.className.replace(" css-show", "");
  }
}


function loadDiv(klasa) {
  document.getElementById('empty_place_for_divs').innerHTML = document.getElementById(klasa).innerHTML;
  document.querySelectorAll(klasa).style.display = "block";
}

function reloadSite() {
  location.reload();
}

document.getElementById("object_one").click();

document.getElementById("object_two").click();

document.getElementById("object_three").click();

// Open and close sidebar
function sidebar_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function sidebar_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}
</script>

</body>
</html>
