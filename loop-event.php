<ul class="box-list full">
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

  $start_date = DateTime::createFromFormat('Ymd', get_field('start_date'));
?>

<li>
  <?php if ( has_post_thumbnail() ) { ?>
    <a href="<?php the_permalink() ?>" class="thumb">
    <?php
      $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'post-thumbnail' );
      echo '<img src="' . $thumb['0'] . '" alt="" />';
    ?>
    </a>
  <?php } ?>
  <div class="box-content">
    <h4><a href="<?php the_permalink() ?>">
      <?php the_title(); ?>
      <?php if (!empty($start_date)) {
        echo '<span> ' . $start_date->format('l, F j, Y') . '</span>';
      } ?>
    </a></h4>
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
  <?php
    if (!empty($registration_url)) {
      if($registration_url_check !== 'http'){
        echo '<a href="http://' . $registration_url . '" class="btn btn-clr">Register for this event</a>';
      } else {
        echo '<a href="' . $registration_url . '" class="btn btn-clr">Register for this event</a>';
      }      
    } else {
      echo '<a href="' . get_the_permalink() . '" class="btn btn-clr">View details</a>'; 
    }
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
