

window.onload=function(){
    hideData();
    firebase.auth().onAuthStateChanged(function (user) {
        if (user) {
            checkUser(user);
        }else{
            showData()
        }
    });
}

function validateLogin(){
    hideData()
    const email = document.getElementById('email').value;
    const password = document.getElementById('password').value;

    firebase.auth().signInWithEmailAndPassword(email, password)
        .then(function (response) {
            const user = response.user
            checkUser(user);
        })
        .catch(function (error) {
            alert(error);
            showData();
        });


    return false;
}
function checkUser(user){
    firebase.database().ref('Admin/Users/'+user.uid).on('value',(snapshot)=>{
        try{
            const data = snapshot.val();
            if(snapshot.child('name').exists()){
                console.log('user is admin');
                document.location='./';
            }else{
                alert('User not admin');
            }
        }catch(e){}
        showData()
    });
}

function hideData(){
    document.getElementById('main-content-div').style.display='none'
    document.getElementById('loading').style.display='block'
}
function showData(){
    document.getElementById('main-content-div').style.display='block'
    document.getElementById('loading').style.display='none'

}