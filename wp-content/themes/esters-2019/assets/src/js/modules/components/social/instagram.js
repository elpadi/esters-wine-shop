const $ = require('jquery');

class Instagram {

	constructor() {
		this.container = document.createElement('div');
	}

	fetch() {
		console.log('Instagram.fetch');
		return Promise.all([
			app.ajax({ action: 'instagram_feed' }),
			app.fetchIcon('instagram')
		]).then(responses => {
			if (responses[0] && responses[0].success) this.parse(JSON.parse(responses[0].data), responses[1].success ? responses[1].data : '');
		});
	}

	parse(feed, icon) {
		console.log('Instagram.parse', feed);
		this.container.innerHTML = feed.data.map(p => {
			return $(document.createElement('a'))
				.addClass('instagram__post')
				.attr('target', '_blank')
				.attr('href', p.link)
				.html(`
					<img src="${p.images.standard_resolution.url}" alt="">
					<p>${p.caption.text}</p>
					${icon}
				`).get(0).outerHTML;
		}).join('');
	}

}

module.exports = Instagram;
