<?php
/*
Template Name: Press
*/
get_header();
?>

<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post();
  $limit = 10;
  $press_releases = get_field('press_releases');
  $press = get_field('press');
  // logos are image objects and files are urls
  $logo = get_field('logo_preview');
  $logo_file = get_field('logo_download');
  $logo_dark = get_field('logo_preview_dark');
  $logo_dark_file = get_field('logo_download_dark');
  $logo_small = get_field('logo_preview_small');
  $logo_small_file = get_field('logo_download_small');
  $logo_small_dark = get_field('logo_preview_small_dark');
  $logo_small_dark_file = get_field('logo_download_small_dark');
  $press_assets = get_field('press_assets');
?>

<section class="press-intro">
  <div class="container cf">
  <?php the_content(); ?>
  </div>
</section>

<?php if (!empty($press_releases)) { ?>
<section>
  <div class="container cf">
    <h3>Press Releases</h3>
    <ul class="timeline">
    <?php
      $i = 1;
      foreach ($press_releases as $item) {
        $quote = $item['quote'];
        $url = $item['url'];
        $urlHTTP = substr($url, 0, 4);
        $link_text = $item['link_text'];
        $date = DateTime::createFromFormat('Ymd', $item['date']);
        $classes = '';
        if ($i > $limit) {
          $classes = ' class="hide"';
        }
        echo '<li'. $classes .'><div class="bubble">';
        echo $quote;
        echo '<p class="meta">';
        if (!empty($url)) {
          if($urlHTTP !== 'http') {
          echo '<a href="http://' . $url . '">';
          } else {
          echo '<a href="' . $url . '">';
          }
        }
        echo $link_text;
        if (!empty($url)) {
          echo '</a>';
        }
        if (!empty($date)) {
          echo ' - ' . $date->format('j F Y');
        }
        echo '</p>';
        echo '</div></li>';

        $i++;
      }
      if ($i > $limit) {
        echo '<li class="more-bar"><a href="#" class="btn timeline-load">Show More</a></li>';
      }
    ?>
    </ul>
  </div>
</section>
<?php } ?>

<?php if (!empty($press)) { ?>
<section class="alternate">
  <div class="container cf">
    <h3>In the Press</h3>
    <ul class="timeline">
    <?php
      $i = 1;
      foreach($press as $item) {
        $quote = $item['quote'];
        $url = $item['url'];
        $urlHTTP = substr($url, 0, 4);
        $link_text = $item['link_text'];
        $date = DateTime::createFromFormat('Ymd', $item['date']);
        $classes = '';
        if ($i > $limit) {
          $classes = ' class="hide"';
        }
        echo '<li'. $classes .'><div class="bubble">';
        echo $quote;
        echo '<p class="meta">';
        if (!empty($url)) {
          if($urlHTTP !== 'http') {
          echo '<a href="http://' . $url . '">';
          } else {
          echo '<a href="' . $url . '">';
          }
        }
        echo $link_text;
        if (!empty($url)) {
          echo '</a>';
        }
        if (!empty($date)) {
          echo ' - ' . $date->format('j F Y');
        }
        echo '</p>';
        echo '</div></li>';

        $i++;
      }
      if ($i > $limit) {
        echo '<li class="more-bar"><a href="#" class="btn timeline-load">Show More</a></li>';
      }
    ?>
    </ul>
  </div>
</section>
<?php } ?>

<section>
  <div class="container">
    <h3>Press Assets</h3>
    <div class="asset-logos cf">
    <?php
      if (!empty($logo)) {
        $src = $logo['sizes']['medium'];
        if (!empty($logo_file)) {
          $url = $logo_file;
        } else {
          $url = $logo['sizes']['large'];
        }
        echo '<a class="press-logo" href="' . $url . '"><img src="' . $src . '" alt="logo" /></a>';
      }
      if (!empty($logo_dark)) {
        $src = $logo_dark['sizes']['medium'];
        if (!empty($logo_dark_file)) {
          $url = $logo_dark_file;
        } else {
          $url = $logo_dark['sizes']['large'];
        }
        echo '<a class="press-logo logo-dark" href="' . $url . '"><img src="' . $src . '" alt="logo on dark" /></a>';
      }
      if (!empty($logo_small)) {
        $src = $logo_small['sizes']['medium'];
        if (!empty($logo_small_file)) {
          $url = $logo_small_file;
        } else {
          $url = $logo_small['sizes']['large'];
        }
        echo '<a class="press-logo logo-small" href="' . $url . '"><img src="' . $src . '" alt="small logo" /></a>';
      }
      if (!empty($logo_small_dark)) {
        $src = $logo_small_dark['sizes']['medium'];
        if (!empty($logo_small_dark_file)) {
          $url = $logo_small_dark_file;
        } else {
          $url = $logo_small_dark['sizes']['large'];
        }
        echo '<a class="press-logo logo-small logo-dark" href="' . $url . '"><img src="' . $src . '" alt="small logo on dark" /></a>';
      }
    ?>
    </div>
    <div class="press-assets">
    <?php
      foreach($press_assets as $item) {
        $src = $item['image']['sizes']['post-thumbnail'];
        $url = $item['image']['sizes']['large'];
        echo '<a href="' . $url . '"><img src="' . $src . '" alt="" /></a>';
      }
    ?>
    </div>
  </div>
</section>

<?php
endwhile;
endif;
?>
<?php get_footer(); ?>
