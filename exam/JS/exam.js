var flag1 = false; //flag for camera and microphone
var flag2 = false; //question fetch flag
var flag3 = false;
var flag4 = false; //timer
var flag5 = false; //timer started

var totalQuestions = 0;
var attempted = 0;
var questions = [];
var currentTimer = 0;
var currentIndex = 0;
var totalTime = 1800;
var x;


window.onload = function () {
    document.body.oncopy = function (event) {
        event.preventDefault();
        alert('NO COPY!!!!!!!!!');
    }
    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            alert('You Have Changed Window.!');
            document.location = './dashboard.php';
        }
    });
    document.addEventListener('contextmenu', event => event.preventDefault());
    showLoading();
    firebase.auth().onAuthStateChanged(function (user) {
        if (user) {
            enableCamera();
            loadOld();
        } else {
            document.location = './';
        }
    });
}

function loadOld() {
    firebase.database().ref('UserQuestions/' + firebase.auth().currentUser.uid + '/' + quizId).once('value').then((snap) => {
        attempted = 0;
        snap.forEach(s => {
            const data = s.val();
            totalQuestions++;
            questions.push([data.question, data.option1, data.option2, data.option3, data.option4, data.answer, data.selected, data.id]);
            if (data.selected != "") {
                attempted++;
            }
        });

        if (totalQuestions == 0) {
            loadQuestions()
        } else {
            flag2 = true;
            showView();
            changeQuestion(1);
            loadOldTimer()
        }
    }).catch((err) => {
        alert(err);
    });
}

function loadOldTimer() {
    firebase.database().ref('UserQuestions/' + firebase.auth().currentUser.uid + '/status/' + quizId).once('value').then((snapshot) => {
        if (snapshot.child('timer').exists()) {
            const data = snapshot.val();
            currentTimer = data.timer;
            if (data.status != undefined) {
                if (data.status == "end") {
                    alert('Already Attempted or time end')
                    document.location = './dashboard.php';
                    return;
                }
            }
        } else {
            currentTimer = totalTime;
            firebase.database().ref('UserQuestions/' + firebase.auth().currentUser.uid + '/status/' + quizId).set({
                timer: currentTimer,
                status: 'started'
            });
        }
        flag4 = true;
    }).catch((err) => {
        console.log(err);
        alert(err);
        document.location = './dashboard.php';
    });
}

function enableCamera() {
    var video = document.querySelector("#videoElement");

    if (navigator.mediaDevices.getUserMedia) {
        navigator.mediaDevices.getUserMedia({ video: true, audioinput: true })
            .then(function (stream) {
                video.srcObject = stream;
                flag1 = true;
                showView();
            })
            .catch(function (error) {
                alert("Camera Error! " + error);
                document.location = './dashboard.php';
            });
    }

    setTimeout(() => {
        enableCamera()
    }, 15000);
}

function loadQuestions() {
    firebase.database().ref('Questions/' + quizId).once('value').then((snapshot) => {
        var tQuestions = [];
        snapshot.forEach(s => {
            const data = s.val();
            tQuestions.push([data.question, data.option1, data.option2, data.option3, data.option4, data.answer, "", data.id]);
        });
        questions = chooseRandom(tQuestions, 25);
        totalQuestions = questions.length;
        var ctr = 0;
        for (x = 0; x < totalQuestions; x++) {
            firebase.database().ref('UserQuestions/' + firebase.auth().currentUser.uid + '/' + quizId + '/' + questions[x][7]).set({
                question: questions[x][0],
                option1: questions[x][1],
                option2: questions[x][2],
                option3: questions[x][3],
                option4: questions[x][4],
                answer: questions[x][5],
                selected: questions[x][6],
                id: questions[x][7]
            }).then((res) => {
                ctr++;
                console.log(ctr);
                if (ctr == totalQuestions - 1) {
                    flag2 = true;
                    showView();
                    changeQuestion(0);
                }
            }).catch((err) => {
                alert(err);
            });
        }
        flag2 = true;
        showView();
        loadOldTimer();
    }).catch((error) => {
        alert(error);
        console.log(error);
    });
}

