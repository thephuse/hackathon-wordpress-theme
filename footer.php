</main>
<?php if (!is_404() && !is_page_template('template-report.php')): ?>
<footer class="cf site-footer">
  <div class="container">
    <div class="left third">
      <p>&copy;<?php the_date('Y'); ?> <?php bloginfo('name'); ?></p>
    </div>
    <div class="middle third">
      <?php include('share.php'); ?>
    </div>
    <?php $contactemail = mytheme_option('contact-email'); ?>
    <div class="right third">
      <?php if ($contactemail): ?>
      <p><a href="mailto:<?php echo $contactemail; ?>"><img src="<?php bloginfo('template_url'); ?>/images/email.png"> <?php echo $contactemail; ?></a></p>
      <?php endif; ?>
    </div>
    <?php
      wp_nav_menu( array(
        'theme_location' => 'footer-menu',
        'container' => 'nav',
        'container_class' => 'footer-menu',
        'items_wrap' => '%3$s',
        'menu_id' => '',
        'fallback_cb' => ''
      ));
    ?>
  </div>
</footer>
<?php endif; ?>

<script>
    var _gaq=[['_setAccount','UA-34745862-1'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>
<?php wp_footer(); ?>

</body>
</html>
