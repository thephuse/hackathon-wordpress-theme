<?php get_header(); ?>

<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>

<section class="sponsors white">
  <div class="container cf">
  <?php

    /* ///////////////////////////////////////////// SPONSORS */
    $global_heading   = get_field('global_sponsors_heading');
    $local_heading    = get_field('local_sponsors_heading');
    $sponsors1        = get_field('sponsors1');
    $sponsors1_logos  = get_field('sponsors1_logos');
    $sponsors1b       = get_field('sponsors_1b_heading');
    $sponsors1b_logos = get_field('sponsors_1b_logos');
    $sponsors1c       = get_field('sponsors_1c_heading');
    $sponsors1c_logos = get_field('sponsors_1c_logos');
    $sponsors2        = get_field('sponsors2');
    $sponsors2_logos  = get_field('sponsors2_logos');
    $sponsors3        = get_field('sponsors3');
    $sponsors3_logos  = get_field('sponsors3_logos');
    $sponsors4        = get_field('sponsors4');
    $sponsors4_labels = get_field('sponsors4_labels');

    /* ///////////////////////////////////////////// GLOBAL SPONSORS */
    if (!empty($global_heading)) {
      echo '<h2>' . $global_heading . '</h2>';
    }
    if (!empty($sponsors1_logos)) {
      echo '<div class="sponsor-logos featured inline">';
      if (!empty($sponsors1)) {
        echo '<h3>' . $sponsors1 . '</h3>';
        echo '<div class="logos">';
      }
      foreach($sponsors1_logos as $item) {
        //logo image is required
        $logo = $item['logo'];
        $link = $item['link'];
        $linkCheck = substr($link, 0, 4);
        if (!empty($link)) {
          if($linkCheck !== 'http'){
            echo ' <a href="http://' . $link . '">';
          } else {
            echo '<a href="' . $link . '">';
          }
        }
        echo '<img src="' . $logo . '" alt="" />';
        if (!empty($link)) {
          echo '</a>';
        }
      }
      if (!empty($sponsors1)) {
        echo '</div>';
      }
      echo '</div>';
    }

    if (!empty($sponsors1b_logos)) {
      echo '<div class="sponsor-logos featured inline">';
      if (!empty($sponsors1b)) {
        echo '<h3>' . $sponsors1b . '</h3>';
        echo '<div class="logos">';
      }
      foreach($sponsors1b_logos as $item) {
        //logo image is required
        $logo = $item['logo'];
        $link = $item['link'];
        $linkCheck = substr($link, 0, 4);
        if (!empty($link)) {
          if($linkCheck !== 'http'){
            echo ' <a href="http://' . $link . '">';
          } else {
            echo '<a href="' . $link . '">';
          }
        }
        echo '<img src="' . $logo . '" alt="" />';
        if (!empty($link)) {
          echo '</a>';
        }
      }
      if (!empty($sponsors1b)) {
        echo '</div>';
      }
      echo '</div>';
    }

    if (!empty($sponsors1c_logos)) {
      echo '<div class="sponsor-logos featured">';
      if (!empty($sponsors1)) {
        echo '<h3>' . $sponsors1c . '</h3>';
        echo '<div class="logos">';
      }
      foreach($sponsors1c_logos as $item) {
        //logo image is required
        $logo = $item['logo'];
        $link = $item['link'];
        $linkCheck = substr($link, 0, 4);
        if (!empty($link)) {
          if($linkCheck !== 'http'){
            echo ' <a href="http://' . $link . '">';
          } else {
            echo '<a href="' . $link . '">';
          }
        }
        echo '<img src="' . $logo . '" alt="" />';
        if (!empty($link)) {
          echo '</a>';
        }
      }
      if (!empty($sponsors1c)) {
        echo '</div>';
      }
      echo '</div>';
    }


    if (!empty($sponsors2_logos)) {
      echo '<div class="sponsor-logos">';
      if (!empty($sponsors2)) {
        echo '<h3>' . $sponsors2 . '</h3>';
        echo '<div class="logos">';
      }
      foreach($sponsors2_logos as $item) {
        //logo image is required
        $logo = $item['logo'];
        $link = $item['link'];
        $linkCheck = substr($link, 0, 4);
        if (!empty($link)) {
          if($linkCheck !== 'http'){
            echo ' <a href="http://' . $link . '">';
          } else {
            echo '<a href="' . $link . '">';
          }
        }
        echo '<img src="' . $logo . '" alt="" />';
        if (!empty($link)) {
          echo '</a>';
        }
      }
      if (!empty($sponsors2)) {
        echo '</div>';
      }
      echo '</div>';
    }
    if (!empty($sponsors3_logos)) {
      echo '<div class="sponsor-logos contributing-organizations">';
      if (!empty($sponsors3)) {
        echo '<h3>' . $sponsors3 . '</h3>';
        echo '<div class="logos">';
      }
      foreach($sponsors3_logos as $item) {
        //logo image is required
        $logo = $item['logo'];
        $link = $item['link'];
        $linkCheck = substr($link, 0, 4);
        if (!empty($link)) {
          if($linkCheck !== 'http'){
            echo ' <a href="http://' . $link . '">';
          } else {
            echo '<a href="' . $link . '">';
          }
        }
        echo '<img src="' . $logo . '" alt="" />';
        if (!empty($link)) {
          echo '</a>';
        }
      }
      if (!empty($sponsors3)) {
        echo '</div>';
      }
      echo '</div>';
    }
    if (!empty($sponsors4_labels)) {
      echo '<div class="sponsor-labels">';
      if (!empty($sponsors4)) {
        echo '<h3>' . $sponsors4 . '</h3>';
        echo '<div class="logos">';
      }
      foreach($sponsors4_labels as $item) {
        //label is required
        $label = $item['name'];
        $link = $item['link'];
        $linkCheck = substr($link, 0, 4);
        if (!empty($link)) {
          if($linkCheck !== 'http'){
            echo ' <a href="http://' . $link . '">';
          } else {
            echo ' <a href="' . $link . '">';
          }
        }
        echo ' <span>' . $label . '</span>';
        if (!empty($link)) {
          echo '</a>';
        }
      }
      if (!empty($sponsors4)) {
        echo '</div>';
      }
      echo '</div>';
    }
  ?>
  </div>
