<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - ElectronLab</title>

<link href="<?php echo base_url('assets/css/bootstrap-4.6.2.min.css'); ?>" rel="stylesheet">
<script src="<?php echo base_url('assets/js/jquery-3.6.0.min.js'); ?>"></script>

<style>

/* BACKGROUND SAMA */
body {
   background: linear-gradient(-45deg, #6366F1, #8B5CF6, #4F46E5, #7C3AED);
   background-size: 400% 400%;
   animation: gradientMove 12s ease infinite;
   font-family: 'Segoe UI', sans-serif;
   color: #fff;
   min-height: 100vh;
   display:flex;
   align-items:center;
   justify-content:center;
}

@keyframes gradientMove {
   0% { background-position: 0% 50%; }
   50% { background-position: 100% 50%; }
   100% { background-position: 0% 50%; }
}

/* CARD GLASS */
.login-card {
   width:100%;
   max-width:400px;
   background: rgba(255,255,255,0.1);
   backdrop-filter: blur(15px);
   border-radius:20px;
   padding:30px;
}

/* INPUT */
.form-control {
   background: rgba(255,255,255,0.1);
   border:none;
   color:#fff;
}

.form-control::placeholder {
   color:rgba(255,255,255,0.6);
}

.form-control:focus {
   background: rgba(255,255,255,0.2);
   color:#fff;
   box-shadow:none;
}

/* BUTTON */
.btn-login {
   background:#22C55E;
   border:none;
   border-radius:25px;
}

/* ALERT */
.alert {
   display:none;
}

</style>
</head>

<body>

<div class="login-card">

   <h4 class="text-center mb-4">🚀 Login ElectronLab</h4>

   <div class="alert alert-danger" id="errorMsg"></div>
   <div class="alert alert-success" id="successMsg"></div>

   <form id="loginForm">

      <div class="form-group">
         <label>Nama</label>
         <input type="text" name="nama" class="form-control" placeholder="Masukkan nama" required>
      </div>

      <div class="form-group">
         <label>Email</label>
         <input type="email" name="email" class="form-control" placeholder="Masukkan email" required>
      </div>

      <button type="submit" class="btn btn-login btn-block mt-3">
         Login
      </button>

   </form>

</div>

<script>

$('#loginForm').submit(function(e){
   e.preventDefault();

   let formData = $(this).serialize();

   // RESET MESSAGE
   $('#errorMsg').hide();
   $('#successMsg').hide();

   $.ajax({
      url: "<?= base_url('user/login') ?>",
      method: "POST",
      data: formData,
      dataType: "json",
      success: function(res){

         if(res.status == 'success'){
            $('#successMsg').text(res.message).fadeIn();

            // redirect setelah login
            setTimeout(()=>{
               window.location.href = "<?= base_url('quiz/index') ?>";
            },1000);

         }else{
            $('#errorMsg').text(res.message).fadeIn();
         }

      },
      error: function(){
         $('#errorMsg').text('Server error!').fadeIn();
      }
   });

});

</script>

</body>
</html>