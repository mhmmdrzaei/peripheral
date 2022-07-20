 <?php get_header();  ?>
<main>
 
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