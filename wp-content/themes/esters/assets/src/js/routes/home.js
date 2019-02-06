class HomeRoute {

	init() {
        // JavaScript to be fired on the home page  
          if ($(window).width() < 668) {
                  }
                    else {
                   setTimeout(function(){   $('#signUpModal').modal('show'); }, 8000);
                }
          $('.Modern-Slider').slick({
          autoplay: false,
          autoplaySpeed: 10000,
          speed: 600,
          slidesToShow: 1,
          slidesToScroll: 1,
          pauseOnHover: false,
          dots: true,
          pauseOnDotsHover: true,
          cssEase: 'linear',
          // fade:true,
          draggable: false,
        });
	}

	finalize() {
	}

}

