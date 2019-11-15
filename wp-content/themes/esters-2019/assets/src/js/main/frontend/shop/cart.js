const ShoppingCartPage = require('../../../modules/shop/cart');

if ('app' in window) {
	window.app.addModule('cartpage', ShoppingCartPage);
}
else console.error('App is not loaded');
