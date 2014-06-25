<?php
/*
Template Name: Submit Project
*/

get_header(); ?>

<?php



$MAX_TEAM_MEMBERS = 25;
$result = '';
$thank_you = '';

if ('POST' == $_SERVER['REQUEST_METHOD'] && 
    !empty( $_POST['action'] ) && 
    $_POST['action'] == 'submit_project') {


    $post_data = array();
    foreach ($_POST as $key => $value) {
      $post_data[$key] = wp_strip_all_tags($value);
    }

    $team_members = false;
    for ($n = 0; $n < $MAX_TEAM_MEMBERS; $n++) {
      if (!empty($post_data['name_'.$n]) && !empty($post_data['email_'.$n])) {
        $team_members = true;         
      }
    }

    // Do the form validation
    if (empty($post_data['project_name'])) {
      $result = 'Please enter a name for your project.';
    }
    elseif (empty($post_data['event_id'])) {
      $result = 'Please select an event.';
    }
    elseif (empty($post_data['description'])) {
      $result = 'Please enter a description of your project.';
    }
    elseif (!$team_members) {
      $result = 'Please enter the name and email of at least one team member.';
    }
    else {
      $project_name = $post_data['project_name'];
      $challenge_name = $post_data['challenge_name'];
      $challenge_id = $post_data['challenge_id'];
      $event_id = $post_data['event_id'];
      $description = $post_data['description'];
      $new_post = array(
        'post_title'   => $project_name,
        'post_name'    => sanitize_title_with_dashes($project_name,'','save'),
        'post_content' => $description,
        'post_status'  => 'draft',
        'post_author'  => 1,
        'post_type'    => 'project'
      );

      // Save the new post
      $post_id = wp_insert_post($new_post, true);

      if (is_wp_error($post_id)) {
        $contactemail = mytheme_option('contact-email');
        $result = 'Uh oh, looks like something went wrong on our end. Please email your project to <a href="mailto:'.$contactemail.'">'.$contactemail.'</a> and we will enter it for you!';
      }
      else {
        // Add the rest of the fields
        add_post_meta($post_id, 'challenge_name', $challenge_name);
        add_post_meta($post_id, 'challenge_id', $challenge_id);
        add_post_meta($post_id, 'event_id', $event_id);
        add_post_meta($post_id, 'link_demo', $post_data['link_demo']);
        add_post_meta($post_id, 'link_repo', $post_data['link_repo']);
        add_post_meta($post_id, 'link_video', $post_data['link_video']);

        // Foreach team member with a name, add them to the project
        update_field('team_members', $MAX_TEAM_MEMBERS, $post_id);
        for ($n = 0; $n < $MAX_TEAM_MEMBERS; $n++) {
          if (!empty($post_data['name_'.$n])) {
            update_field('team_members_'.$n.'_name', $post_data['name_'.$n], $post_id);
            update_field('team_members_'.$n.'_email', $post_data['email_'.$n], $post_id);
            update_field('team_members_'.$n.'_role', $post_data['role_'.$n], $post_id);
            update_field('team_members_'.$n.'_website', $post_data['website_'.$n], $post_id);           
          }
        }

        $thank_you = get_field('thank_you_message');
      }
    }
}

?>


