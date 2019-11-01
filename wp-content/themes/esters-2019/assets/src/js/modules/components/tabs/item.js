const $ = require('jquery');

class TabItem {

	constructor(title, content, name='') {
		this.title = title.addClass('tabs__title');
		this.content = content;
		this.name = name ? name : app.slugify(this.title[0].textContent.trim(), '-');
	}

}

module.exports = TabItem;
