const App = require('../../../base/app');
const app = new App();

app.modules['menu'] = require('../../../modules/pages/menu');

app.init();
window.app = app;
