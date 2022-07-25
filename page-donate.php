 <?php get_header();  ?>
<main>
    <section class="svgBGDonate">
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
       viewBox="0 0 1518.29 759.4" style="enable-background:new 0 0 1518.29 759.4;" xml:space="preserve">
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
      <g>
        <path class="st6" d="M1162.13,697.32c0-197.98-160.49-358.47-358.47-358.47c-197.98,0-358.47,160.49-358.47,358.47"/>
        <path class="st6" d="M1228.66,697.32c0-234.73-190.28-425.01-425.01-425.01c-234.73,0-425.01,190.28-425.01,425.01"/>
        <path class="st6" d="M1295.19,697.32c0-271.47-220.07-491.54-491.54-491.54S312.11,425.85,312.11,697.32"/>
        <path class="st6" d="M1361.73,697.32c0-308.22-249.86-558.08-558.08-558.08c-308.22,0-558.08,249.86-558.08,558.08"/>
        <path class="st6" d="M1428.26,697.32c0-344.96-279.65-624.61-624.61-624.61c-344.96,0-624.61,279.65-624.61,624.61"/>
      </g>
      <polyline class="st8" points="129.77,656.29 179.04,705.56 228.31,656.29   "/>
    </g>
    </svg>


  </section>
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>
  </main>
  </section>
 
  <section class="pageMain">
    <nav class="shopMenu">
      <?php wp_nav_menu( array(
        'container' => false,
        'theme_location' => 'commerce'
      )); ?>
    </nav>
    <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <section class="support">
        <h2>Support</h2>
        <section class="supportContent">
           <?php the_content(); ?>
        </section>
      </section>
     
      <section class="donation">
        <h2>Donation Amount</h2>
        <section class="donationwidget">
          <?php echo do_shortcode('[wdgk_donation]'); ?>
        </section>
      </section>




    <?php endwhile; // end the loop?>
  </section>
</main>

<?php get_footer(); ?>