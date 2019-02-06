class CommonRoute {

	init() {
		// JavaScript to be fired on all pages
		$('.filter-dropdown').click(function() {
			$('#filtering-form').toggleClass('active');
		});
		setTimeout(function() {
			$(".loader").fadeOut('fast');
		}, 1000);
		(function() {
			$(document).on('click', '.hamburger-menu', function() {
				$('.banner').toggleClass('active');
				$('.bar').toggleClass('animate');
			});
			$('.main-menu li a').click(function() {
				$('.banner').toggleClass('active');
				$('.bar').toggleClass('animate');
			});
		})();
		//equal heights		  
		var equalheight = function(container) {
			var currentTallest = 0,
				currentRowStart = 0,
				rowDivs = new Array(),
				$el,
				topPosition = 0;
			$(container).each(function() {
				$el = $(this);
				$($el).height('auto')
				topPostion = $el.position().top;
				if (currentRowStart != topPostion) {
					for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
						rowDivs[currentDiv].height(currentTallest);
					}
					rowDivs.length = 0; // empty the array
					currentRowStart = topPostion;
					currentTallest = $el.height();
					rowDivs.push($el);
				} else {
					rowDivs.push($el);
					currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
				}
				for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
					rowDivs[currentDiv].height(currentTallest);
				}
			});
		}
		$(window).on('load', function() {
			equalheight('.esters-products li');
		});
		$(window).on('resize', function() {
			equalheight('.esters-products li');
		});
		if (/Android|BlackBerry|iPhone|iPad|iPod|webOS/i.test(navigator.userAgent) === false) {
			$(window).scroll(function() {
				if ($(this).scrollTop() > 200) {
					$('.mobile-header').addClass('fixed');
				} else {
					$('.mobile-header').removeClass('fixed');
				}
			});
		}
		$(window).scroll(function() {
			if ($(this).scrollTop() > 200) {
				$('.nav-container').addClass('fixed');
			} else {
				$('.nav-container').removeClass('fixed');
			}
			if ($(this).scrollTop() > 200) {
				$('.hamburger-menu').addClass('fixed');
			} else {
				$('.hamburger-menu').removeClass('fixed');
			}
		});
		$('a[rel="relativeanchor"]').click(function() {
			$('html, body').animate({
				scrollTop: $($.attr(this, 'href')).offset().top - 80
			}, 500);
			return false;
		});
		// Scroll Reveal
		window.sr = ScrollReveal({
			//reset: true,
			opacity: 0,
			scale: 1,
			duration: 800,
			distance: '100px',
			mobile: false,
			viewFactor: 0.4
		});
		sr.reveal('.fadein');
	}

	finalize() {
	}

}

