<!-- CONTENT -->
<div class="main-wrapper">

   <!-- SIDEBAR -->
   <div class="sidebar">
      <h5>📘 Materi</h5>
      <div class="lesson-item active" data-step="0">Stoikiometri & Hukum Dasar Kimia</div>
      <div class="lesson-item" data-step="1">Definisi dan Makna Konsep Mol</div>
      <div class="lesson-item" data-step="2">Hubungan Mol dengan Jumlah Partikel</div>
      <div class="lesson-item" data-step="3">Hubungan Mol dengan Massa</div>
      <div class="lesson-item" data-step="4">Hubungan Mol dengan Volume Gas</div>
      <div class="lesson-item" data-step="5">Konsep Mol dalam Larutan</div>
   </div>

   <!-- CONTENT -->
   <div class="content">

      <div class="video-box p-0">
            <video width="100%" height="100%" controls>
                <source src="<?= base_url('assets/materi/video/video.mp4') ?>" type="video/mp4">
                Browser tidak mendukung video.
            </video>
        </div>

      <div class="progress">
         <div class="progress-bar bg-success" id="progressBar"></div>
      </div>

      <div class="learning-area">

         <div class="left-image">
            <img id="stepImage" src="<?php echo base_url('assets/materi/2.JPG') ?>">
         </div>

         <div class="right-content">

            <div class="content-scroll">

               <!-- STEP 1 -->
               <div class="step-item active">
                  <h4>Pengantar Stoikiometri</h4>
                  <p>
                     Stoikiometri merupakan cabang kimia yang mempelajari hubungan kuantitatif antara zat-zat yang terlibat dalam suatu reaksi kimia. 
                     Pemahaman ini berakar pada hukum dasar kimia yang bersifat universal.
                     <br><br>
                     Hukum Lavoisier: massa reaktan = massa produk<br>
                     Hukum Proust: perbandingan massa unsur konstan<br>
                     Hukum Dalton: perbandingan bilangan bulat sederhana<br>
                     Gay-Lussac & Avogadro: perbandingan volume gas mengikuti koefisien reaksi
                  </p>
               </div>

               <!-- STEP 2 -->
               <div class="step-item">
                  <h4>Definisi dan Makna Konsep Mol</h4>
                  <p>
                     1 mol = 6,02 × 10^23 partikel<br><br>
                     Mol adalah satuan jumlah zat, bukan massa.
                  </p>
               </div>

               <!-- STEP 3 -->
               <div class="step-item">
                  <h4>Hubungan Mol dengan Jumlah Partikel</h4>
                  <p>
                     Hubungan mol dengan jumlah partikel:<br><br>
                     <b>x = n × NA</b>
                  </p>
               </div>

               <!-- STEP 4 -->
               <div class="step-item">
                  <h4>Hubungan Mol dengan Massa</h4>
                  <p>
                     Hubungan mol dengan massa:<br><br>
                     <b>m = n × Mr</b>
                  </p>
               </div>

               <!-- STEP 5 -->
               <div class="step-item">
                  <h4>Hubungan Mol dengan Volume Gas</h4>
                  <p>
                     Hubungan mol dengan volume gas:<br><br>
                     <b>V = n × Vm</b><br><br>
                     STP = 22,4 L/mol<br>
                     RTP = 24 L/mol<br><br>
                     Persamaan gas ideal:<br>
                     <b>PV = nRT</b>
                  </p>
               </div>

               <!-- STEP 6 -->
               <div class="step-item">
                  <h4>Konsep Mol dalam Larutan</h4>
                  <p>
                     Molaritas:<br>
                     <b>M = n / V</b><br><br>
                     Pengenceran:<br>
                     <b>M1V1 = M2V2</b>
                  </p>
               </div>

            </div>

            <div class="footer-nav">
               <button class="btn btn-light btn-prev">Prev</button>
               <div>Step <span id="currentStep">1</span>/<span id="totalStep">6</span></div>
               <button class="btn btn-success btn-next">Next</button>
            </div>

         </div>

      </div>
   </div>
</div>

<script>

/* STEP */
let current=0;
let steps=$('.step-item');

let images=[
   "<?php echo base_url('assets/materi/2.JPG') ?>",
   "<?php echo base_url('assets/materi/2-5.JPG') ?>",
   "<?php echo base_url('assets/materi/2-5.JPG') ?>",
   "<?php echo base_url('assets/materi/2-5.JPG') ?>",
   "<?php echo base_url('assets/materi/2-5.JPG') ?>",
   "<?php echo base_url('assets/materi/2-5.JPG') ?>"
];

$('#totalStep').text(steps.length);

function showStep(i){
   steps.removeClass('active');
   steps.eq(i).addClass('active');

   $('#currentStep').text(i+1);
   $('#totalStep').text(steps.length);

   $('#stepImage').attr('src',images[i]);

   let percent = Math.round(((i + 1) / steps.length) * 100);
   $('#progressBar').css('width', percent + '%');

   $('.lesson-item').removeClass('active');
   $('.lesson-item').eq(i).addClass('active');

   $('.btn-prev').prop('disabled', i === 0);

   if(i === steps.length - 1){
      $('.btn-next').removeClass('btn-success').addClass('btn-primary').text('Finish');
   }else{
      $('.btn-next').removeClass('btn-primary').addClass('btn-success').text('Next');
   }
}

$('.btn-next').click(function(){
   if(current < steps.length - 1){
      current++;
      showStep(current);
   }else{
      if(confirm('Materi selesai, lanjut ke quiz?')){
         window.location.href = "<?= base_url('quiz/start') ?>";
      }
   }
});

$('.btn-prev').click(()=>{
   if(current>0){
      current--;
      showStep(current);
   }
});

$('.lesson-item').click(function(){
   let i = $(this).data('step');
   current = i;
   showStep(i);
});

showStep(current);

</script>