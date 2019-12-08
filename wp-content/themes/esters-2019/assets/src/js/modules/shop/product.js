const $ = require('jquery');

class Product {

	constructor() {
		$('.products').each((i, el) => {
			$(el).addClass('product-sublisting').find('h2').not('.woocommerce-loop-product__title').addClass('star-heading');
		});
		$('.woocommerce-product-gallery__image').addClass('double-border');
	}

}

module.exports = Product;
