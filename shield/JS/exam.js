// main code starts here
var userId = "";
var userData = [];

var questions = [];
var questionIndex = 0;
var totalQuestions = 0;

var rTime;

// flags to show view
var flag1 = false; //user data fetch
var flag2 = false; //questions flag
var flag3 = false; //camera flag
var flag4 = true; //status check flag

window.onload = function () {
    showLoading()
    enableCamera();
    fetchUserData();
    document.getElementById('examName').innerHTML = examId;
}


// fetch user data
function fetchUserData() {
    firebase.auth().onAuthStateChanged(function (user) {
        if (user) {
            userId = user.uid
            firebase.database().ref('Events/' + examId + '/' + userId).on('value', (snapshot) => {
                if (snapshot.child('f_name').exists()) {
                    userData = snapshot.val();
                    document.getElementById('userName').innerHTML = userData.f_name + " " + userData.l_name + "(" + userData.mobile + ")"
                    flag1 = true;
                    showView();
                } else {
                    alert('You Have Not Registered For This Event');
                    document.location = '../registerForEvent.html';
                }
            });
            loadQuestions();


        } else {
            // User is signed out.
            alert('Invalid Navigation. User Not Sign IN.');
            document.location = './login.html';
        }
    });
}

//load questions
function loadQuestions() {
    firebase.database().ref('UserQuestions/'+examId+'/' + userId).once('value').then((snapshot) => {
        if (snapshot.child('eStatus').exists()) {
            //already in exam
            snapshot.forEach(queSnap => {
                var data = queSnap.val();
                if (data.id != undefined) {
                    questions.push([data.id, data.question, data.option1, data.option2, data.option3, data.option4, data.answer, data.selected]);
                }
                if(data.timer != undefined){
                    rTime = data.timer;
                }
                if(data.eStatus!=undefined){
                    var status =data.eStatus;
                    if(status=="finished"){
                        alert('You Already Have Completed This Exam!!!')
                        document.location = './';
                        flag4 = false;
                    }
                }
                
            });
            totalQuestions = questions.length;
            viewQuestion(0);
            flag2 = true;
            showView();
        } else {
            //new to exam
            firebase.database().ref('QuizQuestions/' + examId).once('value').then((snapshot1) => {
                snapshot1.forEach(queSnap => {
                    var data = queSnap.val();
                    questions.push([data.id, data.question, data.option1, data.option2, data.option3, data.option4, data.answer, "null"]);

                    firebase.database().ref('UserQuestions/'+examId+'/' + userId + '/' + data.id).set({
                        id: data.id,
                        question: data.question,
                        option1: data.option1,
                        option2: data.option2,
                        option3: data.option3,
                        option4: data.option4,
                        answer: data.answer,
                        selected: "null"
                    });
                });
                firebase.database().ref('UserQuestions/'+examId+'/' + userId + '/eStatus').set({
                    eStatus: 'started'
                });
                firebase.database().ref('UserQuestions/'+examId+'/'+userId+'/userId').set({
                    uId:userId,
                    name:userData.f_name+' '+userData.l_name,
                    email:userData.email,
                    phone:userData.mobile,
                    collage:userData.collage,
                    city:userData.city
                });
                firebase.database().ref('UserQuestions/'+examId+'/' + userId + '/timer').set({
                    timer: 3600
                });
                rTime = 3600;
                totalQuestions = questions.length;
                viewQuestion(0);
                flag2 = true;
                showView();
            }).catch((e) => {
                alert("Err => " + e);
            });
        }
    }).catch((error) => {
        alert("Error => " + error);
    });
}

// enable Camera
function enableCamera() {
    var video = document.querySelector("#videoElement");

    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true, audio:true })
            .then(function (stream) {
                video.srcObject = stream;
                flag3 = true;
                showView();
            })
            .catch(function (error) {
                alert("Camera Error! " + error);
                document.location = './';
            });
    }
}

// common callable methods
function showView() {
    // validate if all flags are set to true
    if (flag1 && flag2 && flag3 && flag4) {
        document.getElementById('main-content-div').style.display = "block";
        document.getElementById('loading').style.display = "none";

        
        var x = setInterval(function() {
        
            document.getElementById('timeRemaining').innerHTML=''+parseInt(rTime/60)+'mins '+(rTime%60)+' sec';
        
            rTime--;
        
            if(rTime%5==0){
                //update online
                firebase.database().ref('UserQuestions/'+examId+'/'+userId+'/timer').set({
                    timer:rTime
                })
            }
          
            // If the count down is finished, write some text
            if (rTime < 0) {
              clearInterval(x);
              alert('timeout');
              finishExam();
              showLoading()
            }
          }, 1000);
    }
}

function endExam(){
    if(confirm('Do You Really Want To End Exam?')){
        finishExam()
    }
}

function finishExam(){
    firebase.database().ref('UserQuestions/'+examId+'/'+userId+'/eStatus').update({
        eStatus:"finished"
    }).then((result)=>{
        alert('Exam Submitted!');
        document.location='./';
    })
}

function showLoading() {
    document.getElementById('main-content-div').style.display = "none";
    document.getElementById('loading').style.display = "block";
}

function viewQuestion(i) {
    questionIndex = i;
    var questionNo = document.getElementById('questionNo');
    var qText = document.getElementById('question');
    var o1Text = document.getElementById('option1Text');
    var o2Text = document.getElementById('option2Text');
    var o3Text = document.getElementById('option3Text');
    var o4Text = document.getElementById('option4Text');

    qText.innerHTML = questions[i][1];
    o1Text.innerHTML = questions[i][2];
    o2Text.innerHTML = questions[i][3];
    o3Text.innerHTML = questions[i][4];
    o4Text.innerHTML = questions[i][5];
    questionNo.innerHTML = i + 1;

    // set radio buttons
    disableAllRadio();

    if (questions[i][2] == questions[i][7]) {
        document.getElementById('option1').checked = true;
    } else if (questions[i][3] == questions[i][7]) {
        document.getElementById('option2').checked = true;
    } else if (questions[i][4] == questions[i][7]) {
        document.getElementById('option3').checked = true;
    } else if (questions[i][5] == questions[i][7]) {
        document.getElementById('option4').checked = true;
    }
}

function disableAllRadio() {
    document.getElementById('option1').checked = false;
    document.getElementById('option2').checked = false;
    document.getElementById('option3').checked = false;
    document.getElementById('option4').checked = false;
}


document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        alert('You Have Changed Window. It Will be treated as copy!');
    }
});
function copyFunc() {
    alert('Copy Not Allowed!!!');
    return false;
}

function nextQuestion() {
    if ((questionIndex + 1) < totalQuestions) {
        viewQuestion(questionIndex + 1);
    }
}

function prevQuestion() {
    if (questionIndex > 0) {
        viewQuestion(questionIndex - 1);
    }
}

function selectOption(index) {
    selectedOption = questions[questionIndex][index + 1];
    questions[questionIndex][7] = selectedOption;
    // save to firebase
    firebase.database().ref('UserQuestions/'+examId+'/' + userId + '/' + questions[questionIndex][0]).update({
        selected: "" + selectedOption
    });
}



