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

    .login-control {
        padding: 20px;
        padding-top: 25px;
        padding-bottom: 25px;
    }
</style>

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
            <input type="reset" value="Reset" class="btn btn-danger mb-2 mr-2">
            <input type="button" value="Verify" onclick="verifyOtp()" class="btn btn-success mb-2 mr-2">
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
            <br>
            <span style="color:red;">For Diploma students only<br>*project competition for Computer Engineering and Information Technology department only.</span>
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
            <label for="department">
                Department/Branch
            </label>
            <input type="text" name="department" id="department" class="form-control" required placeholder="Enter Department/Branch">
        </div>
        <div class="form-group">
            <label for="collageName">
                College Name
            </label>
            <input type="text" name="collageName" id="collageName" class="form-control" required placeholder="Enter College Name">
        </div>
        <div class="form-group">
            <label for="collageCity">
                College City/Town
            </label>
            <input type="text" name="collageCity" id="collageCity" class="form-control" required placeholder="Enter College City">
        </div>
        <div class="form-group">
            <label for="event">
                Select Event
            </label>
            <select name="event" id="event" class="form-control" onchange="verifyIfPro()">
                <option value="select">--Select Event--</option>
                <?php for ($i = 0; $i < sizeof($eventData); $i++) {
                    // disable chess
                    //  if($eventData[$i][0]=="chess"){
                    //     continue;
                    //  }

                ?>
                    <option value="<?php echo $eventData[$i][0]; ?>" <?php if ($eId == $eventData[$i][0]) {
                                                                            echo "selected";
                                                                        } ?>><?php echo $eventData[$i][1]; ?></option>
                <?php
                } ?>
            </select>
        </div>
        <div class="form-group" id="talent-link-div">
            <label for="link-talent">
                Link For Your Video
            </label>
            <input type="text" name="link-talent" id="link-talent" class="form-control" placeholder="Enter Your Video Link here">
        </div>
        <div class="container" id="prodiv" style="display: none; border:ridge; padding:10px;border-radius: 15px;">
            <div class="form-group">
                <label for="participantCount">
                    Select Number Of Participants for your team (Participants Should Be From Same Collage)
                </label>
                <select name="participantCount" id="participantCount" class="form-control" onchange="enableEntries()">
                    <option value="0">1</option>
                    <option value="1">2</option>
                    <option value="2">3</option>
                    <option value="3">4</option>
                </select>
            </div>
            <br>
            <div class="container" id="participant1div" style="border: ridge;display: none; padding:10px; border-radius: 15px;">
                <div class="form-group">
                    <label for="participant1name">
                        Name of Participant 2
                    </label>
                    <input type="text" name="participant1name" id="participant1name" class="form-control" placeholder="Enter Participant 1 Name">
                </div>
                <div class="form-group">
                    <label for="participant1email">
                        Email Of Participant 2
                    </label>
                    <input type="email" name="participant1email" id="participant1email" class="form-control" placeholder="Enter Email Of Participant 1">
                </div>
            </div>
            <br>
            <div class="container" id="participant2div" style="border: ridge; padding:10px;display: none; border-radius: 15px;">
                <div class="form-group">
                    <label for="participant2name">
                        Name of Participant 3
                    </label>
                    <input type="text" name="participant2name" id="participant2name" class="form-control" placeholder="Enter Participant 2 Name">
                </div>
                <div class="form-group">
                    <label for="participant2email">
                        Email Of Participant 3
                    </label>
                    <input type="email" name="participant2email" id="participant2email" class="form-control" placeholder="Enter Email Of Participant 2">
                </div>
            </div>
            <br>
            <div class="container" id="participant3div" style="border: ridge; padding:10px;display: none; border-radius: 15px;">
                <div class="form-group">
                    <label for="participant3name">
                        Name of Participant 4
                    </label>
                    <input type="text" name="participant3name" id="participant3name" class="form-control" placeholder="Enter Participant 3 Name">
                </div>
                <div class="form-group">
                    <label for="participant3email">
                        Email Of Participant 4
                    </label>
                    <input type="email" name="participant3email" id="participant3email" class="form-control" placeholder="Enter Email Of Participant 3">
                </div>
            </div>
        </div>
        <br>
        <div class="form-group">
            <input type="submit" value="Submit" class="btn btn-success">
        </div>

        <center>
            <!--<span style="color:red;">*chess entries are full</span>-->
        </center>
    </form>
</div>

<br><br>

