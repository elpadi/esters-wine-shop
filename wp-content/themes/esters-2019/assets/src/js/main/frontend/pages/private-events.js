const PrivateEventsPage = require('../../../modules/pages/private-events');

if ('app' in window) {
	window.app.addModule('eventspage', PrivateEventsPage);
}
else console.error('App is not loaded');
