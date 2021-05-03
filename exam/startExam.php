<?php
if (isset($_POST['examId'])) {
} else {
    echo "<script>alert('invalid navigation');document.location='./dashboard.php';</script>";
    exit;
}
?>

<?php include "./header.php"; ?>
<div id="main">
    <hr class="hr" style="border-color: white; margin: 5px;">
    <div class="row" style="max-width: 100%;">
        <div class="col-md-4" style="margin-top: 5px;padding: 0;">
            <center>
                <h5 class="font-styled-header" style="margin: 0px;">
                    Shield 4.0
                </h5>
            </center>
        </div>
        <div class="col-md-4" style="margin-top: 5px;padding: 0;">
            <center>
                <h5 class="font-styled-header" style="margin: 0px;">
                    Exam :- <?php echo $_POST['examId']; ?>
                </h5>
            </center>
        </div>
        <div class="col-md-4" style="margin: 0px; padding: 0;">
            <center>
                <button class="btn btn-danger btn-sm" style="margin: 0; " onclick="endExam()">End Exam</button>
            </center>
        </div>
    </div>
    <hr class="hr" style="border-color: white; margin: 4px;"><br>
    <div class="container" style="border: ridge; border-radius: 15px;"><br>
        <span>
            <center>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-stopwatch" viewBox="0 0 16 16">
                    <path d="M8.5 5.6a.5.5 0 1 0-1 0v2.9h-3a.5.5 0 0 0 0 1H8a.5.5 0 0 0 .5-.5V5.6z" />
                    <path d="M6.5 1A.5.5 0 0 1 7 .5h2a.5.5 0 0 1 0 1v.57c1.36.196 2.594.78 3.584 1.64a.715.715 0 0 1 .012-.013l.354-.354-.354-.353a.5.5 0 0 1 .707-.708l1.414 1.415a.5.5 0 1 1-.707.707l-.353-.354-.354.354a.512.512 0 0 1-.013.012A7 7 0 1 1 7 2.071V1.5a.5.5 0 0 1-.5-.5zM8 3a6 6 0 1 0 .001 12A6 6 0 0 0 8 3z" />
                </svg>
                Time Remaining :- <span id="timerDiv"></span>
            </center>
        </span>
        <div class="progress">
            <div class="progress-bar" role="progressbar" id="timeProgressBar" style="width: 100%; color: black;"></div><br>
        </div>

        <hr class="hr" style="border-color: white;">

        <div class="mainContainer">
            <div class="question">
                Question :
                <span id="questionId">
                    1/10
                </span><br>
                <h5 id="question">
                    Question Text Shall Go Here including image
                </h5>
            </div>
            <br>

            <div id="optionsDiv">
                <div class="form-group">
                    <input type="radio" name="options" id="option1" onclick="selectOption(1)">
                    <label for="option1">
                        <span id="option1Text">Option 1 Text Goes Here</span>
                    </label>
                </div>
                <div class="form-group">
                    <input type="radio" name="options" id="option2" onclick="selectOption(2)">
                    <label for="option2">
                        <span id="option2Text">Option 2 Text Goes Here</span>
                    </label>
                </div>
                <div class="form-group">
                    <input type="radio" name="options" id="option3" onclick="selectOption(3)">
                    <label for="option3">
                        <span id="option3Text">Option 3 Text Goes Here</span>
                    </label>
                </div>
                <div class="form-group">
                    <input type="radio" name="options" id="option4" onclick="selectOption(4)">
                    <label for="option4">
                        <span id="option4Text">Option 4 Text Goes Here</span>
                    </label>
                </div>
            </div>
            <div class="controls">
                <hr class="hr" style="border-color: white;">
                <center>
                    <button class="btn btn-primary" onclick="changeQuestion(-1)">Previous</button>
                    <button class="btn btn-primary" onclick="changeQuestion(1)">&nbsp;&nbsp;&nbsp;Next&nbsp;&nbsp;&nbsp;&nbsp;</button>
                </center>
                <hr class="hr" style="border-color: white;">
            </div>
            <div class="row" id="views">
                <div class="col-md-4">
                    <center>
                        <h5>
                            Overall Summary
                        </h5>
                    </center>
                    Total Questions :- 25 <br>
                    Attempted Questions :- <span id="attemptedQuestionCount">0</span><br>
                    Not Attempted Questions :- <span id="notAttemptedQuestionCount">25</span>
                </div>
                <div class="col-md-4">
                    <center>
                        <video autoplay="true" id="videoElement"></video>
                    </center>
                </div>
                <div class="col-md-4"></div>
            </div>
        </div>

        <br>
    </div>
</div>
<br><br>
<?php include "./footer.php"; ?>
<script>
    const quizId = '<?php echo $_POST['examId']; ?>';
</script>
<script src="./JS/exam.js"></script>