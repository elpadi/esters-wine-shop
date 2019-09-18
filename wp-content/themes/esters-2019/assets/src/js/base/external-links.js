class ExternalLinks {

	constructor() {
		for (let l of this.getLinks()) l.target = '_blank';
	}

	getLinks() {
		return document.querySelectorAll('#menu-social-menu a');
	}

}

module.exports = ExternalLinks;
