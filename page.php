<?php get_header(); ?>

<article class="page-content container">
  <?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>

    <?php the_content(); ?>

  <?php
  endwhile;
  endif;
  ?>
</article>

<?php get_footer(); ?>
