const Listing = require('./listing');

class EventsListing extends Listing {

	constructor() {
		super('events');
	}

	getPostHTML(p) {
		let parts = p.content.rendered.split('<!--more-->').map(s => {
			let div = document.createElement('div');
			div.innerHTML = s;
			return div;
		});
		if (parts.length == 2) {
			let title = p.title.rendered,
				dateElement = parts[0].firstElementChild,
				dateParts = (new Date(dateElement.innerHTML)).toUTCString().split(' '), // e.g. "Tue, 01 Oct 2019 00:00:00 GMT"
				timeElement = parts[0].children[1],
				imageSrc = 'https://www.esterswineshop.com/wp-content/uploads/2019/10/Esters_Pumpkin-Wine_Photo-Credit-Kelly-Bylsma.jpg';
			// remove date + time
			dateElement.remove();
			timeElement.remove();
			let brief = parts[0].innerHTML,
				desc = parts[1].innerHTML;
			// build
			return `<article id="post-${p.id}" class="entry type-${p.type}">
				<header class="entry-header">
					<div class="event__date">
						<span class="event__date-monthname">${dateParts[2]}</span>
						<span class="event__date-daynum">${dateParts[1]}</span>
						<span class="event__date-dayname">${dateParts[0].replace(',','')}</span>
					</div>
					<img class="event__image" src="${imageSrc}">
					<div class="event__info">
						<p class="event__title">${title}</p>
						<p class="event__time">${timeElement.innerHTML}</p>
						<div class="event__brief">${brief}</div>
					</div>
				</header>
				<main class="entry-content">
					<h2 class="entry-title event__title">${title}</h2>
					<p class="event__time">${timeElement.innerHTML}</p>
					<div class="event__desc">${desc}</div>
				</main>
			</article>`;
		}
		else return super.getPostHTML(p);
	}

}

module.exports = EventsListing;
