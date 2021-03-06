  <?php get_header(); ?>
<main>
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
     <?php wp_list_categories_for_post_type('post'); ?>
  </main>
  </section>

  <section class="pageMain">
     <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
     <section class="postMain">
       <figure>
         <?php  the_post_thumbnail('large');?>
       </figure>
       <section class="postcontent">
         <section class="postContentDetails">
          <h3 class="entry-title"><?php the_title(); ?></h3>
           <?php the_date(); ?>
            <?php the_category(); ?>
            <?php
            $author_post = get_field('author');
            if( $author_post ): ?>

                By <a href="<?php echo the_permalink( $author_post->ID ); ?>"><?php echo esc_html( $author_post->post_title ); ?></a>
                
            <?php endif; ?>

         </section>
         <section class="postContentText">
           <?php the_content(); ?>
         </section>
       </section>
     </section>
  </section>
    <div id="nav-below" class="navigation">
    <p class="nav-previous"><?php previous_post_link('%link', '&larr;'); ?></p>
    <p class="nav-next"><?php next_post_link('%link', '&rarr;'); ?></p>
  </div><!-- #nav-below -->
</main>
 <?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>