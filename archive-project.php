<?php get_header(); ?>

<?php include('searchbar-project.php'); ?>

<section>
  <div class="container cf">
    <?php if ( have_posts() ): include('loop-project.php'); else: ?>
    <p class="empty-section">Nothing yet! Check back soon.</p>
    <p class="text-center"><a href="<?php bloginfo('url'); ?>/submit/" class="btn">Submit a project</a></p>
		<?php endif; ?>
  </div><!-- /container -->
</section>
<?php get_footer(); ?>
