var selectedQuiz = "";


var markArray = [];

function selectQuiz(quiz) {
    selectedQuiz = quiz;
}




function generateResult(){
    hideData();
    if(selectedQuiz == ""){
        alert('Select Event First');
        return;
    }
    markArray = [];
    markArray.push(["#", "Student's Name", "Email", "Phone Number", "Collage", "City", "Event", "Marks", "Remaining Time"]);


    firebase.database().ref('UserQuestions/'+selectedQuiz).once('value').then((snapshot)=>{
        var x = 1;
        snapshot.forEach(s => {
            var marks = 0;
            var name, email, collage, city, phone;
            var rTime = 0;
            s.forEach(ques => {
                const data = ques.val();
                if(data.city != undefined){
                    name = data.name;
                    email = data.email;
                    phone = data.phone;
                    collage = data.collage;
                    city = data.city;
                }
                if(data.timer != undefined){
                    rTime = data.timer;
                }
                if(data.answer != undefined){
                    // do code
                    if(data.answer==data.selected){
                        marks++;
                    }
                }
            });
            const t = parseInt(rTime/60)+'mins '+(rTime%60)+' sec';
            markArray.push([x, name, email, phone, collage, city, selectedQuiz, marks, t]);
            x++;
        });

        generateExcel();
        console.log(markArray);

        showData();
    }).catch((e)=>{
        showData();
        alert(e);
        console.log(e);
    });
}


function generateExcel(){
    try {
        var wb = XLSX.utils.book_new();
        wb.Props = {
            Title: selectedQuiz + " Results",
            Subject: "Results for "+selectedQuiz,
            Author: "Aditya Bodhankar",
            CreatedDate: new Date()
        };
        wb.SheetNames.push("Results");

        var ws_data = markArray ;
        var ws = XLSX.utils.aoa_to_sheet(ws_data);
        wb.Sheets["Results"] = ws;
        

        var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

        function s2ab(s) {
            var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
            var view = new Uint8Array(buf);  //create uint8array as viewer
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
            return buf;
        }
        saveAs(new Blob([s2ab(wbout)], { type: "application/octet-stream" }), selectedQuiz+'_marks.xlsx');
    } catch (e) {
        console.log(e)
        alert(e)
    }
}












function hideData(){
    document.getElementById('main-content-div').style.display='none'
    document.getElementById('navbar').style.display='none'
    document.getElementById('header-title').style.display='none'
    document.getElementById('loading').style.display='block'
}
function showData(){
    document.getElementById('main-content-div').style.display='block'
    document.getElementById('navbar').style.display='block'
    document.getElementById('header-title').style.display='block'
    document.getElementById('loading').style.display='none'

}
