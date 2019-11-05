const $ = require('jquery');

class Cart {

	constructor() {
		$(document.body).on('updated_cart_totals', e => {
			console.log('Cart.constructor', arguments);
		});
	}

}

module.exports = Cart;