function changeQuestion(changeIndex) {
    currentIndex = currentIndex + (changeIndex);
    if (currentIndex < 0) {
        currentIndex = totalQuestions - 1;
    }
    if (currentIndex >= totalQuestions) {
        currentIndex = 0;
    }
    document.getElementById('question').innerHTML = questions[currentIndex][0]
    document.getElementById('option1Text').innerHTML = questions[currentIndex][1]
    document.getElementById('option2Text').innerHTML = questions[currentIndex][2]
    document.getElementById('option3Text').innerHTML = questions[currentIndex][3]
    document.getElementById('option4Text').innerHTML = questions[currentIndex][4]
    document.getElementById('questionId').innerHTML = (currentIndex + 1) + '/' + totalQuestions
    document.getElementById('attemptedQuestionCount').innerHTML = attempted + '';
    document.getElementById('notAttemptedQuestionCount').innerHTML = (totalQuestions - attempted) + '';

    disableAllRadio();

    if (questions[currentIndex][1] == questions[currentIndex][6]) {
        document.getElementById('option1').checked = true;
    } else if (questions[currentIndex][2] == questions[currentIndex][6]) {
        document.getElementById('option2').checked = true;
    } else if (questions[currentIndex][3] == questions[currentIndex][6]) {
        document.getElementById('option3').checked = true;
    } else if (questions[currentIndex][4] == questions[currentIndex][6]) {
        document.getElementById('option4').checked = true;
    }
}

const chooseRandom = (arr, num = 1) => {
    var res = [];
    for (let i = 0; i < num;) {
        const random = Math.floor(Math.random() * arr.length);
        if (res.indexOf(arr[random]) !== -1) {
            continue;
        }
        res.push(arr[random]);
        i++;
    }
    return res;
}

function showView() {
    if (flag1 && flag2 && flag4) {
        document.getElementById('main').style.display = "block"
        document.getElementById('loading').style.display = "none"
        startTimer();
    }
}

function showLoading() {
    document.getElementById('main').style.display = "none"
    document.getElementById('loading').style.display = "block"
}

function startTimer() {
    if (!flag5) {
        x = setInterval(function () {
            currentTimer--;
            if (currentTimer % 3 == 0) {
                firebase.database().ref('UserQuestions/' + firebase.auth().currentUser.uid + '/status/' + quizId).update({
                    timer: currentTimer,
                    status: "started"
                });
            }

            var seconds = currentTimer % 60;
            var minutes = parseInt(currentTimer / 60);
            var rt = parseInt((currentTimer * 100) / totalTime);
            document.getElementById('timeProgressBar').style.width = rt + "%";
            document.getElementById('timerDiv').innerHTML = minutes + 'minutes : ' + seconds + 'seconds'

            if (currentTimer < 0) {
                clearInterval(x);
                finishExam();
                showLoading();
            }
        }, 1000);
        flag5 = true;
    }
}

function finishExam() {
    clearInterval(x);
    firebase.database().ref('UserQuestions/' + firebase.auth().currentUser.uid + '/status/' + quizId).update({
        timer: 0,
        status: 'end'
    }).then((res) => {
        alert('Exam Ended');
        document.location = './dashboard.php';
    }).catch((er)=>{
        console.log(er)
    });
}

function disableAllRadio() {
    document.getElementById('option1').checked = false;
    document.getElementById('option2').checked = false;
    document.getElementById('option3').checked = false;
    document.getElementById('option4').checked = false;
}

function selectOption(o){
    const option = questions[currentIndex][o];
    questions[currentIndex][6]=option
    firebase.database().ref('UserQuestions/' + firebase.auth().currentUser.uid + '/' + quizId + '/' + questions[currentIndex][7]).update({
        selected:option
    });
}

function endExam(){
    if(confirm("Do You Want to end exam?")){
        if(confirm("This can't be undone after submit")){
            finishExam();
        }
    }
}
