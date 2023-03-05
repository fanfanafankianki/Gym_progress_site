function loadBMICalculator() {
  var BMICalculator = `<br><br> BMI Calculator <br><br>
  <input type="text" id="weight" placeholder="Weight"><br><br>
  <input type="text" id="height" placeholder="Height"><br><br>
  <button onclick="calculateBMI()">Calculate BMI</button><br><br>
  <div id="result"></div>`;
  let target = document.getElementById("empty_place_for_divs");
  document.getElementById("empty_place_for_divs").innerHTML = BMICalculator;
}

function calculateBMI() {
  // Pobieranie wartości wagi i wzrostu z pól input
  var weight = document.getElementById("weight").value;
  var height = document.getElementById("height").value;

  // Konwersja pól input na liczby
  weight = parseFloat(weight);
  height = parseFloat(height);

  // Sprawdzanie, czy wprowadzono prawidłowe dane
  if (isNaN(weight) || isNaN(height) || height <= 0) {
    document.getElementById("result").innerHTML =
      "Incorrect data has been entered.";
    return;
  }

  // Obliczenie BMI
  var bmi = (weight / (height * height)) * 10000;

  // Wyświetlenie wyniku
  document.getElementById("result").innerHTML =
    "Your BMI is: " + bmi.toFixed(2);
}

function loadCaloriesCalculator() {
  var CaloriesCalculator = `<br><br> Caloric requirement calculator <br><br>
  <input type="text" id="weight" placeholder="Weight"><br><br>
  <input type="text" id="height" placeholder="Height"><br><br>
  <input type="text" id="age" placeholder="Age"><br><br>
  <select id="gender">
      <option value="male">Men</option>
      <option value="female">Women</option>
  </select><br><br>
  <select id="activity">
      <option value="1.20">Almost none</option>
      <option value="1.40">Light activity</option>
      <option value="1.60">Moderate activity</option>
      <option value="1.80">Large activity</option>
      <option value="2.00">Very high activity</option>
  </select><br><br>
  <button onclick="calculateCaloricRequirement()">Calculate your caloric needs</button><br><br>
  <div id="result"></div><br>`;
  let target = document.getElementById("empty_place_for_divs");
  document.getElementById("empty_place_for_divs").innerHTML =
    CaloriesCalculator;
}

function calculateCaloricRequirement() {
  // Pobieranie wartości wagi, wzrostu i wieku z pól input
  var weight = document.getElementById("weight").value;
  var height = document.getElementById("height").value;
  var age = document.getElementById("age").value;
  var gender = document.getElementById("gender").value;
  var activity = document.getElementById("activity").value;

  // Konwersja pól input na liczby
  weight = parseFloat(weight);
  height = parseFloat(height);
  age = parseFloat(age);

  // Sprawdzanie, czy wprowadzono prawidłowe dane
  if (isNaN(weight) || isNaN(height) || isNaN(age) || height <= 0) {
    document.getElementById("result").innerHTML =
      "Incorrect data has been entered.";
    return;
  }

  // Obliczenie zapotrzebowania kalorycznego
  var PPM;
  var BMR;
  var BMR_Masa;
  var BMR_Redukcja;
  if (gender === "male") {
    PPM = 66 + 13.7 * weight + 5 * height - 6.8 * age;
    BMR = (66 + 13.7 * weight + 5 * height - 6.8 * age) * activity;
    BMR_Masa = (66 + 13.7 * weight + 5 * height - 6.8 * age) * activity + 150;
    BMR_Redukcja =
      (66 + 13.7 * weight + 5 * height - 6.8 * age) * activity - 150;
  } else {
    PPM = 655 + 9.6 * weight + 1.8 * height - 4.7 * age;
    BMR = (655 + 9.6 * weight + 1.8 * height - 4.7 * age) * activity;
    BMR_Masa = (655 + 9.6 * weight + 1.8 * height - 4.7 * age) * activity + 150;
    BMR_Redukcja =
      (655 + 9.6 * weight + 1.8 * height - 4.7 * age) * activity - 150;
  }

  // Wyświetlenie wyniku
  document.getElementById("result").innerHTML =
    "Your Basal Metabolic Rate is approx: " +
    PPM.toFixed(2) +
    " calories. <br><br>";
  document.getElementById("result").innerHTML +=
    "Your daily caloric requirement is approx: " +
    BMR.toFixed(2) +
    " calories. <br><br>";
  document.getElementById("result").innerHTML +=
    "Your daily caloric requirement to gain weight is approx: " +
    BMR_Masa.toFixed(2) +
    " calories. <br><br>";
  document.getElementById("result").innerHTML +=
    "Your daily caloric requirement to lose weight is approx: " +
    BMR_Redukcja.toFixed(2) +
    " calories. <br><br>";
}

