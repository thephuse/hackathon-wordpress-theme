<?php get_header(); ?>

<div class="container">
  <div class="cf">
    <div class="main-col">
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post();
      $organizer = get_field('organizer');
      $contact_email = get_field('contact_email');
      $datasets = get_field('datasets');
      $tags = wp_get_post_terms( $post->ID, 'challenge-tag', array() );
      $sponsors = get_field('sponsors');
    ?>

      <?php the_content(); ?>

    <?php
    endwhile;
    endif;
    ?>
    </div><!-- /main-col -->

    <div class="sidebar">
      <?php if (!empty($organizer) || !empty($contact_email)) { ?>
        <div class="widget challenge-info">
        <?php
          if (!empty($organizer)) {
            echo '<h3>Organizer</h3> <strong>' . $organizer . '</strong>';
          }
          if (!empty($contact_email)) {
            echo '<h3>Email</h3> ' . $contact_email;
          }
        ?>
        </div>
      <?php } ?>

      <?php if (!empty($datasets)) { ?>
        <div class="widget challenge-datasets">
          <h3>Related Datasets</h3>
          <ul>
          <?php
            while (has_sub_field('datasets')) {
              $postobj = get_sub_field('dataset');
              // dataset needs one of these to be defined...
              $url = get_field('resource_url', $postobj->ID);
              $urlCheck = substr($url, 0, 4);
              if (empty($url)) {
                $file = get_field('file', $postobj->ID);
                $url = $file['url'];
              }
              $title = $postobj->post_title;
              if($urlCheck !== 'http') {
                echo '<li><a href="http://' . $url . '">' . $title . '</a></li>';
              } else {
                echo '<li><a href="' . $url . '">' . $title . '</a></li>';
              }
            }
          ?>
          </ul>
        </div>
      <?php } ?>

      <?php
        if (count($tags) > 0) {
          echo '<div class="widget tags"><h3>Tags</h3>';
          foreach ($tags as $term) {
            echo '<a href="' . get_bloginfo('url') . '/challenge-tag/' . $term->slug . '">';
            echo $term->name;
            echo '</a> ';
          }
          echo '</div>';
        }
      ?>

    </div><!-- /sidebar -->
  </div><!-- /cf -->

  <?php if (!empty($sponsors)) { ?>
  <div class="inner-section event-sponsors">
    <h2>Challenge Sponsors</h2>
    <?php
      foreach($sponsors as $item) {
        //logo image is required
        $logo = $item['logo']['sizes']['logo'];
        $link = $item['url'];
        $linkCheck = substr($link, 0, 4);
        if (!empty($link)) {
          if($linkCheck !== 'http') {
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
