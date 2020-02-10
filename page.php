<?php
/*
Template Name: Search Results: Tap List Page
*/
?>
<?php get_header(); ?>

	<div class="generic-page-container">

		<section id="generic-page" class="viewer">
			<div class="viewer-content">
				
				<?php while ( have_posts() ) : the_post(); // Start Loop ?>
				
				<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
					<h1 class="posttitle"><?php the_title(); ?></h1>
					<div class="entry-content">
				    	<?php the_content(); ?>
				    </div><!--! end of entry-content -->
				</div><!--! end of postID div -->
				
				<?php endwhile; // End the loop. Whew. ?>
				
			</div>
		</section>
	
	</div>

<?php get_footer(); ?>