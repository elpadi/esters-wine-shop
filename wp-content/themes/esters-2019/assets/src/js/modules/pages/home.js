const $ = require('jquery');
const Slider = require('../components/slider');

class HomePage {

	constructor() {
		this.initSlider();
	}

	initSlider() {
		let element = $('#home-slideshow');
		if (element.children().length > 1) new Slider(element);
	}

}

module.exports = HomePage;
