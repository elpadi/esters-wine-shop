class DOM {

	static forceTargetBlank() {
		for (let l of $$('.external-link').concat(
			[/* other external links */]
		)) l.target = '_blank';
	}

	static fixTopPositions() {
		let t = document.querySelector('#masthead').offsetHeight;
		for (let s of ['#page','#tome-menu'])
			document.querySelector(s).style.paddingTop = t + 'px';
		for (let s of ['#menu-burger'])
			document.querySelector(s).style.marginTop = t + 'px';
	}

	static isElementInViewport(rect, vw, vh, threshold=0.3) {
		return rect.top < vh * (1 - threshold) && rect.bottom > vh * threshold;
	}

}

module.exports = DOM;
