const $ = require('jquery');

class CheckoutGift {

	constructor() {
		this.container = document.querySelector('#checkout__gift');
		$('#main').on('change', '#is_order_gift', this.toggle.bind(this));
	}

	toggle(e) {
		this.container.classList.toggle('show-fields', e.target.checked);
	}

}

module.exports = CheckoutGift;
