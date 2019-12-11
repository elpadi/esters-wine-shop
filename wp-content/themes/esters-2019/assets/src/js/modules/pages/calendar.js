const $ = require('jquery');
const EventsListing = require('../components/posts/events-listing');

class CalendarPage {

	constructor() {
		document.querySelector('.page--calendar #content').style.backgroundImage = `url(${app.ENV.URLS.THEME}/assets/img/bg-patterns/menu.jpg)`;
	}

	load() {
		this.addEvents();
	}

	addEvents() {
		this.events = new EventsListing();
		this.events.fetch().then(() => {
			this.addEventsTitle();
			this.addEventsContent();
		});
	}

	addEventsTitle() {
		document.querySelector('.page--calendar .entry-content').insertAdjacentHTML('beforeend', `<h2>What's Upcoming At Esters</h2>`);
	}

	addEventsContent() {
		document.querySelector('.page--calendar article.entry').insertAdjacentHTML('afterend', this.events.getPostsHTML());
		setTimeout(() => {
			$('.event__desc p').filter((i, p) => p.innerText.trim() == '').remove();
		}, 100);
	}

}

module.exports = CalendarPage;
