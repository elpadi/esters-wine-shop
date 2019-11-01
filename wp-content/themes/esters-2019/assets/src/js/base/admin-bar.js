class AdminBar {

	constructor() {
	}

	load() {
		if (document.body.classList.contains('debug--off')
			&& (this.container = document.querySelector('#wpadminbar'))
		) {
			this.updateBar();
		}
	}

	removeHowdy() {
		let user = this.container.querySelector('.display-name').parentElement;
		if (user
			&& user.childNodes.length
			&& user.childNodes[0].nodeType == 3
		) {
			user.childNodes[0].remove();
		}
	}

	addTomeLogo() {
		let svg = document.querySelector('.custom-logo-link svg');
		if (svg) {
			document.querySelector('#wp-admin-bar-root-default').insertAdjacentHTML('afterbegin', `
				<li id="wp-admin-bar-tome-logo">
					${svg.outerHTML}
				</li>
			`);
		}
	}

	fixTranslationEditURL() {
		let edit = document.querySelector('#wp-admin-bar-edit');
		if (edit) {
			let editBtn = edit.querySelector('a');
			// remove the lang query var from translated items.
			editBtn.href = editBtn.href.replace(/&lang=[a-z]+/, '');
			console.log('AdminBar.fixTranslationEditURL', editBtn.href);
		}
	}

	removeItem(id) {
		let item = document.querySelector(`#wp-admin-bar-${id}`);
		if (item) item.remove();
	}

	removeUnwantedAddNewTypes() {
		for (let postType of ['auto-biblio-entry']) this.removeItem(`new-${postType}`);
	}

	removeEdit() {
		this.removeItem('edit');
	}

	useAddNewSubItem(postType, urlSuffix='') {
		let addNew = document.querySelector('#wp-admin-bar-new-content'),
			addNewType = document.querySelector(`#wp-admin-bar-new-${postType}`);
		if (addNew && addNewType) {
			addNew.querySelector('a').href = addNewType.querySelector('a').href + urlSuffix;
			addNew.querySelector('.ab-label').innerHTML = 'Add New ' + addNewType.querySelector('.ab-item').innerHTML;
			addNew.classList.remove('menupop');
			addNew.querySelector('.ab-sub-wrapper').remove();
		}
	}

	updateAddNew() {
		let tmc = document.querySelector('#tome-module-content');
		if (tmc) {
			switch (tmc.dataset.section) {
				case 'bibliography': this.useAddNewSubItem('manual-biblio-entry'); break;
				case 'media': this.useAddNewSubItem('media'); break;
			}
			this.removeEdit();
		}
		else if (document.body.classList.contains('page')) {
			this.useAddNewSubItem('page');
		}
		else if (document.body.classList.contains('blog')) {
			this.useAddNewSubItem('post');
		}
		else if (document.body.classList.contains('archive')) {
			if (document.body.classList.contains('category')) {
				let match = document.body.className.match(/category-([^ ]+)/);
				this.useAddNewSubItem('post', match ? `?post_type=post&category=${match[1]}` : '');
			}
			else this.useAddNewSubItem('post');
			this.removeEdit();
		}
		setTimeout(() => this.removeUnwantedAddNewTypes(), 100);
	}

	updateBar() {
		this.removeHowdy();
		this.addTomeLogo();
		this.fixTranslationEditURL();
		this.updateAddNew();
	}

}

module.exports = AdminBar;
