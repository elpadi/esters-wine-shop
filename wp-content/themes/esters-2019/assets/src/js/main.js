const App = require('./base/app');

const app = new App();

app.modules['pagecontent'] = require('./content/page');
/*

app.modules['sidemenu'] = require('./components/sidemenu');
*/

app.init();

window.app = app;
