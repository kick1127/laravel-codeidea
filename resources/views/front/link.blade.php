<?php include_once('./header.php'); ?>

<style>
body{background:#fff;}
#header, #footer, .bg-parallax{display:none !important;}
.page-link .btn{vertical-align:middle;display:inline-block;cursor:pointer;padding:0 15px;max-width:100%;height:38px;line-height:39px;font-family:'NanumSquareRound', sans-serif;font-size:12px;font-weight:700;
	color:#fff;text-align:left;background:#474e67;border-radius:3px;transition:all .2s ease-in-out;overflow :hidden;white-space:nowrap;text-overflow:ellipsis;}
.page-link .btn:hover{background:#474e67;}
.page-link li{position:relative;margin:10px 0; font-size:12px;}
.page-link li a:after{content:""attr(href)"";font-size:10px;color:#fffa6c;font-weight:400;margin-left:10px;display:inline-block;}
.page-link li a:hover{}
.page-link li a.tt{margin-top:20px;}
.page-link li a.not{background:#ff9130}
.page-link li a.no{background:rgba(53,57,69,0.3) !important;}
.page-link li a.add{background:#ff8b45 !important;}
.page-link li a.common{background:#252628;}
.page-link li a.popup-ajax, .page-link li a.popup-inline{background:#4365e2;}
.page-link li a.popup-ajax:hover, .page-link li a.popup-inline:hover{background:#254ad6;}
/*.page-link li ul{position:relative;margin-top:30px;padding-left:130px;}
.page-link li ul:before{position:absolute;top:0;left:0;z-index:6;content:attr(data-label);font-size:12px;font-weight:400;margin-right:10px;display:inline-block;padding:0 10px;line-height:1em;height:28px;border-radius:3px;border:1px solid rgba(0,0,0,0.2);box-shadow:0 4px 5px rgba(0,0,0,0.03);display:inline-flex;align-items:center;justify-content:center;}
.page-link li ul li{position:relative;}
.page-link li ul li:before{content:'';display:inline-block;width:20px;height:1px;background:rgba(0,0,0,0.2);position:absolute;top:50%;left:-20px;z-index:0;}
.page-link li ul li:first-child:before{width:100px;left:-100px;}*/

.page-link li.sub{display:flex;align-items:flex-first;margin-top:30px;font-family:'NanumSquareRound', sans-serif;}
.page-link li.sub .label{font-size:13px;font-weight:600;margin-top:13px;margin-right:50px;display:inline-block;padding:0 10px;line-height:1em;height:32px;border-radius:3px;color:#fff;background:#858ca5;display:inline-flex;align-items:center;justify-content:center;}
.page-link li.sub ul{position:relative;}
.page-link li.sub ul:before{content:'';position:absolute;top:30px;left:-20px;width:1px;height:calc(100% - 58px);background:#aeb5cd;display:inline-block;}
.page-link li ul li:before{content:'';display:inline-block;width:20px;height:1px;background:#aeb5cd;position:absolute;top:50%;left:-20px;z-index:0;}
.page-link li ul li:first-child:before{width:50px;left:-50px;}
</style>


<div class="container" style="padding:40px 15px;font-size:14px;">
	<!--<span style="display:inline-block;width:6px;height:6px;background:#4365e2;margin-right:5px;"></span> 팝업
	<span style="display:inline-block;width:6px;height:6px;background:#252628;margin-right:5px;margin-left:20px;"></span> 내용없음 페이지-->
	<ul class="page-link mt30">
		<li><a href="index.php" target="_blank" class="btn">메인페이지</a></li>

		<li><a href="portfolio.php" target="_blank" class="btn">Portfolio</a></li>
		<li><a href="contact.php" target="_blank" class="btn">Contact</a></li>

		<li><a href="ajax.gallView.php" target="_blank" class="btn popup-ajax">view (팝업)</a></li>



		<li class="mt60"><a href="./css/iconfont/codeidea/" target="_blank" class="btn">아이콘 (codeidea)</a></li>
		<li class=""><a href="./css/iconfont/newfont/" target="_blank" class="btn">아이콘 (newfont)</a></li>

	</ul>
</div>

<script>
$('li').each(function() {
	var label = $(this).attr('data-label');
	if(label) {
		$(this).addClass('sub');
		$(this).prepend('<span class="label">' + label + '<span>');
	}
});
</script>