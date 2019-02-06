class AboutRoute {

	init() {
		// JavaScript to be fired on the about us page
		// Instagram
		var accessToken = '1173431465.a606ce3.de1203fe2f924065979b78df9a8aae0d';
		$.getJSON('https://api.instagram.com/v1/users/self/media/recent/?access_token=' + accessToken + '&callback=?', function(insta) {
			$.each(insta.data, function(photos, src) {
				if (photos === 24) {
					return false;
				}
				$('<div class="ig-post">' + '<a href="' + src.link + '" target="_blank">' + '<div class="image" style="background-image:url(' + src.images.standard_resolution.url + ');"></div>' + '</a>' + '</div>').appendTo('.instagram-slider');
			});
			$('.instagram-slider').slick({
				infinite: true,
				speed: 1000,
				slidesToShow: 4,
				slidesToScroll: 4
			});
		});

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
			var contentString = '<div id="map-content">' + '<div id="siteNotice">' + '<h1 id="firstHeading" class="firstHeading">Esters</h1>' + '<div id="bodyContent">' + '<p>1314 7th St<br>' + 'Santa Monica, Calif. 90401<br>' + '<a href="https://goo.gl/p19fkc" target="_blank">' + 'Directions</a></p>' + '</div>' + '</div>' + '</div>';
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
