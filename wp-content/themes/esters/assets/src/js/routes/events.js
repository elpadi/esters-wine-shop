class EventsRoute {

	init() {
        console.log("events");
        $(document).on("click", "#details", function(e) {
          $(this).parents('.item').toggleClass('darken');
          $(this).parent('.center-item').toggleClass('active');
          $(this).text('Hide Details');
          $(this).toggleClass('active');
        });
        $(document).on("click", "#menu a", function(e) {
          $('.center-item').removeClass('active');
          $('.item').removeClass('darken');
          $('#details').text('View Details');
          $('#details').removeClass('active');
        });
        var slider = $('.bxslider').bxSlider({
          pagerCustom: '#menu'
        });
        $('.scroll-down').click(function() {
          var current = slider.getCurrentSlide();
          slider.goToNextSlide(current) + 1;
        });
        $(document).scroll(function() {
          if ($(this).scrollTop() > 150) {
            $('.center-item').addClass('taller');
          } else {
            $('.center-item').removeClass('taller');
          }
        });
		/*
        $(document).ready(function() {
            $('.img-wrap').waypoint(function(direction) {
              if (direction === 'down') {
                $(this).addClass('active');
              } else {
                $(this).removeClass('active')
              } 
            }, {
              offset: '80%'
            });
        });
		*/
	}

	finalize() {
	}

}
