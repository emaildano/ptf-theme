<?php
/*
Template Name: Search Results: Styles Page
*/
?>
<?php get_header(); ?>

	<?php get_template_part('template_search-box'); ?>
	
	<section id="styles-search-results" class="viewer">
		<div class="viewer-content">
			
			<?php get_template_part('template_category-nav'); ?>
			
			<div class="the-border"></div>
			<div class="results-grid">
				
					<?php 
						$getStyles = new Style(); 
						$Styles = $getStyles->getAllStyles();
						$numStyles = count($Styles);
						$styleCounter = 0;
						foreach ($Styles as $Style) {
							$styleCounter++;
					?>
				
						<?php if ($styleCounter == 1) { ?>
						<ul class="clearfix">
						<?php } ?>
					
							<li>
								<a href="/style/<?php echo $Style->slug; ?>" title="<?php echo $Style->name; ?>">
									<span><?php echo $Style->name; ?></span>
								</a>
							</li>
						
						<?php if ( $styleCounter == $numStyles ) { ?>
						</ul>
						<?php } ?> 
						
					<?php } ?>
					
			</div>
			
			<?php get_template_part('template_three-ads'); ?>
			
		</div>
	</section>

<?php get_footer(); ?>