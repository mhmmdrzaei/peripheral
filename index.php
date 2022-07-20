<?php //index.php is the last resort template, if no other templates match ?>
<?php get_header();  ?> 
<main> 
<section class="pageSide">
    <main class="headerContainer">
  <?php get_sidebar(); ?>
  <?php wp_list_categories_for_post_type('post'); ?>
</main>
</section>


<section class="pageMain">
  <?php get_template_part( 'loop', 'index' ); ?>
</section>
</main>

<?php get_footer(); ?>