$(document).ready(function() {

	//Попап менеджер FancyBox
	//Документация: http://fancybox.net/howto
	//<a class="fancybox"><img src="image.jpg" /></a>
	//<a class="fancybox" data-fancybox-group="group"><img src="image.jpg" /></a>
	$(".fancybox").fancybox();

	//Плавный скролл до блока .div по клику на .scroll
	//Документация: https://github.com/flesler/jquery.scrollTo
	$("a.scroll").click(function() {
		$.scrollTo($(".div"), 800, {
			offset: -90
		});
	});

	$(".menu-button").click(function() {
		$(".menu ul").slideToggle();
	});

	// Гелеря fancy-box

	$("a.gallery").fancybox(
	{
		"padding" : 20,
		"imageScale" : false, 
		"zoomOpacity" : false,
		"zoomSpeedIn" : 1000,   
		"zoomSpeedOut" : 1000,  
		"zoomSpeedChange" : 1000, 
		"frameWidth" : 700,  
		"frameHeight" : 600, 
		"overlayShow" : true, 
		"overlayOpacity" : 0.8, 
		"hideOnContentClick" :false,
		"centerOnScroll" : false
	});

	// MMENU

    $(function() {
        $('nav#menu').mmenu({
        	extensions	: [ 'fx-listitems-slide', 'fx-panels-zoom', 'fx-listitems-slide', 'multiline', 'shadow-page', 'shadow-panels', 'listview-large', 'pagedim-black' ]
        });
    });

    $(function() {
    	$('#mm-1 .mm-title').text('Меню');
    });
    
});