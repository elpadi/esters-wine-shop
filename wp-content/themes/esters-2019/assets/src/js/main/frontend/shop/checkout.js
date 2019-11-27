const CheckoutGift = require('../../../modules/shop/checkout-gift');

if ('app' in window) {
	window.app.addModule('checkoutgift', CheckoutGift);
}
else console.error('App is not loaded');

