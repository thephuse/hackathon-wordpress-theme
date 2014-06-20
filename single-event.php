<?php get_header(); ?>

<div class="container">
  <div class="cf">
    <div class="main-col">
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post();
      setup_postdata($post);
      $data = get_post_meta( $post->ID, 'ndoch', true );
      $city = $data['ndoch_location'];
      $state = $data['ndoch_state'];
      $country = $data['ndoch_country'];

      $venue_name = get_field('venue_name');
      $venue_address = get_field('venue_address');
      $venue_address2 = get_field('venue_address2');
      $venue_city = get_field('venue_city');
      $venue_zip = get_field('venue_zip');
      $venue_map = get_field('venue_map');

      $registration_url = get_field('registration_url');
      $registration_url_check = substr($registration_url, 0, 4);
      if (function_exists('eae_encode_emails')) {
        $registration_url = eae_encode_emails($registration_url);
      }
      $event_site_url = get_field('event_site_url');
      $event_site_url_check = substr($event_site_url, 0, 4);

      $start_date = DateTime::createFromFormat('Ymd', get_field('start_date'));
      $start_time = get_field('start_time');
      $end_date = DateTime::createFromFormat('Ymd', get_field('end_date'));
      $end_time = get_field('end_time');

      // logos are objects
      $main_sponsor_logo = get_field('main_sponsor_logo');
      $main_sponsor_url = get_field('main_sponsor_url');
      $main_sponsor_url_check = substr($main_sponsor_url, 0, 4);
      $sponsors = get_field('sponsors');

      $show_organizers = get_field('show_organizers'); // boolean

      $project_args = array(
        'post_type' => 'project', 
        'numberposts' => -1,
        'meta_key' => 'event_id',
        'meta_value' => $post->ID
      );
      $projects = new WP_query($project_args);
    ?>

      <?php the_content(); ?>

    <?php
    endwhile;
    endif;
    ?>
    </div><!-- /main-col -->

    <div class="sidebar">
      <?php if (!empty($start_date)) { ?>
        <div class="group times">
        <?php
          echo $start_date->format('l, F j, Y');
          if (!empty($start_time)) {
            echo ' - ' . $start_time;
          }
          if (!empty($end_date)) {
            echo ' to <br>' . $end_date->format('l, F j, Y');
          }
          if (!empty($end_time)) {
            echo ' - ' . $end_time;
          }
        ?>
        </div>
      <?php } ?>

      <?php if (!empty($registration_url) || !empty($event_site_url)) { ?>
        <div class="group buttons">
        <?php
          if (!empty($registration_url)) {
            if($registration_url_check !== 'http') {
              echo '<a href="http://' . $registration_url . '" class="btn">Register for this event</a>';
            } else {
              echo '<a href="' . $registration_url . '" class="btn">Register for this event</a>';
            }
          }
          if (!empty($event_site_url)) {
            if($event_site_url_check !== 'http') {
              echo '<a href="http://' . $event_site_url . '" class="btn btn-primary" target="_blank">Visit event website</a>';
            } else {
              echo '<a href="' . $event_site_url . '" class="btn btn-primary" target="_blank">Visit event website</a>';
            }
          }
        ?>
        </div>
      <?php } ?>

      <div class="widget event-map">
        <div id="map" style="height:200px;"></div>
        <script type="text/javascript">
          var geocoder = L.mapbox.geocoder('neisan.i2bkm72l');
          var map = L.mapbox.map('map', 'neisan.i2bkm72l');
          <?php if (!empty($venue_map['address'])) { ?>
            var lat = '<?php echo $venue_map[lat]; ?>';
            var lon = '<?php echo $venue_map[lng]; ?>';
            map.setView([lat, lon], 10);
            L.mapbox.markerLayer({
              type: 'Feature',
              geometry: {
                type: 'Point',
                coordinates: [lon, lat]
              },
              properties: {
                'marker-size': 'large',
                'marker-color': '#d11f27'
              }
            }).addTo(map);
          <?php } else { ?>
            var theAddress = '<?php echo $venue_address; ?>';
            var theCity = '<?php echo $city; ?>';
            var theState = '<?php echo $state; ?>';
            var theCountry = '<?php echo $country; ?>';
            var param = theState;
            if (theState == 'N/A') {
              param = theCountry;
            }
            var theq = theCity + '+' + param;
            if (theAddress) {
              theq = theAddress + '+' + theq;
            }
            theq = theq.split(" ").join("+");
            geocoder.query(theq, showMap);
            var coords;
            function showMap(err, data) {
              coords = data.latlng;
              map.setView([coords[0], coords[1]], 10);
              L.mapbox.markerLayer({
                type: 'Feature',
                geometry: {
                  type: 'Point',
                  coordinates: [coords[1], coords[0]]
                },
                properties: {
                  'marker-size': 'large',
                  'marker-color': '#d11f27'
                }
              }).addTo(map);
            }
          <?php } ?>
        </script>
        <p>
          <?php
            if (!empty($venue_name)) {
              echo '<strong>' . $venue_name . '</strong> <br>';
            }
            if (!empty($venue_address)) {
              echo $venue_address . ' <br>';
            }
            if (!empty($venue_address2)) {
              echo $venue_address2 . ' <br>';
            }
            if (!empty($venue_city)) {
              echo $venue_city . '&nbsp; ';
            } elseif (!empty($city)) {
              echo $city . '&nbsp; ';
            }
            if (!empty($state) && $state != 'N/A') {
              echo $state . '&nbsp; ';
            }
            if (!empty($venue_zip)) {
              echo $venue_zip;
            }
          ?>
        </p>
      </div>

      <?php if (!empty($main_sponsor_logo)) { ?>
        <div class="group event-sponsor">
          <h3>Main Sponsor</h3>
        <?php
          $src = $main_sponsor_logo['sizes']['logo'];
          if (!empty($main_sponsor_url)) {
            if($main_sponsor_url_check !== 'http'){
              echo '<a href="http://' . $main_sponsor_url . '" target="_blank">';
            } else {
              echo '<a href="' . $main_sponsor_url . '" target="_blank">';
            }
          }
          echo '<img src="' . $src . '" alt="" />';
          if (!empty($main_sponsor_url)) {
            echo '</a>';
          }
        ?>
        </div>
      <?php } ?>
    </div><!-- /sidebar -->
  </div><!-- /cf -->


  <?php if ($projects->have_posts()): ?>
  <div class="inner-section">
    <h2>Projects</h2>
    <ul class="box-list full project-list">
    <?php while ($projects->have_posts()): $projects->the_post(); ?>
    <?php
      $challenge_id = get_field('challenge_id');
      $challenge = get_post($challenge_id);
      $challenge_other = trim(get_field('challenge_name'));
      $event_id = get_field('event_id');
      $event = get_post($event_id);
      $event_slug = $event->post_name;
      $event_search_term = get_query_var('project-event');
      if (!$event_search_term || $event_slug == $event_search_term):
        $found_projects = true;
    ?>
      <li>
        <div class="box-content">
          <h4><a href="<?php the_permalink() ?>"><?php the_title(); ?></a></h4>
          <?php custom_excerpt(30); ?>
          <footer>
            <?php if (!empty($challenge_id) || !empty($challenge_other)): ?>
                <h5>Challenge</h5>
                <?php if (!empty($challenge_id)): ?>
                  <p><?php echo $challenge->post_title; ?></p>
                <?php else: ?>
                  <p><?php echo $challenge_other; ?></p>
                <?php endif; ?>
              <?php endif; ?>
              
              <?php if (!empty($event)): ?>
                <h5>Event</h5>
                <p><?php echo $event->post_title; ?></p>
              <?php endif; ?> 
          </footer>
        </div>
        <?php
          echo '<a href="' . get_the_permalink() . '" class="btn btn-clr">View Project</a>';
        ?>
      </li>

    <?php endif; endwhile; ?>
    </ul>
  </div>
  <?php endif; wp_reset_query(); ?>

  <?php if ($show_organizers) { ?>
  <div class="inner-section">
    <h2>Organizers</h2>
    <?php
      $people = getOrganizers($post->ID);
      if($people) {
        echo '<ul class="event-organizers">';
        foreach($people as $person) {
          $aid = $person->object_id;
          $info = get_userdata($aid);
          $name = get_the_author_meta('display_name', $aid);
          $email = get_the_author_meta('user_email', $aid);
          $avatar = get_avatar($aid, 132);

          echo '<li>';
          if (!empty($email)) {
            echo '<a href="mailto:' . antispambot($email) . '">';
          }
          echo $avatar;
          echo '<strong>' . $name . '</strong>';
          if (!empty($email)) {
            echo '</a>';
          }
          echo '</li>';
        }
        echo '</ul>';

      } else {
        echo '<p>None to show</p>';
      }
    ?>
  </div>
  <?php } ?>

  <?php if (!empty($sponsors)) { ?>
  <div class="inner-section event-sponsors">
    <h2>Sponsors &amp; Partners</h2>
    <?php
      foreach($sponsors as $item) {
        //logo image is required
        $logo = $item['logo']['sizes']['logo'];
        $link = $item['url'];
        $linkCheck = substr($link, 0, 4);
        if (!empty($link)) {
          if($linkCheck !== 'http'){
          echo '<a href="http://' . $link . '">';
          } else {
          echo '<a href="' . $link . '">';
          }
        }
        echo '<img src="' . $logo . '" alt="" />';
        if (!empty($link)) {
          echo '</a>';
        }
      }
    ?>
  </div>
  <?php } ?>

</div><!-- /container -->

<?php get_footer(); ?>
