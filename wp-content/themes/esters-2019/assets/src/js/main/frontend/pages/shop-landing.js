const ShopLandingPage = require('../../../modules/pages/shop-landing');

if ('app' in window) {
	window.app.addModule('landingpage', ShopLandingPage);
}
else console.error('App is not loaded');
