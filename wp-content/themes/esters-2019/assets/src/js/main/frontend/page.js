const ColumnizeText = require('../../modules/pages/columnize-text');

if ('app' in window) {
	window.app.addModule('textcolumns', ColumnizeText);
}
else console.error('App is not loaded');
