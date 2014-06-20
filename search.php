<?php get_header(); ?>

  <?php
    global $query_string;
    $searching_events = strpos($query_string, 'event-type=');
    $searching_projects = strpos($query_string, 'project-event=');
    $searching_data = strpos($query_string, 'data-category=');
    $searching_challenge = strpos($query_string, 'challenge-category=');
    ?>

    <?php
    if ($searching_events !== false) { ?>
      <?php include('searchbar-event.php'); ?>
      <section>
        <div class="container cf">
          <h3>Events containing: <em><?php the_search_query(); ?></em></h3>
          <?php
          if ( have_posts() ) :
            include('loop-event.php');
          else: ?>
            <p>Sorry, no results found for <strong><?php echo get_search_query(); ?></strong>.</p>
            <p>Questions? Check out our <a href="<?php bloginfo('url'); ?>/about/faq/">FAQ</a> or feel free to <a href="<?php bloginfo('url'); ?>/contact/">get in touch</a>!</p>
          <?php endif; ?>
        </div>
      </section>


    <?php } elseif ( $searching_projects !== false ) { ?>
      <?php include('searchbar-project.php'); ?>
      <section>
        <div class="container cf">
          <h3>Projects containing: <em><?php the_search_query(); ?></em></h3>
          <?php
          $found_projects = false;
          $query_event = get_page_by_path(get_query_var('project-event'), OBJECT, 'event');
          $search_q = get_search_query();
          if ( have_posts() )
            include('loop-project.php');
          if (!have_posts() || !$found_projects): ?>
            <p>Sorry, no results found <?php if (!empty($search_q)) echo 'for <strong>'.$search_q.'</strong>'; ?> for the event <strong><?php echo $query_event->post_title; ?></strong>.</p>
          <?php endif; ?>
        </div>
      </section>

    <?php } elseif ( $searching_data !== false ) { ?>
      <?php include('searchbar-data.php'); ?>
      <section>
        <div class="container cf">
          <h3>Datasets containing: <em><?php the_search_query(); ?></em></h3>
          <?php
          if ( have_posts() ) :
            include('loop-data.php');
          else:
            echo '<p>Sorry, no results found for <strong>' . get_search_query() . '</strong></p>';
          endif; ?>
        </div>
      </section>

    <?php } elseif ( $searching_challenge !== false ) { ?>
      <?php include('searchbar-challenge.php'); ?>
      <section>
        <div class="container cf">
          <h3>Challenges containing: <em><?php the_search_query(); ?></em></h3>
          <?php
          if ( have_posts() ) :
            include('loop-challenge.php');
          else:
            echo '<p>Sorry, no results found for <strong>' . get_search_query() . '</strong></p>';
          endif; ?>
        </div>
      </section>

    <?php } else { ?>

    <div class="container cf">
      <div class="main-col">
        <h3>Search Results For: <em><?php the_search_query(); ?></em></h3>
        <?php
        if(have_posts()) :
        while(have_posts()) : the_post(); ?>
          <div class="post">
          <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
          <?php if ( has_post_thumbnail() ) {
              $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'excerpt-thumb' );
              echo '<img src="' . $thumb['0'] . '" alt="" />';
          } ?>
          <?php the_excerpt(); ?>
          <p class="meta">
            <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
          </p>
        </div>
        <?php endwhile; ?>

        <?php if(function_exists('wp_paginate')) { ?>
          <div class="pagination cf">
            <?php wp_paginate(); ?>
          </div>
          <?php } else { ?>
          <div class="pagination cf">
            <div class="posts-nav older"><?php next_posts_link('Older <span>&gt;</span>', 0); ?></div>
            <div class="posts-nav newer"><?php previous_posts_link('<span>&lt;</span> Newer', 0); ?></div>
          </div>
        <?php } ?>

      <?php
      else :
        echo '<p>Sorry, no results found for <strong>' . get_search_query() . '</strong></p>';
      endif;
      ?>
    </div><!-- /main-col -->
    <div class="sidebar">
      <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('blog-sidebar') ) {} ?>
    </div>
  </div><!-- /container -->
  <?php } ?>

<?php get_footer(); ?>
