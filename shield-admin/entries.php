<?php include "./header.php"; ?>

<script src="./JS/xlsx.full.min.js"></script>
<script src="./JS/entries.js"></script>
<script lang="javascript" src="./JS/FileSaver.min.js"></script>




<nav class="navbar-light" style="padding-top: 2%; padding-bottom: 2%;" id="navbar">
    <div id="navbar1">
        <ul class="nav justify-content-center">
            <li class="nav-item active navlink">
                <a class="nav-link active" href="./">
                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-house" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M2 13.5V7h1v6.5a.5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5V7h1v6.5a1.5 1.5 0 0 1-1.5 1.5h-9A1.5 1.5 0 0 1 2 13.5zm11-11V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                        <path fill-rule="evenodd" d="M7.293 1.5a1 1 0 0 1 1.414 0l6.647 6.646a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5z" />
                    </svg>
                    <small id="home-txt">
                        Home
                    </small>
                </a>
            </li>
            <li class="nav-item navlink">
                <a class="nav-link" href="./entries.php">
                    <small id="events-txt">
                        Entries
                    </small>
                </a>
            </li>
            <li class="nav-item navlink">
                <a class="nav-link" href="./getResults.php">
                    <small id="events-txt">
                        Results
                    </small>
                </a>
            </li>
            <li class="nav-item navlink">
                <a class="nav-link" onclick="return logout()" href="#">
                    <small id="logout-txt" style="color: red;">
                        Logout
                    </small>
                </a>
            </li>
        </ul>
    </div>
    <br><br>
</nav>






<div class="container" id="loading" style="height: 400px;">
    <center>
        <br><br><br>
        <h1>
            Creating Excel.....
        </h1>
        <H3>
            PLEASE WAIT.
        </H3>
    </center>
</div>

<div class="container entries-container" id="main-content-div">

    <form action="" method="post" onsubmit="return false">
        <div class="form-group">
            <label for="event">
                Select The Event Name
            </label>
            <br>
            <input type="radio" name="event" id="CQuiz" onclick="selectQuiz('CQuiz')">
            <label for="CQuiz">
                CQuiz
            </label><br>
            <input type="radio" name="event" id="JavaQuiz" onclick="selectQuiz('JavaQuiz')">
            <label for="JavaQuiz">
                JavaQuiz
            </label>

        </div>

        <div class="form-group">
            <input type="button" id="button-download" onclick="return downloadExcel()" value="Download Entries In Excel Sheet" class="btn btn-success">
        </div>
    </form>

</div>


<?php include "./footer.php"; ?>