const $ = require('jquery');

class GlobalModule {

	constructor() {
		$('#theme-header__online-shops').addClass('double-border');
		$('.button').addClass('btn').removeClass('button');
		$('.woocommerce-Addresses h3').addClass('star-heading');
		if (app.ENV.USER.ID && /\/my-account\/?/.test(location.pathname)) document.body.classList.add('my-account-dashboard');
	}

}

module.exports = GlobalModule;
