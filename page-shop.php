  <?php get_header();  ?>
<main>

  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>

  </main>
  </section>
  
  <section class="pageMain">
    <nav class="shopMenu">
      <?php wp_nav_menu( array(
        'container' => false,
        'theme_location' => 'commerce'
      )); ?>
    </nav>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <?php the_content(); ?>

    <?php endwhile; // end the loop?>
  </section>
</main>

<?php get_footer(); ?>