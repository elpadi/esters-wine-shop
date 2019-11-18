const $ = require('jquery');
const Slider = require('../components/slider');

class PrivateEventsPage {

	constructor() {
		this.ec = $('.entry-content');
		this.initSlider();
	}

	selectSlideTitle(index) {
		console.log('PrivateEventsPage.selectSlideTitle', index);
		let titles = this.ec.find('.slider-title');
		titles.removeClass('current-slide').filter(`[data-index="${index}"]`).addClass('current-slide');
	}

	onSlideChange(e, slick, currentSlide, animSlide) {
		this.selectSlideTitle(animSlide);
		setTimeout(() => {
			this.sliderElement[0].dataset.slideHasImage = this.sliderElement.find('.slick-active img').length ? 'true' : 'false';
		}, 1000);
	}

	onSlideTitleClick(e) {
		let index = e.currentTarget.dataset.index;
		console.log('PrivateEventsPage.onSlideTitleClick', index);
		this.sliderElement.slick('goTo', Number(index));
	}

	initSlider() {
		this.sliderElement = $(document.createElement('section')).addClass('private-events__slider');
		// extract slide contents
		this.ec.children('.wp-block-separator').each((i, hr) => {
			let itemContent = $(hr).nextUntil('.wp-block-separator');
			if (itemContent.length) {
				let item = $(document.createElement('article')).addClass('private-events__slide').append(itemContent);
				this.sliderElement.append(item.attr('data-has-image', item.find('img').length ? 'true' : 'false'));
			}
		});
		// init slide titles
		this.ec[0].querySelector('h2').insertAdjacentHTML('afterend',
			this.sliderElement.find('h3').map((i, h3) => `<p class="slider-title" data-index="${i}">${h3.innerHTML}</p>`).get().join('')
		);
		// init slick
		this.ec.on('click', '.slider-title', this.onSlideTitleClick.bind(this));
		this.sliderElement.insertAfter(this.ec).on('beforeChange', this.onSlideChange.bind(this));
		requestAnimationFrame(() => {
			new Slider(this.sliderElement);
			this.onSlideChange(undefined, undefined, -1, 0); // first slide on change
		});
		setTimeout(() => $('#main').addClass('visible'), 200);
	}

}

module.exports = PrivateEventsPage;
