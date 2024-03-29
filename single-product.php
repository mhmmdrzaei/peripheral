  <?php get_header(); ?>

<main>
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
  </main>
  </section>
  <section class="pageMain">
     <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
     <section class="postMain">
      <nav class="shopMenu">
        <?php wp_nav_menu( array(
          'container' => false,
          'theme_location' => 'commerce'
        )); ?>
      </nav>

       <section class="productContent">
        <section class="productImages">

        </section>
         <section class="productContentDetails">
          <h2 class="entry-title"><?php the_title(); ?></h2>

          <section class="productDesc">
            <?php the_content(); ?>
          </section>
         </section>
       </section>
     </section>
</main>
 <?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>