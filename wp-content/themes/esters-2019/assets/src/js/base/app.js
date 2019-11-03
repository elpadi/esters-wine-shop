const $ = require('jquery');
const Obj = require('./obj');
const Str = require('./str');
const DOM = require('./dom');
const Media = require('./media');
const WP = require('./wp');
const GlobalModule = require('../modules/global');

class App {

	constructor() {
		this.modules = { global: GlobalModule };
		this.instances = {};
		this.ENV = global.JS_ENV;
	}

	init() {
		window.addEventListener('DOMContentLoaded', e => this.onDocReady())
		window.addEventListener('load', e => this.load());
		window.addEventListener('resize', e => this.resize());
	}

	load() {
		setTimeout(this.resize.bind(this), 100);
		setTimeout(() => document.body.classList.add('content-loaded'), 200);
		this.vw = window.innerWidth;
		this.vh = window.innerHeight;

		this.dispatch('load');
	}

	isElementInViewport(rect, threshold=0.3) {
		return DOM.isElementInViewport(rect, this.vw, this.vh, threshold);
	}

	getDims(obj) {
		return Media.getDims(obj);
	}

	fixTopPositions() {
		return DOM.fixTopPositions();
	}

	slugify(s, glue='_') {
		return Str.slugify(s, glue);
	}

	queryStringToObject(s) {
		return Str.queryStringToObject(s);
	}

	removeFileExtension(path) {
		return Str.removeFileExtension(path);
	}

	objSet(name, val, obj) {
		return Obj.set(name, val, obj);
	}

	ajax(data, method='GET') {
		return WP.ajax(data, method);
	}

	apiRequest(endpoint, data) {
		return WP.apiRequest(endpoint, data);
	}

	fetchPosts(type='pages', ids='', context='edit') {
		return WP.fetchPosts(type, ids, context);
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

	instanceInvoke(name, fn, ...args) {
		if ((name in this.instances) && (fn in this.instances[name])) {
			this.instances[name][fn].apply(this.instances[name], args);
		}
	}

	onDocReady() {
		console.log('App.onDocReady', this.modules, document.body.className);
		for (let name in this.modules) {
			let m = this.modules[name];
			this.instances[name] = new m(this);
			this.instances[name].app = this;
		}
	}

}

module.exports = App;
