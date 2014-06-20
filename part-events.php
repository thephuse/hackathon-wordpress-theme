<section class="home-events">
  <div class="container cf">
    <div class="left">
      <h2>
        <?php
          $numberEvents = wp_count_posts('event')->publish;
          $numberCities = count($locations);
        ?>
        Featured<br>
        <strong>Events</strong>
      </h2>
    </div>

    <ul class="event-locations">
      <?php
      $args = array(
        'post_type' => 'event',
        'orderby' => 'post_date',
        'order' => 'DESC',
        'numberposts' => '-1'
      );
      $posts = get_posts($args); shuffle($posts); ?>
      <?php if (count($posts) > 0): $n = 0; foreach($posts as $post): setup_postdata($post); ?>
          <li>
            <a href="<?php the_permalink(); ?>" title="<?php the_title();?>">
              <span><?php the_title();?></span>
            </a>
          </li>
        <?php if ($n++ > 5) break; ?>
        <?php endforeach; ?>
        <li>
          <a href="<?php bloginfo('url'); ?>/events/" class="all-link">
            <span>View All Events</span>
          </a>
         </li>
      <?php endif; wp_reset_query(); ?>
    </ul>
  </div>
</section>
