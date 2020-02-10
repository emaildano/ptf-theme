<?php get_header(); ?>
			
	<div class="column-container clearfix">
		<section class="main-column">
			<h1 class="section-title">Recent Posts Section</h1>
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
		<?php get_sidebar(); ?>
	</div>

<?php get_footer(); ?>