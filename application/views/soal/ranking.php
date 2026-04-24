<div class="container py-5">

    <!-- 🔥 SCORE -->
    <div class="result-box">
        <h4>Hasil Soal Kamu</h4>
        <?php $score = $soal['score']; ?>
        <?php $score = $total_soal; ?>
        <div class="score">
            <?= $score ?> / <?= $total_soal ?>
        </div>

        <p class="mt-2">Keren! terus tingkatkan ya 🚀</p>

        <a href="<?= base_url('soal') ?>" class="btn btn-light mt-3">
            Ulangi Soal
        </a>
    </div>

    <!-- 🏆 RANKING -->
    <div class="card-ranking">
        <h5 class="mb-3 text-center">🏆 Leaderboard Soal (Realtime)</h5>

        <table class="table table-bordered table-hover">
            <thead class="thead-dark">
                <tr>
                    <th width="10%">Rank</th>
                    <th>Nama</th>
                    <th width="20%">Score</th>
                </tr>
            </thead>

            <!-- 🔥 WAJIB ADA ID -->
            <tbody id="ranking-body">
                <tr><td colspan="3" class="text-center">Loading...</td></tr>
            </tbody>
        </table>
    </div>

</div>

<script>
var lastUser = <?= json_encode($this->session->userdata('last_user_id')); ?>;

function loadRanking(){
    $.ajax({
        url: "<?= base_url('soal/get_ranking_ajax') ?>",
        type: "GET",
        dataType: "json",
        success: function(data){

            var html = "";
            var no = 1;

            data.forEach(function(r){

                var rowClass = "";

                // 🏆 TOP 3
                if(no == 1) rowClass = "top1";
                else if(no == 2) rowClass = "top2";
                else if(no == 3) rowClass = "top3";

                // 🔥 HIGHLIGHT USER
                if(r.user_id == lastUser){
                    rowClass += " me";
                }

                html += `
                    <tr class="${rowClass}">
                        <td>${no}</td>
                        <td>${r.name ? r.name : 'User ' + r.user_id}</td>
                        <td>${r.score}</td>
                    </tr>
                `;

                no++;
            });

            $("#ranking-body").html(html);
        },
        error: function(){
            $("#ranking-body").html('<tr><td colspan="3">Error load data</td></tr>');
        }
    });
}

// 🔁 AUTO REFRESH
setInterval(loadRanking, 3000);

// LOAD PERTAMA
loadRanking();
</script>