<?php
/*
Template Name: Test
*/
?>

<?php get_template_part( 'templates/header' ); ?>

<?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post(); ?>

    <?php endwhile; ?>
<?php endif; ?>

<?php 

//get contact
get_template_part('templates/section', 'contact');

// get press
get_template_part('templates/section', 'press');

?>

<?php get_template_part( 'templates/footer' ); ?>
