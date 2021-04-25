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
                console.log(data.event);
                if(data.event=="CQuiz" || data.event=="GkQuiz" || data.event=="CQuiz2" || data.event=="GkQuiz2"){
                    e.push(data.event);
                }
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
    eventData.forEach(e => {
        createCard(e[0],e[2]);
    });
}

function createCard(title, examLink) {
    var mainDiv = document.getElementById('mainList')

    var parent = document.createElement('div')
    parent.classList.add('col-md-4')

    var parent1 = document.createElement('div')
    parent1.classList.add('card')
    parent1.classList.add('text-dark')
    parent1.classList.add('border-dark')
    parent1.classList.add('mb-3')
    parent1.classList.add('card-quiz')

    var cardHeader = document.createElement('div')
    cardHeader.classList.add('card-header')
    cardHeader.innerHTML = "<h3>" + title + "</h3>"

    var cardBody = document.createElement('div')
    cardBody.classList.add('card-body')
    cardBody.classList.add('text-dark')

    var cardTitle = document.createElement('h5')
    cardTitle.classList.add('card-title')
    if (examLink == "" || examLink == "none") {
        // link.classList.add('disabled')
        cardTitle.innerHTML = "Link Will Be Active on event timing"
    } else {
        cardTitle.innerHTML = "Click Start Exam to continue"
    }

    var cardText = document.createElement('p')
    cardText.classList.add('card-text')

    var formDiv = document.createElement('form');
    formDiv.setAttribute('action','./startExam.php');
    formDiv.setAttribute('method','POST');
    
    var valStore = document.createElement('input');
    valStore.setAttribute('type','text');
    valStore.style.display="none";
    valStore.setAttribute('name','examId');
    valStore.value = examLink;

    var submitBtn = document.createElement('button');
    submitBtn.setAttribute('type','submit');
    submitBtn.classList.add('btn');
    submitBtn.classList.add('btn-success');
    if(examLink == "" || examLink == "none" || examLink == undefined || examLink=="undefined"){
        submitBtn.setAttribute('disabled','')
    }
    submitBtn.innerHTML = "Start Exam";

    formDiv.appendChild(valStore);
    formDiv.appendChild(submitBtn);

    cardText.appendChild(formDiv)

    cardBody.appendChild(cardTitle)
    cardBody.appendChild(cardText)

    parent1.appendChild(cardHeader)
    parent1.appendChild(cardBody)

    parent.appendChild(parent1)

    mainDiv.appendChild(parent)
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