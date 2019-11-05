const App = require('../../../base/app');
const app = new App();

app.modules['cart'] = require('../../../modules/shop/cart');

app.init();
window.app = app;
