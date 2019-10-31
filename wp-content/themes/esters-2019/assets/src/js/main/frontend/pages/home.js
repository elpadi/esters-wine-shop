const App = require('../../../base/app');
const app = new App();

app.modules['home'] = require('../../../modules/pages/home');

app.init();
window.app = app;
