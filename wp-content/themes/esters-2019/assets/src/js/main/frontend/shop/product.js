const App = require('../../../base/app');
const app = new App();

app.modules['product'] = require('../../../modules/shop/product');

app.init();
window.app = app;
