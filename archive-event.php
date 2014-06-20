<?php get_header(); ?>

<?php include('searchbar-event.php'); ?>

<section>
  <div class="container cf">
    <?php if ( have_posts() ) { include('loop-event.php'); } ?>
  </div><!-- /container -->
</section>
<?php get_footer(); ?>
