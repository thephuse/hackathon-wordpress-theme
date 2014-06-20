<section class="home-search-events home-events">
  <?php
    $map_id       = get_field('map');
    $hero_buttons = get_field('hero_buttons');
  ?>
    <?php
      if (!empty($map_id)): ?>
        <div id="map"></div>
        <script type="text/javascript">
          var map = L.mapbox.map('map', '<?php echo $map_id; ?>')
          map.touchZoom.disable();
          map.doubleClickZoom.disable();
          map.scrollWheelZoom.disable();
          // disable tap handler, if present.
          if (map.tap) map.tap.disable();
        </script>
    <?php endif; ?>
      <div class="container map-inner cf">
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
    <?php
      if (!empty($map_id)): ?>
      <div class="map-overlay"></div>
      <a href="#" class="trigger-map small">View Map</a>
    <?php endif; ?>
</section>
