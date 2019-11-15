const AboutPage = require('../../../modules/pages/about');
const InstaSlider = require('../../../modules/components/media/instagram-slider');

if ('app' in window) {
	window.app.addModule('aboutpage', AboutPage);
	window.app.addModule('instaslider', InstaSlider);
}
else console.error('App is not loaded');
