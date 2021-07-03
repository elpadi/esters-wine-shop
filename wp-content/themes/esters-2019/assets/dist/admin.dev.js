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

},{}]},{},[1])
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIi4uLy4uLy4uLy4uLy4uLy4uLy4uLy4uLy5jb25maWcveWFybi9nbG9iYWwvbm9kZV9tb2R1bGVzL2Jyb3dzZXItcGFjay9fcHJlbHVkZS5qcyIsInNyYy9qcy9hZG1pbi5qcyIsInNyYy9qcy9hZG1pbi9jdXN0b21pemVyL2N1c3RvbWl6ZXIuanMiLCJzcmMvanMvYmFzZS9hcHAuanMiXSwibmFtZXMiOltdLCJtYXBwaW5ncyI6IkFBQUE7QUNBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTs7QUNUQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7QUMzQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBIiwiZmlsZSI6ImdlbmVyYXRlZC5qcyIsInNvdXJjZVJvb3QiOiIiLCJzb3VyY2VzQ29udGVudCI6WyIoZnVuY3Rpb24oKXtmdW5jdGlvbiByKGUsbix0KXtmdW5jdGlvbiBvKGksZil7aWYoIW5baV0pe2lmKCFlW2ldKXt2YXIgYz1cImZ1bmN0aW9uXCI9PXR5cGVvZiByZXF1aXJlJiZyZXF1aXJlO2lmKCFmJiZjKXJldHVybiBjKGksITApO2lmKHUpcmV0dXJuIHUoaSwhMCk7dmFyIGE9bmV3IEVycm9yKFwiQ2Fubm90IGZpbmQgbW9kdWxlICdcIitpK1wiJ1wiKTt0aHJvdyBhLmNvZGU9XCJNT0RVTEVfTk9UX0ZPVU5EXCIsYX12YXIgcD1uW2ldPXtleHBvcnRzOnt9fTtlW2ldWzBdLmNhbGwocC5leHBvcnRzLGZ1bmN0aW9uKHIpe3ZhciBuPWVbaV1bMV1bcl07cmV0dXJuIG8obnx8cil9LHAscC5leHBvcnRzLHIsZSxuLHQpfXJldHVybiBuW2ldLmV4cG9ydHN9Zm9yKHZhciB1PVwiZnVuY3Rpb25cIj09dHlwZW9mIHJlcXVpcmUmJnJlcXVpcmUsaT0wO2k8dC5sZW5ndGg7aSsrKW8odFtpXSk7cmV0dXJuIG99cmV0dXJuIHJ9KSgpIiwiY29uc3QgQXBwID0gcmVxdWlyZSgnLi9iYXNlL2FwcCcpO1xuXG5jb25zdCBhcHAgPSBuZXcgQXBwKCk7XG5cbmFwcC5tb2R1bGVzWydjdXN0b21pemVyJ10gPSByZXF1aXJlKCcuL2FkbWluL2N1c3RvbWl6ZXIvY3VzdG9taXplcicpO1xuXG5hcHAuaW5pdCgpO1xuXG53aW5kb3cuYXBwID0gYXBwO1xuIiwiY2xhc3MgQ3VzdG9taXplciB7XG5cblx0Y29uc3RydWN0b3IoKSB7XG5cdFx0aWYgKCdjdXN0b21pemUnIGluIHdwKSBzZXRUaW1lb3V0KCgpID0+IHRoaXMuaW5pdCgpLCAzMDAwKTtcblx0fVxuXG5cdG1vdmVTbGlkZShuZXdJbmRleCwgb2xkSW5kZXgpIHtcblx0XHRmb3IgKGxldCBrIG9mIFsndGl0bGUnLCdpbWFnZScsJ2J5bGluZScsJ3BhZ2UnXSkge1xuXHRcdFx0bGV0IG5ld25hbWUgPSBgaG9tZV9zbGlkZXNfJHtuZXdJbmRleH1fJHtrfWA7XG5cdFx0XHRpZiAob2xkSW5kZXggPiAwKSB7XG5cdFx0XHRcdGxldCBvbGRuYW1lID0gYGhvbWVfc2xpZGVzXyR7b2xkSW5kZXh9XyR7a31gO1xuXHRcdFx0XHR3cC5jdXN0b21pemUudmFsdWUobmV3bmFtZSkoXG5cdFx0XHRcdFx0d3AuY3VzdG9taXplLnZhbHVlKG9sZG5hbWUpKClcblx0XHRcdFx0KTtcblx0XHRcdH1cblx0XHRcdGVsc2Uge1xuXHRcdFx0XHR3cC5jdXN0b21pemUudmFsdWUobmV3bmFtZSkoZmFsc2UpO1xuXHRcdFx0fVxuXHRcdH1cblx0fVxuXG5cdHJvbGxvdmVyU2xpZGVzKCkge1xuXHRcdGNvbnNvbGUubG9nKCdDdXN0b21pemVyLnJvbGxvdmVyU2xpZGVzJyk7XG5cdFx0Zm9yIChsZXQgaSA9IDU7IGkgPj0gMDsgaS0tKSB0aGlzLm1vdmVTbGlkZShpLCBpIC0gMSlcblx0fVxuXG5cdGluaXRTbGlkZVJvbGxvdmVyQ29udHJvbCgpIHtcblx0XHRsZXQgcm9sbEN0cmwgPSB3cC5jdXN0b21pemUuY29udHJvbCgnaG9tZV9zbGlkZXNfcm9sbG92ZXInKTtcblx0XHRpZiAocm9sbEN0cmwpIHtcblx0XHRcdGNvbnNvbGUubG9nKCdIb21lUGFnZS5pbml0U2xpZGVSb2xsb3ZlckNvbnRyb2wnLCByb2xsQ3RybCk7XG5cdFx0XHRyb2xsQ3RybC5jb250YWluZXIuZmluZCgnaW5wdXQnKS5hdHRyKCd2YWx1ZScsICdJbnNlcnQgRmlyc3QgU2xpZGUnKVxuXHRcdFx0LmFkZENsYXNzKCdidXR0b24nKS5vbignY2xpY2snLCBlID0+IHRoaXMucm9sbG92ZXJTbGlkZXMoKSk7XG5cdFx0fVxuXHR9XG5cblx0aW5pdCgpIHtcblx0XHRjb25zb2xlLmxvZygnQ3VzdG9taXplci5pbml0Jyk7XG5cdFx0dGhpcy5pbml0U2xpZGVSb2xsb3ZlckNvbnRyb2woKTtcblx0fVxuXG59XG5cbm1vZHVsZS5leHBvcnRzID0gQ3VzdG9taXplcjtcbiIsImNsYXNzIEFwcCB7XG5cblx0Y29uc3RydWN0b3IoKSB7XG5cdFx0dGhpcy5tb2R1bGVzID0ge307XG5cdFx0dGhpcy5pbnN0YW5jZXMgPSB7fTtcblx0XHRpZiAoISgnJCQnIGluIGdsb2JhbCkpIGdsb2JhbC4kJCA9IGZ1bmN0aW9uKHEsIG49bnVsbCkgeyByZXR1cm4gQXJyYXkuZnJvbSgobiA/IG4gOiBkb2N1bWVudCkucXVlcnlTZWxlY3RvckFsbChxKSkgfTsgXG5cdH1cblxuXHRpbml0KCkge1xuXHRcdHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCdET01Db250ZW50TG9hZGVkJywgZSA9PiB0aGlzLm9uRG9jUmVhZHkoKSlcblx0XHR3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcignbG9hZCcsIGUgPT4gdGhpcy5sb2FkKCkpO1xuXHRcdHdpbmRvdy5hZGRFdmVudExpc3RlbmVyKCdyZXNpemUnLCBlID0+IHRoaXMucmVzaXplKCkpO1xuXHR9XG5cblx0aXNFbGVtZW50SW5WaWV3cG9ydChyZWN0KSB7XG5cdFx0bGV0IHRocmVzaG9sZCA9IDAuMztcblx0XHRyZXR1cm4gcmVjdC50b3AgPCB0aGlzLnZoICogKDEgLSB0aHJlc2hvbGQpICYmIHJlY3QuYm90dG9tID4gdGhpcy52aCAqIHRocmVzaG9sZDtcblx0fVxuXG5cdGxvYWQoKSB7XG5cdFx0Ly9pZiAodGhpcy5pc0FkbWluID09IGZhbHNlKSB0aGlzLmZpeFRvcFBvc2l0aW9ucygpO1xuXHRcdHNldFRpbWVvdXQodGhpcy5yZXNpemUuYmluZCh0aGlzKSwgMTAwKTtcblx0XHRzZXRUaW1lb3V0KCgpID0+IGRvY3VtZW50LmJvZHkuY2xhc3NMaXN0LmFkZCgnY29udGVudC1sb2FkZWQnKSwgMjAwKTtcblx0XHR0aGlzLnZ3ID0gd2luZG93LmlubmVyV2lkdGg7XG5cdFx0dGhpcy52aCA9IHdpbmRvdy5pbm5lckhlaWdodDtcblx0XHR0aGlzLmRpc3BhdGNoKCdsb2FkJyk7XG5cdH1cblxuXHRhZGRUb29sdGlwU3ZnQXJyb3coaW5zdGFuY2U9bnVsbCkge1xuXHRcdGxldCBhcnJvdywgdHQgPSBpbnN0YW5jZSA/IGluc3RhbmNlLmVsZW1lbnRUb29sdGlwKCkgOiBkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCcudG9vbHRpcHN0ZXItYmFzZScpO1xuXHRcdGlmICh0dCAmJiAoYXJyb3cgPSB0dC5xdWVyeVNlbGVjdG9yKCcudG9vbHRpcHN0ZXItYXJyb3cnKSkpIHtcblx0XHRcdGFycm93Lmluc2VydEFkamFjZW50SFRNTCgnYmVmb3JlZW5kJyxcblx0XHRcdFx0YDxzdmcgd2lkdGg9XCI1MFwiIGhlaWdodD1cIjUwXCIgdmlld0JveD1cIjAgMCA1MCA1MFwiPlxuXHRcdFx0XHRcdDxwYXRoIGQ9XCJNIDUsNDAgTCAyNSwxNSBMIDQ1LDQwIHpcIiBmaWxsPVwiIzFiMWMxZFwiIHN0cm9rZT1cIiMxYjFjMWRcIi8+XG5cdFx0XHRcdFx0PHBhdGggZD1cIk0gMSw0MCBMIDUsNDAgTCAyNSwxNSBMIDQ1LDQwIEwgNDksNDBcIiBmaWxsPVwibm9uZVwiIHN0cm9rZT1cIndoaXRlXCIvPlxuXHRcdFx0XHQ8L3N2Zz5gXG5cdFx0XHQpO1xuXHRcdH1cblx0fVxuXG5cdGNyZWF0ZUxvYWRpbmdTcGlubmVyKCkge1xuXHRcdGxldCBzcGlubmVyID0gZG9jdW1lbnQuZ2V0RWxlbWVudEJ5SWQoJ3RvbWUtbG9hZGluZy1zcGlubmVyJykuY2xvbmVOb2RlKHRydWUpO1xuXHRcdHNwaW5uZXIuaWQgPSAnJztcblx0XHRyZXR1cm4gc3Bpbm5lcjtcblx0fVxuXG5cdGZpeFRvcFBvc2l0aW9ucygpIHtcblx0XHRsZXQgdCA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoJyNtYXN0aGVhZCcpLm9mZnNldEhlaWdodDtcblx0XHRmb3IgKGxldCBzIG9mIFsnI3BhZ2UnLCcjdG9tZS1tZW51J10pXG5cdFx0XHRkb2N1bWVudC5xdWVyeVNlbGVjdG9yKHMpLnN0eWxlLnBhZGRpbmdUb3AgPSB0ICsgJ3B4Jztcblx0XHRmb3IgKGxldCBzIG9mIFsnI21lbnUtYnVyZ2VyJ10pXG5cdFx0XHRkb2N1bWVudC5xdWVyeVNlbGVjdG9yKHMpLnN0eWxlLm1hcmdpblRvcCA9IHQgKyAncHgnO1xuXHR9XG5cblx0c2x1Z2lmeShzLCBnbHVlPSdfJykge1xuXHRcdHJldHVybiBzLnRyaW0oKS50b0xvd2VyQ2FzZSgpLnJlcGxhY2UoL1teMC05YS16XSsvZywgZ2x1ZSkucmVwbGFjZShuZXcgUmVnRXhwKGAoJHtnbHVlfSkrYCwgJ2cnKSwgZ2x1ZSk7XG5cdH1cblxuXHRxdWVyeVN0cmluZ1RvT2JqZWN0KHMpIHtcblx0XHRsZXQgZCA9IHt9LCBwYXJhbXMgPSBuZXcgVVJMU2VhcmNoUGFyYW1zKHMpO1xuXHRcdGZvciAobGV0IG4gb2YgcGFyYW1zLmVudHJpZXMoKSkgZFtuWzBdXSA9IG5bMV07XG5cdFx0cmV0dXJuIGQ7XG5cdH1cblxuXHRvYmpTZXQobmFtZSwgdmFsLCBvYmopIHtcblx0XHRpZiAob2JqID09IHVuZGVmaW5lZCkgb2JqID0ge307XG5cdFx0b2JqW25hbWVdID0gdmFsO1xuXHRcdHJldHVybiBvYmo7XG5cdH1cblxuXHRyZXNpemUoKSB7XG5cdFx0dGhpcy52dyA9IHdpbmRvdy5pbm5lcldpZHRoO1xuXHRcdHRoaXMudmggPSB3aW5kb3cuaW5uZXJIZWlnaHQ7XG5cdFx0dGhpcy5kaXNwYXRjaCgncmVzaXplJywgdGhpcy52dywgdGhpcy52aCk7XG5cdH1cblxuXHRkaXNwYXRjaChldnROYW1lLCAuLi52YXJzKSB7XG5cdFx0Y29uc29sZS5sb2coJ0FwcC5kaXNwYXRjaCcsIGV2dE5hbWUsIHZhcnMpO1xuXHRcdGZvciAobGV0IG5hbWUgb2YgT2JqZWN0LmtleXModGhpcy5pbnN0YW5jZXMpKSB7XG5cdFx0XHRsZXQgbSA9IHRoaXMuaW5zdGFuY2VzW25hbWVdO1xuXHRcdFx0aWYgKChldnROYW1lIGluIG0pICYmIHR5cGVvZihtW2V2dE5hbWVdKSA9PSAnZnVuY3Rpb24nKSBtW2V2dE5hbWVdLmFwcGx5KG0sIHZhcnMpO1xuXHRcdH1cblx0fVxuXG5cdGZldGNoSWNvbihuYW1lLCBkaXI9J2ljb25zJykge1xuXHRcdHJldHVybiB3aW5kb3cuZmV0Y2goYCR7SlNfVkFSUy5VUkxTLkFKQVh9P2FjdGlvbj1pY29uX2h0bWwmbmFtZT0ke25hbWV9JmRpcj0ke2Rpcn1gKS50aGVuKHIgPT4gci50ZXh0KCkpO1xuXHR9XG5cblx0ZmV0Y2hQb3N0cyhpZHM9JycsIHR5cGU9J3BhZ2VzJywgY29udGV4dD0nZWRpdCcpIHtcblx0XHRpZiAoISgnYXBpJyBpbiB3cCkgfHwgISgnYXBpUmVxdWVzdCcgaW4gd3ApKSByZXR1cm4gUHJvbWlzZS5yZWplY3QoJ1dQIEFQSSBsaWJyYXJ5IGlzIG5vdCBsb2FkZWQuJyk7XG5cdFx0cmV0dXJuIHdwLmFwaVJlcXVlc3Qoe1xuXHRcdFx0bmFtZXNwYWNlOiB3cC5hcGkudmVyc2lvblN0cmluZyxcblx0XHRcdGVuZHBvaW50OiB0eXBlLFxuXHRcdFx0ZGF0YToge1xuXHRcdFx0XHRjb250ZXh0OiBjb250ZXh0LFxuXHRcdFx0XHRpbmNsdWRlOiBpZHNcblx0XHRcdH1cblx0XHR9KTtcblx0fVxuXG5cdGluc3RhbmNlSW52b2tlKG5hbWUsIGZuLCAuLi5hcmdzKSB7XG5cdFx0aWYgKChuYW1lIGluIHRoaXMuaW5zdGFuY2VzKSAmJiAoZm4gaW4gdGhpcy5pbnN0YW5jZXNbbmFtZV0pKSB7XG5cdFx0XHR0aGlzLmluc3RhbmNlc1tuYW1lXVtmbl0uYXBwbHkodGhpcy5pbnN0YW5jZXNbbmFtZV0sIGFyZ3MpO1xuXHRcdH1cblx0fVxuXG5cdG9uRG9jUmVhZHkoKSB7XG5cdFx0Y29uc29sZS5sb2coJ0FwcC5vbkRvY1JlYWR5JywgdGhpcy5tb2R1bGVzLCBkb2N1bWVudC5ib2R5LmNsYXNzTmFtZSk7XG5cdFx0dGhpcy5pc0FkbWluID0gZG9jdW1lbnQuYm9keS5jbGFzc0xpc3QuY29udGFpbnMoJ3RvbWUyLWFkbWluJyk7XG5cdFx0Zm9yIChsZXQgbmFtZSBpbiB0aGlzLm1vZHVsZXMpIHtcblx0XHRcdGxldCBtID0gdGhpcy5tb2R1bGVzW25hbWVdO1xuXHRcdFx0dGhpcy5pbnN0YW5jZXNbbmFtZV0gPSBuZXcgbSh0aGlzKTtcblx0XHRcdHRoaXMuaW5zdGFuY2VzW25hbWVdLmFwcCA9IHRoaXM7XG5cdFx0fVxuXHR9XG5cbn1cblxubW9kdWxlLmV4cG9ydHMgPSBBcHA7XG4iXX0=
