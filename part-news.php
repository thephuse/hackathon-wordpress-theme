<div class="container cf news">
  <?php query_posts('posts_per_page=3');
    if (have_posts()) : ?>
    <div class="box-intro">
      <h3>Latest<br /> <strong>News</strong></h3>
      <a href="<?php bloginfo('url');?>/blog" class="btn">View All News</a>
    </div>
    <ul class="box-list">
      <?php
        while (have_posts()) : the_post();
        $length = 14;
      ?>
      <li>
        <?php if ( has_post_thumbnail() ) { ?>
        <a href="<?php the_permalink() ?>" class="thumb">
          <?php
          $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnail' );
          echo '<img src="' . $thumb['0'] . '" alt="" />';
          ?>
        </a>
        <?php
          } else {
            $length = 42;
          }
        ?>
        <div class="box-content">
          <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
          <?php custom_excerpt($length); ?>
        </div>
        <a href="<?php the_permalink() ?>" class="btn btn-clr">Continue Reading</a>
      </li>
      <?php endwhile; ?>
    </ul>
    <?php endif;
    wp_reset_query(); ?>
</div>
