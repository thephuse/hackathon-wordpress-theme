<!doctype html>
<!--[if lt IE 7 ]> <html class="no-js ie6 ie" lang="en"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7 ie" lang="en"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8 ie" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9 ie" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js no-ie" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title(' | ',true,'right'); ?><?php bloginfo('name'); ?></title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
  <link rel="shortcut icon" href="<?php bloginfo('template_url'); ?>/favicon.ico" />
  <link rel="apple-touch-icon-precomposed" href="<?php bloginfo('template_url'); ?>/apple-touch-icon.png" />
  <?php if (is_page_template('template-report.php')): ?>
  <script type="text/javascript" src="//use.typekit.net/way2zms.js"></script>
  <script type="text/javascript">try{Typekit.load();}catch(e){}</script>
  <?php endif; ?>
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
  if (!is_404() && !is_page_template('template-report.php')):
  $id = getIdViaSlug('home');
  $hashtag = get_field('hashtag',$id);
  $titleSponsor = get_field('title_sponsor_logo',$id);
?>

<header class="site-header">
  <div class="hidden-menu">
    <div class="container cf">
      <div class="left">
        <form class="slim-search" action="<?php bloginfo('url') ?>" method="get">
          <input type="search" class="search-input" id="s" placeholder="Search for anything" name="s">
          <input type="submit" value="Search">
        </form>
      </div>
      <div class="right">
        <?php
          wp_nav_menu( array(
            'theme_location' => 'second-menu',
            'container' => 'nav',
            'container_class' => 'second-menu',
            'menu_id' => '',
            'fallback_cb' => '',
          ));
        ?>
        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('secondary-header-area') ) {} ?>
        <a href="#" class="ico ico-toggle toggle hide-second-menu">Toggle</a>
      </div>
    </div>
  </div>
  <div class="main-header">
    <div class="container cf">
      <div class="left cf">
        <a href="<?php bloginfo('url'); ?>" class="logo">
          <h1><?php bloginfo('name'); ?></h1>
          <img src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
        </a>
        <?php
          if (!empty($titleSponsor)) {
            echo '<img src="' . $titleSponsor . '" alt="" class="title-sponsor" />';
          }
        ?>
      </div>
      <div class="right">
        <?php
          wp_nav_menu( array(
            'theme_location' => 'main-menu',
            'container' => 'nav',
            'container_class' => 'main-menu',
            'menu_id' => '',
            'fallback_cb' => ''
          ));
        ?>
        <a href="#" class="ico ico-toggle toggle show-second-menu">Toggle</a>
      </div>
    </div>
  </div>
</header>

