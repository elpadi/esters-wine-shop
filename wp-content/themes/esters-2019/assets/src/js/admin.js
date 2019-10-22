const App = require('./base/app');

const app = new App();

app.modules['customizer'] = require('./admin/customizer/customizer');

app.init();

window.app = app;
