<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-10">
		<form id="filtering-form">
			<div class="row">
				<div class="filter-li col-xs-12 col-sm-3">
				<!-- pa_wine-type -->
				<?php
				if( $terms = get_terms( 'pa_wine-type') ) : // to make it simple I use default categories
				echo '<select id="typefilter" name="typefilter" class="filter-select">

				<option selected="selected">Wine Type</option>';
				foreach ( $terms as $term ) :
				echo '<option data-id="' . $term->term_id . '" value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
				endforeach;
				echo '</select>';
				endif;
				?>
				</div>
				<div class="filter-li col-xs-12 col-sm-3">
				<!-- pa_region -->
				<?php
				if( $terms = get_terms( 'pa_region') ) : // to make it simple I use default categories
				echo '<select id="regionfilter" name="regionfilter" class="filter-select">

				<option selected="selected">Region</option>';
				foreach ( $terms as $term ) :
				echo '<option data-id="' . $term->term_id . '" value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
				endforeach;
				echo '</select>';
				endif;
				?>
				</div>
				<div class="filter-li col-xs-12 col-sm-3">
				<!-- pa_grape -->
				<?php
				if( $terms = get_terms( 'pa_grape-varietal') ) : // to make it simple I use default categories
				echo '<select id="varietyfilter" name="varietyfilter" class="filter-select">

				<option selected="selected">Grape Varietal</option>';
				foreach ( $terms as $term ) :
				echo '<option data-id="' . $term->term_id . '" value="' . $term->term_id . '">' . $term->name . '</option>'; // ID of the category as the value of an option
				endforeach;
				echo '</select>';
				endif;
				?>
				</div>
				<div class="filter-li col-xs-12 col-sm-3">
				<!-- Max Price -->
				<select id="price" name="price_max" tabindex="-98" class="filter-select">
				<option selected="selected">Price</option>
				<option data-id="0-25" value="0-25">$0 - $25</option>
				<option data-id="25-50" value="25-50">$25 - $50</option>
				<option data-id="51-100000" value="51-100000">$50 & Over</option>
				</select>
				</div>
			</div>
		</form> 
	</div>
	<div class="col-xs-12 col-sm-12 col-md-2 hidden-sm hidden-xs">
		<a class="btn btn-outline reset" href="#">Reset Filter</a>
	</div>
</div>
