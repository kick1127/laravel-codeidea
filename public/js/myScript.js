//------------------------------------------------
// PC 전용
//------------------------------------------------

function mySlide() {
	//갤러리 슬라이드
	$('.hover.slide').each(function() {
		var container = $(this).find('swiper-container');
		if(container.length < 1) {
			$(this).wrapInner('<div class="swiper-container"><div class="swiper-wrapper">');
			$(this).find('img').each(function() {
				$(this).wrap('<div class="swiper-slide">');
			});
		}
	});	
}


$(document).ready(function() {
	
	var winHeight = $(window).outerHeight(),
		footerHeight = $('#footer').outerHeight();
	$('.page-container, .max-height').css({'min-height':winHeight - footerHeight - 102});


	$(window).scroll(function() {	
		if($(this).scrollTop() > 56) {
			$('#header:not(.fixed-transparent)').addClass('scroll-fixed');
			$('#header:not(.fixed-transparent)').animate({"top": 0}, 700, 'easeInOutExpo');
		}
		if($(this).scrollTop() > 401) {
			$('#header.fixed-transparent').addClass('scroll-fixed');
			$('#header.fixed-transparent').animate({"top": 0}, 700, 'easeInOutExpo');
		}
		if( $(this).scrollTop() < 55 ){
			$('#header').removeClass("scroll-fixed");
			$('#header').removeAttr("style");
			$('#header').clearQueue();
		}		
	});
	
	
	//갤러리 슬라이드
	mySlide();

	$('.hover.slide').each(function() {
		var a = $(this).parent();
		var slideWrapper = $(this);
		var mySwiper =  new Swiper($(slideWrapper.find('.swiper-container')), {
			paginationClickable: true,
			loop : true,
			autoplay: 500,
			autoplayDisableOnInteraction:false,
			slidesPerView: 1,
			spaceBetween: 0,
			centeredSlides: true
		});

		mySwiper.stopAutoplay();

		a.mouseover(function(){
			mySwiper.startAutoplay();
		});
		a.mouseleave(function(){
			mySwiper.stopAutoplay();
		});
	});

	



	// 갤러리 비디오 자동재생 및 슬라이드 플레이
	$('.portfolioContainer li a').mouseover(function(){
		var video = $(this).find('video');
		if(video.length) {
			var video_width = video.width();
			video.css({'margin-left': - video_width/2});
			video.get(0).play();
		}
	});
	$(".portfolioContainer li a").mouseleave(function(){
		var video = $(this).find('video');
		if(video.length) {
			video.get(0).pause();
		}
	});
	

	


});
