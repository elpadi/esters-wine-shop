var ajaxURL = MyAjax.ajax_url;


//reset filter

jQuery(".reset").on("click", function (event) {
    event.preventDefault();
    jQuery(".filter-select").val('').selectpicker('refresh');
    var wine_type = jQuery('#typefilter').find(':selected').data('id'),
    region = jQuery('#regionfilter').find(':selected').data('id'),
    variety = jQuery('#varietyfilter').find(':selected').data('id'),
    priceRange = jQuery('#price').find(':selected').data('id');
    productFilter(wine_type, region, variety, priceRange);
    
});



  //equal heights		  
equalheight = function(container) {
  var currentTallest = 0,
    currentRowStart = 0,
    rowDivs = new Array(),
    $el,
    topPosition = 0;
  jQuery(container).each(function() {
    $el = $(this);
    jQuery($el).height('auto')
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

//search query
jQuery(document).on('submit', '.search-container form', function() {
    var $form = jQuery(this);
    var $input = $form.find('input[name="s"]');
    var query = $input.val();
    var $content = jQuery('.esters-products');
    jQuery.ajax({
      type: 'post',
      url: ajaxURL,
      data: {
        action: 'load_search_results',
        query: query
      },
      beforeSend: function() {
        $input.prop('disabled', true);
        jQuery('<div class="loader-wrapper"><div class="products-loader"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div></div>').appendTo('.esters-products');
      },
      success: function(response) {
        $input.prop('disabled', false);
        $content.removeClass('loading');
        $content.html(response);
      },
      complete: function() {
        jQuery(".loader-wrapper").remove();
          setTimeout(function(){  equalheight('.esters-products li');}, 10);
      }
    });
    return false;
  });

//filter query
jQuery('#filtering-form').on('change', 'select', function(e) {
  //console.log("eh");
  //var val = jQuery(e.target).val();
  var wine_type = jQuery('#typefilter').find(':selected').data('id'),
    region = jQuery('#regionfilter').find(':selected').data('id'),
    variety = jQuery('#varietyfilter').find(':selected').data('id'),
    priceRange = jQuery('#price').find(':selected').data('id');
  //call filter
  productFilter(wine_type, region, variety, priceRange)
});

function productFilter(wine_type, region, variety, priceRange) {
  console.log(wine_type, region, variety, priceRange);		
  jQuery.ajax({
    url: ajaxURL,
    type: 'POST',
    data: {
      action: 'filter_action',
      wine_type: wine_type,
      region: region,
      variety: variety,
      price: priceRange,
    },
    beforeSend: function() {
      jQuery('<div class="loader-wrapper"><div class="products-loader"><div class="spinner"><div class="double-bounce1"></div><div class="double-bounce2"></div></div></div></div>').appendTo('.esters-products');
    },
    success: function(data) {
      //console.log(data);
      jQuery('.esters-products').html(data);
     
    },
    complete: function() {
      jQuery(".loader-wrapper").remove();
        
        setTimeout(function(){  equalheight('.esters-products li');}, 10);
    }
  });
}