window.onload = function(){
    document.getElementById('main-content-div').style.display="none";
    document.getElementById('loading').style.display="block";
    firebase.auth().onAuthStateChanged(function (user) {
        if (user) {
            loadUI(user)
        } else {
            document.location = './login.html';
        }
    });
}



function loadUI(user) {
    firebase.database().ref("Users/" + user.uid).once('value').then((snap) => {
        if(!snap.child('f_name').exists()){
            document.location='../registerForEvent.html';
            return
        }
        const data = snap.val();
        setUserDetails(data);
        firebase.database().ref('Links').once('value').then((s) => {
            const linkData = s.val();
            firebase.database().ref('Registrations/' + user.uid).once('value').then((snapshot) => {
                console.log(snapshot)
                var x = false;
                if (snapshot.child('CQuiz').exists()) {
                    //display c quiz section
                    try{
                        enableC(linkData.CQuiz);
                    }catch(e){
                        enableC('none');
                    }
                    x=true;
                }
                if (snapshot.child('JavaQuiz').exists()) {
                    //display Java quiz section
                    try{
                        enableJava(linkData.JavaQuiz);
                    }catch(e){
                        enableJava('');
                    }
                        
                    x=true;
                }

                if(!x){
                    createCard('No Quiz Added','none');
                }

                document.getElementById('main-content-div').style.display="block";
                document.getElementById('loading').style.display="none";
            });
        })
    })
}

function setUserDetails(data) {
    document.getElementById('userName').innerHTML = data.f_name + " " + data.l_name
}

function enableC(link) {
    createCard('C QUIZ', link)
}

function enableJava(link) {
    createCard('JAVA QUIZ', link)
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
    if(examLink == "" || examLink == "none" || examLink == undefined ||examLink=="undefined"){
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
