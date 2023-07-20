<?php
include "db.php";
include "config.php";

session_start();
if(!empty($_POST['email']))
{

  $query="SELECT * FROM tbl_203_users WHERE email='". $_POST['email']."' and password='".$_POST['password']."'";
  $result=mysqli_query($connection,$query);
  $row=mysqli_fetch_array($result);
  if(is_array($row))
  {
   $name=$row['name'];
   $_SESSION['id']=$row['id'];
   $_SESSION['img']=$row['img'];
   $_SESSION['user_type']=$row['user_type'];
   if($_SESSION['user_type']=="admin")
      header('Location: ' .URL. 'index.php');
   else
   {
    $query1="SELECT PatientID FROM tbl_203_patients WHERE name='".$name."'";
    $result1=mysqli_query($connection,$query1);
    $row1=mysqli_fetch_array($result1);
    if($row1)
    {
    header('Location: ' .URL. 'patient.php?id='.$row1['PatientID'].'');
    }
    else $message="You Haven't patient profile";

   }

  }
  else
  { 
    $message="Invalid Email or Passowrd!";
  }
}
?>
<!DOCTYPE html>
<html lang="en">

  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
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
            <form class="mb-3 mt-md-4" action="#" method="post">
              <h2 class="fw-bold mb-2 text-uppercase ">Login</h2>
              <p class=" mb-5">Please enter your email and password</p>
              <div class="mb-3">
                <label for="email" class="form-label ">Email address</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="name@example.com">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label ">Password</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="***">
              </div>
              <p class="small"><a class="text-primary" href="forget-password.html">Forgot password?</a></p>
              <div class="d-grid">
                <button class="btn btn-outline-dark" type="submit">Login</button>
              </div>
            </form>
            <div>
              <p class="mb-0  text-center">Don't have an account? <a href="register.php"
                  class="text-primary fw-bold">Sign
                  Up</a></p>
                 
                    <?php if(isset($message))
                     {
                      echo "<div class='alert alert-danger' role='alert'> $message </div>";
                     }
                    ?>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
  </body>
</html>