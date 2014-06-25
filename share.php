<?php
  $hashtag = mytheme_option('hashtag');
  $twitter = mytheme_option('twitter');
  $facebook = mytheme_option('facebook');
  $flickr = mytheme_option('flickr');
?>
<div class="share">
  <?php if ($twitter): ?>
  	<a href="<?php echo $twitter; ?>" class="tweet-link"><i class="ico ico-twbird">Twitter</i> <?php echo $hashtag; ?></a>
	<?php endif; ?>
  <?php if ($facebook): ?>
  <a href="<?php echo $facebook; ?>" class="ico ico-fb">FaceBook</a>
	<?php endif; ?>
  <?php if ($flickr): ?>  
  <a href="<?php echo $flickr; ?>" class="ico ico-flickr">Flickr</a>
	<?php endif; ?>
</div>
