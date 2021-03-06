const $ = require('jquery');

class ColumnizeText {

	constructor() {
		if (window.innerWidth > 980 && !document.body.classList.contains('legal-page')) this.columnize();
	}

	columnize() {
		let ps = $('#main .entry-content > p'), i = -1, splits = [], isInMiddle = false;
		ps.each((j, el) => {
			if (!isInMiddle) {
				i++;
				splits.push([]);
				isInMiddle = true;
			}
			splits[i].push(el);
			isInMiddle = el.nextElementSibling && el.nextElementSibling.nodeName == 'P';
		});
		console.log('PageContent.columnizeText', ps. splits);
		splits.forEach(group => {
			$(document.createElement('div')).addClass('text-columns').insertBefore(group[0]).append(group);
		});
	}

}

module.exports = ColumnizeText;
