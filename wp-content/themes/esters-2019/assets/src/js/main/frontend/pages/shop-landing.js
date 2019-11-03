const App = require('../../../base/app');
const app = new App();

app.modules['landing'] = require('../../../modules/pages/shop-landing');

app.init();
window.app = app;
