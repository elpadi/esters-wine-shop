const App = require('../../../base/app');
const app = new App();

app.modules['private_events'] = require('../../../modules/pages/private-events');

app.init();
window.app = app;
