<div class="sub-bar search-bar">
  <div class="container cf">
    <form role="search" method="get" id="project-searchform" action="<?php bloginfo('home'); ?>/projects">
      <div>
        <input type="text" placeholder="Search for a project or challenge..." name="s" id="s" class="search-input"<?php if(is_search()) { echo ' value="' . get_search_query() . '"'; } ?> />
        <input type="submit" id="searchsubmit" value="Search" />
        <?php
          $args = array(
            'post_type' => 'event',
            'orderby' => 'title',
            'order' => 'ASC',
            'numberposts' => '-1'
          );
          $events = get_posts($args); ?>
        <div class="select-wrapper">
          <select name="project-event">
            <option selected="selected" value="0">Select an Event</option>
            <?php if ( count($events) > 0 ): foreach($events as $p): 
                  $post_slug = $p->post_name;
              if (get_query_var('project-event') == $post_slug) {
                $selected = "selected";
              } else {
                $selected = "";
              }
            ?>
            <option name="<?php echo $post_slug; ?>" value="<?php echo $post_slug; ?>" 
              <?php echo $selected; ?>>
              <?php echo $p->post_title; ?></option>
            <?php endforeach; endif; ?>
          </select>
        </div>
      </div>
    </form>
  </div>
</div>
