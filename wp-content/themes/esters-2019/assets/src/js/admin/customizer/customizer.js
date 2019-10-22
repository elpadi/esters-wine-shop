class Customizer {

	constructor() {
		if ('customize' in wp) setTimeout(() => this.init(), 3000);
	}

	moveSlide(newIndex, oldIndex) {
		for (let k of ['title','image','byline','page']) {
			let newname = `home_slides_${newIndex}_${k}`;
			if (oldIndex > 0) {
				let oldname = `home_slides_${oldIndex}_${k}`;
				wp.customize.value(newname)(
					wp.customize.value(oldname)()
				);
			}
			else {
				wp.customize.value(newname)(false);
			}
		}
	}

	rolloverSlides() {
		console.log('Customizer.rolloverSlides');
		for (let i = 5; i >= 0; i--) this.moveSlide(i, i - 1)
	}

	initSlideRolloverControl() {
		let rollCtrl = wp.customize.control('home_slides_rollover');
		if (rollCtrl) {
			console.log('HomePage.initSlideRolloverControl', rollCtrl);
			rollCtrl.container.find('input').attr('value', 'Insert First Slide')
			.addClass('button').on('click', e => this.rolloverSlides());
		}
	}

	init() {
		console.log('Customizer.init');
		this.initSlideRolloverControl();
	}

}

module.exports = Customizer;
