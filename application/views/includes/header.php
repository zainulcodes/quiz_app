<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>MolScope</title>

	<link href="<?php echo base_url('assets/css/bootstrap.min.css'); ?>" rel="stylesheet">
	<link rel="stylesheet" href="<?php echo base_url('assets/css/styles.css'); ?>">

	<script src="<?php echo base_url('assets/js/jquery-3.6.0.min.js'); ?>"></script>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark custom-navbar fixed-top">
	<div class="container">

		<a href="<?php echo base_url(); ?>" class="navbar-brand">MolScope</a>

		<button class="navbar-toggler" id="menuToggle">☰</button>

		<div class="collapse navbar-collapse d-none d-lg-flex justify-content-end">
			<ul class="navbar-nav align-items-center">

				<li><a href="<?php echo base_url(); ?>" class="nav-link active-menu">Home</a></li>
				<li><a href="<?php echo base_url('materi'); ?>" class="nav-link">Materi</a></li>
				<li><a href="<?php echo base_url('quiz/start'); ?>" class="nav-link">Quiz</a></li>
				<li><a href="<?php echo base_url('soal'); ?>" class="nav-link">Soal</a></li>
				<li><a href="<?php echo base_url('quiz/quiz_ranking'); ?>" class="nav-link">Ranking Quiz</a></li>
				<li><a href="<?php echo base_url('soal/ranking'); ?>" class="nav-link">Ranking Soal</a></li>
				<li class="ml-3">
					<button id="toggleTheme" class="theme-toggle">🌙</button>
				</li>

				<li class="ml-2">
					<a href="<?php echo base_url('user/logout'); ?>" class="btn btn-register">Log out</a>
				</li>

			</ul>
		</div>

	</div>
</nav>

<!-- MOBILE MENU -->
<div class="mobile-menu" id="mobileMenu">
	<div class="mobile-content">

		<div class="d-flex justify-content-between align-items-center mb-3">
			<h5 class="mb-0">Menu</h5>

			<button id="toggleThemeMobile" class="theme-toggle">🌙</button>
		</div>

		<a href="<?php echo base_url(); ?>" class="nav-link">Home</a>
		<a href="<?php echo base_url('materi'); ?>" class="nav-link">Materi</a>
		<a href="<?php echo base_url('quiz/start'); ?>" class="nav-link">Quiz</a>
		<a href="<?php echo base_url('soal'); ?>" class="nav-link">Soal</a>
		<a href="<?php echo base_url('quiz/quiz_ranking'); ?>" class="nav-link">Ranking Quiz</a>
		<a href="<?php echo base_url('soal/ranking'); ?>" class="nav-link">Ranking Soal</a>

		<hr>
		<a href="<?php echo base_url('user/logout'); ?>" class="btn btn-register">Log out</a>

	</div>
</div>

<div class="mobile-overlay" id="mobileOverlay"></div>