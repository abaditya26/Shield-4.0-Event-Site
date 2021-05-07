var userData = [];
var userId = "";
var flag1 = false;
var flag2 = false;

window.onload = function () {
    hideOtpBtn();
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        'size': 'normal',
        'callback': (response) => {
            flag1 = true;
            showOtpBtn();
        }
    });
    recaptchaVerifier.render();

    showLoading();
    // check if user is already log in
    firebase.auth().onAuthStateChanged(function (user) {
        if (user) {
            checkIfUserExist(user);
        } else {
            showLogin();
        }
    });
    verifyIfPro()
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
                .then(function () {
                    document.location = './registration.php';
                }).catch(function (error) {
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
    if(flag1 && flag2){
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

    if (validateUserInput()) {

        showLoading();

        userData = {
            name: name,
            phoneNo: phoneNo,
            collageName: collageName,
            collageCity: collageCity,
            emailId: email,
            uid: userId
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
            alert('error');
            console.log(e);
        });
    }

    return false;
}

function registerEntry(user, event) {
    firebase.database().ref('Users/' + user.uid).set(user).then((result) => {
        if (event == "project") {
            const c = parseInt(document.getElementById('participantCount').value);
            firebase.database().ref('Events/' + event + '/' + user.uid + '/Participant1').set({
                name: user.name,
                phoneNo: user.phoneNo,
                collageName: user.collageName,
                collageCity: user.collageCity,
                emailId: user.emailId,
                uid: user.uid,
                event: event,
                type: "participant"
            }).then((res) => {
                var ct = 0;
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
                        type: "participant"
                    }).then((res) => {
                        ct++;
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
            firebase.database().ref('Events/' + event + '/' + user.uid).set({
                name: user.name,
                phoneNo: user.phoneNo,
                collageName: user.collageName,
                collageCity: user.collageCity,
                emailId: user.emailId,
                uid: user.uid,
                event: event,
                type: "participant"
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
            });
        }
    }).catch((e) => {
        alert('Error => ' + e);
    });
    return false;
}


function validateUserInput() {
    const e = document.getElementById('event').value;
    if (e == "select") {
        alert('Please select event');
        return false;
    }
    return true;
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
}


document.getElementById('phoneNo').addEventListener('input', function (evt) {
    const d = document.getElementById('phoneNo').value;
    if(d==""){
        flag2 = false;
        hideOtpBtn();
    }else{
        flag2=true;
        showOtpBtn();
    }
})

