<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - TrExpense</title>
   
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Account - TrExpense</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Favicons -->
    <link href="https://i.ibb.co/m0qwzgZ/trexpense-favicon.png" rel="icon">
    <link href="https://i.ibb.co/kG3Pn2M/trexpense-apple-touch-icon.png" rel="apple-touch-icon">
    <!-- My CSS -->
    <link rel="stylesheet" href="styles.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <!-- <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="index.php"><img src="https://i.ibb.co/x74SzZ2/techwave-favicon.png"> TechWave</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 mr-auto">
              <li class="nav-item">
                <a class="nav-link " aria-current="page" href="index.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="register.php">Register</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="#">Login</a>
              </li>
              
              
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-secondary" type="submit">Search</button>
            </form>
          </div>
        </div>
    </nav> -->

    <?php
      include_once('nav-common.php');
    ?>

    <div class="container mb-5">
        <h3 class="display-4 text-center mt-5 mb-4">Welcome Back!</h3>
        <hr class="my-4">
    </div>
    <div class="container d-flex justify-content-center">
        <form action="dblogin.php" method="POST" class="loginform mb-5 text-center">
            <div class="mb-4 ">
             
              <input type="text" class="form-control data-in text-center" onkeyup="hideAlertBox()" id="username" name="email" aria-describedby="userNameHelp" placeholder="Username">
            </div>
            <div class="mb-4">
              <input type="password" class="form-control data-in text-center" id="password" name="password" placeholder="Password">
            </div>
            <div class="mb-4 row">
                <div class="col-md-6">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="rememberMe" name="rememberMe">
                    <label class="form-check-label" for="rememberMe">
                      Remember Me
                    </label>
                  </div>
                </div>
                <div class="col-md-6 text-md-right">
                  <a href="#">Forgot Password?</a>
                </div>
              </div>
            <button type="submit" class="btn submit-btn btn-dark mt-4 mb-3">Login</button>
            <div><p class="text-center mt-2">Don't have an account? <a href="register.php">Register</a></p></div>
            <?php

              if(isset($_GET['error'])) {
                echo('
                <div id="alertbox" class="alert alert-danger mt-3" role="alert">
                    Email or Password is incorrect
                </div>');
              }

            ?>
          </form>
    </div>
          
    <!-- Hide alertbox JS -->
    <script>
      function hideAlertBox() {
        const alertBox = document.getElementById("alertbox");
        alertBox.style.display = "none";
      }
    </script>

    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>