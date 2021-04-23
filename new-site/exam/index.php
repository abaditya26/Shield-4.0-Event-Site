<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shield 4.0</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">
    <link rel="shortcut icon" href="../images/shield_logo.png" type="image/x-icon">
    <link rel="stylesheet" href="../CSS/login.css">
</head>

<body>


    <!-- goto top button -->
    <div>
        <button onclick="topFunction()" id="scrollButton" title="Go to top">
            <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-up" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 0 1-.708-.708l6-6z" />
            </svg>
        </button>
    </div>
    <!-- goto top end -->


    <div class="header">

        <center>
        <div class="top-header-div">
                <img src="../images/gpj_logo.png" alt="GPJ Logo" style="width: 100px;height: 100px;">
                <h4 class="font-styled-header">
                    Government Polytechnic ,Jalgaon <br>
                    (An Institute of Government Of Maharashtra) <br>
                    Since 1960
                </h4>
            </div>
        </center>
    </div>

    <div class="container" id="loading" style="display: none;">
        <center>
            <br><br><br>
            <h3 class="font-styled-header">
                Loading ...
            </h3>
            <br><br><br>
        </center>
    </div>

    <div class="container"id="main">
    
    <form action="" method="post" onsubmit="return false">
            <div id="title">
                <center>
                    <img src="../images/shield_title.png" alt="Shield 4.0" style="max-width: 80%; margin-left: 30px; margin-right: 30px;">
                    <h3>4.0</h3>
                    <h4>Exam Login</h4>
                </center>
            </div>

            <div class="form-group">
                <input type="tel" name="phoneNo" id="phoneNo" class="form-control" required placeholder="Enter Phone Number">
                <div id="recaptcha-container"></div>
                <input type="button" id="sendOtpBtn" value="Send OTP" class="btn btn-primary w-100" onclick="sendOtp()">
            </div>

            <div class="form-group" id="otpLayout">
                <input type="number" name="otpInput" id="otpInput" class="form-control" required placeholder="Enter OTP">
                <input type="button" value="Validate OTP" class="btn btn-success btn-lg w-100" id="validateOtpBtn" onclick="validateOtp()">
            </div>

        </form>
    </div>
<br><br><br>

</body>
</html>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
<script src="../JS/init.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-database.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-auth.js"></script>

<script src="./JS/index.js"></script>