function loadFFMICalculator() {
  var FFMICalculator = `<br><br> FFMI Calculator <br><br>
  <input type="text" id="weight" placeholder="Weight"><br><br>
  <input type="text" id="height" placeholder="Height"><br><br>
  <input type="text" id="fat" placeholder="Fat level (%)"><br><br>
  <button onclick="calculateFFMI()">Calculate FFMI</button><br><br>
  <div id="result"></div>`;
  let target = document.getElementById("empty_place_for_divs");
  document.getElementById("empty_place_for_divs").innerHTML = FFMICalculator;
}

function calculateFFMI() {
  // Pobieranie wartości wagi, wzrostu i poziomu tkanki tłuszczowej z pól input
  var weight = document.getElementById("weight").value;
  var height = document.getElementById("height").value;
  var fat = document.getElementById("fat").value;

  // Konwersja pól input na liczby
  weight = parseFloat(weight);
  height = parseFloat(height);
  fat = parseFloat(fat);

  // Sprawdzanie, czy wprowadzono prawidłowe dane
  if (
    isNaN(weight) ||
    isNaN(height) ||
    isNaN(fat) ||
    height <= 0 ||
    fat < 0 ||
    fat > 100
  ) {
    document.getElementById("result").innerHTML =
      "Incorrect data has been entered.";
    return;
  }

  // Obliczenie masy beztłuszczowej
  var leanMass = weight * (1 - fat / 100);

  // Obliczenie FFMI
  var ffmi = leanMass / ((height / 100) * (height / 100));

  var normalized_ffmi = ffmi + 6.1 * (1.8 - height / 100);

  // Wyświetlenie wyniku
  document.getElementById("result").innerHTML =
    "Your FFMI is: " +
    ffmi.toFixed(2) +
    "<br> Your Normalized FFMI is: " +
    normalized_ffmi.toFixed(2);
}

function myAccFunc(arg) {
  var x = document.getElementById(arg);
  if (x.className.indexOf("css-show") == -1) {
    x.className += " css-show";
  } else {
    x.className = x.className.replace(" css-show", "");
  }
}

function createUserElement(
  profile_id,
  profile_name,
  trainingList = [],
  trainingIds = []
) {
  let a = document.createElement("a");
  a.innerHTML = profile_name;
  a.setAttribute("href", "javascript:void(0)");
  a.setAttribute("onclick", `myAccFunc('${profile_name}_items${profile_id}')`);
  a.setAttribute("class", "css-button css-left-align css-show");
  a.setAttribute("id", profile_name);
  let target = document.getElementById("target");
  target.insertBefore(a, target.firstChild);

  createChildElements(a, profile_id, profile_name);
  if (trainingList.length === trainingIds.length && trainingList.length > 0) {
    for (let i = 0; i < trainingList.length; i++) {
      createTrainingElement(
        trainingList[i],
        trainingIds[i],
        profile_name,
        profile_id
      );
    }
  }
}

function createAddUserElement() {
  let a2 = document.createElement("a");
  a2.innerHTML = "Add new profile";
  a2.setAttribute("onclick", "loadProfileDiv()");
  a2.setAttribute("href", "#");
  a2.setAttribute("class", "css-button css-block2 css-left-align");

  let target = document.getElementById("target");
  target.insertBefore(a2, target.firstChild);
}