<?php include "./footer.php"; ?>
<script>
    var userData = [];
    var userId = "";
    var flag1 = false;
    var flag2 = false;

    window.onload = function() {
        hideOtpBtn();
        window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
            'size': 'normal',
            'callback': (response) => {
                flag1 = true;
                showOtpBtn();
            }
        });
        showLoading();
        recaptchaVerifier.render();
        // check if user is already log in
        firebase.auth().onAuthStateChanged(function(user) {
            if (user) {
                checkIfUserExist(user);
            } else {
                showLogin();
            }
        });
        verifyIfPro();
    }

    function checkIfUserExist(user) {
        userId = user.uid;
        firebase.database().ref('Users/' + user.uid).once('value').then((snapshot) => {
            if (snapshot.child("name").exists()) {
                const data = snapshot.val();
                try {
                    const name = data.name;
                    const phoneNo = data.phoneNo;
                    const collage = data.collageName;
                    const city = data.collageCity;
                    const email = data.emailId;
                    userData = {
                        name: name,
                        phoneNo: phoneNo,
                        collageName: collage,
                        collageCity: city,
                        emailId: email
                    };
                    // todo: send to view
                    document.getElementById('old-reg-btn').style.display = "block";
                    document.getElementById('name').value = name;
                    document.getElementById('email').value = email;
                    document.getElementById('collageName').value = collage;
                    document.getElementById('collageCity').value = city;
                } catch (e) {
                    alert(e);
                    console.log(e);
                }
            }
            // show the registration form
            console.log(user);
            if (user.phoneNumber == undefined) {
                firebase.auth().signOut()
                    .then(function() {
                        document.location = './registration.php';
                    }).catch(function(error) {
                        // An error happened.
                        alert(error);
                    });
            }
            document.getElementById('phoneNumber').value = user.phoneNumber + ""
            document.getElementById('phoneNo').value = user.phoneNumber + ""
            showRegistration();
        }).catch((error) => {
            alert('error');
            console.log(error)
            showRegistration();
        });
    }

    function generateOtp() {
        var number = document.getElementById('phoneNo').value;
        if (number.length < 10) {
            alert('enter valid number');
            return;
        }
        showLoading();
        const appVerifier = window.recaptchaVerifier;
        if (!number.includes('+91', 0)) {
            number = "+91" + number;
        }

        // show otp view

        firebase.auth().signInWithPhoneNumber(number, appVerifier).then((result) => {
            window.confirmationResult = result;
            alert('OTP SENT. VALIDATE OTP.');
            showOtpInput();
            showLogin();
        }).catch((err) => {
            console.log(err);
            showLogin();
        });

    }

    function showOtpInput() {
        document.getElementById('otp-div').style.display = "block";
        document.getElementById('recaptcha-container').style.display = "none";
        hideOtpBtn();
    }

    function verifyOtp() {
        showLoading();
        const code = document.getElementById('otp-input').value;
        confirmationResult.confirm(code).then((result) => {
            const user = result.user;
            checkIfUserExist(user);
        }).catch((e) => {
            console.log(e);
            showOtpInput();
            showLogin();
            alert(e);
        });
    }


    function showLoading() {
        document.getElementById('loading').style.display = "block";
        document.getElementById('otpVerificationForm').style.display = "none";
        document.getElementById('registrationForm').style.display = "none";
    }

    function showLogin() {
        document.getElementById('loading').style.display = "none";
        document.getElementById('otpVerificationForm').style.display = "block";
        document.getElementById('registrationForm').style.display = "none";
    }

    function showRegistration() {
        document.getElementById('loading').style.display = "none";
        document.getElementById('otpVerificationForm').style.display = "none";
        document.getElementById('registrationForm').style.display = "block";
    }

    function showOtpBtn() {
        if (flag1 && flag2) {
            document.getElementById('sendOtpBtn').style.display = "block";
        }
    }

    function hideOtpBtn() {
        document.getElementById('sendOtpBtn').style.display = "none";
    }

    function resendOtp() {
        hideOtpBtn();
        document.getElementById('otp-div').style.display = "none";
        document.getElementById('recaptcha-container').style.display = "block";
    }


    // code for registration



    function registerUser() {
        const name = document.getElementById('name').value;
        const email = document.getElementById('email').value;
        const phoneNo = document.getElementById('phoneNumber').value;
        const collageName = document.getElementById('collageName').value;
        const collageCity = document.getElementById('collageCity').value;
        const event = document.getElementById('event').value;
        const department = document.getElementById('department').value;

        if (validateUserInput()) {

            showLoading();

            userData = {
                name: name,
                phoneNo: phoneNo,
                collageName: collageName,
                collageCity: collageCity,
                emailId: email,
                uid: userId,
                department: department
            };


            // check if the user has already registered for the current event

            firebase.database().ref('Events/' + event + '/' + userId).once('value').then((snapshot) => {
                if (snapshot.child('uid').exists()) {
                    if (confirm('You have already registered to this event.\nDo You want to overwrite entry?')) {
                        //do entry
                        registerEntry(userData, event);
                    } else {
                        //cancel entry
                        document.location = './registration.php';
                    }
                } else {
                    registerEntry(userData, event);
                }
            }).catch((e) => {
                alert('Error. Your data does not exist. please register first.');
                console.log(e);
                document.location = '../'
            });
        }

        return false;
    }


    function registerEntry(user, event) {
        firebase.database().ref('Users/' + user.uid).set(user).then((result) => {
            console.log('asd')
            if (event == "project") {
                const c = parseInt(document.getElementById('participantCount').value);
                console.log(c)
                firebase.database().ref('Events/' + event + '/' + user.uid + '/Participant1').set({
                    name: user.name,
                    phoneNo: user.phoneNo,
                    collageName: user.collageName,
                    collageCity: user.collageCity,
                    emailId: user.emailId,
                    uid: user.uid,
                    event: event,
                    department: user.department,
                    type: "participant",
                    date: getDateTime()
                }).then((res) => {
                    var ct = 0;
                    if (ct == 0) {
                        firebase.database().ref('Registrations/' + user.uid + '/' + event).set({
                            uid: user.uid,
                            event: event
                        }).then((r) => {
                            alert('Registration Complete.');
                            document.location = './viewRegistrations.php';
                        }).catch((e1) => {
                            alert('Entry Registration incomplete');
                            showRegistration();
                            firebase.database().ref('Events/' + event + '/' + user.uid).removeValue();
                        });
                    }
                    console.log('reg1')
                    for (i = 0; i < c; i++) {
                        const n = document.getElementById('participant' + (i + 1) + 'name').value;
                        const e = document.getElementById('participant' + (i + 1) + 'email').value;
                        firebase.database().ref('Events/' + event + '/' + user.uid + '/Participant' + (i + 2)).set({
                            name: n,
                            phoneNo: user.phoneNo,
                            collageName: user.collageName,
                            collageCity: user.collageCity,
                            emailId: e,
                            uid: user.uid,
                            event: event,
                            department: user.department,
                            type: "participant",
                            date: getDateTime()
                        }).then((res) => {
                            ct++;
                            console.log(ct)
                            console.log(c)
                            if (ct == c) {
                                firebase.database().ref('Registrations/' + user.uid + '/' + event).set({
                                    uid: user.uid,
                                    event: event
                                }).then((r) => {
                                    alert('Registration Complete.');
                                    document.location = './viewRegistrations.php';
                                }).catch((e1) => {
                                    alert('Entry Registration incomplete');
                                    showRegistration();
                                    firebase.database().ref('Events/' + event + '/' + user.uid).removeValue();
                                });
                            }
                        }).catch((error1) => {
                            console.log(error1);
                        });
                    }
                }).catch((error1) => {
                    console.log(error1);
                });
            } else {
                if (event == "talent") {
                    var link = document.getElementById('link-talent').value;
                    firebase.database().ref('Events/' + event + '/' + user.uid).set({
                        name: user.name,
                        phoneNo: user.phoneNo,
                        collageName: user.collageName,
                        collageCity: user.collageCity,
                        emailId: user.emailId,
                        uid: user.uid,
                        event: event,
                        department: user.department,
                        type: "participant",
                        link: link,
                        date: getDateTime()
                    }).then((result1) => {
                        firebase.database().ref('Registrations/' + user.uid + '/' + event).set({
                            uid: user.uid,
                            event: event
                        }).then((r) => {
                            alert('Registration Complete.');
                            document.location = './viewRegistrations.php';
                        }).catch((e1) => {
                            alert('Entry Registration incomplete');
                            showRegistration();
                            firebase.database().ref('Events/' + event + '/' + user.uid).removeValue();
                        });
                    }).catch((error) => {
                        alert('Error => ' + error);
                        console.log(error)
                    });
                } else {
                    if (event == "CQuiz" || event == "GkQuiz") {
                        firebase.database().ref('Events/' + event).once('value').then((s2) => {
                            var totalEntries = 0;
                            s2.forEach(element => {
                                totalEntries++;
                            });
                            if (totalEntries >= 250) {
                                alert('Sorry! Entry Full!');
                            } else {
                                firebase.database().ref('Events/' + event + '/' + user.uid).set({
                                    name: user.name,
                                    phoneNo: user.phoneNo,
                                    collageName: user.collageName,
                                    collageCity: user.collageCity,
                                    emailId: user.emailId,
                                    uid: user.uid,
                                    event: event,
                                    department: user.department,
                                    type: "participant",
                                    date: getDateTime()
                                }).then((result1) => {
                                    firebase.database().ref('Registrations/' + user.uid + '/' + event).set({
                                        uid: user.uid,
                                        event: event
                                    }).then((r) => {
                                        alert('Registration Complete.');
                                        document.location = './viewRegistrations.php';
                                    }).catch((e1) => {
                                        alert('Entry Registration incomplete');
                                        showRegistration();
                                        firebase.database().ref('Events/' + event + '/' + user.uid).removeValue();
                                    });
                                }).catch((error) => {
                                    alert('Error => ' + error);
                                    console.log(error)
                                });
                            }
                        }).catch((error2) => {
                            console.log(error2);
                            alert(error2);
                        })
                    } else {
                        console.log('12')
                        firebase.database().ref('Events/' + event + '/' + user.uid).set({
                            name: user.name,
                            phoneNo: user.phoneNo,
                            collageName: user.collageName,
                            collageCity: user.collageCity,
                            emailId: user.emailId,
                            uid: user.uid,
                            event: event,
                            department: user.department,
                            type: "participant",
                            date: getDateTime()
                        }).then((result1) => {
                            console.log('1')
                            firebase.database().ref('Registrations/' + user.uid + '/' + event).set({
                                uid: user.uid,
                                event: event
                            }).then((r) => {
                                alert('Registration Complete.');
                                document.location = './viewRegistrations.php';
                            }).catch((e1) => {
                                alert('Entry Registration incomplete');
                                showRegistration();
                                firebase.database().ref('Events/' + event + '/' + user.uid).removeValue();
                            });
                        }).catch((error) => {
                            alert('Error => ' + error);
                            console.log(error)
                        });
                    }
                }
            }
        }).catch((e) => {
            alert('Error => ' + e);
            console.log(e)
        });
        return false;
    }


    function validateUserInput() {
        const e = document.getElementById('event').value;
        if (e == "select") {
            alert('Please select event');
            return false;
        }
        if (e == "talent") {
            var link = document.getElementById('link-talent').value;
            if (link == undefined || link == "") {
                alert('Link For your talent\'s video is required.');
                showRegistration();
                return false;
            }
            if (!isValidHttpUrl(link)) {
                alert('URL is not valid');
                return false;
            }
        }
        return true;
    }

    function isValidHttpUrl(string) {
        let url;

        try {
            url = new URL(string);
        } catch (_) {
            return false;
        }

        return url.protocol === "http:" || url.protocol === "https:";
    }




    function enableEntries() {
        const c = parseInt(document.getElementById('participantCount').value);
        if (c == 0) {
            document.getElementById('participant1div').style.display = "none";
            document.getElementById('participant2div').style.display = "none";
            document.getElementById('participant3div').style.display = "none";
        }
        if (c >= 1) {
            document.getElementById('participant1div').style.display = "block";
            document.getElementById('participant2div').style.display = "none";
            document.getElementById('participant3div').style.display = "none";
        }
        if (c >= 2) {
            document.getElementById('participant2div').style.display = "block";
            document.getElementById('participant3div').style.display = "none";
        }
        if (c >= 3) {
            document.getElementById('participant3div').style.display = "block";
        }
    }


    function verifyIfPro() {
        const e = document.getElementById('event').value;
        if (e == "project") {
            document.getElementById('prodiv').style.display = "block";
        } else {
            document.getElementById('prodiv').style.display = "none";
        }
        if (e == "talent") {
            document.getElementById('talent-link-div').style.display = "block"
        } else {
            document.getElementById('talent-link-div').style.display = "none"
        }
    }


    document.getElementById('phoneNo').addEventListener('input', function(evt) {
        const d = document.getElementById('phoneNo').value;
        if (d == "") {
            flag2 = false;
            hideOtpBtn();
        } else {
            flag2 = true;
            showOtpBtn();
        }
    })


    function getDateTime() {
        var today = new Date();

        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

        return date + " " + time;
    }
</script>
<!-- <script src="./JS/registration.js"></script> -->