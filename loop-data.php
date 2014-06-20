<ul class="data-list cf">
<?php while ( have_posts() ) : the_post();
  $resource = get_field('resource_url');
  $resourceCheck = substr($resource, 0, 4);
  $file = get_field('file');
  $logo = get_field('logo');
  $link = get_field('logo_link');
  $cats = wp_get_post_terms( $post->ID, 'data-category', array() );
  $tags = wp_get_post_terms( $post->ID, 'data-tag', array() );
?>

<li>
  <div class="data-logo">
  <?php
      if (!empty($logo)) {
        $src = $logo['sizes']['logo'];
        if (!empty($src)) {
          echo '<img src="' . $src . '" alt="" />';
        } 
      } elseif (!empty($link)) {
        echo '<img src="' . $link . '" alt="" />';
      }
      ?>
  </div>
  <div class="data-content">
    <h3>
      <?php
        if (!empty($file)) {
          $href = $file['url'];
          echo '<a href="' . $resource . '" target="_blank">' . get_the_title() . '</a>';
        }
        if(!empty($resource)) {
          $href = $resource;
          $hrefCheck = substr($href, 0, 4);
          if($hrefCheck !== 'http'){
            echo '<a href="http://' . $resource . '" target="_blank">' . get_the_title() . '</a>';
          } else {
            echo '<a href="' . $resource . '" target="_blank">' . get_the_title() . '</a>';
          }
        }
      ?>
    </h3>
    <?php custom_excerpt(20); ?>
    <p class="meta"><a href="<?php echo $resource; ?>"><?php echo $resource; ?></a></p>
  </div>
  <div class="data-extra">
    <?php if (count($cats) > 0): foreach ($cats as $term):
          echo '<a href="' . get_bloginfo('url') . '/data-category/' . $term->slug . '">';
          echo '<img src="'.get_template_directory_uri().'/images/icons/jess3_intel_ndoch_microsite_'.str_replace('-', '', $term->slug).'.svg">';
          echo '</a> ';
       endforeach; endif; ?>

    <?php if (count($tags) > 0): 
    echo '<div class="data-tags"><strong>Tags: </strong>'; $tag_output = array();
      foreach ($tags as $term): 
          $tag_output[] = '<a href="' . get_bloginfo('url') . '/data-tag/' 
            . $term->slug . '">' . $term->name . '</a>';
       endforeach; echo implode(', ', $tag_output); echo '</div>'; endif; ?>
  </div>
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
