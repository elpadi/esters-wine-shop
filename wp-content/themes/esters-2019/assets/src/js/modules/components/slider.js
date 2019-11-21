const $ = require('jquery');
const Slick = require('slick-carousel');

class Slider {

	constructor(element, options={}) {
		(('fn' in element) ? element : $(element)).slick($.extend({
			infinite: true,
			speed: 1000,
			prevArrow: `<button type="button" class="slick-prev"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><rect x="0" fill="none" width="20" height="20"/><g><path d="M14 5l-5 5 5 5-1 2-7-7 7-7z"/></g></svg></button>`,
			nextArrow: `<button type="button" class="slick-next"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><rect x="0" fill="none" width="20" height="20"/><g><path d="M6 15l5-5-5-5 1-2 7 7-7 7z"/></g></svg></button>`
		}, options));
	}

}

module.exports = Slider;
