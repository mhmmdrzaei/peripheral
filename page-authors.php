
<?php get_header();  ?> 
<main> 
<section class="pageSide">
    <main class="headerContainer">
  <?php get_sidebar(); ?>

</main>
</section>
<section class="pageMain">
  
   <?php $args = array( 'post_type' => 'authors', 
            // 'meta_key'      => 'start_date',
            // 'orderby'      => 'meta_value',
             'order'       => 'DESC',
            // 'orderby' => array(
            //    'meta_value_num' => 'desc',
            //    'post_date' => 'desc'
            'posts_per_page' => -1 );
        query_posts( $args ); // hijack the main loop

        if ( ! have_posts() ) : ?>

  <?php endif; // end if there are no posts ?>
  <?php // if there are posts, Start the Loop. ?>

  <?php while ( have_posts() ) : the_post(); ?>
    <section class="contributors">
      <h2>Contributors:</h2>
    </section>
    <section class="contributorsContainer">
                <a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
               <h3 class="entry-title" aria-label="Event title"><?php the_title(); ?></h3>
            
          </a>    
    </section>


       



  <?php endwhile; // End the loop. Whew. ?>

    
     <?php wp_reset_query();?> 
</section>

 
</main>
<?php get_footer(); ?>




