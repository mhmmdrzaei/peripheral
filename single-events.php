  <?php get_header(); ?>
<main>
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
     <?php wp_list_categories_for_post_type('events'); ?>
  </main>
  </section>
  <section class="pageMain postsTemplate">
     <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
     <section class="postMain">
       <section class="postMainSide">
         <?php  the_post_thumbnail('large');?>
         <section class="postMainDetails">
           <h2 class="entry-title"><?php the_title(); ?></h2>
           <section class="postMaindateTime">
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
             <p><?php the_field('event_time'); ?></p>
              <section class="eventinfo">


                <?php if( have_rows('online_event_information' ) ): ?>
                    <?php while( have_rows('online_event_information') ): the_row(); ?>

                    <a href="<?php echo get_sub_field('link_location'); ?>" target="_blank"><?php the_sub_field('link_label_location'); ?></a>

                    
                  <?php endwhile; ?>
                <?php endif; ?>

              </section>


              <section class="addresslocation">
                <?php 
                $location = get_field('event_location');
                if( $location ) {

                    // Loop over segments and construct HTML.
                    $address = '';
                    foreach( array('street_number', 'street_name', 'city', 'state', 'post_code', 'country') as $i => $k ) {
                        if( isset( $location[ $k ] ) ) {
                            $address .= sprintf( '<span class="segment-%s">%s</span>, ', $k, $location[ $k ] );
                        }
                    }

                    // Trim trailing comma.
                    $address = trim( $address, ', ' );

                    // Display HTML.
                    echo '<p>' . $address . '.</p>';
                }
                ;?>
              </section>
              <p><?php the_category(); ?></p>
           </section>
         </section>
       </section>

       <section class="postcontent">
        <section class="postContentDesc">
          <?php echo get_field('event_description'); ?>
        </section>
        <section class="googleMap map" id="map"   aria-label="Google Map location">
          <?php 
          $location = get_field('event_location');
          if( $location ): ?>
              <div class="acf-map" data-zoom="16">
                  <div class="marker" data-lat="<?php echo esc_attr($location['lat']); ?>" data-lng="<?php echo esc_attr($location['lng']); ?>"></div>
              </div>
          <?php endif; ?>
        </section>

       </section>
     </section>
  </section>
</main>
 <?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>