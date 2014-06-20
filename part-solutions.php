<div class="container cf home-challenges">
  <?php
    $featured_term = get_term_by('slug', 'featured', 'project-category');
    $args = array(
      'post_type' => 'project',
      'tax_query' => array(
        array(
          'taxonomy' => 'project-category',
          'field' => 'id',
          'terms' => (int)$featured_term->term_id
        )
      ),
      'order' => 'DESC',
      'numberposts' => '3'
    );
    $posts = get_posts($args);
    if( count($posts) > 0 ) : ?>
    <div class="solutions-header">
      <h2>Featured Projects</h2>
      <a href="<?php bloginfo('url');?>/projects" class="btn">View All Projects</a>
    </div>

    <ul class="box-list challenge-list">
      <?php
        foreach($posts as $post) :
          setup_postdata($post);
          $length = 14;
          $eventID = get_field('event_id');
          $eventName = get_post($eventID);
          $challengeID = get_field('challenge_id');
          $challengeName = get_post($challengeID);
          $challengeOther = trim(get_field('challenge_name'));

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
          
          <div class="solution-excerpt">
            <?php custom_excerpt($length); ?>
          </div>

          <div class="solution-meta">
            <h3>Challenge</h3>
            <p><strong><?php echo $challengeName->post_title; ?></strong></p>

            <h3>Event</h3>
            <p><strong><?php echo $eventName->post_title; ?></strong></p>
          </div>
        </div>
        <a href="<?php the_permalink() ?>" class="btn btn-clr">View Solution</a>
      </li>
      <?php endforeach; ?>
    </ul>
    <?php endif;
    wp_reset_query(); ?>

</div>
