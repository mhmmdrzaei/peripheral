<?php get_header();  ?> 

<main> 
  <section class="svgEvents">
    <!-- Generator: Adobe Illustrator 26.1.0, SVG Export Plug-In . SVG Version: 6.00 Build 0)  -->
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
       viewBox="0 0 1190.62 877.5" style="enable-background:new 0 0 1190.62 877.5;" xml:space="preserve">
    <style type="text/css">
      .st0{fill:none;stroke:#25FF00;stroke-width:5;stroke-miterlimit:10;}
      .st1{fill:none;stroke:#000000;stroke-miterlimit:10;}
      .st2{fill:#FFFFFF;}
      .st3{fill:#FFFFFF;stroke:#25FF00;stroke-miterlimit:10;}
      .st4{fill:none;stroke:#25FF00;stroke-width:7.702;stroke-miterlimit:10;}
      .st5{fill:#25FF00;}
      .st6{fill:none;stroke:#25FF00;stroke-width:10.989;stroke-miterlimit:10;}
      .st7{fill:none;stroke:#25FF00;stroke-width:14;stroke-miterlimit:10;stroke-dasharray:29.885,29.885;}
      .st8{fill:none;stroke:#25FF00;stroke-width:12;stroke-miterlimit:10;}
      .st9{fill:none;stroke:#25FF00;stroke-width:8.569;stroke-miterlimit:10;}
      .st10{fill:none;stroke:#25FF00;stroke-width:14;stroke-miterlimit:10;}
      .st11{fill:none;stroke:#25FF00;stroke-width:14;stroke-miterlimit:10;stroke-dasharray:28.941,28.941;}
    </style>
    <g>
      <circle class="st6" cx="747.54" cy="438.75" r="238.64"/>
      <circle class="st7" cx="747.54" cy="438.75" r="295.53"/>
      <circle class="st7" cx="747.54" cy="438.75" r="352.43"/>
      <circle class="st7" cx="443.08" cy="438.75" r="352.43"/>
      <circle class="st7" cx="443.08" cy="438.75" r="295.53"/>
      <circle class="st6" cx="443.08" cy="438.75" r="238.64"/>
      <path class="st5" d="M512.99,438.75c0,46.19,37.44,83.63,83.63,83.63c46.19,0,83.63-37.44,83.63-83.63s-37.44-83.63-83.63-83.63
        C550.43,355.11,512.99,392.56,512.99,438.75"/>
    </g>
    </svg>
  </section>
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
    <?php wp_list_categories_for_post_type('events'); ?>
  </main>
  </section>

<section class="pageMain eventsMain">
  
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

      <article id="post-<?php the_ID(); ?>" class="eventPagePost" aria-label="article container">


       
          <a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
            <figure class="sideImagePosts" aria-label="event image">
              <?php the_post_thumbnail('large');?>
            </figure>
            <section class="eventdetails">
               <h3 class="entry-title" aria-label="Event title"><?php the_title(); ?></h3>
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