<?php
  if (is_page_template('template-before.php')) {
    /* ///////////////////////////////////////////// HERO */
    $map_id       = get_field('map');
    $hero_content = get_field('hero_content');
    $hero_buttons = get_field('hero_buttons');
    $hashtag      = get_field('hashtag');
  ?>
  <div class="hero">
    <?php
      if (!empty($map_id)) {
        echo '<div id="map"></div>'; ?>
        <script type="text/javascript">
          var map = L.mapbox.map('map', '<?php echo $map_id; ?>')
          map.touchZoom.disable();
          map.doubleClickZoom.disable();
          map.scrollWheelZoom.disable();
          // disable tap handler, if present.
          if (map.tap) map.tap.disable();
        </script>
    <?php } ?>
    <div class="hero-content">
      <div class="container">
        <?php
          echo $hero_content;
          if (!empty($hero_buttons)) {
            foreach($hero_buttons as $item) {
              // link and label are required.
              $link    = $item['link'];
              $linkCheck = substr($link, 0, 4);
              $label   = $item['label'];
              $primary = $item['primary'];
              $class   = '';
              if ($primary) {
                $class = 'btn-primary';
              }
              if($linkCheck !== 'http') {
                echo '<a href="http://' . $link . '" class="btn ' . $class . '">' . $label . '</a>';
              } else {
                echo '<a href="' . $link . '" class="btn ' . $class . '">' . $label . '</a>';
              }
            }
          }
          if (shortcode_exists('tweets')) { echo do_shortcode('[tweets max=1]'); }
        ?>
      </div><!-- /container -->

      <div class="social">
        <?php include('share.php'); ?>
      </div>
    </div><!-- /hero-content -->
    <?php
      if (!empty($map_id)) { ?>
      <div class="map-overlay"></div>
      <a href="#" class="trigger-map">Map</a>
    <?php } ?>
  </div><!-- /hero -->
  <?php
  } elseif (is_page_template('template-during.php')) {
    /* ///////////////////////////////////////////// DURING EVENT HERO */
  ?>
  <div class="hero jess3-microsite">
    <div class="presentation">
      <iframe src="http://beta.mappr.io/play/ndoch-draft" width="100%" height="100%"></iframe>
    </div>
    <div class="form">
      <iframe src="<?php bloginfo('url'); ?>/jess3/themes/demoeskei/civic-hacking.php" seamless frameborder="0" height="100%" width="100%" ALLOWTRANSPARENCY="true"></iframe>
    </div>
    <div class="social">
      <?php include('share.php'); ?>
    </div>
    <div class="map-overlay"></div>
    <a href="#" class="trigger-visualization">View Visualization</a>
  </div><!-- /hero -->
  <div class="home-cta-gutter">
    <?php $buttons = get_field('hero_buttons'); ?>
    <?php foreach ($buttons as $button): ?>
      <a href="<?php echo $button['link']; ?>" class="btn"><?php echo $button['label']; ?></a>
    <?php endforeach; ?>
  </div>

  <?php
  } elseif (is_page_template('template-after.php')) {
    /* ///////////////////////////////////////////// DURING EVENT HERO */
  ?>
  <div class="hero jess3-microsite after-event-content">
    <div class="infographic">
    </div>
    <div class="container">
      <div class="intro-content">
        <h4>On May 31 - June 1, 2014</h4>
        <h3>We Changed the Face of</h3>
        <h2>Civic Hacking</h2>
        <h3>Together</h3>

        <span class="thank-you">Thank You</span>
        <h5>For Your Help</h5>
        <div class="buttons">
          <a href="<?php bloginfo('url'); ?>/report/" class="btn btn-primary">View 2014 Report</a>
          <a href="<?php bloginfo('url'); ?>/submit/" class="btn">Submit a Project</a>
        </div>
      </div>
    </div>
    <div class="social">
      <?php include('share.php'); ?>
    </div>
    <div class="map-overlay"></div>
  </div><!-- /hero -->

<?php } else { ?>
  <?php
    $src = "";
    if ( is_page() || is_singular('event') || is_singular('challenge') ) {
    if ( have_posts() ) :
    while ( have_posts() ) : the_post();
      if ( has_post_thumbnail() ) {
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($page->ID), 'banner' );
        $src = $thumb['0'];
      }
    endwhile;
    endif;
  }
  if (is_post_type_archive()) {
    if ('Events' == post_type_archive_title('', false) ) {
      $src = get_template_directory_uri().'/images/bg-events.png';
    } elseif ('Challenges' == post_type_archive_title('', false) ) {
      $src = get_template_directory_uri().'/images/bg-challenges.png';
    } elseif ('Projects' == post_type_archive_title('', false) ) {
      $src = get_template_directory_uri().'/images/project_bg.png';
    }
  } ?>
  <div class="intro" <?php if ( !empty($src) ) { echo 'style="background-image: url(' . $src . ')"'; }?>>
    <div class="container">
      <div class="intro-content">
        <h2><?php if (is_home()) {
          $id = null;
          $the_slug = 'blog';
          $args=array(
            'name' => $the_slug,
            'post_type' => 'page',
            'post_status' => 'publish',
            'posts_per_page' => 1
          );
          $found_posts = get_posts( $args );
          if( $found_posts ) {
            $id = $found_posts[0]->ID;
          }
          $data = get_post($id);
          $title = $data->post_title;
          echo $title;
        } elseif (is_author()) {
          echo 'Posts by ' . get_the_author();
        } elseif (is_post_type_archive()) {
          post_type_archive_title();
        } elseif (is_archive()) {
          echo single_cat_title();
        } elseif (is_search()) {
          echo 'Results for: &ldquo;' . get_search_query() . '&rdquo;';
        } elseif (is_subpage()) {
          echo get_the_title(is_subpage());
        } elseif (is_404()) {
          echo '404';
        } elseif (is_page_template('template-after.php')) {
          //nothing
        } else {
          the_title();
        } ?></h2>
        <?php
          if (is_singular('event')) {
          if ( have_posts() ) :
            while ( have_posts() ) : the_post();
            $terms = get_the_terms($post->ID,'event-type');
            $event_url = get_field('event_site_url');
            $event_url_check = substr($event_url, 0, 4);
          ?>
            <p class="event-meta">
              <?php
                if(!empty($terms)) {
                  $term_list = array();
                  foreach ($terms as $term) {
                    $term_list[] = $term->name;
                  }
                  echo '<img src="' . get_bloginfo('template_url') . '/images/ico-tag.png"><span>' . join(", ", $term_list) . '</span> ';
                }
                if(!empty($event_url)) {
                  if($event_url_check !== 'http') {
                    echo '<img src="' . get_bloginfo('template_url') . '/images/ico-link.png"><a href="http://' . $event_url . '">' . $event_url . '</a>';
                  } else {
                    echo '<img src="' . get_bloginfo('template_url') . '/images/ico-link.png"><a href="' . $event_url . '">' . $event_url . '</a>';
                  }
                }
              ?>
            </p>
            <?php
            endwhile;
          endif;
        } elseif (is_page_template('template-after.php')) { ?>

          <h4>On May 31 - June 1, 2014</h4>
          <h3>We Changed the Face of</h3>
          <h2>Civic Hacking</h2>
          <h3>Together</h3>

          <span class="thank-you">Thank You</span>
          <h5>For Your Help</h5>
        <?php } elseif (is_singular('challenge')) {
          // nothing...
        } elseif (is_single() && !is_singular('project')) {
          if ( have_posts() ) :
            while ( have_posts() ) : the_post(); ?>
            <p class="meta">
              Posted on <?php the_date(); ?> by <?php the_author_posts_link(); ?>
            </p>
            <?php
            endwhile;
          endif;
        } ?>
      </div><!-- /intro-content -->
    </div><!-- /container -->
  </div><!-- /intro -->
