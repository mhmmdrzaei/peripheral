  <?php get_header(); ?>
<main>
  <section class="pageSide">
      <main class="headerContainer">
    <?php get_sidebar(); ?>

  </main>
  </section>
  <section class="authorMain">
     <?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
     <section class="authorname">
       <h2>Contributor:</h2><h3><?php the_title(); ?></h3>
     </section>
     <section class="authorBio">
       <?php the_field('author_bio'); ?>
     </section>
     <section class="articlesListed">
       <h4>Articles:</h4>
       <section class="issueContributed">
         
       </section>
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