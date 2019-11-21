const $ = require('jquery');
const WP = require('./wp');

class Theme {

	static fetchAsset(path) {
		return WP.ajax({
			action: 'get_asset_contents',
			path: path
		});
	}

}

module.exports = Theme;
