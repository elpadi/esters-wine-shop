const $ = require('jquery');
const MediaGrid = require('../components/media/grid');
const PressListing = require('../components/posts/press-listing');

class AboutPage {

	constructor() {
		this.initPressGrid();
	}

	addPressContent() {
		document.querySelector('#colophon > .columns').insertAdjacentHTML('beforebegin', `
			<section id="press-articles">
				<header><h2 class="star-heading">Press</h2></header>
				<main class="columns">${this.articles.getPostsHTML()}</main>
			</section>
		`);
	}

	moveHealthButton() {
		$('.page--about .entry-content > .wp-block-button').appendTo('#press-articles');
	}

	initPressGrid() {
		this.articles = new PressListing();
		this.articles.fetch().then(() => {
			this.addPressContent();
			setTimeout(() => this.moveHealthButton(), 500);
		});
	}

}

module.exports = AboutPage;
