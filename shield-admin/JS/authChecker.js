firebase.auth().onAuthStateChanged(function (user) {
    if (user) {
        // User is signed in.
    } else {
        // User is signed out.
        document.location='./login.php';
    }
});


function logout(){
    firebase.auth().signOut()
        .then(function () {
            // Sign-out successful.
            document.location='./login.php';
        }).catch(function (error) {
            // An error happened.
            alert('error');
        });
}