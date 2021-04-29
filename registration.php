<?php include "./header.php"; ?>
<?php include "./data.php"; ?>
<?php
$eId = "";
if (isset($_GET['id'])) {
    extract(($_GET));
    $eId = $id;
}
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    .main-container {
        margin-top: 2%;
        border-radius: 10px;
        padding: 10px;
        border: inset;
        border-width: 5px;
        outline: none;
    }
</style>

<!-- registration form goes here -->

<!-- temp code to be removed -->

<div class="container" id="loading">
    <center>
        <div class="loader"></div>
    </center>
</div>

<style>
    .login {
        max-width: 330px;
    }
</style>




<div class="container" id="otpVerificationForm" style="max-width: 410px; padding: 50px; background: rgba(255,255,255,0.2); border: ridge; border-radius: 10px;">
    <div id="title">
        <center>
            <img src="./images/shield_title.png" alt="Shield 4.0" style="max-width: 80%; margin-left: 30px; margin-right: 30px;">
            <h3>4.0</h3>
            <h4>Registration</h4>
        </center>
    </div>
    <form action="" method="post" onsubmit="return false">

        <div class="form-group">
            <input type="tel" name="phoneNo" id="phoneNo" class="form-control login-control mb-3" required placeholder="Enter Phone Number">

        </div>
        <div class="form-group" align='center' style="display: none;" id="otp-div">
            <input type="number" name="otp-input" id="otp-input" class="form-control mb-2 login-control" required placeholder="Enter the OTP">
            <input type="button" value="Resend OTP" class="btn btn-secondary mb-2 mr-2" onclick="resendOtp()">
            <input type="button" value="Verify" onclick="verifyOtp()" class="btn btn-success mb-2 mr-2">
            <input type="reset" value="Reset" class="btn btn-danger mb-2 mr-2">
        </div>
        <div class="form-group">
            <center>
                <div id="recaptcha-container" style="width: 100%;"></div>
                <input type="button" value="Send Otp" onclick="generateOtp()" class="btn btn-success mb-2 mr-2" id="sendOtpBtn">
            </center>
        </div>
    </form>
</div>



<div class="container" onload="verifyIfPro()">
    <form action="" method="post" id="registrationForm" style="display: none;" onsubmit="return registerUser()">
        <center>
            <h3>
                Registrations
            </h3>
            <button onclick="document.location='./viewRegistrations.php'" type="button" id="old-reg-btn" style="display: none;" class="btn btn-sm btn-secondary">View Old Registrations</button>
        </center>
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
            <input type="email" name="email" id="email" class="form-control" required placeholder="Enter Your Email Address">
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
            <select name="event" id="event" class="form-control" onchange="verifyIfPro()">
                <option value="select">--Select Event--</option>
                <?php for ($i = 0; $i < sizeof($eventData); $i++) {
                ?>
                    <option value="<?php echo $eventData[$i][0]; ?>" <?php if ($eId == $eventData[$i][0]) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $eventData[$i][1]; ?></option>
                <?php
                } ?>
            </select>
        </div>
        <div class="container" id="prodiv" style="display: none; border:ridge; padding:10px;border-radius: 15px;">
            <div class="form-group">
                <label for="participantCount">
                    Select Number Of Participant For Your Team (Participants Should Be From Same Collage)
                </label>
                <select name="participantCount" id="participantCount" class="form-control" onchange="enableEntries()">
                    <option value="0">0</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>
            <br>
            <div class="container" id="participant1div" style="border: ridge;display: none; padding:10px; border-radius: 15px;">
                <div class="form-group">
                    <label for="participant1name">
                        Name of Participant 1
                    </label>
                    <input type="text" name="participant1name" id="participant1name" class="form-control" placeholder="Enter Participant 1 Name">
                </div>
                <div class="form-group">
                    <label for="participant1email">
                        Email Of Participant 1
                    </label>
                    <input type="email" name="participant1email" id="participant1email" class="form-control" placeholder="Enter Email Of Participant 1">
                </div>
            </div>
            <br>
            <div class="container" id="participant2div" style="border: ridge; padding:10px;display: none; border-radius: 15px;">
                <div class="form-group">
                    <label for="participant2name">
                        Name of Participant 2
                    </label>
                    <input type="text" name="participant2name" id="participant2name" class="form-control" placeholder="Enter Participant 2 Name">
                </div>
                <div class="form-group">
                    <label for="participant2email">
                        Email Of Participant 2
                    </label>
                    <input type="email" name="participant2email" id="participant2email" class="form-control" placeholder="Enter Email Of Participant 2">
                </div>
            </div>
            <br>
            <div class="container" id="participant3div" style="border: ridge; padding:10px;display: none; border-radius: 15px;">
                <div class="form-group">
                    <label for="participant3name">
                        Name of Participant 3
                    </label>
                    <input type="text" name="participant3name" id="participant3name" class="form-control" placeholder="Enter Participant 3 Name">
                </div>
                <div class="form-group">
                    <label for="participant3email">
                        Email Of Participant 3
                    </label>
                    <input type="email" name="participant3email" id="participant3email" class="form-control" placeholder="Enter Email Of Participant 3">
                </div>
            </div>
        </div>
        <br>
        <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-success">
        </div>
    </form>
</div>



<?php include "./footer.php"; ?>
<script src="./JS/registration.js"></script>