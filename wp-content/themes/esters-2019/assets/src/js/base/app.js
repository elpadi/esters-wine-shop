const $ = require('jquery');
const Obj = require('./obj');
const Str = require('./str');
const DOM = require('./dom');
const Media = require('./media');
const WP = require('./wp');
const Theme = require('./theme');
const GlobalModule = require('../modules/global');

class App {

	constructor() {
		this.modules = { global: GlobalModule };
		this.instances = {};
		this.ENV = global.JS_ENV;
		this.hasCreatedInstances = false;
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

	fetchPosts(type='pages', params={}) {
		return WP.fetchPosts(type, params);
	}

	fetchIcon(name, dir='icons') {
		return Theme.fetchAsset(`${dir}/${name}.svg`);
	}

	resize() {
		this.vw = window.innerWidth;
		this.vh = window.innerHeight;
		this.dispatch('resize', this.vw, this.vh);
	}

	addModule(name, module) {
		console.log('App.addModule', name, this.hasCreatedInstances);
		if (this.hasCreatedInstances) {
			if (name in this.instances) throw `Module name "${name}" is already in use.`;
			this.createModuleInstance(module, name);
		}
		else {
			if (name in this.modules) throw `Module name "${name}" is already in use.`;
			this.modules[name] = module;
		}
		return this;
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

	createModuleInstance(module, name) {
		console.log('App.createModuleInstance', name, module);
		this.instances[name] = new module(this);
		this.instances[name].app = this;
	}

	onDocReady() {
		this.hasCreatedInstances = true;
		console.log('App.onDocReady', this.modules, document.body.className);
		for (let name of Object.keys(this.modules)) this.createModuleInstance(this.modules[name], name);
	}

}

module.exports = App;
