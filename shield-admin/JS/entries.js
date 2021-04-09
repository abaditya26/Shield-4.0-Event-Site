var selectedQuiz = "";

var entries = [];

function selectQuiz(quiz) {
    selectedQuiz = quiz;
}

function downloadExcel() {
    entries = [];
    hideData();
    if (selectQuiz == "") {
        alert("Select Quiz First")
        return;
    }
    entries.push(["#","Name Of Student","Email","Phone Number","Collage Name","City Of Collage","Type","Event"]);

    var index = 1;
    firebase.database().ref('Events/'+selectedQuiz).once('value').then((snapshot)=>{
        snapshot.forEach(entry => {
            const data = entry.val();
            console.log(data)
            entries.push([index,data.f_name+' '+data.l_name,data.email, data.mobile,data.collage, data.city, data.type,selectedQuiz]);
        });
        generateExcel();
        showData()
    }).catch((error)=>{ 
        alert(error)
        console.log(error)
    })
    
}

function generateExcel(){
    try {
        var wb = XLSX.utils.book_new();
        wb.Props = {
            Title: selectedQuiz + " Entries",
            Subject: "Entries for "+selectedQuiz,
            Author: "Aditya Bodhankar",
            CreatedDate: new Date()
        };
        wb.SheetNames.push("Entries");

        
        var ws_data = entries ;
        var ws = XLSX.utils.aoa_to_sheet(ws_data);
        wb.Sheets["Entries"] = ws;
        

        var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });

        function s2ab(s) {
            var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
            var view = new Uint8Array(buf);  //create uint8array as viewer
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
            return buf;
        }
        saveAs(new Blob([s2ab(wbout)], { type: "application/octet-stream" }), selectedQuiz+'entries.xlsx');
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

/*

    //proceed to download
    try {
        var wb = XLSX.utils.book_new();
        wb.Props = {
            Title: selectedQuiz + " Entries",
            Subject: "Entried",
            Author: "Aditya Bodhankar",
            CreatedDate: new Date()
        };
        wb.SheetNames.push("Test Sheet");
        var ws_data = [['hello', 'world']];  //a row with 2 columns
        var ws = XLSX.utils.aoa_to_sheet(ws_data);
        wb.Sheets["Test Sheet"] = ws;

        var wbout = XLSX.write(wb, { bookType: 'xlsx', type: 'binary' });
        function s2ab(s) {
            var buf = new ArrayBuffer(s.length); //convert s to arrayBuffer
            var view = new Uint8Array(buf);  //create uint8array as viewer
            for (var i = 0; i < s.length; i++) view[i] = s.charCodeAt(i) & 0xFF; //convert to octet
            return buf;
        }
        saveAs(new Blob([s2ab(wbout)], { type: "application/octet-stream" }), 'test.xlsx');
    } catch (e) {
        console.log(e)
        alert(e)
    }
*/