function createChildElements(parent, profile_id, profile_name) {
  let div = document.createElement("div");
  div.setAttribute("id", profile_name + "_items" + profile_id);
  div.setAttribute(
    "class",
    "css-bar-block css-hide css-padding-large css-medium css-show"
  );

  let a1 = document.createElement("a");
  a1.innerHTML = "Add Training";
  a1.setAttribute("onclick", "loadAddTrainingDiv(" + profile_id + ")");
  a1.setAttribute("href", "#");
  a1.setAttribute("class", "css-bar-item css-button");
  div.appendChild(a1);

  let a2 = document.createElement("a");
  a2.innerHTML = "Training history";
  a2.setAttribute("onclick", "loadTrainingHistoryDiv(" + profile_id + ")");
  a2.setAttribute("href", "#");
  a2.setAttribute("class", "css-bar-item css-button");
  div.appendChild(a2);

  let a3 = document.createElement("a");
  a3.innerHTML = "Charts";
  a3.setAttribute("onclick", "loadChartDiv(" + profile_id + ")");
  a3.setAttribute("href", "#");
  a3.setAttribute("class", "css-bar-item css-button");
  div.appendChild(a3);

  parent.parentNode.insertBefore(div, parent.nextSibling);
}

function createTrainingElement(
  training,
  training_id,
  profile_name,
  profile_id
) {
  let a1 = document.createElement("a");
  a1.innerHTML = training;
  a1.setAttribute("onclick", "loadTrainingDiv(" + training_id + ")");
  a1.setAttribute("href", "#");
  a1.setAttribute("class", "css-bar-item css-button css-show");
  let target = document.getElementById(profile_name + "_items" + profile_id);
  target.insertBefore(a1, target.firstChild);
}

function createRegisterElement() {
  var registerForm = `Register now and start tracking your progress.<br>
    <form action="php_functions/registration.php" method="post">
    Register now! <br>
    <input type="text" id="username" name="username" placeholder="Username">
    <br>
    <input type="email" id="email" name="email" placeholder="Email">
    <br>
    <input type="password" id="password" name="password" placeholder="Password">
    <br>
    `;

  if (error_registration) {
    registerForm += "<p style='color:red;'>" + error_registration + "</p>";
  }

  registerForm += `<input type="submit" name="submitRegistration" value="Register">
    </form><br>
    `;

  document.getElementById("welcome_site2").innerHTML += registerForm;
}

function loadProfileDiv() {
  document.getElementById(
    "empty_place_for_divs"
  ).innerHTML = `<form method='post'>
  <br><br>Add new profile: <br><br>
  <input type='text' name='text' class='css-input css-border' placeholder='Profile name'><br>
  <input type='submit' name='add_profile' class='css-button css-black' value='Add profile'>
  </form>`;
}

