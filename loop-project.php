<a href="<?php bloginfo('url'); ?>/submit/" class="btn right" style="margin-bottom: 40px;">Submit your project</a>
<ul class="box-list full project-list">
<?php while ( have_posts() ) : the_post();
  $challenge = get_field('challenge_id');
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
      <?php if (($challenge !== '0' && !empty($challenge->post_title)) || !empty($challenge_other)): ?>
          <h5>Challenge</h5>
          <?php if ($challenge !== '0' && !empty($challenge->post_title)): ?>
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

<?php if (function_exists('wp_paginate')): ?>
  <div class="pagination cf">
    <?php wp_paginate(); ?>
  </div>
  <?php else: ?>
  <div class="pagination cf">
    <div class="posts-nav older"><?php next_posts_link('Next <span>&gt;</span>', 0); ?></div>
    <div class="posts-nav newer"><?php previous_posts_link('<span>&lt;</span> Previous', 0); ?></div>
  </div>
<?php endif; ?>
