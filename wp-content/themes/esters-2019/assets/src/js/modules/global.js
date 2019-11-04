const $ = require('jquery');

class GlobalModule {

	constructor() {
		$('#theme-header__online-shops').addClass('double-border');
		$('.button').addClass('btn').removeClass('button');
	}

}

module.exports = GlobalModule;
