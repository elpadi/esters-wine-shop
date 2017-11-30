/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can
 * always reference jQuery with $, even when in .noConflict() mode.
 * ======================================================================== */
(function($) {
  // Use this variable to set up the common and page specific functions. If you
  // rename this variable, you will also need to rename the namespace below.
  var Sage = {
    // All pages
    'common': {
      init: function() {
        // JavaScript to be fired on all pages
        $('.filter-select').selectpicker();
        $('.filter-dropdown').click(function() {
          $('#filtering-form').toggleClass('active');
        });
        $(window).load(function() {
          setTimeout(function() {
            $(".loader").fadeOut('fast');
          }, 1000);
        });
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
        equalheight = function(container) {
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
        $(window).load(function() {
          equalheight('.esters-products li');
        });
        $(window).resize(function() {
          equalheight('.esters-products li');
        });
        // Custom Select
        /*
$('select').each(function(){
    var $this = $(this), numberOfOptions = $(this).children('option').length;
  
    $this.addClass('select-hidden'); 
    $this.wrap('<div class="select"></div>');
    $this.after('<div class="select-styled"></div>');

    var $styledSelect = $this.next('div.select-styled');
    $styledSelect.text($this.children('option').eq(0).text());
  
    var $list = $('<ul />', {
        'class': 'select-options'
    }).insertAfter($styledSelect);
  
    for (var i = 0; i < numberOfOptions; i++) {
        $('<li />', {
            text: $this.children('option').eq(i).text(),
            rel: $this.children('option').eq(i).val()
        }).appendTo($list);
    }
  
    var $listItems = $list.children('li');
  
    $styledSelect.click(function(e) {
        e.stopPropagation();
        $('div.select-styled.active').not(this).each(function(){
            $(this).removeClass('active').next('ul.select-options').hide();
        });
        $(this).toggleClass('active').next('ul.select-options').toggle();
    });
  
    $listItems.click(function(e) {
        e.stopPropagation();
        $styledSelect.text($(this).text()).removeClass('active');
        $this.val($(this).attr('rel'));
        $list.hide();
        //console.log($this.val());
    });
  
    $(document).click(function() {
        $styledSelect.removeClass('active');
        $list.hide();
    });

});  
*/
        $(document).ready(function() {
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
        });
        $(document).ready(function() {
          $('a[rel="relativeanchor"]').click(function() {
            $('html, body').animate({
              scrollTop: $($.attr(this, 'href')).offset().top - 80
            }, 500);
            return false;
          });
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
      },
      finalize: function() {
        // JavaScript to be fired on all pages, after page specific JS is fired
      }
    },
    // Home page
    'home': {
      init: function() {
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
       
      },
      finalize: function() {
        // JavaScript to be fired on the home page, after the init JS
      }
    },
    // About us page, note the change from about-us to about_us.
    /*
    'events': {
      init: function() {
        // JavaScript to be fired on the about us page
          

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
          
      }
    },
    */
      
     'page_template_template_shop_landing': {
      init: function() { 
      
    //Equal Height
        (function($) {
          "use strict";
          $.fn.equalHeights = function(widthThreshold) {
            var self = this,
              nodeObjects = [],
              heights = [],
              tallest;
            $(window).on("load resize", function() {
              self.children().each(function(i) {
                $(this).css("height", "");
                var height = $(this).height(),
                  paddingTop = Math.ceil(parseFloat($(this).css("padding-top"))),
                  paddingBottom = Math.ceil(parseFloat($(this).css("padding-bottom"))),
                  borderTop = Math.ceil(parseFloat($(this).css("border-top-width"))),
                  borderBottom = Math.ceil(parseFloat($(this).css("border-bottom-width"))),
                  totalHeight = height + paddingTop + paddingBottom + borderBottom + borderTop;
                nodeObjects[i] = {
                  height: height,
                  paddingTop: paddingTop,
                  paddingBottom: paddingBottom,
                  borderTop: borderTop,
                  borderBottom: borderBottom,
                  totalHeight: totalHeight
                };
                heights[i] = totalHeight;
              });
            });
            $(window).on("load resize", function() {
              if (widthThreshold && $(window).width() < widthThreshold) {
                return false;
              }
              self.children().each(function(i) {
                var diff,
                  oldHeight = $(this).height(),
                  newHeight;
                tallest = Math.max.apply(Math, heights);
                diff = tallest - nodeObjects[i].totalHeight;
                newHeight = oldHeight + diff;
                $(this).height(newHeight);
              });
            });
          };
        }(jQuery));
        //EQ Hieghts        
        $(".equalHeights").equalHeights();
          
          
          
      }
    },  
      
      
    'events': {
      init: function() {
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
      }
    },
    // About us page, note the change from about-us to about_us.
    'woocommerce_page': {
      init: function() {
        $('#year').click(function() {
          $('.qty').val('12');
        });
        $('#months').click(function() {
          $('.qty').val('6');
        });
        $('#month').click(function() {
          $('.qty').val('1');
        });
        // JavaScript to be fired on the about us page
      }
    },
     'checkout': {
      init: function() {
          
            var ckbox = $('#custom_checkbox');

    $('.giftcheckbox input').on('click',function () {
        if (ckbox.is(':checked')) {
           $('.gift_recipient_wrapper').slideDown(700);
        } else {
             $('.gift_recipient_wrapper').slideUp(700);
        }
    });
          
      }
     },
      
      
      
      
      
    // About us page, note the change from about-us to about_us.
    'page_template_template_about': {
      init: function() {
        // JavaScript to be fired on the about us page
         // Instagram
        $(function() {
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
        });
          
        
          
          
          
          // AIzaSyDwthfpVNhd5zzCn5Q_nbMHTcIO9tXGdIY
        // Google Maps API
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
    }
  };
  // The routing fires all common scripts, followed by the page specific scripts.
  // Add additional events for more control over timing e.g. a finalize event
  var UTIL = {
    fire: function(func, funcname, args) {
      var fire;
      var namespace = Sage;
      funcname = (funcname === undefined) ? 'init' : funcname;
      fire = func !== '';
      fire = fire && namespace[func];
      fire = fire && typeof namespace[func][funcname] === 'function';
      if (fire) {
        namespace[func][funcname](args);
      }
    },
    loadEvents: function() {
      // Fire common init JS
      UTIL.fire('common');
      // Fire page-specific init JS, and then finalize JS
      $.each(document.body.className.replace(/-/g, '_').split(/\s+/), function(i, classnm) {
        UTIL.fire(classnm);
        UTIL.fire(classnm, 'finalize');
      });
      // Fire common finalize JS
      UTIL.fire('common', 'finalize');
    }
  };
  // Load Events
  $(document).ready(UTIL.loadEvents);
})(jQuery); // Fully reference jQuery after this point.