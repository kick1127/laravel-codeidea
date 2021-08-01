<?php include_once('./front/lib/common.lib.php'); ?>
@include('partials.header')

<div id="mainpage" class="page-container">
	
	<?php if (!$chkMobile) { ;//pc전용 ?>
	<section class="main-wrap max-height pc_only" style="">	
		<div class="imageHolder object01"><img src="{{ asset('front/img/main/object01.png') }}" style=""></div>
		<div class="imageHolder object02"><img src="{{ asset('front/img/main/object02.png') }}" style=""></div>
		<div class="imageHolder object03"><img src="{{ asset('front/img/main/object03.png') }}" style=""></div>
		<div class="imageHolder object04"><img src="{{ asset('front/img/main/object04.png') }}" style=""></div>
		<div class="imageHolder object05"><img src="{{ asset('front/img/main/object05.png') }}" style=""></div>
		<div class="imageHolder object06"><span class="ani-object06"></span><!--<img src="./img/main/object06.png" style="">--></div>
		<div class="imageHolder object07"><img src="{{ asset('front/img/main/object07.png') }}" style=""></div>
		<div class="imageHolder object08"><span class="ani-object08"></span><!--<img src="./img/main/object08.png" style="">--></div>
		<div class="imageHolder object09"><span class="ani-logo"></span></div>
		<div class="imageHolder object10"><img src="{{ asset('front/img/main/object10.png') }}" style=""></div>
		<div class="imageHolder object11"><span class="ani-object11"></span><!--<img src="./img/main/object11.png" style="">--></div>
		<div class="imageHolder object12"><span class="ani-object12"></span><!--<img src="./img/main/object12.png" style="">--></div>
		<div class="imageHolder object13"><img src="{{ asset('front/img/main/object13.png') }}" style=""></div>
		<div class="imageHolder object14"><img src="{{ asset('front/img/main/object14.png') }}" style=""></div>
		<div class="imageHolder object15"><img src="{{ asset('front/img/main/object15.png') }}" style=""></div>
		<div class="imageHolder object16"><img src="{{ asset('front/img/main/object16.png') }}" style=""></div>
		<div class="imageHolder object17"><img src="{{ asset('front/img/main/object17.png') }}" style=""></div>
		<div class="imageHolder object18">
			<a href="{{ route('front.portfolio') }}" class="btn red portfolio">PORTFOLIO</a>
			<a href="{{ route('front.contact') }}" class="btn green contact">CONTACT</a>
		</div>
	</section>
	<?php } ?>
	
	<?php if ($chkMobile) { //mobile전용 ?>
	<section class="main-wrap mobile_only max-height flexCenter">
		<div style="position:absolute;top:10%;left:0;width:100%;text-align:center;"><span class="ani-logo"></span></div>
		<div style="position:absolute;bottom:5%;"><img src="{{ asset('front/img/temp/mobile-ani.png') }}" style="max-width:calc(100% - 40px);margin:40px auto"></div>
	</section>
	<?php } ?>
	
</div>

<?php if (!$chkMobile) { //pc전용 ?>
<script>
$(document).on("mousemove", function(event) {
	var window_height = $('.page-container').height();
	var window_width = $(this).width();
	var mouseXpos = event.clientX;
	var mouseYpos = event.clientY;
	var YrotateDeg = (window_width / 2 - mouseXpos) * 0.003;
	var XrotateDeg = (window_height / 2 - mouseYpos) * -0.003;
	$(".main-wrap").css(
	"transform",
	"rotateX(" + XrotateDeg + "deg) rotateY(" + YrotateDeg + "deg)"
	);
});

$(document).ready(function() {
	$('.btn.portfolio, .btn.contact').mouseover(function(){
		$('.main-wrap').addClass('blur');
	});
	$(".btn.portfolio, .btn.contact").mouseleave(function(){
		$('.main-wrap').removeClass('blur');
	});
});
</script>
<?php } ?>

@include('partials.footer')