<?php
include "db.php";
include "config.php";
$message="";

if(!empty($_POST['email']))
{
  $query1="SELECT * FROM tbl_203_users where email='".$_POST['email']."'";
  $result1=mysqli_query($connection,$query1);
  $row=mysqli_fetch_assoc($result1);
  if(!$row)
  {
    $query1="SELECT * FROM tbl_203_users where name=".$_POST['fullname']."";

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
  
    $phone=$_POST['phone'];
    $usertype=$_POST['type'];

    $query="INSERT INTO tbl_203_users (name,password,email,img,phone,user_type) VALUES ('$fullname','$password','$email','$targetFile', '$phone', '$usertype')";
    $result=mysqli_query($connection,$query);
    if($result&&mysqli_affected_rows($connection)>0)
    {
      $message="Register succesfull";
    }
    else
    { 
      $message="Register Failed";
    }
  }
  else
  { 
    $message="Email exist";
  } 
}

?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  </head>

  <body>
<div class="vh-100 d-flex justify-content-center align-items-center">
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-12 col-md-8 col-lg-6">
        <div class="border border-3 border-primary"></div>
        <div class="card bg-white shadow-lg">
          <div class="card-body p-5">
            <form class="mb-3 mt-md-4" action="#" method="post" enctype="multipart/form-data" id="register">
              <h2 class="fw-bold mb-2 text-uppercase ">Register</h2>
              <p class=" mb-5">Please fill the fields</p>
              <div class="mb-3">
                <label for="fullname" class="form-label ">Full name</label>
                <input type="text" class="form-control" name="fullname" id="fullname" pattern="^[A-Za-z]+(?:\s[A-Za-z]+)+$" required>
              </div>
              <div class="mb-3">
                <label for="email" class="form-label ">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com" required>
              </div>
              <div class="mb-3">
                <label for="password" class="form-label ">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="***" required>
              </div>
              <div class="mb-3">
                <label for="formFileSm" class="form-label">Choose image</label>
                <input  name="img" class="form-control form-control-sm" id="formFileSm" type="file" accept=".png, .jpg, .jpeg">
              </div>
              <div class="mb-3">
                <label for="phone" class="form-label ">Phone</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
              </div>
              <select name="type" class="form-select mb-3-top" aria-label="Default select example">
                <option selected disabled>Choose user type</option>
                <option value="admin">admin</option>
                <option value="user">user</option>
              </select>
              <br>
                <button class="btn btn-outline-dark" type="submit">Register</button>
              </div>
            </form>
            <div>
              <p class="mb-0  text-center">have an account? <a href="login.php"
                  class="text-primary fw-bold">Sign
                  In</a></p>
                 
                    <?php if($message!="Register succesfull" && $message!="")
                     {
                      echo "<div class='alert alert-danger' role='alert'> $message </div>";
                     }
                     if($message=="Register succesfull")
                     {
                      echo "<div class='alert alert-success' role='alert'> $message </div>";
                      echo "<script>setTimeout(function(){ window.location.href = '".URL."login.php'; }, 2000);</script>";
                      mysqli_close($connection);
                      $message="";
                     }
                    ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script src="js/register.js"></script>
  </body>
</html>