<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="<?= base_url('assets/admin/css/adminlte.min.css') ?>">
</head>
<body class="login-page">
<div class="login-box">
<div class="card p-3">
<h2 class="login-box-msg">Login</h2>
<p class="login-box-msg"><?= isset($message) ? $message : '' ?></p>
<form method="post" action="<?= base_url('auth/do_login') ?>">
<input name="email" class="form-control mb-2" placeholder="Email">
<input name="password" type="password" class="form-control mb-2" placeholder="Password">
<button class="btn btn-primary btn-block">Login</button>
</form>
</div>
</div>
</body>
</html>