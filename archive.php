<?php get_header(); ?>
<main> 
  <section class="pageSide">
      <main class="headerContainer">
        <?php get_sidebar(); ?>
      </main>
  </section>
  <section class="pageMain">
        <?php if ( have_posts() ) the_post(); ?>

        <h1>
          <?php if ( is_day() ) : ?>
            Daily Archives: <?php the_date(); ?>
          <?php elseif ( is_month() ) : ?>
            Monthly Archives: <?php the_date('F Y'); ?>
          <?php elseif ( is_year() ) : ?>
            Yearly Archives: <?php the_date('Y'); ?>
          <?php else : ?>
            Blog Archives
          <?php endif; ?>
        </h1>

        <?php
        /* Since we called the_post() above, we need to
         * rewind the loop back to the beginning that way
         * we can run the loop properly, in full.
         */
        rewind_posts();

        /* Run the loop for the archives page to output the posts.
         * If you want to overload this in a child theme then include a file
         * called loop-archives.php and that will be used instead.
         */
        get_template_part( 'loop', 'archive' );
        ?>

  </section>
</main>


<?php get_footer(); ?>