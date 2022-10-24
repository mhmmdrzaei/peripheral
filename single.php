  <?php get_header(); ?>
  <?php $today = current_time('Ymd'); ?>
<main>



  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
     <?php wp_list_categories_for_post_type('post'); ?>
  </main>
  </section>

  <section class="pageMain">

       <?php if( have_rows('full_width_ad', 'options' ) ): ?>
        <section class="fullwidthAd" id="ad">
           <?php while( have_rows('full_width_ad', 'options') ): the_row();?>
            
            <?php 
             $datetill = get_sub_field('event_date_start');
             $rand_row = array_rand($rows, 1); // ge
             if( $datetill < $today  ): 
             $image = get_sub_field('full_width_ad_image');
             $imageURL = $image['sizes']['large'];

             $imageMarkup = '<img class="" src="'.$image['sizes']['large'].'" alt="'.$image['alt'].'" />';  
             echo $imageMarkup;
               ?>

            



             <?php endif; ?> 
            

         <?php endwhile; ?>
         </section>
       <?php endif; ?>
     
     <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
     <section class="postMain">
       <figure class="imgSide">
         <?php  the_post_thumbnail('large');?>
       </figure>
       <section class="postcontent">
          <section class="postDetails">
            <section class="titleDate">
               <h3 class="entry-title" aria-label="Article title">
              <?php the_title(); ?>
                </h3>
                <?php the_date(); ?>
            </section>

              <?php the_category(); ?>
              <?php
              $author_post = get_field('author');
              if( $author_post ): ?>
                  <p>By <?php echo esc_html( $author_post->post_title ); ?></p>
              <?php endif; ?>
          </section>
         <section class="postContentText">
           <?php the_content(); ?>
         </section>
       </section>
     </section>
       <div id="nav-below" class="navigation">
       <p class="nav-previous"><?php previous_post_link('%link', '&larr;'); ?></p>
       <p class="nav-next"><?php next_post_link('%link', '&rarr;'); ?></p>
     </div><!-- #nav-below -->
  </section>

</main>
 <?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>