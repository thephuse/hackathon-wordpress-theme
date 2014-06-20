<?php get_header(); ?>

<article class="post container">
  <?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post(); ?>

    <?php the_content(); ?>

    <div class="share">
      <a href="http://twitter.com/home?status=<?php print(urlencode(the_title())); ?>+<?php print(urlencode(get_permalink())); ?>%20" class="ico ico-tw">Tweet</a>
      <a href="http://www.facebook.com/share.php?u=<?php print(urlencode(get_permalink())); ?>&title=<?php print(urlencode(the_title())); ?>" class="ico ico-fb">FaceBook Share</a>
      <a href="https://plus.google.com/share?url=<?php print(urlencode(get_permalink())); ?>" class="ico ico-gp">GooglePlus+</a>
    </div>

  <?php
  endwhile;
  endif;
  ?>
</article>
<div class="comment-area container">
<?php 
  // If comments are open or we have at least one comment, load up the comment template.
  if ( comments_open() || get_comments_number() ) {
    comments_template();
  }
?>
</div>

<?php get_footer(); ?>
