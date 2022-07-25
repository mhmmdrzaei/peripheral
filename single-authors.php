  <?php get_header(); ?>
<main>
  <section class="svgBGauthorsSingle">
<svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
   viewBox="0 0 1828.62 1321.83" style="enable-background:new 0 0 1828.62 1321.83;" xml:space="preserve">
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
  <line class="st10" x1="760.93" y1="666.65" x2="775.38" y2="670.48"/>
  <line class="st10" x1="760.93" y1="666.65" x2="775.38" y2="662.83"/>
  <g>
    <path class="st5" d="M668.58,459.09v403.65c56.56-48.91,92.35-121.19,92.35-201.83C760.93,580.27,725.15,507.99,668.58,459.09"/>
    <circle class="st10" cx="494.22" cy="660.91" r="266.71"/>
    <line class="st11" x1="803.35" y1="677.89" x2="1572.69" y2="881.7"/>
    <line class="st10" x1="1586.68" y1="885.4" x2="1601.12" y2="889.23"/>
    <line class="st11" x1="803.35" y1="655.41" x2="1572.69" y2="451.61"/>
    <line class="st10" x1="1586.68" y1="447.9" x2="1601.12" y2="444.07"/>
  </g>
</g>
</svg>
  </section>
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>

  </main>
  </section>
  <section class="pageMain">
     <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
     <section class="authorname">
       <h2>Contributor:</h2> <h3><?php the_title(); ?></h3>
     </section>
     <section class="authorBio">
       <?php the_field('author_bio'); ?>
     </section>
     <section class="articlesListed">
       <h3>Articles:</h3>
       <?php if( have_rows('issues_contributed') ): ?>
         <section class="issueContributed">
         <h4>Issues Contributed:</h4>
         <section class="issueContributedList">
           <?php while( have_rows('issues_contributed') ): the_row(); ?>
            <a href="<?php the_sub_field('link_to_shop_item'); ?>"><?php the_sub_field('issue_information'); ?></a>
            
           <?php endwhile; ?>
             </section>
           </section>
       <?php endif; ?> 
       

      <?php if( have_rows('from_the_archive_connected') ): ?>
        <section class="fromTheArchives">
        <h4>From the Archives:</h4>
        <section class="from_the_archive_connected">
          <?php while( have_rows('from_the_archive_connected') ): the_row(); ?>

            <?php
            $archivePost = get_sub_field('connect_to_articles');
            if( $archivePost ): ?>

            <a href="<?php echo the_permalink( $archivePost->ID ); ?>"><?php echo esc_html( $archivePost->post_title ); ?></a>
                
            <?php endif; ?>
          <?php endwhile; ?>
            </section>
          </section>
      <?php endif; ?> 
           

     </section>

  </section>
</main>
 <?php endwhile; // end of the loop. ?>



<?php get_footer(); ?>