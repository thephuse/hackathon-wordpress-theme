<?php get_header(); ?>

<?php include('searchbar-data.php'); ?>

<section>
  <div class="container cf">
    <a href="<?php bloginfo('url'); ?>/submit-dataset/" class="btn right data-button">Submit your dataset</a>
    <h2 class="data-title">Browse by Category</h2>
    <ul class="data-grid">
	  <?php $categories = get_terms(array('data-category'), array('order' => 'ASC', 'hide_empty' => true)); ?>
		<?php foreach ($categories as $category):?>
	    <li>
	      <a href="<?php echo get_bloginfo('url') . '/data-category/' . $category->slug; ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/icons/jess3_intel_ndoch_microsite_<?php echo str_replace('-', '', $category->slug); ?>.svg"></a>
	      <h3><a href="<?php echo get_bloginfo('url') . '/data-category/' . $category->slug; ?>"><?php echo str_replace('/', ' / ', $category->name); ?></a></h3>
	    </li>
	  <?php endforeach; ?>
		</ul>
  </div><!-- /container -->
</section>

<section>
  <div class="container cf">
    <?php if ( have_posts() ) { include('loop-data.php'); } ?>
  </div><!-- /container -->
</section>
<?php get_footer(); ?>