</section>

<section class="sponsors">
  <div class="container">
    <?php 
    if (!empty($local_heading)) {
      echo '<h2>' . $local_heading . '</h2>';
    }
    ?>
    <?php
        $locations = array();

        $args = array(
          'post_type' => 'event',
          'post_status' => 'publish',
          'posts_per_page' => -1,
          'caller_get_posts'=> 1
          );

        $events = new WP_Query($args);
        if ( $events->have_posts() ) {
          while ( $events->have_posts() ):
            $events->the_post();
            setup_postdata($post);

            $data = get_post_meta( $post->ID, 'ndoch', true );
            $city = $data['ndoch_location'];
            $state = $data['ndoch_state'];
            $country = $data['ndoch_country'];

            if (!empty($city) && $city !== 'None Selected') {

              $location = array(
                'city' => $city,
                'state' => $state == 'N/A' ? '' : $state,
                'country' => $country, 
                'link' => get_permalink(),
                'logos' => array());

              $main_logo = get_field('main_sponsor_logo');
              if (!empty($main_logo))
                $location['logos'][] = array('logo' => $main_logo, 'link' => get_field('main_sponsor_url'));

                $logos = get_field('sponsors'); 
                foreach($logos as $logo) {
                $location['logos'][] = array('logo' => $logo['logo'], 'link' => $logo['url']);
              }
              if (!empty($location['logos']))
                  $locations[] = $location;
            }
            wp_reset_query(); endwhile;
        }
        wp_reset_query();
    ?>
    <ul class="local-sponsors">
      <?php usort($locations, function ($a, $b) { return strcmp( $a['city'], $b['city'] ); }); ?>
      <?php foreach($locations as $location): ?>
        <li>
          <a href="<?php echo $location['link']; ?>" class="location">
            <?php echo $location['city'].',<br/>'.(empty($location['state']) ? '' : $location['state'].',<br/>').$location['country']; ?>
          </a>
          <div class="logos">
            <?php foreach ($location['logos'] as $logo): ?>
              <a target="_blank" href="<?php echo $logo['link']; ?>"><img src="<?php echo $logo['logo']['url']; ?>"/></a>
            <?php endforeach; ?>
          </div>
        </li>
      <?php endforeach; ?>
    </ul>
    </div>
</section>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
