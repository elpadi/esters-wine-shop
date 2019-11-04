const $ = require('jquery');

class ProductListing {

	constructor() {
		document.querySelector('#content').style.backgroundImage = `url(${app.ENV.URLS.THEME}/assets/img/bg-patterns/shop.jpg)`;
		/*
		this.cols = $('.wp-block-column').addClass('double-border');
		this.cols = $('.wc-block-grid__product-link').addClass('btn');
		*/
		
		/*
		this.addClubButtons();
		this.addShopButtons();
		*/
	}

	/*
	addButtons(colIndex, btns) {
		let btnsHTML = btns.map(btn => `<a class="btn" href="${btn.href}">${btn.content}</a>`).join('');
		this.cols.get(colIndex).insertAdjacentHTML('beforeend', `<p class="shop-btns">${btnsHTML}</p>`);
	}

	addClubButtons() {
	}

	addShopButtons() {
		this.addButtons(1, [{
			href: '/shop',
			content: 'Shop Now'
		}]);
	}

	initSlider() {
		let element = $('#home-slideshow');
		if (element.children().length > 1) new Slider(element);
	}
	*/

}

module.exports = ProductListing;
