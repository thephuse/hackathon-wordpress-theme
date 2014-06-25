<?php
/*
Template Name: During Event Homepage
*/
get_header();
?>

<?php if ( have_posts() ) : ?>
<?php while ( have_posts() ) : the_post(); ?>

<?php
  /* ///////////////////////////////////////////// SEARCH EVENTS */
  include('part-search-events.php');
?>

<section id="featured_sponsors">
  <div class="container cf">

    <div class="featured-list">
      <?php echo '<img src="' . get_bloginfo('template_url') . '/images/intel-featured_360.png" alt="" />' ?>
      <p>
        Check out Intel’s developer tools to speed your development!
      </p>
      <ul>
        <li>The <a href="https://software.intel.com/en-us/html5/tools">Intel® XDK</a> is free a development tool for Windows, OSX and Linux that lets developers easily create web-based apps for phones, tablets, and PCs using HTML 5</li>
        <li>The <a href="http://developer.mashery.com/">Mashery API Network</a> provides with access to over 50 Mashery-powered RESTful APIs using a single ID.</li>
      </ul>
      <a class="btn" href="http://hackforchange.org/intel-tools-for-civic-hackers/">Learn More</a>
    </div>

    <div class="featured-list">
      <?php echo '<img src="' . get_bloginfo('template_url') . '/images/kf-featured_360.png" alt="" />' ?>
      <p>
        View challenges by the Knight Foundation to get started, including:
      </p>
      <ul>
        <li><a href="http://hackforchange.org/challenges/networking-distributed-project-teams/">Networking Distributed Project Teams</a></li>
        <li><a href="http://hackforchange.org/challenges/knight-challenge-career-hacking-tools/">Career Hacking Tools</a></li>
        <li><a href="http://hackforchange.org/challenges/talent-ideation-challenge/">Talent Ideation Challenge</a></li>
        <li><a href="http://hackforchange.org/challenges/self-employed-support-networks/">Self Employed Support Networks</a></li>
      </ul>
      <a class="btn" href="http://www.knightfoundation.org/">Learn More</a>
    </div>

  </div>
</section>

<section class="home-news">
<?php
  /* ///////////////////////////////////////////// CHALLENGES & NEWS */
  $show_challenges = get_field('show_challenges');
  if ($show_challenges) {
    include('part-challenges.php');
  }
  include('part-news.php');
?>
</section>

<section class="sponsors">
  <div class="container cf">
  <?php
    /* ///////////////////////////////////////////// SPONSORS */
    $sponsors_heading = get_field('sponsors_heading');
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

    if (!empty($sponsors_heading)) {
      echo '<h2>' . $sponsors_heading . '</h2>';
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
      if (!empty($sponsors2)) {
        echo '</div>';
      }
      echo '</div>';
    }
    if (!empty($sponsors3_logos)) {
      echo '<div class="sponsor-logos">';
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
            echo '<a href="http://' . $link . '">';
          } else {
            echo '<a href="' . $link . '">';
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
	<p><a href="<?php echo get_bloginfo('url').'/partners/'; ?>" class="btn">View all Organizations</a></p>
  </div>
</section>

<?php endwhile; ?>
<?php endif; ?>

<?php get_footer(); ?>
