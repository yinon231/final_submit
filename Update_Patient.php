<?php 
include "db.php";
include "config.php";
session_start();
$id=$_GET['id'];
if (isset($_SESSION['id'])) {
   if(empty($_POST['fullName']))
   {
        $query="SELECT * FROM tbl_203_patients WHERE PatientID=".$_GET['id']."";
        $result=mysqli_query($connection,$query);
        $row=mysqli_fetch_assoc($result);
   }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/script.js"></script>
    <title>Update Patient</title>
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
  <main>
  <div class="container-fluid add">
  <h1>Update Patient</h1>
  <form action="" method="post" enctype="multipart/form-data" id="update">
        <div class="avatar-upload">
          <div class="avatar-preview">
            <div class="avatar-edit">
              <label id="pencil" for="imageUpload"></label>
              <input name="image" type='file' id="imageUpload" accept=".png, .jpg, .jpeg"  />
            </div>
              <div id="imagePreview" <?php if(empty($_POST['fullName'])) echo "style='background-image:url(".$row['Img'].")'" ?>
              ></div>
          </div>
        </div>
        <div class="mb-3">
            <label class="form-label">Full Name</label>
            <input type="text" name="fullName" class="form-control" id="fullName" pattern="^[A-Za-z]+(?:\s[A-Za-z]+)+$" required title="Please enter a valid name (letters and spaces only)"
            <?php
              if(empty($_POST['fullName'])) echo "value='".$row['name']."'";
            ?>
             required>
        </div> 
        <div class="mb-3">
            <label class="form-label">Height</label>
            <input type="number" name="height" class="form-control" required min="70" max="250"
            <?php
              if(empty($_POST['fullName'])) echo "value='".$row['Height']."'";
            ?>
            >
        </div>
        <div class="mb-3">
          <label class="form-label">Weight</label>
          <input type="number" name="weight" class="form-control" required min="20" max="300"
          <?php
              if(empty($_POST['fullName']))  echo "value='".$row['Weight']."'";
           ?>
          >
        </div>
        <div class="mb-3">
          <label class="form-label">Age</label>
          <input type="number" name="age" class="form-control" required min="0" max="120"
          <?php
            if(empty($_POST['fullName']))  echo "value='".$row['Age']."'";
           ?>
          >
        </div>
        <select name="type" class="form-select mb-3-top" aria-label="Default select example">
          <option selected disabled>Choose diabetes type</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="Pre-Diabetes">Pre-Diabetes</option>
        </select>
          <div class="mb-3">
          <label class="form-label">Blood Pressure</label>
          <input type="number" name="blood" class="form-control" required min="10" max="440"
          <?php
            if(empty($_POST['fullName']))  echo "value='".$row['Blood_Pressure']."'";
           ?>
          >
        </div>
        <div class="mb-3 center">
              <input type="submit" class="btn btn-outline-secondary" value="Update Profile" id="btn-form">
        </div>
        <?php
        if(!empty($_POST['fullName'])){
            $id=$_GET['id'];
            $targetDirectory = 'uploads/';
            if(!isset($_POST['image']))
            {
                $targetFile = $targetDirectory . 'default.png';
            }
            else{
                $targetFile = $targetDirectory . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $targetFile); 
            } 
            $name=$_POST['fullName'];
            $height=$_POST['height'];
            $weight=$_POST['weight'];
            $age=$_POST['age'];
            $type=$_POST['type'];
            $blood_pressure=$_POST['blood'];
            $sugar_level=100;
            $prediction_sugar=100;
          
            $query1 = "UPDATE tbl_203_patients SET name = '$name', Height = '$height', Weight = '$weight', Age = '$age', Type = '$type', Blood_Pressure = '$blood_pressure',Img='$targetFile' WHERE PatientID = '$id'";
            $result1 = mysqli_query($connection, $query1);
            if ($result1 && mysqli_affected_rows($connection) > 0) 
            {
              echo "<div class='alert alert-success' role='alert'>Update Patient Successfully!</div>";
              echo "<script>setTimeout(function(){ window.location.href = '".URL."index.php'; }, 2000);</script>";
              mysqli_close($connection);
             
              exit();
            } else if(mysqli_affected_rows($connection) == 0) 
                    {
                        echo "<div class='alert alert-danger' role='alert'>You entered the same values</div>";
                    }
        }
        ?>
    </form>
    </div>
  </main> 
  <footer class="footer">
    <span>&copy; Copyright 2023 SmartSugar</span>   
  </footer>
  <script src="js/Update.js"></script>
</body>
</html>