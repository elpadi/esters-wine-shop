const $ = require('jquery');

class GlobalModule {

	constructor() {
		$('#theme-header__online-shops').addClass('double-border');
	}

}

module.exports = GlobalModule;
