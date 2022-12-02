  <?php get_header(); ?>
<main>



  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
     <?php wp_list_categories_for_post_type('post'); ?>
  </main>
  </section>

  <section class="pageMain">

      <section class="fullwidthAd" id="ad">

        <?php $cars = get_field( 'full_width_ad','options' ); 

         if( is_array( $cars )) { ?>

           <?php $car = array_rand( $cars );  ?>
           <figure>
             <a href="<?php echo$cars[$car]['links_to_full'] ?>" target="_blank"><img src="<?php echo $cars[$car]['full_width_ad_image'];?>" alt="advertisement"></a>
           </figure>

         <?php } ?>

      </section>
     
     <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
     <section class="postMain">
      <section class="imgSide">
        <figure class="imgSideInner">
          <?php  the_post_thumbnail('large');?>
        </figure>
        <section class="page_side_ad " id="ad">

          <?php $cars = get_field( 'page_side_ad','options' ); 
           if( is_array( $cars )) { ?>
             <?php $car = array_rand( $cars ); ?>
              <figure>
               <a href="<?php echo$cars[$car]['links_to_side'] ?>" target="_blank"><img src="<?php echo $cars[$car]['page_side_ad_image'];?>" alt="advertisement"></a>
              </figure>
            
           <?php } ?>

        </section>

      </section>

       
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

          <section class="fullwidthAd" id="ad">

            <?php $cars = get_field( 'half_width_site_banner_ad','options' ); 
             $datetill = get_sub_field('date_running_till');
             $today = current_time('Ymd');
             if( is_array( $cars ) && ($datetill < $today)) { ?>
               <?php $car = array_rand( $cars ); ?>
               <figure>
                <a href="<?php echo$cars[$car]['links_to_half'] ?>" target="_blank"><img src="<?php echo $cars[$car]['half_width_ad_image'];?>" alt="advertisement"></a>
               </figure>
             <?php } ?>

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