<ul class="box-list full challenge-list">
<?php while ( have_posts() ) : the_post();
  $length = 14;
  $organizer = get_field('organizer');
  $url = get_permalink();
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
      $length = 40;
    }
  ?>
  <div class="box-content">
    <h4><a href="<?php the_permalink() ?>">
      <strong><?php the_title(); ?></strong>
      <?php if (!empty($organizer)) {
        echo '<span class="cut"> By ' . $organizer . '</span>';
      } ?>
    </a></h4>
    <?php custom_excerpt($length); ?>
  </div>
  <?php
    echo '<a href="' . $url . '" class="btn btn-clr">View Challenge</a>';
  ?>
</li>

<?php endwhile; ?>
</ul>

<?php if(function_exists('wp_paginate')) { ?>
  <div class="pagination cf">
    <?php wp_paginate(); ?>
  </div>
  <?php } else { ?>
  <div class="pagination cf">
    <div class="posts-nav older"><?php next_posts_link('Next <span>&gt;</span>', 0); ?></div>
    <div class="posts-nav newer"><?php previous_posts_link('<span>&lt;</span> Previous', 0); ?></div>
  </div>
<?php } ?>
