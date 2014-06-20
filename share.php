<?php
  $hashtag = get_field('hashtag',getIdViaSlug('home'));
?>
<div class="share">
  <a href="http://www.twitter.com/civichackingday" class="tweet-link"><i class="ico ico-twbird">Twitter</i> <?php echo $hashtag; ?></a>
  <a href="http://fb.me/hackforchange" class="ico ico-fb">FaceBook</a>
  <a href="https://www.flickr.com/groups/hackforchange/" class="ico ico-flickr">Flickr</a>
</div>
