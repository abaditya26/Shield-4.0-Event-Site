var userData = [];
var userId = "";

window.onload = function () {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
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
                document.getElementById('old-reg-btn').style.display="block";
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
    }
    showLoading();
    const appVerifier = window.recaptchaVerifier;
    if (!number.includes('+91', 0)) {
        number = "+91" + number
    }

    // show otp view

    firebase.auth().signInWithPhoneNumber(number, appVerifier).then((result) => {
        window.confirmationResult = result;
        alert('OTP SENT. VALIDATE OTP.')
        showLogin();
    }).catch((err) => {
        console.log(err);
        showLogin();
    });

}

function verifyOtp() {
    showLoading();
    const code = document.getElementById('otp-input').value;
    confirmationResult.confirm(code).then((result) => {
        const user = result.user;
        checkIfUserExist(user);
    }).catch((e) => {
        console.log(e);
        alert(e);
    });
}


function showLoading() {
    document.getElementById('loading').style.display = "block"
    document.getElementById('otpVerificationForm').style.display = "none"
    document.getElementById('registrationForm').style.display = "none"
}

function showLogin() {
    document.getElementById('loading').style.display = "none"
    document.getElementById('otpVerificationForm').style.display = "block"
    document.getElementById('registrationForm').style.display = "none"
}

function
    showRegistration() {
    document.getElementById('loading').style.display = "none"
    document.getElementById('otpVerificationForm').style.display = "none"
    document.getElementById('registrationForm').style.display = "block"
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
        firebase.database().ref('Events/' + event + '/' + user.uid).set({
            name: user.name,
            phoneNo: user.phoneNo,
            collageName: user.phoneNo,
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















// algo

/*
onload render captcha
    check if user exist
    if yes
        check if its entry present in database
        if yes
            render the stored data to view
            show registration
        else
            shoe registration
    else
        show registration


on send otp button clcik
verify captcha
send the otp

on verify otp button
verify otp
if match
    show registration
    again check for user availiability
    if user exists follow onload
else
    show registration

onregistration submit
    check if already registered
    if available
        give error
    else
        register user to event
br



*/