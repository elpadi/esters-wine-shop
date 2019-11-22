class Listing {

	constructor() {
	}

	fetch() {
		return (('apiEndpoint' in this)
			? app.fetchPosts(this.apiEndpoint, this.apiParams)
			: app.ajax({ action: this.ajaxAction })
		).then(response => {
			let posts = Array.isArray(response) ? response : (response ? (('success' in response) && response.success ? response.data : []) : []);
			console.log('Listing.fetch', posts);
			this.posts = posts;
		});
	}

	getPostsHTML() {
		return this.posts.map(p => this.getPostHTML(p)).join('');
	}

	getPostHTML(p) {
		return `<article id="post-${p.id}" class="entry type-${p.type}">
			<header class="entry-header">
				<h2 class="entry-title">${p.title.rendered}</h2>
			</header>
			<div class="entry-content">${p.content.rendered}</div>
		</article>`;
	}

}

module.exports = Listing;
