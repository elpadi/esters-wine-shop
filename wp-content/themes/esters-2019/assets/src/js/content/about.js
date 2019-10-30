const $ = require('jquery');
const _ = require('lodash');
const Slick = require('slick-carousel');
const Instagram = require('../components/social/instagram');

class AboutPage {

	constructor() {
		this.modsPromises = [];
		if (Number(JS_VARS.DEBUG) == 0) this.modsPromises.push(this.addInstagramFeed());
		this.modsPromises.push(this.columnizePress());

		Promise.all(this.modsPromises).then(() => document.body.classList.add('content-mods-finished'));
	}

	addInstagramFeed() {
		let feed = new Instagram();
		return feed.fetch().then(resp => {
			document.querySelector('#main .entry-content > .wp-block-gallery')
				.insertAdjacentElement('beforebegin', feed.container);
			this.initSlider(feed.container);
		});
	}

	initSlider(element) {
		$(element).addClass('instagram-slider').slick({
			infinite: true,
			speed: 1000,
			slidesToShow: 4,
			slidesToScroll: 4
		});
	}

	columnizePress() {
		$$('.entry-content > h2')
			.filter(h2 => h2.textContent == 'Press')
			.forEach(h2 => {
				let items = [], next = h2.nextElementSibling, cols = $(document.createElement('div')).addClass('press-columns columns');
				while (next && next.nodeName == 'FIGURE') {
					items.push(next);
					next = next.nextElementSibling;
				}
				cols.append(items).insertBefore('#theme-footer__legal');
				$(h2).addClass('star-heading press-heading').insertBefore(cols);

				cols.find('figcaption').each((i, cap) => {
					if (cap.previousElementSibling.nodeName == 'A') {
						let a = cap.previousElementSibling.cloneNode();
						a.innerHTML = cap.innerHTML;
						cap.innerHTML = '';
						cap.appendChild(a);
					}
				});
			});
		return Promise.resolve(true);
	}

}

module.exports = AboutPage;
