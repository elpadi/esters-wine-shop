const MenuPage = require('../../../modules/pages/menu');

if ('app' in window) {
	window.app.addModule('menupage', MenuPage);
}
else console.error('App is not loaded');
