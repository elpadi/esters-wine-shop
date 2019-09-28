const $ = require('jquery');

class Instagram {

	constructor() {
		this.container = document.createElement('div');
	}

	fetch() {
		console.log('Instagram.fetch');
		return Promise.all([
			$.getJSON(JS_VARS.URLS.AJAX, { action: 'instagram_feed' }),
			app.fetchIcon('instagram')
		]).then(values => {
			let resp = values[0], icon = values[1];
			if (resp && ('data' in resp)) this.parse(resp.data, icon);
		});
	}

	parse(posts, icon) {
		console.log('Instagram.parse', posts);
		this.container.innerHTML = posts.map(p => {
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
