var flag = true;
var flag1 = false;
window.onload = function () {
    showLoading();
    hideOtpBtn();
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
        'size': 'normal',
        'callback': (response) => {
            flag1 = true;
            showOtpBtn();
        },
        'expired-callback': () => {
            // Response expired. Ask user to solve reCAPTCHA again.
            // ...
        }
    });
    recaptchaVerifier.render();
    firebase.auth().onAuthStateChanged(function (user) {
        if (user) {
            // User is signed in.
            if (user.phoneNumber != undefined) {
                document.location = './dashboard.php';
            }
        }
        hideLoading();
    });
}

function sendOtp() {
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
        showOtpInputLayout();
        flag1 = false;
        hideLoading();
    }).catch((err) => {
        console.log(err);
        hideLoading();
    });
}

function validateOtp() {
    showLoading();
    flag = false;
    const code = document.getElementById('otpInput').value;
    confirmationResult.confirm(code).then((result) => {
        const user = result.user;
        firebase.database().ref('Users/' + user.uid).once('value').then((snapshot) => {
            console.log(snapshot)
            flag = true;
            if (snapshot.hasChild('uid')) {
                hideLoading()
                alert('login success')
                document.location = './dashboard.php';
            } else {
                hideLoading()
                firebase.auth().signOut()
                    .then(function () {
                        alert('login failed')
                        document.location = './';
                    }).catch(function (error) {
                        // An error happened.
                        alert(error)
                        document.location = './';
                    });
            }
        }).catch((error1) => {
            alert(error1);
            hideLoading();
        });
    }).catch((e) => {
        console.log(e);
        alert(e);
        hideLoading();
    });
}


function showLoading() {
    document.getElementById('main').style.display = "none"
    document.getElementById('loading').style.display = "block"
}

function hideLoading() {
    if (flag) {
        document.getElementById('main').style.display = "block"
        document.getElementById('loading').style.display = "none"
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

function showOtpBtn() {
    if(flag1 && flag2){
        document.getElementById('sendOtpBtn').style.display = "block";
    }
}

function hideOtpBtn() {
    document.getElementById('sendOtpBtn').style.display = "none";
}

function showOtpInputLayout(){
    document.getElementById('phoneNo').setAttribute('disabled','');
    document.getElementById('otpLayout').style.display="block";
    document.getElementById('recaptcha-container').style.display="none"
    hideOtpBtn();
}

function hideOtpInputLayout(){
    document.getElementById('phoneNo').removeAttribute('disabled');
    document.getElementById('otpLayout').style.display="none";
    document.getElementById('recaptcha-container').style.display="block"
}

function resendOtp(){
    hideOtpInputLayout();
}