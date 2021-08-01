//------------------------------------------------
// MOBILE 전용
//------------------------------------------------

function toggleClass(el, target_='parent', classname='open', option='') {
	$(el).click(function() {	
		var target = target_ == 'parent' ? $(this).parent() : $(target_);
		$(target).toggleClass(classname);
		$(el).not(this).parent().removeClass(classname);
		$(target).find('.fixedCover').fadeToggle(200);
		if(option == 'scrollDisable') {
			$('html').toggleClass('scrollDisable');
		}
	});
	$(el).siblings('.fixedCover').click(function() {
		var target = target_ == 'parent' ? $(this).parent() : $(target_);
		$(target).removeClass(classname);
		$('html').removeClass('scrollDisable');
		$(this).fadeToggle(200);
	});
}


$(document).ready(function() {

	var winHeight = $(window).outerHeight(),
		footerHeight = $('#footer').outerHeight();
	$('.page-container, .max-height').css({'min-height':winHeight - footerHeight - 102});
	
	$('#header #nav').each(function() {
		$(this).before('<span class="nav-opener"></span>');
		$(this).prepend('<span class="nav-closer"></span>');
	});

	$('#header .nav-opener').click(function() {
		$('#header #nav').animate({"right": 0}, 400, 'easeInOutExpo');
		$('#header .nav-opener, #header #header-logo').animate({"opacity": 0}, 400, 'easeInOutExpo');
		$('html').addClass('scrollDisable');
	});
	$('#header .nav-closer').click(function() {
		$('#header #nav').animate({"right": "-100%"}, 400, 'easeInOutExpo');
		$('#header .nav-opener, #header #header-logo').animate({"opacity": 1}, 400, 'easeInOutExpo');
		$('html').removeClass('scrollDisable');
	});

	

	$(window).scroll(function() {	
		if($(this).scrollTop() > 56) {
			$('#header').addClass('scroll-fixed');
			$('#header').animate({"top": 0}, 700, 'easeInOutExpo');
		}
		if( $(this).scrollTop() < 55 ){
			$('#header').removeClass("scroll-fixed");
			$('#header').removeAttr("style");
			$('#header').clearQueue();
		}		
	});

	if($('.portfolio-nav').length) {
		//갤러리 페이지 플로팅버튼
		$('.portfolio-nav .toggle').each(function() {
			$(this).after('<div class="fixedCover"></div>');
		});
		toggleClass('.portfolio-nav .toggle','parent','open','scrollDisable');
	}


});

window.onorientationchange = function() { //모바일 가로세로모드 변화감지
	//alert('모드변화');
}