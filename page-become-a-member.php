 <?php get_header();  ?>
<main>
  <section class="svgmembership">
   <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
     viewBox="0 0 780.28 534.17" style="enable-background:new 0 0 780.28 534.17;" xml:space="preserve">
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
    <path class="st5" d="M146.63,326.74c-22.96-13.5-42.19-32.8-55.61-55.83l-2.23-3.83l2.23-3.83c13.42-23.03,32.65-42.33,55.61-55.83
      c23.67-13.92,50.78-21.27,78.39-21.27s54.71,7.36,78.38,21.27c22.96,13.5,42.19,32.8,55.61,55.83l2.23,3.83l-2.23,3.83
      c-13.42,23.03-32.65,42.33-55.61,55.83c-23.67,13.92-50.78,21.27-78.38,21.27S170.3,340.66,146.63,326.74 M295.69,220.54
      c-21.34-12.54-45.78-19.17-70.67-19.17c-24.9,0-49.34,6.63-70.68,19.17c-19.43,11.42-35.9,27.46-47.86,46.54
      c11.96,19.09,28.43,35.12,47.86,46.54c21.34,12.54,45.78,19.17,70.68,19.17c24.9,0,49.34-6.63,70.67-19.17
      c19.43-11.42,35.9-27.45,47.86-46.54C331.59,248,315.12,231.96,295.69,220.54"/>
    <path class="st5" d="M285.4,267.09c0,33.35-27.04,60.39-60.39,60.39c-33.35,0-60.39-27.04-60.39-60.39s27.04-60.39,60.39-60.39
      C258.37,206.69,285.4,233.73,285.4,267.09"/>
    <path class="st5" d="M557.5,348.02c27.6,0,54.71-7.35,78.39-21.27c22.96-13.5,42.19-32.8,55.61-55.83l-13.15-7.66
      c-12.1,20.78-29.46,38.2-50.17,50.37c-21.34,12.54-45.78,19.17-70.68,19.17s-49.34-6.63-70.67-19.17
      c-20.72-12.18-38.07-29.6-50.17-50.37l-13.14,7.66c13.42,23.03,32.65,42.33,55.61,55.83C502.79,340.66,529.9,348.02,557.5,348.02"
      />
   </g>
   </svg>
  </section>
 
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
  </main>
  </section>
  <section class="pageMain membershipPage">
    <nav class="shopMenu">
      <?php wp_nav_menu( array(
        'container' => false,
        'theme_location' => 'commerce'
      )); ?>
    </nav>
    <section class="membershipPagecontent">
      <h2><?php the_title(); ?></h2>
      <section class="membershipOptions">
         <?php $args = array( 'post_type' => 'product', 
                  'product_cat' => 'membership',
                  // 'meta_key'      => 'start_date',
                  'orderby'   => 'meta_value_num',
                  'meta_key'  => '_price',
                  'order' => 'asc',
                 //  'orderby' => array(
                 //     'meta_value_num' => 'desc',
                 //     'post_date' => 'desc'
                 // )
                  'posts_per_page' => -1 );
              query_posts( $args ); // hijack the main loop

              if ( ! have_posts() ) : ?>

        <?php endif; // end if there are no posts ?>
        <?php // if there are posts, Start the Loop. ?>

        <?php while ( have_posts() ) : the_post(); ?>
          <article class="membershipOptioneach">
            
            <a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
              <h2><?php echo $product->get_price_html(); ?></h2>
              <h3><?php the_title(); ?></h3>
            </a>
            <?php the_content(); ?>
           

           <?php 
            global $product;

            echo apply_filters( 'woocommerce_loop_add_to_cart_link',
                sprintf( '<a href="%s" class="addToCartMember" rel="nofollow" data-product_id="%s" data-product_sku="%s" class="button %s product_type_%s">%s</a>',
                    esc_url( $product->add_to_cart_url() ),
                    esc_attr( $product->get_id() ),
                    esc_attr( $product->get_sku() ),
                    $product->is_purchasable() ? 'add_to_cart_button' : '',
                    esc_attr( $product->get_type() ),
                    esc_html( $product->add_to_cart_text() )
                ),
            $product );


            ?>

          </article>



        <?php endwhile; // End the loop. Whew. ?>

          
           <?php wp_reset_query();?> 

      </section>

    </section>

     

</main>

<?php get_footer(); ?>