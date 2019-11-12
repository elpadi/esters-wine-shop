const App = require('../../base/app');

const app = new App();
window.app = app;

app.modules['customizer'] = require('../../admin/customizer/customizer');

app.init();
