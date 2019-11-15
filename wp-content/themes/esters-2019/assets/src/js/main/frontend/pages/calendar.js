const CalendarPage = require('../../../modules/pages/calendar');

if ('app' in window) {
	window.app.addModule('calendarpage', CalendarPage);
}
else console.error('App is not loaded');
