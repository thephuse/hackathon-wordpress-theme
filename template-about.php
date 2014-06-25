<?php
/*
Template Name: About
*/
get_header();
?>

<article class="special-page about container">
  <?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post();
    $section2_image = get_field('section2_image');
    $section2_content = get_field('section2_content');
  ?>

    <div class="cf">
      <div class="left content sixty">
        <?php the_content(); ?>
      </div>
      <div class="about-photos right forty">
        <img src="<?php bloginfo('template_url'); ?>/images/about/about-1.jpg" alt="">
        <img src="<?php bloginfo('template_url'); ?>/images/about/about-2.jpg" alt="">
        <img src="<?php bloginfo('template_url'); ?>/images/about/about-3.jpg" alt="">
        <?php $flickr = mytheme_option('flickr'); ?>
        <?php if ($flickr): ?>
          <a href="<?php echo $flickr; ?>" class="btn">View more photos</a>
        <?php endif; ?>
      </div>
    </div>
    <?php if (!empty($section2_content) || !empty($section2_image)): ?>
    <div class="cf">
      <div class="right content sixty">
        <?php
          if (!empty($section2_content)) {
            echo $section2_content;
          }
        ?>
      </div>
      <div class="left forty">
        <?php
          if (!empty($section2_image)) {
            echo '<img src="' . $section2_image . '" alt="">';
          }
        ?>
      </div>
    </div>
    <?php endif; ?>
  <?php
  endwhile;
  endif;
  ?>
</article>

<?php get_footer(); ?>
