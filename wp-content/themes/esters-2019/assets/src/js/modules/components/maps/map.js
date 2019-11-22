const $ = require('jquery');

class Map {

	constructor() {
		this.latlng = [34.020736, -118.493686];
		this.assetsPath = app.ENV.URLS.THEME + '/assets/img/maps/';
	}

	createMap() {
		this.mapContainer = $(document.createElement('div')).addClass('map-container embedded-map full-width').appendTo('#main');
	}

}

module.exports = Map;
