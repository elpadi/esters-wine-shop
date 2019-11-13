const $ = require('jquery');

class Esters {

	constructor() {
		$('#theme-header__online-shops').addClass('double-border');
		$('.button').addClass('btn').removeClass('button');
		$('.woocommerce-Addresses h3').addClass('star-heading');

		if (app.ENV.USER.ID && /\/my-account\/?/.test(location.pathname)) document.body.classList.add('my-account-dashboard');

		$('.search-form').on('submit', e => {
			if (e.target.s.value == '') {
				e.preventDefault();
				e.target.classList.add('active');
			}
		});
	}

}

module.exports = Esters;
