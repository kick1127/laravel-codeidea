//------------------------------------------------
// 공통적용
//------------------------------------------------


$(window).load(function(){
	$('.loader').fadeOut(300);
});




$(document).ready(function() {
	
	//view페이지에서 상단에 header영역을 포함하는 배경 블록이 있을때
	$('.view-header').each(function() {
		$('#header').addClass('fixed-transparent');
	});

	//팝업
	$('.popup-ajax:not(.insideClose)').magnificPopup({
		type: 'ajax',
		fixedContentPos: true,
		fixedBgPos: true,
		closeOnContentClick: false, 
        closeOnBgClick: false,
		overflowY: 'auto',
		closeBtnInside: false,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in'
	});
	$('.popup-ajax.insideClose').magnificPopup({
		type: 'ajax',
		fixedContentPos: true,
		fixedBgPos: true,
		closeOnContentClick: false, 
        closeOnBgClick: false,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-zoom-in'
	});

	$('.popup-inline:not(.insideClose)').magnificPopup({
		type: 'inline',
		fixedContentPos: false,
		fixedBgPos: true,
		closeOnContentClick: false, 
        closeOnBgClick: true,
		overflowY: 'auto',
		closeBtnInside: false,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-slide-bottom'
	});
	$('.popup-inline.insideClose').magnificPopup({
		type: 'inline',
		fixedContentPos: false,
		fixedBgPos: true,
		closeOnContentClick: false, 
        closeOnBgClick: true,
		overflowY: 'auto',
		closeBtnInside: true,
		preloader: false,
		midClick: true,
		removalDelay: 300,
		mainClass: 'my-mfp-slide-bottom'
	});

	$(document).on('click', '.popClose', function (e) {
		e.preventDefault();
		$.magnificPopup.close();
	});
	$('.myClick').click();


});