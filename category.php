  <?php get_header(); ?>
<main>
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
  </main>
  </section>
  <section class="pageMain">
    <?php if ( have_posts() ) : ?>

        <h1>Category Archives: <?php single_cat_title(); ?></h1><br>
        <?php
          $category_description = category_description();
          if ( ! empty( $category_description ) )
            echo '' . $category_description . '';
           get_template_part( 'loop', 'category' );
          ?>

    <?php endif; ?>
  </section>
</main>

<?php get_footer(); ?>

