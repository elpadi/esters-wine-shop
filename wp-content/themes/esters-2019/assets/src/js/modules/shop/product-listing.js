const $ = require('jquery');

class ProductListing {

	constructor() {
		document.querySelector('#content').style.backgroundImage = `url(${app.ENV.URLS.THEME}/assets/img/bg-patterns/shop.jpg)`;
	}

}

module.exports = ProductListing;
