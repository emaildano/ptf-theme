<?php
/*
Template Name: Search Results: Hoods Page
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
						$getHoods = new Neighborhood(); 
						$Hoods = $getHoods->getAllNeighborhoods();
						$numHoods = count($Hoods);
						$hoodCounter = 0;
						foreach ($Hoods as $Hood) {
							$hoodCounter++;
					?>
				
						<?php if ($hoodCounter == 1) { ?>
						<ul class="clearfix">
						<?php } ?>
					
							<li>
								<a href="/hood/<?php echo $Hood->slug; ?>" title="<?php echo $Hood->name; ?>">
									<span><?php echo $Hood->name; ?></span>
								</a>
							</li>
						
						<?php if ( $hoodCounter == $numHoods ) { ?>
						</ul>
						<?php } ?> 
						
					<?php } ?>
					
			</div>
			
			<?php get_template_part('template_three-ads'); ?>
			
		</div>
	</section>

<?php get_footer(); ?>