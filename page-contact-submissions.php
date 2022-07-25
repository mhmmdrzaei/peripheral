  <?php get_header();  ?>
<main>
  <section class="svgBGcontact">
    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
       viewBox="0 0 1392.84 1365.61" style="enable-background:new 0 0 1392.84 1365.61;" xml:space="preserve">
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
      <line class="st9" x1="601.85" y1="585.76" x2="820.17" y2="627.44"/>
      <line class="st9" x1="601.85" y1="585.76" x2="810.19" y2="1046.39"/>
      <line class="st9" x1="601.85" y1="585.76" x2="1000.82" y2="984.14"/>
      <line class="st9" x1="686.95" y1="959.47" x2="601.85" y2="585.76"/>
      <line class="st9" x1="985.79" y1="829.8" x2="601.85" y2="585.76"/>
      <line class="st9" x1="1091.41" y1="371.82" x2="601.85" y2="585.76"/>
      <line class="st9" x1="373.41" y1="278.68" x2="601.85" y2="585.76"/>
      <line class="st9" x1="310.49" y1="464.79" x2="601.85" y2="585.76"/>
      <line class="st9" x1="753.92" y1="185.7" x2="601.85" y2="585.76"/>
      <line class="st9" x1="302.25" y1="863.61" x2="601.85" y2="585.76"/>
      <line class="st9" x1="311.7" y1="1178.74" x2="601.85" y2="585.76"/>
      <line class="st9" x1="601.85" y1="585.76" x2="848.06" y2="313.79"/>
      <polyline class="st9" points="1078.37,410.93 1096.47,368.71 1054.25,350.61  "/>
      <polyline class="st9" points="943.81,841.76 988.31,830.37 976.92,785.87   "/>
      <polyline class="st9" points="785.32,650.95 825.41,628.54 803,588.45  "/>
      <polyline class="st9" points="767.88,1042.13 813.37,1048.52 819.76,1003.03  "/>
      <polyline class="st9" points="649.22,940.06 687.98,964.7 712.62,925.94  "/>
      <polyline class="st9" points="957.24,987 1003.17,987.69 1003.86,941.77  "/>
      <polyline class="st9" points="852.41,359.24 848.62,313.47 802.85,317.25   "/>
      <polyline class="st9" points="417.38,286.3 372.09,278.65 364.43,323.94  "/>
      <polyline class="st9" points="348.01,445.13 305.62,462.8 323.29,505.2   "/>
      <polyline class="st9" points="296.37,822.2 298.61,868.08 344.48,865.84  "/>
      <polyline class="st9" points="299.65,1136.66 309.01,1181.63 353.98,1172.27  "/>
      <polyline class="st9" points="776.3,223.21 752.42,183.98 713.18,207.86  "/>
    </g>
    </svg>


  </section>
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>

  </main>
  </section>

  <section class="pageMain pageContact">
    <section class="pageContactInner">
      <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>

    <?php endwhile; // end the loop?>
    </section>
    
  </section>
</main>

<?php get_footer(); ?>