<div class="container cf home-challenges">
  <?php
    $featured_term = get_term_by('slug', 'featured', 'challenge-category');
    $args = array(
      'post_type' => 'challenge',
      'tax_query' => array(
        array(
          'taxonomy' => 'challenge-category',
          'field' => 'id',
          'terms' => (int)$featured_term->term_id
        )
      ),
      'order' => 'DESC',
      'numberposts' => '3'
    );
    $posts = get_posts($args);
    if( count($posts) > 0 ) : ?>
    <div class="box-intro">
      <h3>Featured<br /> <strong>Challenges</strong></h3>
      <p>
        A curated list of challenges from Federal Government Departments and Agencies and other national partners.
      </p>
      <a href="<?php bloginfo('url');?>/challenges" class="btn btn-primary">View All Challenges</a>
    </div>

    <ul class="box-list challenge-list">
      <?php
        foreach($posts as $post) :
          setup_postdata($post);
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
        <a href="<?php the_permalink() ?>" class="btn btn-clr">View Challenge</a>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php endif;
    wp_reset_query(); ?>

</div>
