const App = require('../../../base/app');
const app = new App();

app.modules['listing'] = require('../../../modules/shop/product-listing');

app.init();
window.app = app;
