<?php include_once('./front/lib/common.lib.php'); ?>
@include('partials.header')

<div class="page-container">
	
	<section id="portfolio">
		<div class="portfolio-nav">			
			<ul>
				<li class="active"><span>ALL</span></li>
				<li><span>UI</span></li>
				<li><span>UX</span></li>
				<li><span>AD</span></li>
			</ul>
			<span class="toggle mobile_only"></span>
		</div>
		<div class="portfolioContainer">
			<ul>
				<li>
					<span class="tag">POPUP</span>
					<a href="{{ route('front.ajax-gallView') }}" class="popup-ajax"> <!-- 팝업으로 열때 -->						
						<div class="thumb"><img src="./img/temp/temp01.png"></div>
					</a>
				</li>
				<li>
					<span class="tag">GIF</span>
					<a href="{{ route('front.pfview') }}">						
						<div class="thumb"><img src="./img/temp/temp02.png"></div>
						<?php if (!$chkMobile) { //pc전용 ?>
						<div class="hover"><img src="./img/temp/temp.gif"></div><!-- gif로 띄울때 -->
						<?php } ?>
					</a>
				</li>
				<li>
					<span class="tag">TEXT</span>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp03.png"></div>
						<?php if (!$chkMobile) { //pc전용 ?>
						<div class="hover text"><!-- 텍스트로 띄울때 -->
							<span class="sibject">프로젝트 제목</span>
							<p class="content">
								주식투자에 관심 없는 사람들 조차도 '신풍제약'이라는 이름은 한두 번쯤 들어보았을 것이다. 신풍제약은 지난해 자체 개발 제품인..
							</p>
							<p class="info">2021.07.05</p>							
						</div>
						<?php } ?>
					</a>
				</li>
				<li>
					<span class="tag">VIDEO</span>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp04.png"></div>
						<?php if (!$chkMobile) { //pc전용 ?>
						<div class="hover video"><!-- mp4영상으로 띄울때 -->
							<video src="./img/temp/temp_video.mp4"  muted="muted" class="video"></video>
						</div>
						<?php } ?>
					</a>
				</li>
				<li>
					<span class="tag">SLIDE</span>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp05.png"></div>
						<?php if (!$chkMobile) { //pc전용 ?>
						<div class="hover slide"><!-- 슬라이드로 띄울때 --> <!-- 슬라이드형식 리스트를 ajax나 api형식으로 추가 로드하면 <script>mySlide();</script>를 한번 적용해줘야합. js/myScript.js에 있음 -->
							<img src="./img/temp/temp05.png">
							<img src="./img/temp/temp06.png">
							<img src="./img/temp/temp07.png">
							<img src="./img/temp/temp08.png">
							<img src="./img/temp/temp09.png">
						</div>
						<?php } ?>
					</a>
				</li>
				<li>
					<span class="tag">TAG #1</span>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp06.png"></div>
					</a>
				</li>
				<li>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp07.png"></div>
					</a>
				</li>
				<li>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp08.png"></div>
					</a>
				</li>
				<li>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp09.png"></div>
					</a>
				</li>
				<li>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp10.png"></div>
					</a>
				</li>
				<li>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp11.png"></div>
					</a>
				</li>
				<li>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp12.png"></div>
					</a>
				</li>
				<li>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp13.png"></div>
					</a>
				</li>
				<li>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp14.png"></div>
					</a>
				</li>
				<li>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp15.png"></div>
					</a>
				</li>
				<li>
					<a href="{{ route('front.pfview') }}">
						<div class="thumb"><img src="./img/temp/temp16.png"></div>
					</a>
				</li>
			</ul>
		</div>
	</section>

</div>

@include('partials.footer')