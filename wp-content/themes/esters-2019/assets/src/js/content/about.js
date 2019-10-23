const $ = require('jquery');
const Slick = require('slick-carousel');
const Instagram = require('../components/social/instagram');

class AboutPage {

	constructor() {
		if (Number(JS_VARS.DEBUG) == 0) this.addInstagramFeed();
	}

	addInstagramFeed() {
		let feed = new Instagram();
		feed.fetch().then(resp => {
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

}

module.exports = AboutPage;
