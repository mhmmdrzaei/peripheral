<?php get_header();  ?> 

<main> 
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
    <?php wp_list_categories_for_post_type('events'); ?>
  </main>
  </section>

<section class="pageMain">
  
   <?php $args = array( 'post_type' => 'events', 
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

      <article id="post-<?php the_ID(); ?>" class="homepagePost" aria-label="article container">


       
          <a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
            <figure class="sideImagePosts" aria-label="event image">
              <?php the_post_thumbnail('large');?>
            </figure>
            <section class="eventdetails">
               <h2 class="entry-title" aria-label="Event title"><?php the_title(); ?></h2>
              <section class="dateEventPage">
                <?php 
                    $startDate = get_field('event_date_start');
                    $endDate = get_field('event_date_end');
                    if( !empty( $endDate ) ): ?>
                       <?php the_field('event_date_start');?> - <?php the_field('event_date_end'); ?><br>
                    <?php else: ; ?>
                     <?php the_field('event_date_start');?></br>
                    <?php endif; ?>
              </section>
              <section class="eventCat">
                <?php the_category(); ?>
              </section>
            </section>

          </a>
      

      </article><!-- #post-## -->


  <?php endwhile; // End the loop. Whew. ?>

    
     <?php wp_reset_query();?> 
</section>

 
</main>
<?php get_footer(); ?>




