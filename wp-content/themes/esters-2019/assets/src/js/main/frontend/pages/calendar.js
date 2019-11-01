const App = require('../../../base/app');
const app = new App();

app.modules['calendar'] = require('../../../modules/pages/calendar');

app.init();
window.app = app;
