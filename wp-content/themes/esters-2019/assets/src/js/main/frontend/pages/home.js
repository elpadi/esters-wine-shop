const HomePage = require('../../../modules/pages/home');

if ('app' in window) {
	window.app.addModule('homepage', HomePage);
}
else console.error('App is not loaded');
