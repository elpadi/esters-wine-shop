const $ = require('jquery');
const Esters = require('./esters');
const Modal = require('./modal');

class GlobalModule {

	constructor() {
		app.addModule('esters', new Esters());
		app.addModule('modal', new Modal());
	}

}

module.exports = GlobalModule;
