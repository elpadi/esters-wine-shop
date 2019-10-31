const $ = require('jquery');
const MediaGrid = require('../components/media/grid');

class AboutPage {

	constructor() {
		this.initPressGrid();
	}

	initPressGrid() {
		$('.entry-content > h2')
			.filter((i, h2) => h2.textContent == 'Press')
			.each((i, h2) => {
				let items = [], next = h2.nextElementSibling;
				while (next && next.nodeName == 'FIGURE') {
					items.push(next);
					next = next.nextElementSibling;
				}
				let mg = new MediaGrid(items, 'press');
				mg.container.insertBefore('#theme-footer__legal');
				$(h2).nextAll('.wp-block-button').insertBefore('#theme-footer__legal');
				$(h2).addClass('star-heading press-heading').insertBefore(mg.container);
			});
	}

}

module.exports = AboutPage;
