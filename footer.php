<footer>
<main class="footerContainer">
  
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
</main>
    
</footer>

<script>
// scripts.js, plugins.js and jquery are enqueued in functions.php
/* Google Analytics! */
 var _gaq=[["_setAccount","UA-XXXXX-X"],["_trackPageview"]]; // Change UA-XXXXX-X to be your site's ID
 (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
 g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
 s.parentNode.insertBefore(g,s)}(document,"script"));
</script>

<?php wp_footer(); ?>
</body>
</html>