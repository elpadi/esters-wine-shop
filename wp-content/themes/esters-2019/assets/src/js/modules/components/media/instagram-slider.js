const $ = require('jquery');
const Slick = require('slick-carousel');
const Instagram = require('../social/instagram');

class InstagramSlider {

	constructor() {
		if (Number(app.ENV.DEBUG) == 0) this.addSlider();
	}

	addSlider() {
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

}

module.exports = InstagramSlider;
