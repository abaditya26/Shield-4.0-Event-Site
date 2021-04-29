var flag = true;
window.onload = function () {
    showLoading();
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
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