const $ = require('jquery');
const HomePage = require('./home');
const AboutPage = require('./about');

class PageContent {

	constructor() {
		let bcl = document.body.classList;
		if (bcl.contains('page-template')) {
			this.columnizeText();
		}
		if (bcl.contains('page--about')) new AboutPage();
		if (bcl.contains('home')) new HomePage();
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