function loadTrainingDiv(training_id) {
  var xhr = new XMLHttpRequest();

  xhr.open("POST", "php_functions/selectTrainingWithExercise.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var newDiv1 = document.createElement("div");
      newDiv1.id = "TrainingDiv";

      var newDiv2 = document.createElement("div");
      newDiv2.id = "TrainingContainer";
      newDiv2.innerHTML = "<br><br><p></p>";

      var records = JSON.parse(this.responseText);
      var table = document.createElement("table");
      table.setAttribute("border", "10");

      table.style.margin = "0 auto";
      var form = document.createElement("form");
      form.id = "addTrainingForm";
      form.action = "php_functions/insertTrainingWithDate.php";
      form.method = "post";
      newDiv2.appendChild(form);
      for (var i = 0; i < records.length; i++) {
        var row = table.insertRow();
        table.style.width = "55%";
        var cell0 = row.insertCell(0);
        cell0.innerHTML =
          records[i]["training_name"] +
          "<input type='hidden' name='Training_With_Exercises_ID' value='" +
          records[i]["training_with_exercises_id"] +
          "'>";
        cell0.style.textAlign = "center";
        cell0.style.fontWeight = "bold";

        for (var j = 0; j < records[i]["exercises"].length; j++) {
          var subRow = table.insertRow();
          var subCell0 = subRow.insertCell(0);
          var subCell1 = subRow.insertCell(0);
          var subCell2 = subRow.insertCell(0);

          subCell0.innerHTML =
            "<input type='text' name='Weight_" + j + "' placeholder='Weight'>";
          subCell0.style.textAlign = "center";
          subCell1.innerHTML =
            "<input type='text' name='Reps_" +
            j +
            "' placeholder='Number of repetitions'> <input type='hidden' name='Exercise_ID_" +
            j +
            "' value='" +
            records[i]["exercise_id"][j] +
            "'>";
          subCell1.style.textAlign = "center";
          subCell2.innerHTML = records[i]["exercises"][j];
          subCell2.style.textAlign = "center";
        }
      }
      var subCell4 = subRow.insertCell(3);
      subCell4.innerHTML =
        "<input type='submit' name='WstawDate' class='css-button css-black' value='Wyślij'>";
      subCell4.style.textAlign = "center";

      form.appendChild(table);
      newDiv1.appendChild(newDiv2);
      addDisplayBlockToChilds(newDiv1);
      document.querySelector("#empty_place_for_divs").innerHTML =
        newDiv1.outerHTML;
    } else {
      console.error(
        "An error occurred while loading the training div. Response status: ",
        this.status
      );
    }
  };

  xhr.send("training_id=" + training_id);
}

function loadChartDiv(profile_id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php_functions/selectTrainingsByProfileId.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var newDiv1 = document.createElement("div");
      newDiv1.id = "ChartDiv";
      var newDiv2 = document.createElement("div");
      newDiv2.id = "ChartContainer";
      newDiv2.style.fontWeight = "bold";
      if (this.responseText === "") {
        newDiv2.innerHTML = `<br><p></p><br></br><p></p><br><p></p><br><p></p><br><p></p><b>
          <div style='font-size:20px;'>There is no data for this tab.<br> Complete required information and come back here later!</div></b>`;
      } else {
        newDiv2.innerHTML =
          "<br><p></p><br>Select the workout for which you want to view the chart: <br><p></p><br>" +
          this.responseText;
      }
      newDiv1.appendChild(newDiv2);
      addDisplayBlockToChilds(newDiv1);
      document.querySelector("#empty_place_for_divs").innerHTML =
        newDiv1.outerHTML;
    } else {
      console.error(
        "An error occurred while loading the training div. Response status: ",
        this.status
      );
    }
  };
  xhr.send("profile_id=" + profile_id);
}

function loadTrainingHistoryDiv(profile_id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php_functions/selectTrainingsByProfileIdHistory.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var newDiv1 = document.createElement("div");
      newDiv1.id = "TrainingHistoryDiv";
      var newDiv2 = document.createElement("div");
      newDiv2.id = "TrainingHistoryContainer";
      newDiv2.style.fontWeight = "bold";
      if (this.responseText === "") {
        newDiv2.innerHTML = `<br><p></p><br></br><p></p><br><p></p><br><p></p><br><p></p><b>
          <div style='font-size:20px;'>There is no data for this tab.<br> Complete required information and come back here later!</div></b>`;
      } else {
        newDiv2.innerHTML =
          "<br><p></p><br>Select the workout for which you want to view history: <br><p></p><br>" +
          this.responseText;
      }
      newDiv1.appendChild(newDiv2);
      addDisplayBlockToChilds(newDiv1);
      document.querySelector("#empty_place_for_divs").innerHTML =
        newDiv1.outerHTML;
    } else {
      console.error(
        "An error occurred while loading the training div. Response status: ",
        this.status
      );
    }
  };
  xhr.send("profile_id=" + profile_id);
}

