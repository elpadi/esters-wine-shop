const $ = require('jquery');
const AboutPage = require('./about');

class PageContent {

	constructor() {
		if (document.body.classList.contains('page-template')) {
			this.columnizeText();
		}
		if (document.body.classList.contains('page--about')) new AboutPage();
	}

	columnizeText() {
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

module.exports = PageContent;
