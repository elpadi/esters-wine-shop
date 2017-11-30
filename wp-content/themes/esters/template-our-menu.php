<?php
/**
 * Template Name: Menu - New
 */
?>


<!-- Menu Section -->
<section id="menu" class="menu-main doc">
  	<div class="container">
	<div id="menu-announcement">
		<p><?php the_field('menu_note'); ?></p>
	</div>
    <div class="menu-entry"> 
      <!-- Nav tabs -->
      <ul class="nav menu-nav" role="tablist">
        <li role="presentation" id="menu" class="active eat-link">
            <a href="#dinner" aria-controls="dinner" role="tab" data-toggle="tab">Dinner</a>
        </li>
        <li role="presentation" class="lunch-link"><a href="#lunch" aria-controls="drink" role="tab" data-toggle="tab">Lunch</a></li>
        <li role="presentation" class="brunch-link"><a href="#brunch" aria-controls="dinner" role="tab" data-toggle="tab">Brunch</a></li>
        <li role="presentation" class="drink-link"><a href="#drink" aria-controls="drink" role="tab" data-toggle="tab">Drinks</a></li>
      </ul>
      <!-- Tab panes -->
      <div class="tab-content">
       	<!-- Dinner -->
        <div role="tabpanel" class="tab-pane active" id="dinner">
        	<p class="menu-note"><?php the_field('note_dinner'); ?></p>
        	<div id="menu">
        		<div class="row">
					<div class="col-md-5 clearfix">
						<?php if( have_rows('menu_section_dinner_left') ): // Flexible Content
							while ( have_rows('menu_section_dinner_left') ) : the_row(); ?>

							<?php if( get_row_layout() == 'menu_section' ): ?>
								<div class="menu-container">
									<h3><?php the_sub_field('title'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('menu_items') ): ?>
										<?php while ( have_rows('menu_items') ) : the_row(); ?>
											<div class="menu-content">
												<?php the_sub_field('menu_item'); ?>
											</div>
										<?php endwhile; ?>			
									<?php endif; // End Repeater ?> 
								</div>	
								
							<?php  elseif( get_row_layout() == 'menu_subsections' ): ?> 
							
								<div class="menu-container">
									<h3><?php the_sub_field('title_subsections'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('subsections') ): ?>
										<?php while ( have_rows('subsections') ) : the_row(); ?>
											<?php if( get_sub_field('subsection_title') ): ?>
												<h4 class="menu-subhead"><?php the_sub_field('subsection_title'); ?></h4>
											<?php endif; ?>
											<?php if( get_sub_field('subsection_note') ): ?>
												<p class="menu-section-note"><?php the_sub_field('subsection_note'); ?></p>
											<?php endif; ?>
											<?php // Repeater
											if( have_rows('menu_items') ): ?>
												<?php while ( have_rows('menu_items') ) : the_row(); ?>
													<div class="menu-content">
														<?php the_sub_field('menu_item'); ?>
													</div>
												<?php endwhile; ?>				
											<?php endif; // End Repeater ?> 
										<?php endwhile; ?>				
									<?php endif; // End Repeater ?> 
								</div> <!-- .menu-container -->

							<?php else :
							endif; ?>            
						<?php endwhile; ?><?php endif; // End Flexible Content?>  
					</div>
					<div class="col-md-7 clearfix">
						<?php if( have_rows('menu_section_dinner_right') ): // Flexible Content
							while ( have_rows('menu_section_dinner_right') ) : the_row(); ?>

							<?php if( get_row_layout() == 'menu_section' ): ?>
								<div class="menu-container">
									<h3><?php the_sub_field('title'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('menu_items') ): ?>
										<?php while ( have_rows('menu_items') ) : the_row(); ?>
											<div class="menu-content">
												<?php the_sub_field('menu_item'); ?>
											</div>
										<?php endwhile; ?>				
									<?php endif; // End Repeater ?> 
								</div>
								
							<?php  elseif( get_row_layout() == 'menu_subsections' ): ?> 
							
								<div class="menu-container">
									<h3><?php the_sub_field('title_subsections'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('subsections') ): ?>
										<?php while ( have_rows('subsections') ) : the_row(); ?>
											<?php if( get_sub_field('subsection_title') ): ?>
												<h4 class="menu-subhead"><?php the_sub_field('subsection_title'); ?></h4>
											<?php endif; ?>
											<?php if( get_sub_field('subsection_note') ): ?>
												<p class="menu-section-note"><?php the_sub_field('subsection_note'); ?></p>
											<?php endif; ?>
											<?php // Repeater
											if( have_rows('menu_items') ): ?>
												<?php while ( have_rows('menu_items') ) : the_row(); ?>
													<div class="menu-content">
														<?php the_sub_field('menu_item'); ?>
													</div>
												<?php endwhile; ?>				
											<?php endif; // End Repeater ?> 
										<?php endwhile; ?>				
									<?php endif; // End Repeater ?> 
								</div> <!-- .menu-container -->

							<?php else :
							endif; ?>            
						<?php endwhile; ?><?php endif; // End Flexible Content?>  
					</div>
			  	</div> <!-- .row -->
        	</div>
        </div>
        <!-- Lunch -->
        <div role="tabpanel" class="tab-pane fade" id="lunch">
        	<p class="menu-note"><?php the_field('note_lunch'); ?></p>
        	<div id="menu">
        		<div class="row">
        			<div class="col-md-5 clearfix">
						<?php if( have_rows('menu_section_lunch_left') ): // Flexible Content
							while ( have_rows('menu_section_lunch_left') ) : the_row(); ?>

							<?php if( get_row_layout() == 'menu_section' ): ?>
								<div class="menu-container">
									<h3><?php the_sub_field('title'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('menu_items') ): ?>
										<?php while ( have_rows('menu_items') ) : the_row(); ?>
											<div class="menu-content">
												<?php the_sub_field('menu_item'); ?>
											</div>
										<?php endwhile; ?>				
									<?php endif; // End Repeater ?> 
								</div>
								
							<?php  elseif( get_row_layout() == 'menu_subsections' ): ?> 
							
								<div class="menu-container">
									<h3><?php the_sub_field('title_subsections'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('subsections') ): ?>
										<?php while ( have_rows('subsections') ) : the_row(); ?>
											<?php if( get_sub_field('subsection_title') ): ?>
												<h4 class="menu-subhead"><?php the_sub_field('subsection_title'); ?></h4>
											<?php endif; ?>
											<?php if( get_sub_field('subsection_note') ): ?>
												<p class="menu-section-note"><?php the_sub_field('subsection_note'); ?></p>
											<?php endif; ?>
											<?php // Repeater
											if( have_rows('menu_items') ): ?>
												<?php while ( have_rows('menu_items') ) : the_row(); ?>
													<div class="menu-content">
														<?php the_sub_field('menu_item'); ?>
													</div>
												<?php endwhile; ?>				
											<?php endif; // End Repeater ?> 
										<?php endwhile; ?>				
									<?php endif; // End Repeater ?> 
								</div> <!-- .menu-container -->

							<?php else :
							endif; ?>            
						<?php endwhile; ?><?php endif; // End Flexible Content?>  
					</div>
					<div class="col-md-7 clearfix">
						<?php if( have_rows('menu_section_lunch_right') ): // Flexible Content
							while ( have_rows('menu_section_lunch_right') ) : the_row(); ?>

							<?php if( get_row_layout() == 'menu_section' ): ?>
								<h3><?php the_sub_field('title'); ?></h3>
								<?php if( get_sub_field('menu_section_note') ): ?>
									<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
								<?php endif; ?>
								<?php // Repeater
								if( have_rows('menu_items') ): ?>
									<?php while ( have_rows('menu_items') ) : the_row(); ?>
										<div class="menu-content">
											<?php the_sub_field('menu_item'); ?>
										</div>
									<?php endwhile; ?>				
								<?php endif; // End Repeater ?> 

							<?php  elseif( get_row_layout() == 'menu_subsections' ): ?> 
							
								<div class="menu-container">
									<h3><?php the_sub_field('title_subsections'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('subsections') ): ?>
										<?php while ( have_rows('subsections') ) : the_row(); ?>
											<?php if( get_sub_field('subsection_title') ): ?>
												<h4 class="menu-subhead"><?php the_sub_field('subsection_title'); ?></h4>
											<?php endif; ?>
											<?php if( get_sub_field('subsection_note') ): ?>
												<p class="menu-section-note"><?php the_sub_field('subsection_note'); ?></p>
											<?php endif; ?>
											<?php // Repeater
											if( have_rows('menu_items') ): ?>
												<?php while ( have_rows('menu_items') ) : the_row(); ?>
													<div class="menu-content">
														<?php the_sub_field('menu_item'); ?>
													</div>
												<?php endwhile; ?>				
											<?php endif; // End Repeater ?> 
										<?php endwhile; ?>				
									<?php endif; // End Repeater ?> 
								</div> <!-- .menu-container -->

							<?php else :
							endif; ?>            
						<?php endwhile; ?><?php endif; // End Flexible Content?>  
					</div>
			  	</div> <!-- .row -->
        	</div>
        </div>
         <!-- Brunch -->
        <div role="tabpanel" class="tab-pane fade" id="brunch">
        	<p class="menu-note"><?php the_field('note_brunch'); ?></p>
			<div id="menu">
        		<div class="row">
        			<div class="col-md-5 clearfix">
						<?php if( have_rows('menu_section_brunch_left') ): // Flexible Content
							while ( have_rows('menu_section_brunch_left') ) : the_row(); ?>

							<?php if( get_row_layout() == 'menu_section' ): ?>
								<div class="menu-container">
									<h3><?php the_sub_field('title'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('menu_items') ): ?>
										<?php while ( have_rows('menu_items') ) : the_row(); ?>
											<div class="menu-content">
												<?php the_sub_field('menu_item'); ?>
											</div>
										<?php endwhile; ?>	
								</div>					
							<?php endif; // End Repeater ?> 
							
								
							<?php  elseif( get_row_layout() == 'menu_subsections' ): ?> 
							
								<div class="menu-container">
									<h3><?php the_sub_field('title_subsections'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('subsections') ): ?>
										<?php while ( have_rows('subsections') ) : the_row(); ?>
											<?php if( get_sub_field('subsection_title') ): ?>
												<h4 class="menu-subhead"><?php the_sub_field('subsection_title'); ?></h4>
											<?php endif; ?>
											<?php if( get_sub_field('subsection_note') ): ?>
												<p class="menu-section-note"><?php the_sub_field('subsection_note'); ?></p>
											<?php endif; ?>
											<?php // Repeater
											if( have_rows('menu_items') ): ?>
												<?php while ( have_rows('menu_items') ) : the_row(); ?>
													<div class="menu-content">
														<?php the_sub_field('menu_item'); ?>
													</div>
												<?php endwhile; ?>				
											<?php endif; // End Repeater ?> 
										<?php endwhile; ?>
									</div> <!-- .menu-container -->				
								<?php endif; // End Repeater ?>

							<?php else :
							endif; ?>            
						<?php endwhile; ?><?php endif; // End Flexible Content?>  
					</div>
					<div class="col-md-7 clearfix">
						<?php if( have_rows('menu_section_brunch_right') ): // Flexible Content
							while ( have_rows('menu_section_brunch_right') ) : the_row(); ?>

							<?php if( get_row_layout() == 'menu_section' ): ?>
								<div class="menu-container">
									<h3><?php the_sub_field('title'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('menu_items') ): ?>
										<?php while ( have_rows('menu_items') ) : the_row(); ?>
											<div class="menu-content">
												<?php the_sub_field('menu_item'); ?>
											</div>
										<?php endwhile; ?>		
								</div> <!-- .menu-container -->		
							<?php endif; // End Repeater ?> 
								
							<?php  elseif( get_row_layout() == 'menu_subsections' ): ?> 
							
								<div class="menu-container">
									<h3><?php the_sub_field('title_subsections'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('subsections') ): ?>
										<?php while ( have_rows('subsections') ) : the_row(); ?>
											<?php if( get_sub_field('subsection_title') ): ?>
												<h4 class="menu-subhead"><?php the_sub_field('subsection_title'); ?></h4>
											<?php endif; ?>
											<?php if( get_sub_field('subsection_note') ): ?>
												<p class="menu-section-note"><?php the_sub_field('subsection_note'); ?></p>
											<?php endif; ?>
											<?php // Repeater
											if( have_rows('menu_items') ): ?>
												<?php while ( have_rows('menu_items') ) : the_row(); ?>
													<div class="menu-content">
														<?php the_sub_field('menu_item'); ?>
													</div>
												<?php endwhile; ?>				
											<?php endif; // End Repeater ?> 
										<?php endwhile; ?>	
								</div> <!-- .menu-container -->			
							<?php endif; // End Repeater ?> 
								
							<?php else :
							endif; ?>            
						<?php endwhile; ?><?php endif; // End Flexible Content?>  
					</div>
			  	</div> <!-- .row -->
        	</div>
			
        </div>
        <!-- Drink -->
        <div role="tabpanel" class="tab-pane fade" id="drink">
			<p class="menu-note">
       		<?php if( get_field('note_drinks') ): ?>
       			<span><a href="<?php the_field('wine_list_pdf'); ?>" target="_blank"><?php the_field('wine_list_text'); ?></a></span>
				<span id="separator">|</span>
			<?php endif; ?>
       		<span><?php the_field('note_drinks'); ?></span></p>
			<div id="menu">
        		<div class="row">
        			<div class="col-md-5 clearfix">
						<?php if( have_rows('menu_section_drinks_left') ): // Flexible Content
							while ( have_rows('menu_section_drinks_left') ) : the_row(); ?>

							<?php if( get_row_layout() == 'menu_section' ): ?>
								<div class="menu-container">
									<h3><?php the_sub_field('title'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('menu_items') ): ?>
										<?php while ( have_rows('menu_items') ) : the_row(); ?>
											<div class="menu-content">
												<?php the_sub_field('menu_item'); ?>
											</div>
										<?php endwhile; ?>				
									<?php endif; // End Repeater ?> 
								</div>
								
							<?php  elseif( get_row_layout() == 'menu_subsections' ): ?> 
							
								<div class="menu-container">
									<h3><?php the_sub_field('title_subsections'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('subsections') ): ?>
										<?php while ( have_rows('subsections') ) : the_row(); ?>
											<?php if( get_sub_field('subsection_title') ): ?>
												<h4 class="menu-subhead"><?php the_sub_field('subsection_title'); ?></h4>
											<?php endif; ?>
											<?php if( get_sub_field('subsection_note') ): ?>
												<p class="menu-section-note"><?php the_sub_field('subsection_note'); ?></p>
											<?php endif; ?>
											<?php // Repeater
											if( have_rows('menu_items') ): ?>
												<?php while ( have_rows('menu_items') ) : the_row(); ?>
													<div class="menu-content">
														<?php the_sub_field('menu_item'); ?>
													</div>
												<?php endwhile; ?>				
											<?php endif; // End Repeater ?> 
										<?php endwhile; ?>				
									<?php endif; // End Repeater ?> 
								</div> <!-- .menu-container -->

							<?php else :
							endif; ?>            
						<?php endwhile; ?><?php endif; // End Flexible Content?>  
					</div>
					<div class="col-md-7 clearfix">
						<?php if( have_rows('menu_section_drinks_right') ): // Flexible Content
							while ( have_rows('menu_section_drinks_right') ) : the_row(); ?>

							<?php if( get_row_layout() == 'menu_section' ): ?>
								<h3><?php the_sub_field('title'); ?></h3>
								<?php if( get_sub_field('menu_section_note') ): ?>
									<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
								<?php endif; ?>
								<?php // Repeater
								if( have_rows('menu_items') ): ?>
									<?php while ( have_rows('menu_items') ) : the_row(); ?>
										<div class="menu-content">
											<?php the_sub_field('menu_item'); ?>
										</div>
									<?php endwhile; ?>				
								<?php endif; // End Repeater ?> 

							<?php  elseif( get_row_layout() == 'menu_subsections' ): ?> 
							
								<div class="menu-container">
									<h3><?php the_sub_field('title_subsections'); ?></h3>
									<?php if( get_sub_field('menu_section_note') ): ?>
										<p class="menu-section-note"><?php the_sub_field('menu_section_note'); ?></p>
									<?php endif; ?>
									<?php // Repeater
									if( have_rows('subsections') ): ?>
										<?php while ( have_rows('subsections') ) : the_row(); ?>
											<?php if( get_sub_field('subsection_title') ): ?>
												<h4 class="menu-subhead"><?php the_sub_field('subsection_title'); ?></h4>
											<?php endif; ?>
											<?php if( get_sub_field('subsection_note') ): ?>
												<p class="menu-section-note"><?php the_sub_field('subsection_note'); ?></p>
											<?php endif; ?>
											<?php // Repeater
											if( have_rows('menu_items') ): ?>
												<?php while ( have_rows('menu_items') ) : the_row(); ?>
													<div class="menu-content">
														<?php the_sub_field('menu_item'); ?>
													</div>
												<?php endwhile; ?>				
											<?php endif; // End Repeater ?> 
										<?php endwhile; ?>				
									<?php endif; // End Repeater ?> 
								</div> <!-- .menu-container -->

							<?php else :
							endif; ?>            
						<?php endwhile; ?><?php endif; // End Flexible Content?>  
					</div>
			  	</div> <!-- .row -->
        	</div>
        </div>
      </div>
    </div>
  </div>
</section>
