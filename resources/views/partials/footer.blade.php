

<!-- Footer -->
<footer id="footer" class="footer">
	<div class="footer-container">
		<div class="footerCon" style="font-size:12px;">
			©CODEIDEA <?=date('Y')?> All Rights Reserved<br>Co : codeidea.dev&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Co Number : 508-20-64700&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Tel : 010-5440-5414&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Email : huchiy@gmail.com&nbsp;&nbsp;&nbsp;|&nbsp;&nbsp;&nbsp;Address : 18-9, Yeonnam-ro 3-gil, Mapo-gu, Seoul
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