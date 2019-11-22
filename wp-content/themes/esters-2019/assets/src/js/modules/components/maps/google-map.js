const Map = require('./map');

class GoogleMap extends Map {

	constructor() {
		super();

		if (('google' in window) && ('maps' in google)) {
			//google.maps.event.addDomListener(window, 'load', this.createMap.bind(this));
		}
	}

	createCoordinates() {
		return new google.maps.LatLng(this.latlng[0], this.latlng[1]);
	}

	createSettings() {
		return {
			zoom: 15,
			disableDefaultUI: false,
			center: this.createCoordinates(),
			scrollwheel: false,
			scaleControl: false,
			streetViewControl: false,
			draggable: false,
			mapTypeControl: false,
			mapTypeControlOptions: {
				style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
			},
			navigationControl: false,
			navigationControlOptions: {
				style: google.maps.NavigationControlStyle.SMALL
			},
			mapTypeId: google.maps.MapTypeId.ROADMAP
		};
	}

	createLabelPopupContent() {
		return `
		<div id="map-content">
			<div id="siteNotice">
				<h1 id="firstHeading" class="firstHeading">Esters</h1>
				<div id="bodyContent">
					<p>1314 7th St<br>
						Santa Monica, Calif. 90401<br>
						<a href="https://goo.gl/p19fkc" target="_blank">Directions</a>
					</p>
				</div>
			</div>
		</div>`.trim();
	}

	onMarkerClick() {
		this.infoWindow.open(this.map, this.marker);
	}

	createMarker() {
		return new google.maps.Marker({
			position: this.createCoordinates(),
			map: this.map,
			icon: this.assetsPath + 'marker.png',
			shadow: {
				url: this.assetsPath,
				anchor: new google.maps.Point(5, 20)
			}
		});
	}

	createMapStyles() {
		return [{
			featureType: "all",
			stylers: [{
				saturation: -100
			}]
		}, {
			featureType: "road.highway",
			stylers: [{
				hue: "#acacac"
			}, {
				saturation: -100
			}]
		}];
	}

	createMap() {
		super.createMap();

		this.map = new google.maps.Map(this.mapContainer.get(0), this.createSettings());

		this.infoWindow = new google.maps.InfoWindow({
			content: this.createLabelPopupContent(),
			maxWidth: 380
		});

		this.marker = this.createMarker();
		google.maps.event.addListener(this.marker, 'click', this.onMarkerClick.bind(this));

		this.map.setOptions({
			styles: this.createMapStyles()
		});
	}

}

module.exports = GoogleMap;

/*
class AboutRoute {

	init() {
		function initialize() {
			var latlng = new google.maps.LatLng(34.020736, -118.493686);
			var settings = {
				zoom: 15,
				disableDefaultUI: false,
				center: latlng,
				scrollwheel: false,
				scaleControl: false,
				streetViewControl: false,
				draggable: false,
				mapTypeControl: false,
				mapTypeControlOptions: {
					style: google.maps.MapTypeControlStyle.DROPDOWN_MENU
				},
				navigationControl: false,
				navigationControlOptions: {
					style: google.maps.NavigationControlStyle.SMALL
				},
				mapTypeId: google.maps.MapTypeId.ROADMAP
			};
			var map = new google.maps.Map(document.getElementById("map-container"), settings);
			var infowindow = new google.maps.InfoWindow({
				content: contentString,
				maxWidth: 380
			});
			var iconBase = 'http://www.esterswineshop.com/wp-content/themes/esters/dist/images/';
			var markerShadow = {
				url: iconBase + '',
				anchor: new google.maps.Point(5, 20)
			};
			var marker = new google.maps.Marker({
				position: latlng,
				map: map,
				icon: iconBase + 'esters-map-icon.png',
				shadow: markerShadow
			});
			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map, marker);
			});
			var red_road_styles = [{
				featureType: "all",
				stylers: [{
					saturation: -100
				}]
			}, {
				featureType: "road.highway",
				stylers: [{
					hue: "#acacac"
				}, {
					saturation: -100
				}]
			}];
			map.setOptions({
				styles: red_road_styles
			});
		}
		google.maps.event.addDomListener(window, 'resize', initialize);
		google.maps.event.addDomListener(window, 'load', initialize);
	}

	finalize() {
	}

}
*/

