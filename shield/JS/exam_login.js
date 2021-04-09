window.onload=function(){
    document.getElementById('main-content-div').style.display = "none";
    document.getElementById('loading').style.display = "block"
    // check if user is login in or not
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();

    firebase.auth().onAuthStateChanged(function (user) {
        if (user) {
            checkIfUserExist(user);
        }else{
            document.getElementById('main-content-div').style.display = "block";
            document.getElementById('loading').style.display = "none"
        }
    });
}

function checkIfUserExist(user) {
    firebase.database().ref('Users/' + user.uid).once('value').then((snapshot) => {
        if (snapshot.child('mobile').exists()) {
            // redirect to home of exam
            document.location='./';
        }
        document.getElementById('main-content-div').style.display = "block";
        document.getElementById('loading').style.display = "none"
    })
}


// var phoneNo = document.getElementById('phoneNo')
// var otpInput = document.getElementById('otpInput')

function sendOtp(){
    var number = document.getElementById('phoneNo').value;
    const appVerifier = window.recaptchaVerifier;
    if(!number.includes('+91',0)){
        number = "+91"+number;
    }

    document.getElementById('enterOtpDiv').style.display = "block";
    document.getElementById('sendOtpDiv').style.display = "none";
    firebase.auth().signInWithPhoneNumber(number, appVerifier)
        .then((confirmationResult) => {
            // SMS sent. Prompt user to type the code from the message, then sign the
            // user in with confirmationResult.confirm(code).
            window.confirmationResult = confirmationResult;
            alert("OTP SENT. VALIDATE OTP.");
            // enable otp input
        }).catch((error) => {
            // Error; SMS not sent
            alert(error)
        });
}

function validateSignIn(){
    document.getElementById('main-content-div').style.display = "none";
    document.getElementById('loading').style.display = "block"
    const code = document.getElementById('otpInput').value;
    confirmationResult.confirm(code).then((result) => {
        // User signed in successfully.
        const user = result.user;
        firebase.database().ref('Users/' + user.uid).once('value').then((snapshot) => {
            if (snapshot.child('mobile').exists()) {
                // redirect to home of exam
                document.location='./';
            }else{
                alert('You Have Not Registered');
                document.location='../registerForEvent.html';
            }
            document.getElementById('main-content-div').style.display = "block";
            document.getElementById('loading').style.display = "none"
        })
    }).catch((error) => {
        alert(error);
        document.getElementById('main-content-div').style.display = "block";
        document.getElementById('loading').style.display = "none"
    });
}
