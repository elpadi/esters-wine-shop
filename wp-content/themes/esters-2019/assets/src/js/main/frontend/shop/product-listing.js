const ProductListingPage = require('../../../modules/shop/product-listing');

if ('app' in window) {
	window.app.addModule('listingpage', ProductListingPage);
}
else console.error('App is not loaded');
