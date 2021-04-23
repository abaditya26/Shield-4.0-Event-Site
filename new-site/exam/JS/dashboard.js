var flag = true;

var eventData = [];

var eCount = 0;
var rCount = 0;

window.onload = function(){
    showLoading();
    firebase.auth().onAuthStateChanged(function (user) {
        if (user) {
            // User is signed in.
            chechIfUserExists(user);
        } else {
            // User is signed out.
            document.location='./';
        }
    });
}

function chechIfUserExists(user){
    firebase.database().ref('Users/'+user.uid).once('value').then((snapshot)=>{
        const data = snapshot.val();
        if(data.uid == undefined){
            alert('Your data is not recorded. Register First.');
            firebase.auth().signOut();
            document.location='./';
        }else{
            document.getElementById('name').innerHTML=data.name;
            document.getElementById('phone').innerHTML=data.phoneNo;
            fetchEvents(user);
        }
        hideLoading();
    }).catch((error)=>{
        hideLoading();  
        alert('error');
        console.log(error);
    });
}


function fetchEvents(user){
    firebase.database().ref('Registrations/'+user.uid).once('value').then((snapshot)=>{
        var e = [];
        snapshot.forEach(s => {
            const data = s.val();
            if(data.event!=undefined){
                e.push(data.event);
            }
        });
        firebase.database().ref('Links/').once('value').then((s)=>{
            var eObj = {
                CQuiz:"C Quiz",
                GkQuiz:"GK Quiz"
            };
            e.forEach(ev => {
                f=true;
                s.forEach(snap => {
                    const data = snap.val();
                    if(data.event!=undefined){
                        if(ev == data.event){
                            eventData.push([eObj[ev],ev,ev]);
                            f=false;
                        }
                    }
                });
                if(f){
                    eventData.push([eObj[ev],ev,"none"]);
                }
            });
            showCards();
        }).catch((err)=>{
            alert(err);
            console.log(err);
        });
    }).catch((e)=>{
        alert(e);
        console.log(e);
    })
}


function showCards(){
    console.log(eventData);
}


function showLoading(){
    document.getElementById('main').style.display="none"
    document.getElementById('loading').style.display="block"
}

function hideLoading(){
    if(flag){
        document.getElementById('main').style.display="block"
        document.getElementById('loading').style.display="none"
    }
}














function logoutUser(){
    if(confirm('Do You Want To Log Out')){
        firebase.auth().signOut()
            .then(function () {
                // Sign-out successful.
                document.location='./';
            }).catch(function (error) {
                // An error happened.
                alert(error);
            });
    }
}