<?php
/*
Template Name: Contact
*/
get_header();
?>

<div class="container cf contact">
  <?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
  <div class="main-col">
    <?php echo do_shortcode(get_field('contact_form_code')); ?>
  </div><!-- /main-col -->

  <div class="sidebar">
    <div class="widget">
      <?php the_field('contact_information'); ?>
    </div>
  </div>
  <?php endwhile; ?>
  <?php endif; ?>  

</div>

<?php get_footer(); ?>
