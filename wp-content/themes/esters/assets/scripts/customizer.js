(function($) {
  // Site title
  if (('wp' in window) && ('customize' in wp)) wp.customize('blogname', function(value) {
    value.bind(function(to) {
      $('.brand').text(to);
    });
  });
})(jQuery);
