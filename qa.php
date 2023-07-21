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
    <title>Document</title>
</head>
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

<body>
  <div class="container">
    <div class="row row-qa">
      <div class="col-lx-12">
        <div class="card">
          <div class="card-body">
            <div class="row row-qa justify-content-center mt-4">
              <div class="col-xl-5 col-lg-8">
                <div class="text-center">
                  <h3>Frequently Asked Questions?</h3>
                  <p class="text-muted">We have compiled for you the most frequently asked questions on the subjects.
                    For more questions you can contact us using the buttons.</p>
                  <div>
                    <a href="mailto:smartsugar@gmail.com" class="btn btn-primary me-2">Email Us</a>
                    <a href="tel:0528969491" class="btn btn-success  me-2">Call Us</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="row row-qa justify-content-center mt-5">
              <div class="col-9">
                <ul class="nav nav-tabs  nav-tabs-custom nav-justified justify-content-center faq-tab-box" id="pills-tab"
                  role="tablist">
                  <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="pills-genarel-tab" data-bs-toggle="pill"
                      data-bs-target="#pills-genarel" type="button" role="tab" aria-controls="pills-genarel"
                      aria-selected="true">
                      <span class="font-size-16">General Questions</span>
                    </button>
                  </li>
                  <li class="nav-item" role="presentation">
                    <button class="nav-link" id="pills-privacy_policy-tab" data-bs-toggle="pill"
                      data-bs-target="#pills-privacy_policy" type="button" role="tab" aria-controls="pills-privacy_policy"
                      aria-selected="false">
                      <span class="font-size-16">Privacy Policy</span>
                    </button>
                  </li>
                </ul>
              </div>
              <div class="col-lg-9">
                <div class="tab-content pt-3" id="pills-tabContent">
                  <div class="tab-pane fade active show" id="pills-genarel" role="tabpanel"
                    aria-labelledby="pills-genarel-tab">
                    <div class="row row-qa g-4 mt-2">
                      <div class="col-lg-6">
                        <h5>What is SmartSugar ?</h5>
                        <p class="lg-base">individuals with diabetes in effectively tracking and understanding their
                          blood sugar levels. It utilizes a sensor to monitor real-time blood sugar readings and offers
                          valuable features such as menu preparation and personalized feedback on meal choices, as well
                          as a future prediction of blood sugar levels. By providing comprehensive insights and support,
                          the app aims to empower users to make informed decisions about their diet and lifestyle to
                          better manage their diabetes.</p>
                      </div>
                      <div class="col-lg-6">
                        <h5>Why do we use it ?</h5>
                        <p class="lg-base">Empowering Self-Management: The app puts you in control of your diabetes
                          management, providing you with the tools and knowledge needed to take charge of your health
                          and make positive changes.</p>
                      </div>
                      <div class="col-lg-6">
                        <h5>How will it improve my lifestyle ?</h5>
                        <p class="lg-base">If several languages coalesce, the grammar of the resulting language is more
                          simple and regular than that of the individual languages. The new common language will be more
                          simple and regular than the existing</p>
                      </div>
                    </div>
                  </div>
                  <div class="tab-pane fade" id="pills-privacy_policy" role="tabpanel"
                    aria-labelledby="pills-privacy_policy-tab">
                    <div class="row row-qa g-4 mt-2">
                      <div class="col-lg-6">
                        <h5>How is my personal information collected?</h5>
                        <p class="lg-base">Personal information is collected when users sign up and create a profile
                          within the application. The app also gathers data through the sensor used for monitoring blood
                          sugar levels in real-time.</p>
                      </div>
                      <div class="col-lg-6">
                        <h5>What is the purpose of collecting my personal information?</h5>
                        <p class="lg-base">The primary purpose of collecting personal information is to provide users
                          with accurate blood sugar monitoring and personalized health insights. This data is used to
                          create personalized meal plans, offer feedback on dietary choices, and predict future blood
                          sugar levels for better diabetes management.</p>
                      </div>
                      <div class="col-lg-6">
                        <h5>What are my data retention rights ?</h5>
                        <p class="lg-base">We retain user data for as long as necessary to provide our services and as
                          required by applicable laws. However, users have the right to request data deletion, and we
                          promptly comply with such requests.</p>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <footer class="footer">
      <span>&copy; Copyright 2023 SmartSugar</span>   
    </footer>

  <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
