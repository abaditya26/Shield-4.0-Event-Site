<?php include "./header.php"; ?>


<!-- registration form goes here -->

<!-- 
############################################################################
remove or change following code
follow the given IDs
############################################################################
 -->


<!-- temp code to be removed -->

<div class="container" id="loading" style="display: none;">

<center>
    Loading...
</center>

</div>

<div class="container login">
    <form action="" method="post" onsubmit="return false" id="otpVerificationForm">

        <div class="form-group">
            <input type="tel" name="phoneNo" id="phoneNo" class="form-control login-control" required placeholder="Enter Phone Number">
            <div id="recaptcha-container"></div>
            <input type="button" value="Send Otp" onclick="generateOtp()" class="btn btn-success" id="sendOtpBtn">
        </div>
        <div class="form-group">
            <input type="number" name="otp-input" id="otp-input" class="form-control" required placeholder="Enter the OTP">
            <input type="button" value="Verify" onclick="verifyOtp()" class="btn btn-success">
        </div>

    </form>
</div>


<div class="container">
    <form action="" method="post" id="registrationForm" style="display: none;" onsubmit="return registerUser()">
        <div class="form-group">
            <label for="name">
                Enter Your Name
            </label>
            <input type="text" name="name" id="name" class="form-control" required placeholder="Enter Your Name">
        </div>
        <div class="form-group">
            <label for="email">
                Enter Your Email
            </label>
            <input type="email" name="email" id="email"  class="form-control" required placeholder="Enter Your Email Address">
        </div>
        <div class="form-group">
            <label for="phoneNo">
                Phone Number
            </label>
            <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" required placeholder="Enter Phone Number" readonly>
        </div>
        <div class="form-group">
            <label for="collageName">
                Collage Name
            </label>
            <input type="text" name="collageName" id="collageName" class="form-control" required placeholder="Enter Collage Name">
        </div>
        <div class="form-group">
            <label for="collageCity">
                Collage City/Town
            </label>
            <input type="text" name="collageCity" id="collageCity" class="form-control" required placeholder="Enter Collage City">
        </div>
        <div class="form-group">
            <label for="event">
                Select Event
            </label>
            <select name="event" id="event" class="form-control">
                <option value="select">--Select Event--</option>
                <option value="CQuiz">C-Quiz</option>
                <option value="JavaQuiz">Java-Quiz</option>
            </select>
        </div>
        <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-success">
        </div>
    </form>
</div>



<?php include "./footer.php"; ?>
<script src="./JS/registration.js"></script>