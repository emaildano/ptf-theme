<?php
/*
Template Name: 1-Column Page
*/
?>

<?php get_header(); ?>
			
	<div class="column-container clearfix">
		<section class="wide-column">
	    	<?php while ( have_posts() ) : the_post(); // Start Loop ?>
	    	
	    	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	    		<header>
	    			<h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
	    		</header>
	        	<div class="entry-content">
	            	<?php the_content(); ?>
	            </div><!--! end of entry-content -->
	    	</article>
	    	
	    	<?php endwhile; // End the loop. Whew. ?>
		</section>
	</div>

<?php get_footer(); ?>