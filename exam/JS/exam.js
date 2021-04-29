var flag1 = true; //flag for camera and microphone
var flag2 = false; //question fetch flag
var flag3 = false;
var flag4 = false;
var flag5 = false;

var totalQuestions = 0;
var attempted = 0;
var questions = [];
var currentIndex = -1;


window.onload = function () {
    document.body.oncopy = function (event) {
        event.preventDefault();
        alert('NO COPY!!!!!!!!!');
    }
    showLoading();
    firebase.auth().onAuthStateChanged(function (user) {
        if (user) {
            // User is signed in.
            // enableCamera();
            loadOld();
        } else {
            // User is signed out.
            document.location = './';
        }
    });

}

function loadOld() {
    firebase.database().ref('UserQuestions/' + firebase.auth().currentUser.uid + '/' + quizId).once('value').then((snap) => {
        attempted = 0;
        snap.forEach(s => {
            const data = s.val();
            console.log(data);
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
        }
    }).catch((err) => {
        alert(err);
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
    }, 5000);
}

function loadQuestions() {
    firebase.database().ref('Questions/' + quizId).once('value').then((snapshot) => {
        var tQuestions = [];
        snapshot.forEach(s => {
            const data = s.val();
            tQuestions.push([data.question, data.option1, data.option2, data.option3, data.option4, data.answer, "", data.id]);
        });
        questions = chooseRandom(tQuestions, 30);
        totalQuestions = questions.length;
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
                if (x == totalQuestions - 1) {
                    flag2 = true;
                    showView();
                    changeQuestion(1);
                }
            }).catch((err) => {
                alert(err);
            });
        }
        flag2 = true;
        showView();
    }).catch((error) => {
        alert(error);
        console.log(error);
    });
}

function changeQuestion(changeIndex) {
    currentIndex = currentIndex + (changeIndex);
    if (currentIndex < 0 || currentIndex >= totalQuestions) {
        currentIndex = currentIndex - (changeIndex);
    }
    document.getElementById('question').innerHTML=questions[currentIndex][0]
    document.getElementById('option1Text').innerHTML=questions[currentIndex][1]
    document.getElementById('option2Text').innerHTML=questions[currentIndex][2]
    document.getElementById('option3Text').innerHTML=questions[currentIndex][3]
    document.getElementById('option4Text').innerHTML=questions[currentIndex][4]
    document.getElementById('questionId').innerHTML=(currentIndex+1)+'/'+totalQuestions
    document.getElementById('attemptedQuestionCount').innerHTML=attempted+'';
    document.getElementById('notAttemptedQuestionCount').innerHTML=(totalQuestions-attempted)+'';
}

const chooseRandom = (arr, num = 1) => {
    var res = [];
    for (let i = 0; i < num;) {
        const random = Math.floor(Math.random() * arr.length);
        if (res.indexOf(arr[random]) !== -1) {
            continue;
        };
        res.push(arr[random]);
        i++;
    };
    return res;
};

function showView() {
    if (flag1 && flag2 && flag3 && flag4 && flag5) {
        document.getElementById('main').style.display = "block"
        document.getElementById('loading').style.display = "none"
    }
}

function showLoading() {
    document.getElementById('main').style.display = "none"
    document.getElementById('loading').style.display = "block"
}