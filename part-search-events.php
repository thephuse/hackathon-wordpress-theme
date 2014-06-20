<section class="home-search-events">
  <?php
    $map_id       = get_field('map');
    $hero_buttons = get_field('hero_buttons');
  ?>
    <?php
      if (!empty($map_id)): ?>
        <div id="map"></div>
        <script type="text/javascript">
          var map = L.mapbox.map('map', '<?php echo $map_id; ?>')
          map.touchZoom.disable();
          map.doubleClickZoom.disable();
          map.scrollWheelZoom.disable();
          // disable tap handler, if present.
          if (map.tap) map.tap.disable();
        </script>
    <?php endif; ?>
    <div class="search-box">
      <form class="container" role="search" action="<?php bloginfo('url'); ?>/events" method="get">
        <input type="search" id="s" placeholder="Search for an event..." name="s" autocomplete="off">
        <input type="hidden" name="event-type" value="0">
        <input type="submit" value="Search">
      </form>
    </div><!-- /search-box -->
    <?php
      if (!empty($map_id)): ?>
      <div class="map-overlay"></div>
      <a href="#" class="trigger-map small">View Map</a>
    <?php endif; ?>
</section>
