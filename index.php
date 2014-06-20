<?php get_header(); ?>

<div class="container cf">
  <div class="main-col">
  <?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>

  <div class="post">
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <?php if ( has_post_thumbnail() ) {
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'excerpt-thumb' );
        echo '<img src="' . $thumb['0'] . '" alt="" />';
    } ?>
    <?php the_excerpt(); ?>
    <p class="meta">
      <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
      <span class="content">Posted on <?php the_date(); ?> by <?php the_author_posts_link(); ?></span>
    </p>
  </div>
  <?php endwhile; ?>

  <?php if(function_exists('wp_paginate')) { ?>
    <div class="pagination cf">
      <?php wp_paginate(); ?>
    </div>
    <?php } else { ?>
    <div class="pagination cf">
      <div class="posts-nav older"><?php next_posts_link('Older <span>&gt;</span>', 0); ?></div>
      <div class="posts-nav newer"><?php previous_posts_link('<span>&lt;</span> Newer', 0); ?></div>
    </div>
  <?php } ?>

  <?php
  else :
    echo '<p>The requested page is not here. Try using the menu or search to find what you are looking for.</p>';
  endif;
  ?>
  </div><!-- /main-col -->

  <div class="sidebar">
    <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('blog-sidebar') ) {} ?>
	<a href="<?php bloginfo('rss_url'); ?>" class="rss" target="_blank">RSS</a>
  </div>

</div>

<?php get_footer(); ?>
