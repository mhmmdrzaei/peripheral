 <?php get_header(); ?>

<main>
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
  </main>
  </section>
  <section class="pageMain">
     <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
     <section class="postMain">
      <nav class="shopMenu">
        <?php wp_nav_menu( array(
          'container' => false,
          'theme_location' => 'commerce'
        )); ?>
      </nav>
       <figure>
         <?php  the_post_thumbnail('large');?>
       </figure>
       <section class="postcontent">
         <section class="postContentDetails">
          <h3 class="entry-title"><?php the_title(); ?></h3>

         </section>
         <section class="postContentText">
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

            <?php
                global $product;

                $attachment_ids = $product->get_gallery_image_ids();

                foreach( $attachment_ids as $attachment_id ) { ?>

                  <img src="<?php echo $image_link = wp_get_attachment_url( $attachment_id ); ?>" alt="">
            <?php }; ?>
            
         </section>
       </section>
     </section>
  </section>
</main>
 <?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>


<section class="aboutContentSVG">
        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
           viewBox="0 0 1326.38 642.4" style="enable-background:new 0 0 1326.38 642.4;" xml:space="preserve">
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
          <path class="st1" d="M1212.21,517.06V402.14H478.34v-276.8H191.2v155.82h-60.83v180.07c0,16.8-13.62,30.41-30.41,30.41h-7.8"/>
          <polyline class="st1" points="1190.19,495.04 1212.21,517.06 1234.22,495.04  "/>
        </g>
        </svg>
      </section>