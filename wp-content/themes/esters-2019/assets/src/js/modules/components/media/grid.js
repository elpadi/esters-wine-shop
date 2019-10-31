const $ = require('jquery');

class MediaGrid {

	constructor(items, name='grid') {
		this.container = $(document.createElement('div')).addClass(`${name}-columns columns`).append(items);
		requestAnimationFrame(() => this.initGridItems());
	}

	initGridItems() {
		this.makeCaptionLinks();
	}

	makeCaptionLinks() {
		this.container.find('figcaption').each((i, cap) => {
			if (cap.previousElementSibling.nodeName == 'A') {
				let a = cap.previousElementSibling.cloneNode();
				a.innerHTML = cap.innerHTML;
				cap.innerHTML = '';
				cap.appendChild(a);
			}
		});
	}

}

module.exports = MediaGrid;
