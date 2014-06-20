<?php
/*
Template Name: FAQ
*/
get_header();
?>

<article class="special-page faq container">
  <?php if ( have_posts() ) : ?>
  <?php while ( have_posts() ) : the_post();
    $faq = get_field('faq');
  ?>

  <h2><?php the_title(); ?></h2>
  <?php the_content(); ?>

  <?php if (!empty($faq)): ?>
  <div class="columns">
  <?php foreach($faq as $item): ?>
    <div class="faq-item accordion">
      <h3 class="accordion-toggle"><?php echo $item['question']; ?></h3>
      <div class="faq-answer accordion-content"><?php echo $item['answer']; ?></div>
    </div>
  <?php endforeach; ?>
  </div>
  <?php endif; ?>

  <?php
  endwhile;
  endif;
  ?>
</article>

<?php get_footer(); ?>
