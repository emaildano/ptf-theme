<?php get_header(); ?>
	<section id="main-search">
		<div class="page-container">
		
			<?php while ( have_posts() ) : the_post(); // Start Loop ?>
		
			<h1><?php echo get_the_content(); ?></h1>
			
			<?php endwhile; // End the loop. Whew. ?>
			
		</div>
		<div class="column-container clearfix">
			<?php if ( ! have_posts() ) : ?>
				<article id="post-0" class="post error404 not-found">
					<header>
						<h1>Sorry, what you're looking for has either been removed or the event has ended.</h1>
					</header>
		<div class="error404">
			<p><a href="<?php bloginfo('url'); ?>/events/" title="<?php bloginfo('name'); ?>">Check out our other events here.</a></p><p>You can search for something new in the box below, or just head to the <a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>">home page</a>.</p>
		</div><!-- .entry-content -->
			<?php get_template_part('template_search-box'); ?>
					
				</article><!-- #post-0 -->
		</div>
	</section>
		<?php endif; ?>

<?php get_footer(); ?>