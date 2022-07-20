
    <a href="<?php echo home_url( '/' ); ?>" title="<?php bloginfo( 'name', 'display' ); ?>" rel="home">
    <?php require 'images/logo.svg'; ?> 
   </a>
   <nav class="mainMenu">
     <?php wp_nav_menu( array(
       'container' => false,
       'theme_location' => 'primary'
     )); ?>
   </nav>
   <section class="searchField">
     <?php get_search_form(); ?>
   </section>

	
