<?php // If there are no posts to display, such as an empty archive page ?>

<?php if ( ! have_posts() ) : ?>

	<article id="post-0" class="post error404 not-found">
		<h1 class="entry-title">Not Found</h1>
		<section class="entry-content">
			<p>Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.</p>
			<?php get_search_form(); ?>
		</section><!-- .entry-content -->
	</article><!-- #post-0 -->

<?php endif; // end if there are no posts ?>

<?php // if there are posts, Start the Loop. ?>

<?php while ( have_posts() ) : the_post(); ?>
	<article id="post-<?php the_ID(); ?>" class="archivepagePost" aria-label="article container">


	 
	    <a href="<?php the_permalink(); ?>" title="Permalink to: <?php esc_attr(the_title_attribute()); ?>" rel="bookmark">
	      <figure class="sideImagePosts" aria-label="Article image">
	        <?php the_post_thumbnail('large');?>
	      </figure>
	      <section class="archivePostDetails">
	      	<section class="postDetails">
	      		<section class="titleDate">
	      			 <h3 class="entry-title" aria-label="Article title">
	      			<?php the_title(); ?>
	      			  </h3>
	      			  <?php the_date(); ?>
	      		</section>

	      		  <?php the_category(); ?>
					<?php
					$author_post = get_field('author');
					if( $author_post ):
						$author_count = count($author_post);
						if($author_count > 1) {
							$author_list = "";
							foreach( $author_post as $featured_post ): 
								$title = get_the_title( $featured_post->ID );
								$author_list .= esc_html( $title ) . " & ";
							endforeach;
							$author_list = rtrim($author_list, " & ");
							echo '<p> By '. $author_list .'</p>';
						} else {
							$featured_post = $author_post[0];
							echo '<p> By ' . esc_html(get_the_title( $featured_post->ID )) . '</p>';
						}
					endif;
					?>
	      	</section>
	      	<section class="postexcerpt">
	      		<?php the_content('Continue Reading <span class="meta-nav"> &rarr;</span>'); ?>
	      	</section>
	      </section>

	    </a>


	</article><!-- #post-## -->


<?php endwhile; // End the loop. Whew. ?>

<?php // Display navigation to next/previous pages when applicable ?>
<?php if (  $wp_query->max_num_pages > 1 ) : ?>
  <p class="alignleft"><?php next_posts_link('&laquo; Older Entries'); ?></p>
  <p class="alignright"><?php previous_posts_link('Newer Entries &raquo;'); ?></p>
<?php endif; ?>
