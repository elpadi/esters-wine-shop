const $ = require('jquery');
const Tabs = require('../components/tabs/tabs');
const TabItem = require('../components/tabs/item');

class MenuPage {

	constructor() {
		document.querySelector('#content').style.backgroundImage = `url(${app.ENV.URLS.THEME}/assets/img/bg-patterns/menu.jpg)`;
	}

	load() {
		this.initMenuTabs();
	}

	initMenuTabs() {
		let tabs = [];
		$('.entry-content').children('.wp-block-group').each((i, grp) => {
			tabs.push($(grp).find('.wp-block-group__inner-container').children());
		});
		this.tabs = new Tabs(tabs.map(t => new TabItem(t.filter('h2'), t.not('h2'))), true, 'menu');
		this.tabs.container.insertBefore(document.querySelector('.entry-content .wp-block-group'));
	}

}

module.exports = MenuPage;
