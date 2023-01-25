<?php get_header();  ?> 
<main> 
<section class="pageSide">
    <main class="headerContainer">
  <?php get_sidebar(); ?>
 
</main>
</section>
<section class="pageMain homepageMain">
  <section class="homepageSVG">
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
       viewBox="0 0 2309.74 2654.88" style="enable-background:new 0 0 2309.74 2654.88;" xml:space="preserve">
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
      <path class="st0" d="M1133.9,460.1c-439.48,0-795.75,356.27-795.75,795.75s356.27,795.75,795.75,795.75
        s795.75-356.27,795.75-795.75"/>
      <g>
        <polyline class="st0" points="1988.93,1315.13 1929.65,1255.85 1870.37,1315.13     "/>
      </g>
    </g>
    </svg>
  </section>
  
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
          </a>
          <section class="entry-title">
            <a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
              <h1 aria-label="Article title">
              <?php the_title(); ?>
              </h1>
              <?php
              $author_post = get_field('author');
              if( $author_post ):
                  $author_count = count($author_post);
                  if($author_count > 1) {
                      $author_list = "";
                      foreach( $author_post as $featured_post ): 
                          $title = get_the_title( $featured_post->ID );
                          $author_list .= esc_html( $title ) . " & ";
                      endforeach;
                      $author_list = rtrim($author_list, " & ");
                      echo '<h2> By '. $author_list .'</h2>';
                  } else {
                      $featured_post = $author_post[0];
                      echo '<h2> By ' . esc_html(get_the_title( $featured_post->ID )) . '</h2>';
                  }
              endif;
              ?>

            </a>
          </section>


          
      



      </article><!-- #post-## -->


  <?php endwhile; // End the loop. Whew. ?>

    
     <?php wp_reset_query();?> 
</section>

 
</main>
<?php get_footer(); ?>