<?php } ?>

<?php
// loop for creating subpage menu on certain pages.
if ( have_posts() ) :
while ( have_posts() ) : the_post();
  $id = $post->ID;
  if(is_subpage()) {
    $id = is_subpage();
  }
  $showsubheader = is_page('about') || is_subpage() == getIdViaSlug('about') ||
                   is_page('interest') || is_subpage() == getIdViaSlug('interest');
  if ($showsubheader) {
    echo '<div class="page-menu-wrap">';
    $args = array(
      'child_of' => $id,
      'parent' => $id,
      'sort_column' => 'menu_order'
    );
    $children = get_pages($args);
    if( count($children) > 0 ) :
      echo '<ul class="page-menu container">';
      $link = get_permalink($id);
      $class = 'page-id-' . $id;
      echo '<li class="' . $class . '"><a href="' . $link . '">';
      echo get_the_title($id);
      echo '</a></li>';
      foreach($children as $post) :
        setup_postdata($post);
        $link = get_permalink();
        $class = 'page-id-' . $id;
        echo '<li class="' . $class . '"><a href="' . $link . '">';
        the_title();
        echo '</a></li>';
      endforeach;
      echo '</ul>';
    endif;
    wp_reset_query();
    echo '</div>';
  }
endwhile;
endif;

endif;

if (is_page_template('template-report.php')): ?>
  <section class="report-hero">
    <div class="report-hero-backdrop"></div>
    <div class="report-hero-backdrop-bottom"></div>
    <div class="report-hero-content">
      <div class="report-hero-title-box">
        <h1>National day of civic hacking</h1>
        <img src="<?php echo get_template_directory_uri(); ?>/images/report-white-box-date.png" class="date"/>
      </div>
      <div class="report-hero-thank-you">
        <p>From May 31st to June 1st, hundreds of passionate developers, designers, innovators, makers, entrepreneurs, and citizens changed the face of civic hacking. Learn more about how people are bettering their communities, one hack at a time, across the globe.</p>
      </div>
      <div class="scroll-down"><a href="#"><img src="<?php echo get_template_directory_uri(); ?>/images/down-arrow@2x.png"/>Scroll Down</a></div>
    </div>
  </section>

<?php endif; ?>

<main>
