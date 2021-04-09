<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shield 4.0</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="./CSS/style.css">
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="./JS/init.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-auth.js"></script>
    
    <link rel="stylesheet" href="./CSS/signin.css">
    <script src="./JS/login.js"></script>
</head>

<body>


    <div class="container" id="loading">
        <center>
            <br><br><br>
            <h1>
                LOADING.....
            </h1>
            <H3>
                PLEASE WAIT.
            </H3>
        </center>
    </div>





    <!-- login form -->
    <div class="form-signin" id="main-content-div">

        <form action="" onsubmit="return validateLogin()">
            <center>
                <img class="mb-4" src="./images/shield_logo.png" alt="" width="100">
            </center>
            <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

            <div class="form-group">
                <input type="email" name="email" id="email" class="form-control" placeholder="Enter Email Address Here" required>
                <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Login" class="btn btn-success btn-lg w-100">
                <br>
                <input type="reset" value="Reset" class="btn btn-danger w-100">
            </div>

        </form>
    </div>

<?php include "./footer.php"; ?>