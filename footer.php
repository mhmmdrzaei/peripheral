<footer>
<main class="footerContainer">
   <section class="cartnew">
     <a class="cart-customlocation" href="<?php echo wc_get_cart_url(); ?>" title="<?php _e( 'View your shopping cart' ); ?>"> <img src="<?php bloginfo('template_directory'); ?>/images/cart.png" alt="Image of a Shopping Cart">Cart (<?php echo WC()->cart->get_cart_contents_count() ?>)
       </a>

   </section>
  
  <section class="social_media_links" aria-label="Social Medial Links">
    <?php if( have_rows('social_media_links' , 'options') ): ?>
        <ul class="linksEach">
        <?php while( have_rows('social_media_links', 'options') ): the_row(); 
            ?>
            <li>
              <a href="<?php the_sub_field('social_link', 'options') ;?>" target="_blank"><?php the_sub_field('social_label_icon' , 'options') ;?></a>
            </li>
        <?php endwhile; ?>
        </ul>
    <?php endif; ?>
  </section>
  <nav class="footerMen">
    <p>&copy; Peripheral Review <?php echo date('Y'); ?></p>
    <?php wp_nav_menu( array(
      'container' => false,
      'theme_location' => 'footer'
    )); ?>
  </nav>
  <section class="mailingList closed">
    <section class="close">
      Close
    </section>
    <!-- Begin Mailchimp Signup Form -->
    <div id="mc_embed_signup">
    <form action="https://peripheralreview.us14.list-manage.com/subscribe/post?u=5e7cc645c7df3777b0ab1e716&amp;id=6a455bf02d&amp;f_id=001892e0f0" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
        <div id="mc_embed_signup_scroll">
      <h2>Join our mailing list!</h2>
    <div class="mc-field-group">
      <label for="mce-EMAIL">Email Address  <span class="asterisk">*</span>
    </label>
      <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder="Email Address">
      <span id="mce-EMAIL-HELPERTEXT" class="helper_text"></span>
    </div>
    <div class="mc-field-group">
      <label for="mce-FNAME">First Name </label>
      <input type="text" value="" name="FNAME" class="" id="mce-FNAME" placeholder="First Name">
      <span id="mce-FNAME-HELPERTEXT" class="helper_text"></span>
    </div>
    <div class="mc-field-group">
      <label for="mce-LNAME">Last Name </label>
      <input type="text" value="" name="LNAME" class="" id="mce-LNAME" placeholder="Last Name">
      <span id="mce-LNAME-HELPERTEXT" class="helper_text"></span>
    </div>
      <div id="mce-responses" class="clear">
        <div class="response" id="mce-error-response" style="display:none"></div>
        <div class="response" id="mce-success-response" style="display:none"></div>
      </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
        <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_5e7cc645c7df3777b0ab1e716_6a455bf02d" tabindex="-1" value=""></div>
        <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
        </div>
    </form>
    </div>

    <!--End mc_embed_signup-->
  </section>
</main>
    
</footer>

<?php wp_footer(); ?>
</body>
</html>