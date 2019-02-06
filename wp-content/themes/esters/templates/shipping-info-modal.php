<!-- BEGIN Shipping Info Modal -->
<div class="modal fade" id="shipping_details" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
				<h4 class="modal-title" id="myModalLabel">Shipping &amp; Delivery Details</h4>
			</div>
			<div class="modal-body">
				<h3><?php the_field('shipping_title', 'option'); ?></h3>
				<?php the_field('shipping', 'option'); ?>        
				<h3><?php the_field('local_delivery_title', 'option'); ?></h3>
				<?php the_field('local_delivery', 'option'); ?> 
			</div>
		</div>
	</div>
</div>
<!-- END Shipping Info Modal -->
