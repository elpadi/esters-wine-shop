const $ = require('jquery');

class Modal {

	constructor() {
		this.hasModalCheck();
		$(document).on('click', '.modal-btn', this.onModalBtnClick.bind(this)).on('click', '.modal__close-btn', this.onCloseBtnClick.bind(this));
	}

	hasModalCheck() {
		setTimeout(() => {
			document.body.dataset.hasModal = document.querySelectorAll('.modal.visible').length ? 'true' : 'false';
		}, 50);
	}

	onCloseBtnClick(e) {
		$(e.target).closest('.modal').removeClass('visible');
		this.hasModalCheck();
	}

	onModalBtnClick(e) {
		$(`#${e.currentTarget.dataset.modalId}-modal`).addClass('visible');
		this.hasModalCheck();
	}

}

module.exports = Modal;
