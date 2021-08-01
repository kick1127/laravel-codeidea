

<!-- Footer -->
<footer id="footer" class="footer">
	<div class="footer-container">
		<div class="footerCon">
			©CODEIDEA All Rights Reserved
		</div>
		<div class="footerNav pc_only">
			<a href="{{ route('front.portfolio') }}">Portfolio</a>
			<a href="{{ route('front.contact') }}">Contact</a>
		</div>
	</div>
</footer>

<script src="js/bodymovin/lottie.min.js"></script>
<script src='<?=get_url('js/bodymovin/svgAnimation.js')?>'></script>
<script>
wow = new WOW({
	animateClass: 'animated',
	offset:100,
	live:true,
	callback:function(box) {
	}
});
wow.init();
</script>