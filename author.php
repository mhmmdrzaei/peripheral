<?php get_header(); ?>
<main>
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
   
  </main>
  </section>
  <section class="pageMain">
   <?php
        /* Queue the first post, that way we know who
         * the author is when we try to get their name,
         * URL, description, avatar, etc.
         */
        if ( have_posts() )
          the_post();
      ?>

      <h1>Author Archives:
        <a class="name" href="<?php echo get_author_posts_url( get_the_author_meta('ID') ); ?>">
          <?php the_author(); ?>
        </a>
      </h1>

      <?php
        // If a user has filled out their description, show a bio on their entries.
        if ( get_the_author_meta('description') ) : ?>

          <h2>About <?php the_author(); ?> </h2>
          <?php echo get_avatar( get_the_author_meta('user_email'), 60); ?>
          <?php the_author_meta('description'); ?>

        <?php endif; ?>

        <?php
          rewind_posts();
          get_template_part('loop', 'author');
        ?>
    </section>

</main>

<?php get_footer(); ?>