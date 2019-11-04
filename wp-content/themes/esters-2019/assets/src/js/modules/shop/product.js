const $ = require('jquery');

class Product {

	constructor() {
		$('.related.products h2').not('.woocommerce-loop-product__title').addClass('star-heading');
		$('.related.products').find('.button').addClass('btn').removeClass('button');
		$('.woocommerce-product-gallery__image').addClass('double-border');
	}

}

module.exports = Product;
