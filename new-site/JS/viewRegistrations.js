var uId = "";
var userFlag = false;
var eventFlag = false;
eventData = {
    "treasure":{
        id:"treasure",
        name:"Treasure Hunt"
    },
    "CQuiz":{
        id:"CQuiz",
        name:"C Quiz"
    },
    "GkQuiz":{
        id:"GkQuiz",
        name:"GK Quiz"
    },
    "ppt":{
        id:"ppt",
        name:"PPT/Poster Presentation"
    },
    "project":{
        id:"project",
        name:"Project Copetition"
    },
    "chess":{
        id:"chess",
        name:"Chess"
    },
    "talent":{
        id:"talent",
        name:"Talent Hunt"
    }
}


window.onload=function(){
    showLoading();
    firebase.auth().onAuthStateChanged(function (user) {
        if (user) {
            uId = user.uid;
            renderData(user);
        } else {
            alert('Not Log in');
            document.location='./registration.php';
        }
    });
}

function renderData(user){
    firebase.database().ref('Users/'+user.uid).once('value').then((snapshot)=>{
        const data = snapshot.val();
        document.getElementById('name').innerHTML=data.name;
        document.getElementById('phone').innerHTML=data.phoneNo
        document.getElementById('email').innerHTML=data.emailId
        document.getElementById('college').innerHTML=data.collageName
        document.getElementById('city').innerHTML=data.collageCity

        userFlag = true;
        showData();
    }).catch((error)=>{
        alert('error');
    });
    firebase.database().ref('Registrations/'+user.uid).once('value').then((snapshot)=>{
        var eventList = "<ul>";
        snapshot.forEach(s => {
            const data = s.val();
            // data.event
            const id = data.event;
            const name = eventData[id].name;
            eventList = eventList+"<li>"+name+"</li><br>";
        });
        eventList = eventList + "</ul>";
        document.getElementById('events').innerHTML=eventList;
        eventFlag = true;
        showData();
    }).catch((error)=>{
        alert(error);
    });
}


function showLoading(){
    document.getElementById('registration').style.display="none"
    document.getElementById('loading').style.display="block"
}

function showData(){
    if(userFlag && eventFlag){
        // show data
        document.getElementById('registration').style.display="block"
        document.getElementById('loading').style.display="none"
    }
}