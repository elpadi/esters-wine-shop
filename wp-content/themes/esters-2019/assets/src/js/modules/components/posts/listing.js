class Listing {

	constructor(apiEndpoint='post') {
		this.apiEndpoint = apiEndpoint;
	}

	fetch() {
		return app.fetchPosts(this.apiEndpoint).then(posts => {
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