function loadTrainingHistoryTableDiv(profile_id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php_functions/selectTrainingHistoryByProfileId.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var newDiv1 = document.createElement("div");
      newDiv1.id = "TrainingHistoryTableDiv";
      var newDiv2 = document.createElement("div");
      newDiv2.id = "TrainingHistoryTableContainer";
      newDiv2.style.fontWeight = "bold";
      if (this.responseText === "") {
        newDiv2.innerHTML = `<br><p></p><br></br><p></p><br><p></p><br><p></p><br><p></p><b>
          <div style='font-size:20px;'>There is no data for this tab.<br> Complete required information and come back here later!</div></b>`;
      } else {
        newDiv2.innerHTML =
          "<br><p></p><br>Select the workout for which you want to view history: <br><p></p><br>" +
          this.responseText;
      }
      newDiv1.appendChild(newDiv2);
      addDisplayBlockToChilds(newDiv1);
      document.querySelector("#empty_place_for_divs").innerHTML =
        newDiv1.outerHTML;
    } else {
      console.error(
        "An error occurred while loading the training div. Response status: ",
        this.status
      );
    }
  };
  xhr.send("profile_id=" + profile_id);
}

function showTrainingWithExercisesDetails(training_id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php_functions/selectExercisesByTrainingId.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var newDiv1 = document.createElement("div");
      newDiv1.id = "TrainingWithExercisesDiv";
      var newDiv2 = document.createElement("div");
      newDiv2.id = "TrainingWithExercisesContainer";
      newDiv2.style.fontWeight = "bold";
      if (this.responseText === "") {
        newDiv2.innerHTML = `<br><p></p><br></br><p></p><br><p></p><br><p></p><br><p></p><b>
          <div style='font-size:20px;'>There is no data for this tab.<br> Complete required information and come back here later!</div></b>`;
      } else {
        newDiv2.innerHTML =
          "<br><p></p><br>Select exercise for which you want to view the chart: <br><p></p><br>" +
          this.responseText;
      }
      newDiv1.appendChild(newDiv2);
      addDisplayBlockToChilds(newDiv1);
      document.querySelector("#empty_place_for_divs").innerHTML =
        newDiv1.outerHTML;
    } else {
      console.error(
        "An error occurred while loading the training div. Response status: ",
        this.status
      );
    }
  };
  xhr.send("training_id=" + training_id);
}

function showTrainingHistoryDetails(training_history_id) {
  var xhr = new XMLHttpRequest();
  xhr.open("POST", "php_functions/selectExercisesByHistoryId.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onload = function () {
    if (this.status == 200) {
      var newDiv1 = document.createElement("div");
      newDiv1.id = "TrainingHistoryDetailsDiv";
      newDiv1.innerHTML = "<br><br><p></p>";
      var newTable = document.createElement("table");
      newTable.id = "training_history_table";
      newTable.className = "training_history_table";
      newTable.setAttribute("border", "10");
      newTable.style.margin = "0 auto";
      newTable.style.width = "30%";
      // Parsuj odpowiedź responsetext i dodaj ją jako wiersze i komórki tabeli
      var responseData = JSON.parse(this.responseText);
      for (var i = 0; i < responseData.length; i++) {
        var newRow = newTable.insertRow();
        var exerciseCell = newRow.insertCell();
        exerciseCell.style.textAlign = "center";
        exerciseCell.style.fontWeight = "bold";
        exerciseCell.innerHTML = responseData[i].exercise_name;
        var repsCell = newRow.insertCell();
        repsCell.style.textAlign = "center";
        repsCell.innerHTML = "Repetitions: " + responseData[i].reps;
        var weightCell = newRow.insertCell();
        weightCell.style.textAlign = "center";
        weightCell.innerHTML = "Weight: " + responseData[i].weight;
      }

      newDiv1.appendChild(newTable);
      addDisplayBlockToChilds(newDiv1);
      document.querySelector("#empty_place_for_divs").innerHTML =
        newDiv1.outerHTML;
    } else {
      console.error(
        "An error occurred while loading the training div. Response status: ",
        this.status
      );
    }
  };
  xhr.send("training_history_id=" + training_history_id);
}

