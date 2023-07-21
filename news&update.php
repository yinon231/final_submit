<?php 
include "db.php";
include "config.php";
session_start();
if (isset($_SESSION['id'])) {
  $query="SELECT * FROM tbl_203_patients WHERE UserID=".$_SESSION['id']."";
  $result=mysqli_query($connection,$query);  
} else {
  header('Location: ' .URL. 'login.php');
  
}

?> 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Amiko:regular,600,700" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/stylecanvas.scss">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>news&update</title>
</head>
<body>
<header>
  <?php if($_SESSION['user_type']=="admin")
  {
    echo "<a href='index.php' id='logo'></a>";
  }
  else echo "<a href='patient.php?id='".$_SESSION['patientID']."'' id='logo'></a>";
  ?>
  <button class="navbar-toggler" type="button" id="btn-hamburger" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
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
            if($_SESSION['user_type']=="admin")
            {
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
      if($_SESSION['user_type']=="admin")
      {
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
        <a href="Update_User.php" class="material-symbols-outlined" >
            <span class="material-symbols-outlined">settings</span>
        </a>
        <a href="logout.php" class="material-symbols-outlined" >
        <span class="material-symbols-outlined">logout</span>
        </a>
        <a href="#" id="circle" <?php if(isset($_SESSION['img'])) echo "style='background-image:url(".$_SESSION['img'].")'"; else echo 'style=\'background-image:url("images/default.png")\'';?>></a>
    </div>
</header>
  <div class="container py-4">
    <div class="row row-nu">
      <div class="col-md-6">
        <img src="images/news.jpg" alt="Image" class="img-fluid">
      </div>
      <div class="col-md-6">
        <br>
        <br>
        <br>
        <br>
        <h2 class="fw-bold">Stay Tuned</h2>
        <p>On this page you can keep up to date with articles and lectures about the disease.
            You can go to the website of the Israeli Diabetes Association for more details and expansion of knowledge. Click on the button!</p>
            <a href="https://sukeret.mednet.co.il/" class="btn btn-primary btn-nu">Learn More</a>
      </div>
    </div>
    <div class="row-nu row mt-4">
      <div class="col-md-4">
        <div class="card card-nu">
          <img src="images/second.jpg" class="card-img-top" alt="Card Image">
          <div class="card-body">
            <h5 class="card-title">Become more engaged patients</h5>
            <p class="card-text">The best way to mobilize for your health is to understand what you are facing and what treatment options are available to you</p>
            <a href="https://sukeret.mednet.co.il/2019/11/137510/?hilite=%D7%9E%D7%90%D7%9E%D7%A8%D7%99%D7%9D" class="btn btn-primary btn-nu">Read More</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-nu">
          <img src="images/third.jpg" class="card-img-top" alt="Card Image">
          <div class="card-body">
            <h5 class="card-title">Depression and anxiety in type 1 diabetic patients</h5>
            <p class="card-text">A literature review reveals that about a third of children with juvenile diabetes develop symptoms of anxiety and depression that adversely affect glycemic balance and adherence to medication and monitoring of sugar levels</p>
            <a href="https://sukeret.mednet.co.il/2016/05/105364/?hilite=%D7%9E%D7%90%D7%9E%D7%A8%D7%99%D7%9D" class="btn btn-primary btn-nu">Read More</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-nu">
          <img src="images/first.jpg" class="card-img-top" alt="Card Image">
          <div class="card-body">
            <h5 class="card-title">Colorectal Cancer</h5>
            <p class="card-text">People with diabetes are at increased risk of developing colon cancer, according to the results of an international study. However, the reasons for the relationship are still not clear to any consumer.</p>
            <a href="https://sukeret.mednet.co.il/%D7%A1%D7%A8%D7%98%D7%9F-%D7%94%D7%9E%D7%A2%D7%99-%D7%94%D7%92%D7%A1/?hilite=%D7%9E%D7%90%D7%9E%D7%A8%D7%99%D7%9D" class="btn btn-primary btn-nu">Read More</a>
          </div>
        </div>
      </div>
    </div>

    <div class="row-nu row mt-4">
      <div class="col-md-4">
        <div class="card card-nu">
          <img src="images/four.jpg" class="card-img-top" alt="Card Image">
          <div class="card-body">
            <h5 class="card-title">Lecture: Batia Elimelech</h5>
            <p class="card-text">Lecture: Batia Elimelech - diabetes specialist, clinical dietitian in a video about eating fruit and diabetes</p>
            <a href="https://sukeret.mednet.co.il/2020/07/146695/?hilite=%D7%A1%D7%A8%D7%98%D7%95%D7%9F" class="btn btn-primary btn-nu">Read More</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-nu">
          <img src="images/four.jpg" class="card-img-top" alt="Card Image">
          <div class="card-body">
            <h5 class="card-title">What is the connection between diabetes and heart disease?</h5>
            <p class="card-text">It is first of all important to understand the relationship between diabetes and heart disease, because knowledge is the power that will help you and your doctor manage the disease and thus reduce the risk of cardiovascular complications</p>
            <a href="https://sukeret.mednet.co.il/2019/11/137508/" class="btn btn-primary btn-nu">Read More</a>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card card-nu">
          <img src="images/six.jpg" class="card-img-top" alt="Card Image">
          <div class="card-body">
            <h5 class="card-title">From A to Z: the glossary for diabetics</h5>
            <p class="card-text">Type 2 diabetes sufferers have many therapeutic measures available to achieve blood sugar balance. We have put together for you the glossary of terms that every diabetic should know</p>
            <a href="https://sukeret.mednet.co.il/2019/11/137512/" class="btn btn-primary btn-nu">Read More</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
      <span>&copy; Copyright 2023 SmartSugar</span>   
  </footer>

  <!-- Link to Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
