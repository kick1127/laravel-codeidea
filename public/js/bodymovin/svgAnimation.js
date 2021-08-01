function loadBMAnimation(loader, path, stop) {
	var anim = bodymovin.loadAnimation({
		container: document.querySelector(loader),
		renderer: 'svg',
		loop: true,
		autoplay: true,
		path: path
	});
	
}

function loadBMAnimationClass(loader, path) {
	var el = document.getElementsByClassName(loader);
	for (var i = 0; i < el.length; i++) {
		var animation = bodymovin.loadAnimation({
			container: el[i],
			renderer: "svg",
			loop: true,
			autoplay: true,
			path: path
		});
	}
}

loadBMAnimationClass('ani-loader', 'img/ani/loader.json');
loadBMAnimationClass('ani-logo', 'img/ani/logo.json');
loadBMAnimationClass('ani-contact', 'img/ani/contact.json');
loadBMAnimationClass('ani-object06', 'img/ani/object06.json');
loadBMAnimationClass('ani-object08', 'img/ani/object08.json');
loadBMAnimationClass('ani-object11', 'img/ani/object11.json');
loadBMAnimationClass('ani-object12', 'img/ani/object12.json');



//loadBMAnimation('#idid', 'img/ani/sdfsdfad.json');




