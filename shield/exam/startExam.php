<?php 
if(!isset($_POST['examId'])){
   
    ?>
    <script>
        alert('invalid navigation');
        document.location='./';
    </script>
    <?php
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shield 4.0</title>

    <link rel="shortcut icon" href="./images/shield_logo.png" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css"
        integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <link rel="stylesheet" href="../CSS/style.css">
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js"></script>
    <script src="../JS/init.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-database.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.3.2/firebase-auth.js"></script>

    <?php 
    ?>
    <script>
        const examId = "<?php echo $_POST['examId']; ?>";
    </script>
    <?php
    ?>

    <script src="../JS/exam.js"></script>

    <style>
        .card-quiz{
            background-color: rgba(255, 255, 255, 0.8);
        }
    </style>

</head>

<body oncopy="return copyFunc()">

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

    
    <div class="welcomeContainer">
        <div class="row">
            <div class="col-md-6">
                <center>
                    Welcome <u><span id="userName">Loading User Data...</span></u>
                </center>
            </div>
            <div class="col-md-6">
                <center>
                    Exam :- <u><span id="examName">Loading Exam Details...</span></u>
                    <button id="endExamBtn" class="btn btn-danger" onclick="endExam()">End Exam</button>
                </center>
            </div>
            <div class="col-md-12">
                <center>
                    <h5>
                        Remaining Time :- <u><span id="timeRemaining">Loading Exam....</span></u>
                    </h5>
                </center>
            </div>
        </div>
    </div>


    <div class="container" id="loading">
        <br><br><br><br>
        <center>
            <h1>
                Loading...
            </h1>
        </center>
    </div>

    <div class="container" id="main-content-div"  style="padding-top: 40px;">
        <div class="main">
            <div style="font-size: 20px;"> Que <span id="questionNo">1</span>. <span id="question"></span></div>
            <br>
            <div id="options">
                <div class="form-group">
                    <input type="radio" name="option" id="option1" onclick="selectOption(1)">
                    <label for="option1"><span id="option1Text"></span></label>
                </div>
                <div class="form-group">
                    <input type="radio" name="option" id="option2" onclick="selectOption(2)">
                    <label for="option2"><span id="option2Text"></span></label>
                </div>
                <div class="form-group">
                    <input type="radio" name="option" id="option3" onclick="selectOption(3)">
                    <label for="option3"><span id="option3Text"></span></label>
                </div>
                <div class="form-group">
                    <input type="radio" name="option" id="option4" onclick="selectOption(4)">
                    <label for="option4"><span id="option4Text"></span></label>
                </div>
            </div>
            <br><br>
            <div id="buttons">
                <button id="previous" onclick="prevQuestion()" class="btn btn-secondary">
                    Previous
                </button>
                <button id="next" onclick="nextQuestion()" class="btn btn-success">
                    Save & Next
                </button>
                <span style="color: red; font-size: 11px;">
                    *End Exam Button on last question
                </span>
            </div>
        </div>
        <div id="naviation">
            <div class="row">
                <div class="col-md-4">
                    <!-- user camera preview -->
                    <video autoplay="true" id="videoElement"></video>
                </div>
                <div class="col-md-4">
                    <!-- question numbers -->
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>
    </div>

</body>

</html>

<script>
    function logoutUser(){
        if(confirm('Do You Want To Log Out')){
            document.location='../logout.html'
        }
    }
</script>