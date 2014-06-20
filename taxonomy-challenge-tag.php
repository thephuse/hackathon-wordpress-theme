<?php get_header(); ?>

<?php include('searchbar-challenge.php'); ?>

<section>
  <div class="container cf">
    <?php if ( have_posts() ) { include('loop-challenge.php'); } ?>
  </div><!-- /container -->
</section>
<?php get_footer(); ?>
