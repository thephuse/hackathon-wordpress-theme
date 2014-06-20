<?php get_header(); ?>

<?php include('searchbar-data.php'); ?>

<section>
  <div class="container cf">
    <?php if ( have_posts() ) { include('loop-data.php'); } ?>
  </div><!-- /container -->
</section>
<?php get_footer(); ?>
