<?php
include "db.php";
include "config.php";
session_start();
$id = $_GET['id'];

if (isset($_SESSION['id'])) {

  $query = "SELECT tbl_203_patients.*, tbl_203_Diabetes_Type.Recommended FROM tbl_203_patients INNER JOIN tbl_203_Diabetes_Type ON tbl_203_patients.Type = tbl_203_Diabetes_Type.Type WHERE PatientID = " . $_GET['id'] . "";
  $result = mysqli_query($connection, $query);
  $row = mysqli_fetch_assoc($result);
} else {
  header('Location: ' . URL . 'login.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Patient Page</title>
  <link rel="stylesheet" href="css/2.css">
  <link rel="stylesheet" href="css/stylecanvas.scss">
  <link href="https://fonts.googleapis.com/css?family=Amiko:regular,600,700" rel="stylesheet" />
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
  <script src="https://kit.fontawesome.com/d3946a3283.js" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
  <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
  <script src="js/script.js"></script>
</head>

<body>
  <header>
    <a href="#" id="logo"></a>
    <button class="navbar-toggler" type="button" id="btn-hamburger" data-bs-toggle="offcanvas"
      data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
      <span class="material-symbols-outlined">menu</span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <?php
          if ($_SESSION['user_type'] == "admin") {
            echo "<li class='nav-item'>
                     <a class='nav-link' href='index.php'>
                     <span class='material-symbols-outlined icons-nav'>person</span>
                     My Profiles
                     </a>
                     </li>";
          }
          ?>
          <li class="nav-item">
            <a class="nav-link" href="news&update.php">
              <span class="material-symbols-outlined icons-nav">article</span>
              News&Update
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="qa.php">
              <span class="material-symbols-outlined icons-nav">mode_comment</span>
              FAQ
            </a>
          </li>
          <a class="horizontal-line" href="settings.php"></a>
          <li class="nav-item">
            <a class="nav-link" href="Update_User.php">
              <span class="material-symbols-outlined icons-nav">settings</span>
              Settings
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">
              <span class="material-symbols-outlined icons-nav">logout</span>
              Logout
            </a>
          </li>
        </ul>
      </div>
    </div>
    </div>
    <ul class="nav nav-underline">
      <?php
      if ($_SESSION['user_type'] == "admin") {
        echo "<li class='nav-item'>
                 <a class='nav-link' aria-current='page' href='index.php'>My Profiles</a>
               </li>";

      }
      ?>
      <li class="nav-item">
        <a class="nav-link" href="news&update.php">News&Update</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="qa.php">FAQ</a>
      </li>
    </ul>
    <div id="flex-icons">
      <a href="Update_User.php" class="material-symbols-outlined">
        <span class="material-symbols-outlined">settings</span>
      </a>
      <a href="logout.php" class="material-symbols-outlined">
        <span class="material-symbols-outlined">logout</span>
      </a>
      <a href="#" id="circle" <?php if (isset($_SESSION['img']))
        echo "style='background-image:url(" . $_SESSION['img'] . ")'";
      else
        echo 'style=\'background-image:url("images/default.png")\''; ?>></a>
    </div>
  </header>
  <main>
    <div class="wrapper">
      <div class="container">
        <h1>Dashboard</h1>
        <?php
        if ($_SESSION['user_type'] == "admin")
          echo "<h3>Track your patient</h3> ";
        ?>
        <div class="rectangle">
          <h1 class="title">
            <?php echo $row['name'] ?>
          </h1>
          <div id="header">
            <span class="type">Type</span>
            <span class="recommended">Recommended</span>
            <span class="sensor">Sensor Status</span>
            <span class="networkse">Network</span>
          </div>
          <div class="sub-rectangle">
            <span class="subject1 subject_Type">
              <?php echo $row['Type'] ?>
            </span>
            <span class="subject1">
              <?php echo $row['Recommended'] ?> mg/dL
            </span>
            <span class="subject1">
              <?php echo $row['Sensor'] ?> %
            </span>
            <span class="subject1"><i class="fa-sharp fa-solid fa-circle-check" style="color: #52eb00;"></i></span>
          </div>
          <img src=<?php echo "" . $row['Img'] . ""; ?> alt="Example Image" width="48" height="48" class="photo">
          <p class="text_realtime">Real-Time</p>
          <div class="flex">
            <div class="circle_madad">
              <span class="text">
                <?php echo $row['Sugar_Level'] ?>
              </span>
              <span class="units">mg/dL</span>
            </div>
          </div>
          <?php if($_SESSION['user_type']=="admin") 
            echo "<a class='button_meal' href='foods.php?id=" . $id . "'>Check Meal <i class='fas fa-apple-alt'></i></a>";
          ?>
        </div>
        <br>
        <?php 
          echo "<div class='rectangle'>
            <h4>Track By Date</h4>
            <div class='centered-container'>
            <div class='side-menu'>
            <div class='tab-header'>
               <button class='tab-btn' onclick=\"showTabContent('low')\">LOW</button>
               <button class='tab-btn' onclick=\"showTabContent('high')\">HIGH</button>
               <button class='tab-btn' onclick=\"showTabContent('avg')\">AVG</button>
            </div>
            </div>
            
              </div>
            
            <div class='tab-content' id='low'>
            
            <button class='inner-btn' type='button' value='1 WEEK' onclick=\"showText('Low: 7 Days', 'low','1_WEEK','" .
            $id .
            "')\">7 Days</button>
            
            <button class='inner-btn' type='button' value='2 WEEK' onclick=\"showText('Low: 14 Days', 'low','2_WEEK','" .
            $id .
            "')\">14 Days</button>
            
            <button class='inner-btn' type='button' value='1 MONTH' onclick=\"showText('Low: 30 Days', 'low','1_MONTH','" .
            $id .
            "')\">30 Days</button>
            
            <div class='text-container'></div>";

          if (isset($_GET["tabname"])) {
            if ($_GET["tabname"] == "low") {
              switch ($_GET["date"]) {
                case "1_WEEK":
                  $query1 =
                    "SELECT MIN(sugar_level) AS max_sugar_level_last_week FROM dbShnkr23stud2.tbl_203_measurements WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";

                  $result1 = mysqli_query($connection, $query1);

                  $row1 = mysqli_fetch_assoc($result1);

                  echo "<span class='text'>" .
                    $row1["max_sugar_level_last_week"] .
                    "</span>
            
            <span class='units'>mg/dL</span>";

                  break;

                case "2_WEEK":
                  $query1 =
                    "SELECT MIN(sugar_level) AS max_sugar_level_last_week FROM dbShnkr23stud2.tbl_203_measurements WHERE date >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK)";

                  $result1 = mysqli_query($connection, $query1);

                  $row1 = mysqli_fetch_assoc($result1);

                  echo "<span class='text'>" .
                    $row1["max_sugar_level_last_week"] .
                    "</span>
            
            <span class='units'>mg/dL</span>";

                  break;

                case "1_MONTH":
                  $query1 =
                    "SELECT MIN(sugar_level) AS max_sugar_level_last_week FROM dbShnkr23stud2.tbl_203_measurements WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";

                  $result1 = mysqli_query($connection, $query1);

                  $row1 = mysqli_fetch_assoc($result1);

                  echo "<span class='text'>" .
                    $row1["max_sugar_level_last_week"] .
                    "</span>
            
            <span class='units'>mg/dL</span>";

                  break;
              }
            }
          }

          echo " </div>
            
            <div class='tab-content' id='high'>
            
            <button class='inner-btn' type='button' value='1 WEEK' onclick=\"showText('High: 7 Days', 'high','1_WEEK','" .
            $id .
            "')\">7 Days</button>
            
            <button class='inner-btn' type='button' value='2 WEEK' onclick=\"showText('High: 14 Days', 'high','2_WEEK','" .
            $id .
            "')\">14 Days</button>
            
            <button class='inner-btn' type='button' value='1 MONTH' onclick=\"showText('High: 30 Days', 'high','1_MONTH','" .
            $id .
            "')\">30 Days</button>
            
            <div class='text-container'></div>";

          if (isset($_GET["tabname"])) {
            if ($_GET["tabname"] == "high") {
              switch ($_GET["date"]) {
                case "1_WEEK":
                  $query1 =
                    "SELECT MAX(sugar_level) AS max_sugar_level_last_week FROM dbShnkr23stud2.tbl_203_measurements WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";

                  $result1 = mysqli_query($connection, $query1);

                  $row1 = mysqli_fetch_assoc($result1);

                  echo "<span class='text'>" .
                    $row1["max_sugar_level_last_week"] .
                    "</span>
            
            <span class='units'>mg/dL</span>";

                  break;

                case "2_WEEK":
                  $query1 =
                    "SELECT MAX(sugar_level) AS max_sugar_level_last_week FROM dbShnkr23stud2.tbl_203_measurements WHERE date >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK)";

                  $result1 = mysqli_query($connection, $query1);

                  $row1 = mysqli_fetch_assoc($result1);

                  echo "<span class='text'>" .
                    $row1["max_sugar_level_last_week"] .
                    "</span>
            
            <span class='units'>mg/dL</span>";

                  break;

                case "1_MONTH":
                  $query1 =
                    "SELECT MAX(sugar_level) AS max_sugar_level_last_week FROM dbShnkr23stud2.tbl_203_measurements WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";

                  $result1 = mysqli_query($connection, $query1);

                  $row1 = mysqli_fetch_assoc($result1);

                  echo "<span class='text'>" .
                    $row1["max_sugar_level_last_week"] .
                    "</span>
            
            <span class='units'>mg/dL</span>";

                  break;
              }
            }
          }

          echo " </div>
            
              <div class='tab-content' id='avg'>
            
              <button class='inner-btn' type='button' value='1 WEEK' onclick=\"showText('Avg: 7 Days', 'avg','1_WEEK','" .
            $id .
            "')\">7 Days</button>
            
              <button class='inner-btn' type='button' value='2 WEEK' onclick=\"showText('Avg: 14 Days', 'avg','2_WEEK','" .
            $id .
            "')\">14 Days</button>
            
              <button class='inner-btn' type='button' value='1 MONTH' onclick=\"showText('Avg: 30 Days', 'avg','1_MONTH','" .
            $id .
            "')\">30 Days</button>
            
              <div class='text-container'></div>";

          if (isset($_GET["tabname"])) {
            if ($_GET["tabname"] == "avg") {
              switch ($_GET["date"]) {
                case "1_WEEK":
                  $query1 =
                    "SELECT AVG(sugar_level) AS max_sugar_level_last_week FROM dbShnkr23stud2.tbl_203_measurements WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 WEEK)";

                  $result1 = mysqli_query($connection, $query1);

                  $row1 = mysqli_fetch_assoc($result1);

                  echo "<span class='text'>" .
                    $row1["max_sugar_level_last_week"] .
                    "</span>
            
            <span class='units'>mg/dL</span>";

                  break;

                case "2_WEEK":
                  $query1 =
                    "SELECT AVG(sugar_level) AS max_sugar_level_last_week FROM dbShnkr23stud2.tbl_203_measurements WHERE date >= DATE_SUB(CURDATE(), INTERVAL 2 WEEK)";

                  $result1 = mysqli_query($connection, $query1);

                  $row1 = mysqli_fetch_assoc($result1);

                  echo "<span class='text'>" .
                    $row1["max_sugar_level_last_week"] .
                    "</span>
            
            <span class='units'>mg/dL</span>";
                  break;

                case "1_MONTH":
                  $query1 =
                    "SELECT AVG(sugar_level) AS max_sugar_level_last_week FROM dbShnkr23stud2.tbl_203_measurements WHERE date >= DATE_SUB(CURDATE(), INTERVAL 1 MONTH)";

                  $result1 = mysqli_query($connection, $query1);

                  $row1 = mysqli_fetch_assoc($result1);

                  echo "<span class='text'>" .
                    $row1["max_sugar_level_last_week"] .
                    "</span>
            
            <span class='units'>mg/dL</span>";

                  break;
              }
            }
          }
          echo " </div>    
              </div>              
              <br>
            </div>";
        
        ?>
  </main>

      <footer><span>&copy; Copyright 2023 SmartSugar</span></footer>
   
  
</body>

</html>