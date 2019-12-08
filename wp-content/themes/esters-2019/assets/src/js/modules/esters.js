const $ = require('jquery');

class Esters {

	constructor() {
		this.burgerMQL = window.matchMedia('(min-width: 768px)');
		this.initSiteElementClasses();
		this.initSearchForm();
		this.initBurger();
	}

	initSiteElementClasses() {
		$('#theme-header__online-shops').addClass('double-border');
		$('.button').addClass('btn').removeClass('button');
		$('.woocommerce-Addresses h3').addClass('star-heading');

		if (app.ENV.USER.ID && /\/my-account\/?/.test(location.pathname)) document.body.classList.add('my-account-dashboard');
	}

	initSearchForm() {
		$('.search-form').on('submit', e => {
			if (e.target.s.value == '') {
				e.preventDefault();
				e.target.classList.add('active');
			}
		});

		if (!this.burgerMQL.matches) {
			$('.search-form').addClass('active');
		}
	}

	resize() {
		if (this.burgerMQL.matches) {
			this.unsetBurgerTransitionStyles();
		}
		else {
			if (this.isCollapsed()) this.setBurgerTransitionStyles();
		}
	}

	load() {
		if (!this.burgerMQL.matches) {
			setTimeout(this.collapse, 100);
		}
	}

	collapse() {
		document.body.dataset.isBurgerExpanded = 'false';
	}

	expand() {
		document.body.dataset.isBurgerExpanded = 'true';
	}

	isCollapsed() {
		return document.body.dataset.isBurgerExpanded !== 'true';
	}

	isExpanded() {
		return document.body.dataset.isBurgerExpanded === 'true';
	}

	unsetBurgerTransitionStyles() {
		['#theme-nav', '#masthead'].forEach(s => document.querySelector(s).setAttribute('style',''));
	}

	setBurgerTransitionStyles() {
		let nav = document.querySelector('#theme-nav'),
			header = document.querySelector('#masthead'),
			headerRect = header.getBoundingClientRect();

		nav.style.top = `${headerRect.bottom + window.scrollY}px`;
		nav.style.transform = `translateY(calc(-100% - ${headerRect.top + window.scrollY}px - ${headerRect.height}px))`;

		header.style.marginBottom = `${nav.offsetHeight}px`;
	}

	initBurger() {
		$(document).on('click', '.burger-expand-btn', e => this.expand());
		$(document).on('click', '.burger-collapse-btn', e => this.collapse());

		this.burgerMQL.addListener(e => {
			if (e.matches) this.expand();
			else this.collapse();
		});
	}

}

module.exports = Esters;
