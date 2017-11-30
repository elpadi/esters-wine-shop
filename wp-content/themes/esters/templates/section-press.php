<section id="press" class="press">
    <div class="container">
        <div class="entry">
            <div class="text-center">
            <h2 class="sec-title fadein">PRESS</h2>
            </div>
            <div class="entry-content fadein">
                <div class="row">
<?php
  query_posts( array( 'post_type' => 'press', 'posts_per_page' => -1 ) );
  if ( have_posts() ) : while ( have_posts() ) : the_post();
?>

<div class="col-sm-3 col-xs-6">
    <div class="press-link">
    <a href="<?php the_field('article_link'); ?>" target="_blank">
    <?php 
    $image = get_field('press_image');
    if( !empty($image) ): ?>
    <figure class="img-holder"><img src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" class="img-responsive" /></figure>
    <?php endif; ?>
    <?php the_field('source_name'); ?>
    </a>
    </div>
</div>


<?php endwhile; endif; wp_reset_query(); ?>
                </div>
            </div>
        </div>
    </div>
</section>