<?php get_header();  ?> 
<main> 
<section class="pageSide">
    <main class="headerContainer">
  <?php get_sidebar(); ?>
  <?php wp_list_categories_for_post_type('post'); ?>
</main>
</section>
<section class="pageMain">
  
   <?php $args = array( 'post_type' => 'post', 
            // 'meta_key'      => 'start_date',
            // 'orderby'      => 'meta_value',
             'order'       => 'DESC',
            // 'orderby' => array(
            //    'meta_value_num' => 'desc',
            //    'post_date' => 'desc'
            'posts_per_page' => 10 );
        query_posts( $args ); // hijack the main loop

        if ( ! have_posts() ) : ?>

  <?php endif; // end if there are no posts ?>
  <?php // if there are posts, Start the Loop. ?>

  <?php while ( have_posts() ) : the_post(); ?>

      <article id="post-<?php the_ID(); ?>" class="homepagePost" aria-label="article container">


       
          <a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
            <figure class="sideImagePosts" aria-label="Article image">
              <?php the_post_thumbnail('large');?>
            </figure>
             <h1 class="entry-title" aria-label="Article title">
            <?php the_title(); ?>
              </h1>
              <?php
              $author_post = get_field('author');
              if( $author_post ): ?>
                  <h2>By <?php echo esc_html( $author_post->post_title ); ?></h2>
              <?php endif; ?>
          </a>
      



      </article><!-- #post-## -->


  <?php endwhile; // End the loop. Whew. ?>

    
     <?php wp_reset_query();?> 
</section>

 
</main>
<?php get_footer(); ?>




