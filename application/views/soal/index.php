<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>MolScope</title>

<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-4.5.2.min.css'); ?>">

<style>
body { background:#0f172a; font-family:'Segoe UI'; }
.app-wrapper { height:100vh; display:flex; justify-content:center; align-items:center; }
.quiz-app {
    width:100%; max-width:500px; height:90vh;
    background:#fff; border-radius:20px;
    display:flex; flex-direction:column; overflow:hidden;
}
.top-bar { display:flex; justify-content:space-between; padding:15px; font-weight:600; }
.timer { color:#ef4444; font-weight:bold; }
.progress { height:6px; }
.progress-bar { background:linear-gradient(90deg,#4facfe,#00f2fe); }

.content { flex:1; padding:20px; }
.option {
    border:2px solid #eee; padding:15px;
    border-radius:12px; margin-bottom:10px; cursor:pointer;
}
.option.active { background:#eff6ff; border-color:#4facfe; }

.nav-btn { padding:15px; display:flex; justify-content:space-between; }

#reviewPage { display:none; padding:20px; }

.review-item {
    width:45px; height:45px; margin:5px;
    border-radius:10px; display:flex;
    align-items:center; justify-content:center;
    font-weight:bold; cursor:pointer;
}
.review-item.answered { background:#4facfe; color:#fff; }
.review-item.empty { background:#e5e7eb; }

#warningBox {
    display:none; background:#ef4444;
    color:#fff; padding:10px; text-align:center;
}
</style>
</head>

<body>

<div class="app-wrapper">
<div class="quiz-app">

<div id="warningBox"></div>

<div class="top-bar">
    <div>Soal <span id="current">1</span>/<span id="total"></span></div>
    <div class="timer" id="timer">--:--</div>
</div>

<div class="progress">
    <div class="progress-bar" id="progressBar"></div>
</div>

<div class="content">
    <h5 id="question"></h5>
    <div id="options"></div>
</div>

<div class="nav-btn">
    <button class="btn btn-secondary" id="prevBtn">Previous</button>
    <button class="btn btn-primary" id="nextBtn">Next</button>
</div>

<div id="reviewPage">
    <h5>Review Jawaban</h5>
    <div id="reviewGrid" class="d-flex flex-wrap"></div>

    <div class="mt-3">
        <button class="btn btn-secondary" id="backToQuiz">Kembali</button>
        <button class="btn btn-success float-right" id="finalSubmit">Submit Final</button>
    </div>
</div>

</div>
</div>

<script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js'); ?>"></script>

<script>
var questions = <?php echo json_encode($questions); ?>;

var current = 0;
var answers = {};
var totalTime = 600; // detik

var endTime = null;
var serverOffset = 0;
var interval = null;

var violation = 0;
var maxViolation = 3;

$("#total").text(questions.length);

/* ================= SERVER TIME ================= */
function syncServerTime(callback){
    $.get("<?php echo base_url('soal/get_server_time'); ?>", function(res){

        var serverTime = parseInt(res.server_time);
        var clientTime = Date.now();

        serverOffset = serverTime - clientTime;

        var savedEnd = localStorage.getItem("cbt_end_time");

        if(savedEnd){
            endTime = parseInt(savedEnd);

            // ✅ FIX: reset kalau sudah expired
            if(endTime <= serverTime){
                endTime = serverTime + (totalTime * 1000);
                localStorage.setItem("cbt_end_time", endTime);
            }
        } else {
            endTime = serverTime + (totalTime * 1000);
            localStorage.setItem("cbt_end_time", endTime);
        }

        console.log("SERVER:", serverTime);
        console.log("END:", endTime);
        console.log("OFFSET:", serverOffset);

        callback();
    }, "json");
}

/* ================= TIMER ================= */
function startTimer(){
    clearInterval(interval); // ✅ FIX double interval

    interval = setInterval(function(){

        var now = Date.now() + serverOffset;
        var timeLeft = Math.floor((endTime - now) / 1000);

        console.log("NOW:", now, "LEFT:", timeLeft);

        if(timeLeft <= 0){
            $("#timer").text("00:00");
            finish();
            return;
        }

        var m = Math.floor(timeLeft / 60);
        var s = timeLeft % 60;

        $("#timer").text(
            String(m).padStart(2,'0') + ":" +
            String(s).padStart(2,'0')
        );

    },1000);
}

/* ================= STORAGE ================= */
function loadProgress(){
    var a = localStorage.getItem("cbt_answers");
    var c = localStorage.getItem("cbt_current");

    if(a) answers = JSON.parse(a);
    if(c) current = parseInt(c);
}
function saveProgress(){
    localStorage.setItem("cbt_answers", JSON.stringify(answers));
    localStorage.setItem("cbt_current", current);
}

/* ================= LOAD QUESTION ================= */
function loadQuestion(){
    var q = questions[current];

    $("#question").text(q.question);
    $("#current").text(current+1);

    var html="";
    Object.entries(q.option).forEach(function([k,v]){
        var active = answers[q.id]==k ? 'active':'';
        html += `<div class="option ${active}" data-val="${k}">${v}</div>`;
    });

    $("#options").html(html);
    updateButton();
    updateProgress();
}

/* ================= UI ================= */
function updateProgress(){
    var percent=((current+1)/questions.length)*100;
    $("#progressBar").css("width",percent+"%");
}
function updateButton(){
    $("#prevBtn").prop("disabled", current===0);
    $("#nextBtn").text(current===questions.length-1 ? "Review" : "Next");
}

/* ================= EVENT ================= */
$(document).on("click",".option",function(){
    $(".option").removeClass("active");
    $(this).addClass("active");

    answers[questions[current].id]=$(this).data("val");
    saveProgress();
});

$("#nextBtn").click(function(){
    if(current===questions.length-1){
        showReview();
    } else {
        current++;
        loadQuestion();
    }
});
$("#prevBtn").click(function(){
    if(current>0){
        current--;
        loadQuestion();
    }
});

/* ================= REVIEW ================= */
function showReview(){
    $(".content,.nav-btn").hide();
    $("#reviewPage").show();

    var html="";
    questions.forEach(function(q,i){
        var status = answers[q.id] ? "answered":"empty";
        html+=`<div class="review-item ${status}" data-index="${i}">${i+1}</div>`;
    });
    $("#reviewGrid").html(html);
}

$(document).on("click",".review-item",function(){
    current=$(this).data("index");
    $("#reviewPage").hide();
    $(".content,.nav-btn").show();
    loadQuestion();
});

$("#backToQuiz").click(function(){
    $("#reviewPage").hide();
    $(".content,.nav-btn").show();
});

/* ================= FINISH ================= */
$("#finalSubmit").click(function(){
    finish();
});

function finish(){
    clearInterval(interval);

    localStorage.removeItem("cbt_end_time");
    localStorage.removeItem("cbt_answers");
    localStorage.removeItem("cbt_current");

    var duration = totalTime;

    $.post("<?php echo base_url('soal/submit_ajax'); ?>",{
        answers:answers,
        duration:duration
    },function(){
        window.location.href="<?php echo base_url('soal/ranking'); ?>";
    });
}

/* ================= ANTI CHEAT ================= */
let lastHidden = 0;

document.addEventListener("visibilitychange",function(){
    if(document.hidden){
        let now = Date.now();

        if(now - lastHidden > 3000){ // ✅ tidak sensitif
            violation++;
            lastHidden = now;

            $("#warningBox").show().text("Jangan pindah tab! ("+violation+"/"+maxViolation+")");
        }

        if(violation>=maxViolation){
            alert("Auto submit karena kecurangan!");
            finish();
        }
    }
});

/* ================= INIT ================= */
$(document).ready(function(){

    loadProgress();

    syncServerTime(function(){
        startTimer();
        loadQuestion();
    });

    setInterval(saveProgress,2000);
});
</script>

</body>
</html>