const App = require('../../../base/app');
const app = new App();

app.modules['about'] = require('../../../modules/pages/about');
app.modules['instaslider'] = require('../../../modules/components/media/instagram-slider');

app.init();
window.app = app;
