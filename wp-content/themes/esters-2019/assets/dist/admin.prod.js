(function(){function r(e,n,t){function o(i,f){if(!n[i]){if(!e[i]){var c="function"==typeof require&&require;if(!f&&c)return c(i,!0);if(u)return u(i,!0);var a=new Error("Cannot find module '"+i+"'");throw a.code="MODULE_NOT_FOUND",a}var p=n[i]={exports:{}};e[i][0].call(p.exports,function(r){var n=e[i][1][r];return o(n||r)},p,p.exports,r,e,n,t)}return n[i].exports}for(var u="function"==typeof require&&require,i=0;i<t.length;i++)o(t[i]);return o}return r})()({1:[function(require,module,exports){
const App = require('./base/app');

const app = new App();

app.modules['customizer'] = require('./admin/customizer/customizer');

app.init();

window.app = app;

},{"./admin/customizer/customizer":2,"./base/app":3}],2:[function(require,module,exports){
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

},{}],3:[function(require,module,exports){
(function (global){
class App {

	constructor() {
		this.modules = {};
		this.instances = {};
		if (!('$$' in global)) global.$$ = function(q, n=null) { return Array.from((n ? n : document).querySelectorAll(q)) }; 
	}

	init() {
		window.addEventListener('DOMContentLoaded', e => this.onDocReady())
		window.addEventListener('load', e => this.load());
		window.addEventListener('resize', e => this.resize());
	}

	isElementInViewport(rect) {
		let threshold = 0.3;
		return rect.top < this.vh * (1 - threshold) && rect.bottom > this.vh * threshold;
	}

	load() {
		//if (this.isAdmin == false) this.fixTopPositions();
		setTimeout(this.resize.bind(this), 100);
		setTimeout(() => document.body.classList.add('content-loaded'), 200);
		this.vw = window.innerWidth;
		this.vh = window.innerHeight;
		this.dispatch('load');
	}

	addTooltipSvgArrow(instance=null) {
		let arrow, tt = instance ? instance.elementTooltip() : document.querySelector('.tooltipster-base');
		if (tt && (arrow = tt.querySelector('.tooltipster-arrow'))) {
			arrow.insertAdjacentHTML('beforeend',
				`<svg width="50" height="50" viewBox="0 0 50 50">
					<path d="M 5,40 L 25,15 L 45,40 z" fill="#1b1c1d" stroke="#1b1c1d"/>
					<path d="M 1,40 L 5,40 L 25,15 L 45,40 L 49,40" fill="none" stroke="white"/>
				</svg>`
			);
		}
	}

	createLoadingSpinner() {
		let spinner = document.getElementById('tome-loading-spinner').cloneNode(true);
		spinner.id = '';
		return spinner;
	}

	fixTopPositions() {
		let t = document.querySelector('#masthead').offsetHeight;
		for (let s of ['#page','#tome-menu'])
			document.querySelector(s).style.paddingTop = t + 'px';
		for (let s of ['#menu-burger'])
			document.querySelector(s).style.marginTop = t + 'px';
	}

	slugify(s, glue='_') {
		return s.trim().toLowerCase().replace(/[^0-9a-z]+/g, glue).replace(new RegExp(`(${glue})+`, 'g'), glue);
	}

	queryStringToObject(s) {
		let d = {}, params = new URLSearchParams(s);
		for (let n of params.entries()) d[n[0]] = n[1];
		return d;
	}

	objSet(name, val, obj) {
		if (obj == undefined) obj = {};
		obj[name] = val;
		return obj;
	}

	resize() {
		this.vw = window.innerWidth;
		this.vh = window.innerHeight;
		this.dispatch('resize', this.vw, this.vh);
	}

	dispatch(evtName, ...vars) {
		console.log('App.dispatch', evtName, vars);
		for (let name of Object.keys(this.instances)) {
			let m = this.instances[name];
			if ((evtName in m) && typeof(m[evtName]) == 'function') m[evtName].apply(m, vars);
		}
	}

	fetchIcon(name, dir='icons') {
		return window.fetch(`${JS_VARS.URLS.AJAX}?action=icon_html&name=${name}&dir=${dir}`).then(r => r.text());
	}

	fetchPosts(ids='', type='pages', context='edit') {
		if (!('api' in wp) || !('apiRequest' in wp)) return Promise.reject('WP API library is not loaded.');
		return wp.apiRequest({
			namespace: wp.api.versionString,
			endpoint: type,
			data: {
				context: context,
				include: ids
			}
		});
	}

	instanceInvoke(name, fn, ...args) {
		if ((name in this.instances) && (fn in this.instances[name])) {
			this.instances[name][fn].apply(this.instances[name], args);
		}
	}

	onDocReady() {
		console.log('App.onDocReady', this.modules, document.body.className);
		this.isAdmin = document.body.classList.contains('tome2-admin');
		for (let name in this.modules) {
			let m = this.modules[name];
			this.instances[name] = new m(this);
			this.instances[name].app = this;
		}
	}

}

module.exports = App;

}).call(this,typeof global !== "undefined" ? global : typeof self !== "undefined" ? self : typeof window !== "undefined" ? window : {})
},{}]},{},[1]);
