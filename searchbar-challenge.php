<div class="sub-bar search-bar">
  <div class="container cf">
    <form role="search" method="get" id="challenge-searchform" action="<?php bloginfo('home'); ?>/challenges">
      <div>
        <input type="text" placeholder="Search challenges..." name="s" id="s" class="search-input"<?php if(is_search()) { echo ' value="' . get_search_query() . '"'; } ?> />
        <input type="submit" id="searchsubmit" value="Search" />
        <?php
        function get_terms_dropdown($taxonomies, $args){
          $myterms = get_terms($taxonomies, $args);
          $optionname = "challenge-category";
          $emptyvalue = "0";
          $output ="<div class='select-wrapper'><select name='".$optionname."'><option selected='".$selected."' value='".$emptyvalue."'>Select a category</option>'";

          foreach($myterms as $term){
            $term_taxonomy=$term->challenge-category;
            $term_slug=$term->slug;
            $term_name =$term->name;
            $link = $term_slug;
            if (is_tax('challenge-category',$term_slug)) {
              $selected = "selected";
            } else {
              $selected = "";
            }
            $output .="<option name='".$link."' value='".$link."' " . $selected . ">".$term_name."</option>";
          }
          $output .="</select></div>";
        return $output;
        }

        $taxonomies = array('challenge-category');
        $args = array('order'=>'ASC','hide_empty'=>true);
        echo get_terms_dropdown($taxonomies, $args);

        ?>
      </div>
    </form>
  </div>
</div>
