$(document).ready(function(){

	/* NAVBAR SCROLL */
	$(window).scroll(function() {
		$('.custom-navbar').toggleClass('navbar-scrolled', $(this).scrollTop() > 50);
	});

	/* THEME INIT */
	function setInitialTheme() {
		let saved = localStorage.getItem('theme');

		if (saved === 'light') {
			$('body').addClass('light-mode');
			$('.theme-toggle').text('☀️');
		}
	}
	setInitialTheme();

	/* TOGGLE THEME */
	$('#toggleTheme, #toggleThemeMobile').click(function() {
		$('body').toggleClass('light-mode');

		if ($('body').hasClass('light-mode')) {
			localStorage.setItem('theme','light');
			$('.theme-toggle').text('☀️');
		} else {
			localStorage.setItem('theme','dark');
			$('.theme-toggle').text('🌙');
		}
	});

	/* MOBILE MENU */
	$('#menuToggle').click(function(){
		$('#mobileMenu').addClass('active');
		$('#mobileOverlay').addClass('active');
	});

	$('#mobileOverlay').click(function(){
		$('#mobileMenu').removeClass('active');
		$('#mobileOverlay').removeClass('active');
	});

});



// Materi JS 