function showExerciseDetailsChart(exercise_id, training_id) {
  const xhr = new XMLHttpRequest();
  xhr.open(
    "GET",
    "php_functions/selectExerciseDetails.php?exercise_id=" +
      exercise_id +
      "&training_id=" +
      training_id,
    true
  );
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
      const response = JSON.parse(xhr.responseText);
      document.getElementById("TrainingWithExercisesContainer").innerHTML =
        '<div style="display: block;"><canvas id="myChart"></canvas></div>';
      createChart(response.dates, response.weights, response.repetitions);
    }
  };
  xhr.send();
}

function loadAddTrainingDiv(profile_id) {
  var newDiv1 = document.createElement("div");
  newDiv1.id = "AddTrainingDiv";

  var newDiv2 = document.createElement("div");
  newDiv2.id = "AddTrainingContainer";
  var xhr = new XMLHttpRequest();

  xhr.open("POST", "php_functions/selectTrainingWithExercise.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

  xhr.send("profile_id=" + profile_id);
  newDiv2.innerHTML = `<br><p></p><b>Add new training to your profile</b><br><p>
    <form id="addTrainingForm" action="php_functions/insertTrainingWithExercises.php" method="post">
    <input type="hidden" name="profile_id" value="${profile_id}">
    <input type="text" name="text1" class="css-input css-border" placeholder="Training name">
    <input type="text" name="text2" class="css-input css-border" placeholder="Exercise 1">
    <input type="text" name="text3" class="css-input css-border" placeholder="Exercise 2">
    <input type="text" name="text4" class="css-input css-border" placeholder="Exercise 3">
    <input type="text" name="text5" class="css-input css-border" placeholder="Exercise 4">
    <input type="text" name="text6" class="css-input css-border" placeholder="Exercise 5">
    <input type="text" name="text7" class="css-input css-border" placeholder="Exercise 6">
    <input type="text" name="text8" class="css-input css-border" placeholder="Exercise 7">
    <input type="text" name="text9" class="css-input css-border" placeholder="Exercise 8">
    <input type="text" name="text10" class="css-input css-border" placeholder="Exercise 9"><p> </p>
    <input type="submit" name="insertTrainingWithExercises" class="css-button css-black" value="Add training">
    </form>`;
  newDiv1.appendChild(newDiv2);

  addDisplayBlockToChilds(newDiv1);

  document.querySelector("#empty_place_for_divs").innerHTML = newDiv1.outerHTML;
}

function createChart(dates, weights, repetitions) {
  const ctx = document.getElementById("myChart");
  new Chart(ctx, {
    type: "line",
    data: {
      labels: dates,
      datasets: [
        {
          label: "Waga",
          data: weights,
          borderWidth: 8,
          yAxisID: "y",
        },
        {
          label: "Powtórzenia",
          data: repetitions,
          borderWidth: 8,
          yAxisID: "y1",
        },
      ],
    },
    options: {
      responsive: true,
      interaction: {
        mode: "index",
        intersect: true,
      },
      stacked: false,
      plugins: {
        title: {
          display: true,
          text: "Wykres dla treningu",
        },
      },
      scales: {
        y: {
          type: "linear",
          display: true,
          position: "left",
          title: {
            display: true,
            text: "Weight",
          },
        },
        y1: {
          type: "linear",
          display: true,
          position: "right",
          title: {
            display: true,
            text: "Repetitions",
          },
          // grid line settings
          grid: {
            drawOnChartArea: false, // only want the grid lines for one axis to show up
          },
        },
      },
    },
  });
}

function addDisplayBlockToChilds(div) {
  div.style.display = "block";
  var allDescendants = div.getElementsByTagName("*");
  for (var i = 0; i < allDescendants.length; i++) {
    allDescendants[i].style.display = "block";
  }
}

function addClassOnClick(event) {
  const allElements = document.querySelectorAll("*");
  allElements.forEach((element) => {
    element.classList.remove("css-light-grey");
  });

  if (event.target.classList.contains("css-button")) {
    event.target.classList.add("css-light-grey");
  }
}

document.querySelectorAll("div").forEach(function (element) {
  element.addEventListener("click", addClassOnClick);
});

function reloadSite() {
  location.reload();
}

// Open and close sidebar
function sidebar_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}

function sidebar_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}
