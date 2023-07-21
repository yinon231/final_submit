<?php 
include "db.php";
include "config.php";
session_start();
if (isset($_SESSION['id'])) {
  if($_SESSION['user_type']=="user")
  {
    header('Location: ' . URL . 'patient.php?id=' . $_SESSION['patientID']);
  }
  else{
  $query="SELECT * FROM tbl_203_patients WHERE UserID=".$_SESSION['id']."";
  $result=mysqli_query($connection,$query);  
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.3/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.2/js/bootstrap.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />

    <title>My Profiles</title>
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
    <div class="container size-cf">
    <h1 id ="profiles_text">Profiles</h1>
    <h3 id ="List_text">List Of Your Patients</h3>
    <?php
    if (isset($_POST['PatientID'])) {
        
        $patientID = $_POST['PatientID'];
        $deleteQuery = "DELETE FROM tbl_203_patients WHERE PatientID = '$patientID'";
        $deleteResult = mysqli_query($connection, $deleteQuery);
    
        if ($deleteResult) {
          echo "<div class='alert alert-success' role='alert'>Profile deleted successfully!</div>";
          echo "<script>setTimeout(function(){ window.location.href = '".URL."index.php'; },0);</script>";
            // Deletion successful
            
        } else {
            // Error occurred during deletion
           die("Error deleting profile:". mysqli_error($connection));
        }
      }
      ?>
    <input type="text" class="form-control search" placeholder="  Search" width="40px">
    <div id="no-result-message" style="display: none;">No matching profiles found!</div>
    <div class="btn-div">
      <button class="btn btn-style" title="Add Profile" onclick="window.location.href = 'Add_Patient.php';">+ Add Profile</button>
    </div>
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want to delete this patient?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-danger" id="delete">Delete</button>
      </div>
    </div>
  </div>
</div>
    <?php
    if (isset($_SESSION['id'])) {
      $query="SELECT * FROM tbl_203_patients WHERE UserID=".$_SESSION['id']."";
      $result=mysqli_query($connection,$query);
  
    } else {
      header('Location: ' .URL. 'login.php');
      
    }
   
    if(!empty($query))
    {
      echo  "<div class='small'>";
      while($row=mysqli_fetch_assoc($result))
      {

       echo "<div class='profile-small'>
          <div class='cover' onclick=\"window.location.href='patient.php?id=".$row['PatientID']."';\">
              <img src=".$row['Img']." width='48' height='48' alt='' style='border-radius: 50%;'>
              <div class='data'>
                <span id='bold'>".$row['name']."</span>
                <div class='flex-data'>
                    <span>type ".$row['Type']."</span>
                    <span id='network-small'></span>
                    <span>".$row['Sugar_Level']." mg/dL</span>
                </div>
              </div>
            </div>
            <form action='index.php' method='POST' class='deleteForm1'>
            <input type='hidden' name='PatientID' value='".$row['PatientID']."'>
            <button type='button' class='btn btn-secondary rounded-circle btn-little'  onclick=\"window.location.href='Update_Patient.php?id=".$row['PatientID']."';\" data-toggle='tooltip' data-placement='top' title='Edit User'><i class='fas fa-pen'></i></button>
            <button type='submit' class='btn btn-danger rounded-circle btn-little' data-toggle='tooltip' data-placement='top' title='Delete User'><i class='fas fa-times'></i></button>
          </form>
        </div>";
      }
     echo "</div>";
    }
    ?>
   
    <?php
     if (isset($_SESSION['id'])) {
      $query="SELECT * FROM tbl_203_patients WHERE UserID=".$_SESSION['id']."";
      $result=mysqli_query($connection,$query);
    
     
    } else {
      header('Location: ' .URL. 'login.php');
      
    }

    if(!empty($query))
    {
    echo "<div class='container big'>
        <div class='row'>
          <div class='col-1'>ID</div>
          <div class='col-3'>Name</div>
          <div class='col-1'>Type</div>
          <div class='col-2'>Measure</div>
          <div class='col-2'>Status</div>
          <div class='col-3'>Actions</div>
        </div>";
        while($row=mysqli_fetch_assoc($result))
        {
        echo "<div class='row row-profile'>
        <div class='col-1'>".$row['PatientID']."</div>
            <div class='col-3'>
              <img src=".$row['Img']." width='48' height='48' alt='' style='border-radius: 50%'>
              ".$row['name']."
            </div>            
            <div class='col-1'>".$row['Type']."</div>
            <div class='col-2'>".$row['Sugar_Level']." mg/dL</div>
            <div class='col-2'>
              <span id='network'></span>
            </div>
            <div class='col-3'>
            <form action='index.php' method='POST' class='deleteForm'>
              <input type='hidden' name='PatientID' value='".$row['PatientID']."'>
              <button type='button' class='custom-bg-color' title='Select User' onclick=\"window.location.href='patient.php?id=".$row['PatientID']."';\">Select</button>
              <button type='button' class='btn btn-secondary rounded-circle'  onclick=\"window.location.href='Update_Patient.php?id=".$row['PatientID']."';\" data-toggle='tooltip' data-placement='top' title='Edit User'><i class='fas fa-pen'></i></button>
              <button type='submit' class='btn btn-danger rounded-circle' data-toggle='tooltip' data-placement='top' title='Delete User'><i class='fas fa-times'></i></button>
            </form>
            </div>
          </div>";
        }
        echo "</div>";

      }
    ?>
    </main>
    <footer>
      <span>&copy; Copyright 2023 SmartSugar</span>   
    </footer class=footer>
    <script src="js/script.js"></script>
  </body>
</html>