const $ = require('jquery');
const Esters = require('./esters');
const Modal = require('./modal');

class GlobalModule {

	constructor() {
		app.addModule('esters', Esters);
		app.addModule('modal', Modal);
	}

}

module.exports = GlobalModule;
