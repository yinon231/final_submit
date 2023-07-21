<?php 
include "db.php";
include "config.php";
session_start();
if (isset($_SESSION['id'])) {
    $id=$_SESSION['id'];
   if(empty($_POST['fullname']))
   {
        $query="SELECT * FROM tbl_203_users WHERE id=".$_SESSION['id']."";
        $result=mysqli_query($connection,$query);
        $row=mysqli_fetch_assoc($result);
        $type=$row['user_type'];
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
    <title>Update User</title>
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
  <h1>Update User</h1>
  <form action="" method="post" enctype="multipart/form-data" id="update_User">
    
        <div class="mb-3">
        <label for="fullname" class="form-label ">Full name</label>
        <input type="text" class="form-control" name="fullname" id="fullname" pattern="^[A-Za-z]+(?:\s[A-Za-z]+)+$" required
            <?php
              if(empty($_POST['fullname'])) echo "value='".$row['name']."'";
            ?>
             >
        </div> 
        <div class="mb-3">
        <label for="password" class="form-label ">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="***" required
            <?php
              if(empty($_POST['fullname'])) echo "value='".$row['password']."'";
            ?>
            >
        </div>
        <div class="mb-3">
        <label for="email" class="form-label ">Email address</label>
        <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required
          <?php
              if(empty($_POST['fullname']))  echo "value='".$row['email']."'";
           ?>
          >
        </div>
        <div class="mb-3">
        <label for="formFileSm" class="form-label">Choose image</label>
        <input  name="img" class="form-control form-control-sm" id="formFileSm" type="file" accept=".png, .jpg, .jpeg"
          <?php
            if(empty($_POST['fullname']))  echo "value='".$row['img']."'";
           ?>
          >
        </div>
        <div class="mb-3">
                <label for="phone" class="form-label ">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" required
          <?php
            if(empty($_POST['fullname']))  echo "value='".$row['phone']."'";
           ?>
          >
        </div>
        <div class="mb-3 center">
              <input type="submit" class="btn btn-outline-secondary" value="Update Profile" id="btn-form">
        </div>
        <?php
        if(!empty($_POST['fullname'])){
          $fullname=$_POST['fullname'];
          $email=$_POST['email'];
          $password=$_POST['password'];
          $targetDirectory = 'uploads/';
          if (isset($_FILES['img']) && !empty($_FILES['img']['name'])) {
            $targetFile = $targetDirectory . basename($_FILES['img']['name']);
            move_uploaded_file($_FILES['img']['tmp_name'], $targetFile);
          } else {
            $targetFile = $targetDirectory . 'default.png';
          
          }
          $_SESSION['img']=$targetFile;
        
          $phone=$_POST['phone'];
          $query1="UPDATE tbl_203_users SET name = '$fullname', email = '$email', password = '$password', img = '$targetFile', phone = '$phone'  WHERE id = '$id'";
            $result1 = mysqli_query($connection, $query1);
            if ($result1 && mysqli_affected_rows($connection) > 0) 
            {
              echo "<div class='alert alert-success' role='alert'>Update user Successfully!</div>";
              if($_SESSION['user_type']=="admin")
              {
              echo "<script>setTimeout(function(){ window.location.href = '".URL."index.php'; }, 2000);</script>";
              }
              else
              {
                $query2="SELECT PatientID FROM tbl_203_patients WHERE name='".$fullname."'";
                $result2=mysqli_query($connection,$query2);
                $row2=mysqli_fetch_array($result2);
                if($row2)
                {
                  echo "<script>setTimeout(function(){ window.location.href = 'patient.php?id=".$row2['PatientID']."'; }, 2000);</script>";
                }
              } 

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
  <footer class="footernoabs">
    <span>&copy; Copyright 2023 SmartSugar</span>   
  </footer>
  <script src="js/Update_User.js"></script>
</body>
</html>