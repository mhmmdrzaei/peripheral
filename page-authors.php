
<?php get_header();  ?> 
<main> 
    <section class="svgBGauthors">
      <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
         viewBox="0 0 2420.86 1833.98" style="enable-background:new 0 0 2420.86 1833.98;" xml:space="preserve">
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
        <polyline class="st0" points="2246.36,661.14 1669.77,120.53 1777.58,903.54 1200.95,362.94 1308.73,1145.97 732.09,605.38 
            839.87,1388.41 263.2,847.83 370.94,1630.88  "/>
        <polyline class="st0" points="420.02,1571.81 374.41,1640.21 306.01,1594.6   "/>
      </g>
      </svg>

    </section>

    <section class="pageSide">
        <main class="headerContainer">
      <?php get_sidebar(); ?>

    </main>
    </section>
    <section class="pageMain authorsMain">
      
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




