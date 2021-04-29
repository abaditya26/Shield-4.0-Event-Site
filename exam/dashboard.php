<?php include "./header.php"; ?>
<style>
    .card-quiz {
        background-color: rgba(255, 255, 255, 0.8);
    }
</style>
<div class="container" id="main" style="border: ridge; border-radius: 10px;">
    <hr class="hr" style="border-color: white;">
    <div class="row">
        <div class="col-md-8">
            <img src="../images/shield_logo.png" alt="Shield LOGO HERE" style="height: 100px;">
            <div style="display: inline;">
                <span class="font-styled-header" style="font-size: 20px;">SHIELD ONLINE EXAM PORTAL</span>
            </div>
        </div>
        <div class="col-md-4">
            <br>
            <center>
                Name :- <span id="name">Name Of Participant</span><br>
                Phone :- <span id="phone">Phone Of Participant</span><br>
                <button class="btn btn-danger" onclick="logoutUser()">LogOut</button>
            </center>
        </div>
    </div>
    <hr class="hr" style="border-color: white;">
    <div class="cards">
        <div class="row" id="mainList"></div>
    </div>
</div>
<?php include "./footer.php"; ?>

<script src="./JS/dashboard.js"></script>