<div class="container cf special-page">
  <?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>
  <div class="main-col center cf">

    <?php if (empty($thank_you)): ?>
    <?php the_content(); ?>
    <?php else: ?>
    <?php the_field('post_signup_paragraph'); ?>
    <?php endif; ?>

    <?php if (!empty($thank_you)): ?>
    <div class="alert alert-success">
      <?php echo $thank_you; ?>
    </div>
    <p class="text-center">
      <a href="<?php bloginfo('url'); ?>" class="btn">Go Back to the Home Page</a>
      <a href="https://publicgood.me/#/ndoch-signup" class="btn">Get involved on PublicGood.me</a>
    </p>
    <?php else: ?>
    <form id="submit_project" name="submit_project" method="post" action="<?php the_permalink(); ?>">
      <?php if (!empty($result)): ?>
      <div class="alert alert-error">
        <?php echo $result; ?>
      </div>
      <?php endif; ?>
      <div class="form-row">
        <label for="project_name">Project Name *</label>
        <input type="text" name="project_name" value="<?php echo $post_data['project_name']; ?>" required />
      </div>

      <div class="form-row">
        <div class="grid grid-half">
          <label for="challenge_id" class="with-subtitle">Challenge</label>
          <div class="label-subtitle">Select the challenge your project addresses</div>
          <?php
            $args = array(
              'post_type' => 'challenge',
              'orderby' => 'title',
              'order' => 'ASC',
              'numberposts' => '-1'
            );
            $challenges = get_posts($args); ?>
          <select name="challenge_id">
              <option value="0">Select a challenge...</option>
            <?php if ( count($challenges) > 0 ): foreach($challenges as $post): setup_postdata($post); ?>
              <option value="<?php the_id(); ?>" <?php if (get_the_id() == $post_data['challenge_id']) echo 'selected'; ?>><?php the_title(); ?></option>
            <?php endforeach; endif; wp_reset_query(); ?>
          </select>
        </div>
        <div class="grid grid-half">
          <label for="challenge_name" class="with-subtitle">Other Challenge</label>
          <div class="label-subtitle">If you are addressing a different challenge, describe it here</div>
          <input type="text" name="challenge_name" value="<?php echo $post_data['challenge_name']; ?>" />
        </div>
      </div>

      <div class="form-row">
        <label for="event_id">Event *</label>
        <?php
          $args = array(
            'post_type' => 'event',
            'orderby' => 'title',
            'order' => 'ASC',
            'numberposts' => '-1'
          );
          $events = get_posts($args); ?>
        <select name="event_id">
          <?php if ( count($events) > 0 ): foreach($events as $post): setup_postdata($post); ?>
            <option value="<?php the_id(); ?>" <?php if (get_the_id() == $post_data['event_id']) echo 'selected'; ?>><?php the_title(); ?></option>
          <?php endforeach; endif; wp_reset_query(); ?>
        </select>
      </div>
      

      <div class="form-row">
        <label for="description">Description *</label>
        <textarea name="description" required><?php echo $post_data['description']; ?></textarea>
      </div>

      <div class="form-row">
        <div class="grid grid-half">
          <label for="link_demo">Link to Demo Site</label>
          <input type="text" name="link_demo" value="<?php echo $post_data['link_demo']; ?>" />
        </div>
        <div class="grid grid-half">
          <label for="link_repo">Link to Code Repository</label>
          <input type="text" name="link_repo" value="<?php echo $post_data['link_repo']; ?>" />
        </div>
      </div>
      <div class="form-row">
        <label for="link_video">Link to Video (YouTube or Vimeo)</label>
        <input type="text" name="link_video" value="<?php echo $post_data['link_video']; ?>" />
      </div>

      <fieldset>
      <legend>Team Members *<a href="#" class="btn" id="add-team-member" title="Add Team Member">+</a></legend>
      <div class="label-subtitle">Each Team Member's photo will be automatically pulled from <a href="http://gravatar.com" target="_blank">Gravatar</a>.</div>
        <?php for ($n = 0; $n < $MAX_TEAM_MEMBERS; $n++): ?>
        <div class="team-member-form-row" style="display: <?php 
            echo ($n == 0 || strlen($post_data['name_'.$n]) > 0) ? 'block' : 'none'; ?>">
          <img src="<?php echo 'http://www.gravatar.com/avatar/' . 
            md5(strtolower(trim($post_data['email_'.$n]))) . '?s=100&d=mm'; ?>" class="photo"/>
          <div class="content">
            <a href="#" class="close">&times;</a>
            <div class="form-row">
              <div class="grid grid-half">
                <label for="name_<?php echo $n; ?>">Name *</label>
                <input type="text" name="name_<?php echo $n; ?>" value="<?php echo $post_data['name_'.$n]; ?>" 
                  class="required" />
              </div>
              <div class="grid grid-half">
                <label for="email_<?php echo $n; ?>">Email</label>
                <input type="text" class="email" name="email_<?php echo $n; ?>" value="<?php echo $post_data['email_'.$n]; ?>" />
              </div>
            </div>
            <div class="form-row">
              <div class="grid grid-half">
                <label for="role_<?php echo $n; ?>">Role</label>
                <input type="text" name="role_<?php echo $n; ?>" value="<?php echo $post_data['role_'.$n]; ?>" />
              </div>
              <div class="grid grid-half">
                <label for="website_<?php echo $n; ?>">Website/URL</label>
                <input type="text" name="website_<?php echo $n; ?>" value="<?php echo $post_data['website_'.$n]; ?>" />
              </div>
            </div>
          </div>
        </div>
        <?php endfor; ?>
        <div id="no-team-members">
          <p>No one?! Really???</p>
          <p>At least add yourself!</p>
        </div>
      </fieldset>

      <input type="hidden" name="action" value="submit_project" />
      <?php wp_nonce_field( 'submit-project' ); ?>

      <?php the_field('submit_note'); ?>
      
      <div class="form-row submit">
        <input type="submit" value="Submit Project" class="btn" />
      </div>

    </form>
    <?php endif; ?>
  </div><!-- /main-col -->

  <?php endwhile; ?>
  <?php endif; ?>  

</div>

<?php get_footer(); ?>
