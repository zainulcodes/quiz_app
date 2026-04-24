<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz App</title>

    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap-4.5.2.min.css'); ?>">

    <meta name="theme-color" content="#0f172a">
    <meta name="apple-mobile-web-app-capable" content="yes">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: #0f172a;
        }

        /* WRAPPER */
        .app-wrapper {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* MAIN APP */
        .quiz-app {
            width: 100%;
            max-width: 500px;
            height: 100vh;
            background: #fff;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        /* DESKTOP */
        @media (min-width: 768px) {
            .quiz-app {
                height: 90vh;
                border-radius: 20px;
                box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            }
        }

        /* TOP BAR */
        .top-bar {
            display: flex;
            justify-content: space-between;
            padding: 15px 20px;
            font-weight: 600;
        }

        /* PROGRESS */
        .progress {
            height: 6px;
            background: #eee;
        }

        .progress-bar {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, #4facfe, #00f2fe);
            transition: 0.3s;
        }

        /* CONTENT */
        .content {
            flex: 1;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        /* QUESTION */
        #question {
            margin-bottom: 20px;
        }

        /* OPTIONS */
        .option {
            border: 2px solid #eee;
            padding: 15px;
            border-radius: 12px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: 0.2s;
        }

        .option:hover {
            background: #f9fafb;
        }

        .option:active {
            transform: scale(0.98);
        }

        .option.correct {
            background: #22c55e;
            color: #fff;
        }

        .option.wrong {
            background: #ef4444;
            color: #fff;
        }

        /* TIMER */
        .timer {
            color: #ef4444;
            font-weight: bold;
        }

        /* MOBILE FIX */
        @media (max-width: 768px) {
            .content {
                justify-content: flex-start;
                margin-top: 20px;
            }
        }
    </style>
</head>

<body>

    <div class="app-wrapper">
        <div class="quiz-app">

            <!-- HEADER -->
            <div class="top-bar">
                <div>Soal <span id="current">1</span>/<span id="total"></span></div>
                <div class="timer" id="timer">15</div>
            </div>

            <!-- PROGRESS -->
            <div class="progress">
                <div class="progress-bar" id="progressBar"></div>
            </div>

            <!-- CONTENT -->
            <div class="content">
                <h4 id="question">Loading...</h4>
                <div id="options"></div>
            </div>

        </div>
    </div>

    <script src="<?php echo base_url('assets/js/jquery-3.5.1.min.js'); ?>"></script>

    <script>
        var questions = <?php echo json_encode($questions); ?>;

        var current = 0;
        var score = 0;
        var timer = 15;
        var interval;
        var start = Date.now();
        var answers = {};


        $("#total").text(questions.length);

        function loadQuestion() {
            clearInterval(interval);
            timer = 15;
            $("#timer").text(timer);

            var q = questions[current];

            $("#question").fadeOut(150, function() {
                $(this).text(q.question).fadeIn(150);
            });

            $("#current").text(current + 1);

            var html = "";

            Object.entries(q.option).forEach(function([key, val]) {
                html += `<div class="option" data-val="${key}">${val}</div>`;
            });

            $("#options").html(html);

            startTimer();
        }

        function startTimer() {
            interval = setInterval(function() {
                timer--;
                $("#timer").text(timer);

                if (timer <= 0) {
                    nextQuestion();
                }
            }, 1000);
        }

        function updateProgress() {
            var percent = (current / questions.length) * 100;
            percent = Math.min(percent, 100);
            $("#progressBar").css("width", percent + "%");
        }

        function nextQuestion() {
            current++;
            updateProgress();
            if (current < questions.length) {
                loadQuestion();
            } else {
                // redirect
                finish();
            }
        }

        $(document).on("click", ".option", function() {
            clearInterval(interval);
            var selected = $(this).data("val");
            var correct = questions[current].correct_answer;

            answers[questions[current].id] = selected;

            if (selected == correct) {
                $(this).addClass("correct");
                score++;
            } else {
                $(this).addClass("wrong");

                $('.option').each(function() {
                    if ($(this).data('val') == correct) {
                        $(this).addClass('correct');
                    }
                });
            }

            setTimeout(function() {
                nextQuestion();
            }, 700);
        });

        function finish() {
            var url = '<?php echo base_url('quiz/submit_ajax'); ?>';
            var duration = Math.floor((Date.now() - start) / 1000);
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    answers: answers,
                    duration: duration
                },
                dataType: 'json',
                success: function(res) {

                    if (res.score !== undefined) {
                        window.location.href = "<?php echo base_url('quiz/quiz_ranking'); ?>";
                    } else {
                        alert("Gagal submit score");
                    }

                },
                error: function() {
                    alert("Server error");
                }
            });
        }

        loadQuestion();
    </script>

</body>

</html>