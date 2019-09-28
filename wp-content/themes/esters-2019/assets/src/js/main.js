const App = require('./base/app');

const app = new App();

app.modules['pagecontent'] = require('./content/page');
/*

global.CITATION_GENERATORS = {
	mla: require('../../../../../plugins/tome2-admin/assets/src/js/references/citation/citation-mla'),
	chicago_ad: require('../../../../../plugins/tome2-admin/assets/src/js/references/citation/citation-chicago-nb'),
	chicago_nb: require('../../../../../plugins/tome2-admin/assets/src/js/references/citation/citation-chicago-ad')
};

app.modules['sidemenu'] = require('./components/sidemenu');

app.modules['headermedia'] = require('./content/media/header');
app.modules['chapternav'] = require('./content/chapter-nav');
app.modules['gallery'] = require('./content/gallery');
app.modules['references'] = require('./content/references');

app.modules['_external-links'] = require('./base/external-links');
app.modules['_delay-fade'] = require('./content/delay-fade');
app.modules['_scroll-fade'] = require('./content/scroll-fade');
app.modules['_video-autoplay'] = require('./content/autoplay');
app.modules['_resp-imgs'] = require('./content/responsive-images');
*/

app.init();

window.app = app;
