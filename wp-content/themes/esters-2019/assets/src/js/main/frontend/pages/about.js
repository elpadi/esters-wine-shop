const AboutPage = require('../../../modules/pages/about');
const InstaSlider = require('../../../modules/components/media/instagram-slider');
const GoogleMap = require('../../../modules/components/maps/google-map');

if ('app' in window) {
	window.app.addModule('aboutpage', AboutPage);
	window.app.addModule('instaslider', InstaSlider);
	window.app.addModule('map', GoogleMap);
}
else console.error('App is not loaded');
