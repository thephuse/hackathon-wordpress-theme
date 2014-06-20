<?php
/*
Template Name: Organizers
*/
get_header();
?>

<article class="organizers container">
  <?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post();
    $section1_header = get_field('section1_header');
    $section1_people = get_field('section1_people');
    $section2_header = get_field('section2_header');
    $section2_people = get_field('section2_people');
    $section3_header = get_field('section3_header');

    if(!empty($section1_people)) {
      if(!empty($section1_header)) {
        echo '<h2>' . $section1_header . '</h2>';
      }
      echo '<ul class="avatars avatars-large">';
      foreach($section1_people as $item) {
        // name is required
        // image is an object
        $image = $item['image'];
        $name = $item['name'];
        $company = $item['company'];
        $email = $item['email'];
        echo '<li>';
		echo empty($email) ? '<a href="#" class="trigger-info">' : '<a href="mailto:'.$email.'">';
        if(!empty($image)) {
          $src = $image['sizes']['large-avatar'];
          echo '<img src="' . $src . '" alt="' . $name . '" />';
        }
        echo '<div class="info-wrap"><div class="info">';
        echo '<strong>' . $name . '</strong>';
        if (!empty($company)) {
          echo ' ' . $company;
        }
        echo '</div></div></a></li>';
      }
      echo '</ul>';
    }

    if(!empty($section2_people)) {
      if(!empty($section2_header)) {
        echo '<h2>' . $section2_header . '</h2>';
      }
      echo '<ul class="avatars avatars-medium">';
      foreach($section2_people as $item) {
        // name is required
        // image is an object
        $image = $item['image'];
        $name = $item['name'];
        $company = $item['company'];
        $email = $item['email'];
        echo '<li>';
		echo empty($email) ? '<a href="#" class="trigger-info">' : '<a href="mailto:'.$email.'">';
        if(!empty($image)) {
          $src = $image['sizes']['thumbnail'];
          echo '<img src="' . $src . '" alt="' . $name . '" />';
        }
        echo '<div class="info-wrap"><div class="info">';
        echo '<strong>' . $name . '</strong>';
        if (!empty($company)) {
          echo ' ' . $company;
        }
        echo '</div></div></a></li>';
      }
      echo '</ul>';
    }

    if(!empty($section3_header)) {
      echo '<h2>' . $section3_header . '</h2>';
    }

  endwhile;
  endif;

  $people = getUserList();
  if($people) {
    echo '<ul class="avatars avatars-small">';
    foreach($people as $person) {
      $aid = $person->ID;
      $info = get_userdata($aid);
      $name = get_the_author_meta('display_name', $aid);
      $location = get_the_author_meta('location', $aid);
      $avatar = get_avatar($aid, 48);
      $roles = implode(' ', $info->roles);

      if (preg_match('/Organizer/i', $roles)) {
        echo '<li><a href="#" data-tooltip="';
        echo '<strong>' . $name . '</strong>';
        if ($location != 'x') {
          // uses locations from php/locations.php
          echo ' ' . $locations[$location];
        }
        echo '">';
        echo $avatar;
        echo '</a></li>';
      }
    }
    echo '</ul>';
  }

  ?>


</article>

<?php get_footer(); ?>
