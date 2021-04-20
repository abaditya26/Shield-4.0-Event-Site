window.onload = function () {
    window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container');
    recaptchaVerifier.render();

    document.getElementById('main-content-div').style.display = "none";
    document.getElementById('loading').style.display = "block"
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
            const data = snapshot.val();
            // user already present
            try {
                document.getElementById('first_name').value = data.f_name;
                document.getElementById('last_name').value = data.l_name;
                document.getElementById('mobileNo').value = data.mobile;
                document.getElementById('collage').value = data.collage;
                document.getElementById('city').value = data.city;
                document.getElementById('email').value = data.email;
            } catch (e) {
                alert(e);
            }
        }
        document.getElementById('main-content-div').style.display = "block";
        document.getElementById('loading').style.display = "none"
    })
}

 

// otp sign in

function validateData() {
    //get the number
    var number = document.getElementById('mobileNo').value;
    const appVerifier = window.recaptchaVerifier;

    if(!number.includes('+91',0)){
        number = "+91"+number;
    }

    document.getElementById('otpWindow').style.display = "block";
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

function verifyOtp() {
    document.getElementById('main-content-div').style.display = "none";
    document.getElementById('loading').style.display = "block"
    const code = document.getElementById('otp').value;
    confirmationResult.confirm(code).then((result) => {
        // User signed in successfully.
        const user = result.user;
        console.log(user.uid)
        saveData(user);
    }).catch((error) => {
        alert(error);
        document.getElementById('main-content-div').style.display = "block";
        document.getElementById('loading').style.display = "none"
    });
}

function saveData(user){
    var email = document.getElementById('email').value;
    var firstName = document.getElementById('first_name').value;
    var lastName = document.getElementById('last_name').value;
    var mobileNo = document.getElementById('mobileNo').value;
    var collageName = document.getElementById('collage').value;
    var city = document.getElementById('city').value;
    var eventName = document.getElementById('event').value;


    var userId = firebase.auth().currentUser.uid;

    document.getElementById('saving').style.visibility="block"
    document.getElementById('main-content-div').style.display = "none";


    firebase.database().ref('Events/' + eventName + '/' + userId).once('value').then((snapshot) => {
        var flag = true;
        if (snapshot.child('userId').exists()) {
            if (confirm('You have already registered for this event.\nDo You Want To Overwrite old entry?')) {
                flag = false;
            }
        }
        firebase.database().ref('Users/' + userId).set({
            email: email,
            f_name: firstName,
            l_name:lastName,
            mobile: mobileNo,
            collage: collageName,
            city: city,
            userId: userId
        }).then((result) => {
            firebase.database().ref('Events/' + eventName + '/' + userId).set({
                email: email,
                f_name: firstName,
                l_name:lastName,
                mobile: mobileNo,
                collage: collageName,
                city: city,
                userId: userId,
                eventName: eventName,
                type:"participant"
            }).then((result) => {
                firebase.database().ref('Registrations/' + userId + '/' + eventName).set({
                    eventName:eventName
                }).then((result) => {
                    if (flag) {
                        alert('Registration Complete');
                    } else {
                        alert('Entry Over Written');
                    }
                    document.location = './'
                }).catch((error1) => {
                    alert('Error : ' + error1)
                });
            }).catch((error) => {
                alert('Error : ' + error)
            });
        }).catch((err) => {
            alert('Error : ' + err)
        });

    });
}


// https://youtu.be/5jYIIwm6IeI?t=460