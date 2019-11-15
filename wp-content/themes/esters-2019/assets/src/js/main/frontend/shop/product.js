const SingleProductPage = require('../../../modules/shop/product');

if ('app' in window) {
	window.app.addModule('productpage', SingleProductPage);
}
else console.error('App is not loaded');
