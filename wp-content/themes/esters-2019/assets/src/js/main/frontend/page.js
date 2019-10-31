const App = require('../../base/app');
const app = new App();

app.modules['textcolumns'] = require('../../modules/pages/columnize-text');

app.init();
window.app = app;
