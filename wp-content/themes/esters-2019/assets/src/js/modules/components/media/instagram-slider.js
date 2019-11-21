const $ = require('jquery');
const Slider = require('../slider');
const Instagram = require('../social/instagram');

class InstagramSlider {

	constructor() {
		this.addSlider();
	}

	addSlider() {
		let feed = new Instagram();
		return feed.fetch().then(resp => {
			document.querySelector('#main .entry-content > .wp-block-image')
				.insertAdjacentElement('beforebegin', feed.container);
			this.initSlider(feed.container);
		});
	}

	initSlider(element) {
		new Slider($(element).addClass('instagram-slider'), {
			slidesToShow: 4,
			slidesToScroll: 4
		});
	}

}

module.exports = InstagramSlider;
