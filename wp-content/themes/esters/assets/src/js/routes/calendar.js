class CalendarRoute {

	init() {

		window.addEventListener('hashchange', function(e) {
			var h = $(location.hash), old = e.oldURL.split('#');
			h.find('.event-info').addClass('show');
			if (old.length > 1) $('#' + old.pop()).find('.event-info').removeClass('show');
		});

		// stops this clicks being disabled, so they trigger the hashchange.
		$('.event-info-toggler').on('click', function(e) {
			e.stopPropagation(); 
		});
	}

	finalize() {
	}

}
