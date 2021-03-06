const Listing = require('./listing');

class EventsListing extends Listing {

	constructor() {
		super();
		this.ajaxAction = 'get_calendar_events';
	}

	getPostHTML(p) {
		let dateParts = (new Date(p.real_date)).toUTCString().split(' '); // e.g. "Tue, 01 Oct 2019 00:00:00 GMT"
		return `<article id="post-${p.id}" class="entry type-${p.type}">
			<header class="entry-header">
				<div class="event__date">
					<span class="event__date-monthname">${dateParts[2]}</span>
					<span class="event__date-daynum">${dateParts[1]}</span>
					<span class="event__date-dayname">${dateParts[0].replace(',','')}</span>
				</div>
				${p.image_html.replace(`class="`, `class="event__image `)}
				<div class="event__info">
					<h2 class="entry-title event__title">${p.title}<br>${p.time}</h2>
					<div class="event__brief">${p.brief_description}</div>
				</div>
			</header>
			<main class="entry-content">
				<div class="event__desc">${p.full_description}</div>
			</main>
		</article>`;
	}

}

module.exports = EventsListing;
