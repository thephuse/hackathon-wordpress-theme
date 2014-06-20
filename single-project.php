<?php get_header(); ?>

<div class="container cf">
  <div class="main-col">
  <?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
  <?php 
    $eventID = get_field('event_id');
    $eventName = get_post($eventID);
    $linkRepo = trim(get_field('link_repo'));
    $linkDemo = trim(get_field('link_demo'));
    $challengeID = get_field('challenge_id');
    $challengeName = get_post($challengeID);
    $challengeOther = trim(get_field('challenge_name'));
    $videoLink = trim(get_field('link_video'));

    //check that links include http:// to avoid 404s
    $linkRepoURL = substr($linkRepo, 0, 4);
    $linkDemoURL = substr($linkDemo, 0, 4);
    $videoLinkURL = substr($videoLink, 0, 4);
  ?>

  <div class="post">
    <?php if ( has_post_thumbnail() ) {
        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'excerpt-thumb' );
        echo '<img src="' . $thumb['0'] . '" alt="" />';
    } ?>

    <?php 
    if(!empty($videoLink)) { 
      if($videoLinkURL !== 'http'){
        echo do_shortcode('[fve]http://'.$videoLink.'[/fve]'); 
      } else {
        echo do_shortcode('[fve]'.$videoLink.'[/fve]'); 
      } 
    }
    ?>
    
    <?php echo make_clickable_links(get_the_content()); ?>
  </div>
  </div><!-- /main-col -->

  <div class="sidebar">
    <div class="widget">

      <?php 
        if(!empty($linkDemo)) {
        if($linkDemoURL !== 'http'){ ?>
        <a class="btn" target="_blank" href="http://<?php echo $linkDemo; ?>">Demo Site</a>
      <?php } else { ?>
        <a class="btn" target="_blank" href="<?php echo $linkDemo; ?>">Demo Site</a>
      <?php 
          } 
        }
      ?>

      <?php 
        if(!empty($linkRepo)) {
        if($linkRepoURL !== 'http'){ ?>
        <a class="btn accent" target="_blank" href="http://<?php echo $linkRepo; ?>">Code Repository</a>
      <?php } else { ?>
        <a class="btn accent" target="_blank" href="<?php echo $linkRepo; ?>">Code Repository</a>
      <?php 
          } 
        }
      ?>

      <div class="event-info">
        <?php if(!empty($challengeID) || !empty($challengeName)) { ?>
          <h3>Challenge</h3>
          <?php if(!empty($challengeID)) { ?>
            <p><?php echo $challengeName->post_title; ?></p>
          <?php } else { ?>
            <p><?php echo $challengeOther; ?></p>
          <?php } ?>
        <?php } ?>
        
        <?php if(!empty($eventName)) { ?>
          <h3>Event</h3>
          <p><?php echo $eventName->post_title; ?></p>
        <?php } ?>    
      </div>

      <?php 
      if( get_field('team_members') ){ ?>
      <div class="team-members">
        <h3>Team Members</h3>
          <?php while( has_sub_field('team_members') ){ 
            $name = get_sub_field('name');
            $website = get_sub_field('website');
            $role = get_sub_field('role');
            $email = get_sub_field('email');
            $hash = md5($email); 

            //check for http on website link
            $websiteURL = substr($website, 0, 4);

            if(empty($email) && empty($role) && empty($website) && empty($name)){
              continue;
            }
          ?>

          <div class="team-member">
            <div class="member-photo"><img src="http://www.gravatar.com/avatar/<?php echo $hash; ?>" /></div>
            <?php if(!empty($name)) { ?><p class="name"><?php echo $name; ?></p><?php } ?>
            <?php if(!empty($role)) { ?><p><?php echo $role; ?></p><?php } ?>
            <?php if(!empty($website)) { ?>
            <p>
              <?php if($websiteURL !== 'http'){ ?>
                <a href="http://<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a>
              <?php } else { ?>
                <a href="<?php echo $website; ?>" target="_blank"><?php echo $website; ?></a>
              <?php } ?>
            </p>
            <?php } ?>
          </div>
        
        <?php  
          }
        }
        ?>
      </div>
    </div>

   
  </div>

  <?php endwhile; ?>

  <?php
  else : ?>
  <div class="main-col">
    <div class="post">
      <p>The requested page is not here. Try using the menu or search to find what you are looking for.</p>
    </div>
  </div><!-- /main-col -->

  <?php endif; ?>

</div>

<?php get_footer(); ?>
