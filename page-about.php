  <?php get_header();  ?>

<main>

  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
  </main>
  </section>
  <section class="pageMain">
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

      <h2><?php the_title(); ?></h2>
      <?php the_content(); ?>

    <?php endwhile; // end the loop?>
  </section>
</main>

<?php get_footer(); ?>