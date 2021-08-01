<?php include_once('./lib/common.lib.php'); ?>
<!DOCTYPE html>
<html>
<head>
	<meta  charset="utf-8">	
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1.0,user-scalable=yes" />
	<meta http-equiv="X-UA-Compatible" content="IE=10,chrome=1">
	<title>CODEIDEA</title> 

	<!-- Favicons -->
	<link rel="shortcut icon" href="./img/favorite/favorite.ico">

	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/gh/moonspam/NanumSquare@1.0/nanumsquare.css">
	<!-- Styles -->
	<link href="<?=get_url('./css/iconfont/newfont/styles.css')?>" rel="stylesheet" media="screen">
	<link href="<?=get_url('./css/iconfont/codeidea/styles.css')?>" rel="stylesheet" media="screen">
	<link href="<?=get_url('./js/wow/animate.css')?>" rel='stylesheet' type='text/css'>
	<link href="<?=get_url('./css/root.css')?>" rel='stylesheet' type='text/css'>	
	<link href="<?=get_url('./js/magnific-popup/magnific-popup.css')?>" rel="stylesheet">
	<link href="<?=get_url('./js/swiper/swiper.min.css')?>" rel='stylesheet' type='text/css'>	
	<link href="<?=get_url('./js/form/bootstrap-select/bootstrap-select.css')?>" rel='stylesheet' type='text/css'>
	<link href='<?=get_url('./js/form/myform.css')?>' rel='stylesheet' type='text/css'>
	<link href="<?=get_url('./css/styleDefault.css')?>" rel="stylesheet" media="screen">
	<?php if ($chkMobile) { //모바일
		echo '<link rel="stylesheet" href="'.get_url('./css/mobile.css').'">'.PHP_EOL;
	} else {
		echo '<link href="'.get_url('./css/style.css').'" rel="stylesheet" media="screen">';
	} ?>

	<!-- SCRIPTS -->
	<script src="./js/jquery.min.js"></script>
	<script src='<?=get_url('./js/wow/easing.js')?>'></script>
	<script src='<?=get_url('./js/wow/wow.js')?>'></script>	
	<script src="<?=get_url('./js/magnific-popup/jquery.magnific-popup.js')?>"></script>
	<script src="<?=get_url('./js/swiper/swiper.min.js')?>"></script>
	<script src='<?=get_url('./js/form/bootstrap-select/bootstrap.min.js')?>'></script>
	<script src='<?=get_url('./js/form/bootstrap-select/bootstrap-select.js')?>'></script>
	<script src='<?=get_url('./js/form/myform.js')?>'></script>
	<script src="<?=get_url('./js/common.js')?>"></script>
	<?php if ($chkMobile) { //모바일
		echo '<script src="'.get_url('./js/myScript.mob.js').'"></script>';
	} else {
		echo '<script src="'.get_url('./js/myScript.js').'"></script>';
	} ?>	

</head>
<body>

<div class="loader flexCenter">
	<div class="ani-loader"></div>
</div>

<header id="header">
	<div class="header-container">
		<div id="header-logo">
			<a href="index.php" class="logo" alt="CODEIDEA">
				<span class="code"></span>
				<span class="i"></span>
				<span class="d"></span>
				<span class="e"></span>
				<span class="a"></span>
			</a>
		</div>
		<nav id="nav">
			<a href="index.php" class="logo mobile_only" alt="CODEIDEA">
				<span class="code"></span>
				<span class="i"></span>
				<span class="d"></span>
				<span class="e"></span>
				<span class="a"></span>
			</a>
			<ul class="nav_ul">
				<li><a href="portfolio.php">Portfolio</a></li>
				<li><a href="contact.php">Contact</a></li>
			</ul>
			<div class="footer mobile_only">
				<p><span class="map">Seongsuil-ro 6-gil, Seongdong-gu, Seoul</span></p>
				<p><span>Tel : <a href="tel:010-5440-5414">010-5440-5414</a></span><span class="ml20">Email : <a href="mailto:huchiy@gmail.com">huchiy@gmail.com</a></span></p>
			</div>
		</nav>
	</div>
</header>
<div id="headerSpace"></div>