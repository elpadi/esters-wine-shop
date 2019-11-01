const $ = require('jquery');

class Tabs {

	constructor(items, isGlobal=false, name='tabs') {
		this.items = items;
		this.isGlobal = isGlobal;
		this.name = name;
		this.titles = this.createTitles();
		this.contents = this.createContents();
		this.container = this.createContainer().append(this.titles).append(this.contents);
		if (this.isGlobal) window.addEventListener('hashchange', this.onHashChange.bind(this));
		requestAnimationFrame(() => this.initTabSwitch());
	}

	createContainer() {
		return $(document.createElement('div')).addClass(`${this.name}-tabs tabs`);
	}

	createTitles() {
		return $(document.createElement('header')).addClass(`tabs__titles`).append(this.items.map(item => item.title.attr('data-tab-name', item.name)));
	}

	createContents() {
		return $(document.createElement('div')).addClass(`tabs__contents`).append(
			this.items.map(item => $(document.createElement('section')).addClass(`tabs__content`).attr('data-tab-name', item.name).append(item.content))
		);
	}

	onTitleClick(e) {
		e.preventDefault();
		let name = e.currentTarget.dataset.tabName;
		console.log('Tabs.onTitleClick', name);
		this.selectByName(name);
	}

	selectElement(el, skipHashChange=false) {
		if (!el.length) {
			return false;
		}
		console.log('Tabs.selectElement', skipHashChange, el);
		if (this.isGlobal && !skipHashChange) {
			location.hash = el.data('tabName');
		}
		el.addClass('selected').siblings().removeClass('selected');
		return true;
	}

	selectByName(s, skipHashChange=false) {
		console.log('Tabs.selectByName', s);
		return this.selectElement(this.titles.find(`.tabs__title[data-tab-name="${s}"]`), skipHashChange) && this.selectElement(this.contents.children(`.tabs__content[data-tab-name="${s}"]`), skipHashChange);
	}

	selectByIndex(i) {
		console.log('Tabs.selectByIndex', i);
		return this.selectElement(this.titles.children().eq(0), true) && this.selectElement(this.contents.children().eq(0), true);
	}

	initTabSwitch() {
		console.log('Tabs.initTabSwitch', this.isGlobal, location.hash);
		this.container.on('click', '.tabs__title', this.onTitleClick.bind(this));
		if (!this.isGlobal || !location.hash) this.selectByIndex(0);
	}

	onHashChange() {
		console.log('Tabs.onHashChange', location.hash);
		return location.hash.length > 1 ? this.selectByName(location.hash.substring(1), true) : this.selectByIndex(0);
		
	}

}

module.exports = Tabs;
