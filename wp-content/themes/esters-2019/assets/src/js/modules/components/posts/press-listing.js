const Listing = require('./listing');

class PressListing extends Listing {

	constructor() {
		super();
		this.ajaxAction = 'get_press_articles';
	}

	getPostHTML(p) {
		let dateParts = (new Date(p.real_date)).toUTCString().split(' '); // e.g. "Tue, 01 Oct 2019 00:00:00 GMT"
		return `<article id="post-${p.id}" class="entry type-${p.type}">
			<main>
				<a href="${p.article_link}" target="_blank" rel="nofollow">
					<img src="${p.image_src}" alt="">
				</a>
			</main>
			<footer>
				<a href="${p.article_link}" target="_blank" rel="nofollow">${p.source_name}</a>
			</footer>
		</article>`;
	}

}

module.exports = PressListing;
