const $ = require('jquery');

class Product {

	constructor() {
		$('.related.products h2').not('.woocommerce-loop-product__title').addClass('star-heading');
		$('.woocommerce-product-gallery__image').addClass('double-border');
	}

}

module.exports = Product;
