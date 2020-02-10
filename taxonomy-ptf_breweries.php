<?php get_header(); ?>

	<?php get_template_part('template_search-box'); ?>
	
	<section id="search-results" class="viewer">
		<div class="viewer-content">
			
			<?php get_template_part('template_category-nav'); ?>
			
			<?php
				$Beers = new Beer();
				$beersByBrew = $Beers->getBeersByBrewery($wp_query->queried_object->slug);
				$Bars = new Bar();
				
			?>
			
			<div class="tap-list">
				<div class="the-border"></div>
				<div class="about-list clearfix">
					<h2 class="clearfix">
						<a href="/on-tap/" class="who-serving who-serv-altered">
							<span class="number-serving entypo">&ccedil;</span> <span class="serving-text">Back to Breweries</span>
						</a> 
						<span class="tap-list-name"><?php echo $wp_query->queried_object->name; ?></span>
					</h2>
					<span class="origin">Origin: <strong><?php isset($beersByBrew[0]->getOrigin()) ? $beersByBrew[0]->getOrigin() : ''; ?></strong></span>
				</div>
				<ul class="the-tap-list">
				
					<?php
						foreach ($beersByBrew as $aBeer) { 
					?>
				
					<li>
						<div class="about-beer clearfix">
							<h3>
								<span class="who-serving">
									<span class="number-serving"><?php echo $Bars->getBarCountByBeer($aBeer->getId()); ?></span> <span class="serving-text">Bar(s) Serving</span>
								</span> 
								<a href="/beer/<?php echo $aBeer->getSlug(); ?>" title="<?php echo $aBeer->getTitle(); ?>"><?php echo truncate_it(30, $aBeer->getTitle()); ?></a>
							</h3>
							<span class="style-beer">Style: 
								<?php 
									$beerStyles = $aBeer->getStyle();
									$numStyles = count($beerStyles);
									$styleCounter = 0;
									foreach ( $beerStyles as $aStyle ) {
										$styleCounter++;
								?>
								<a href="/style/<?php echo $aStyle->slug; ?>" title="<?php echo $aStyle->name; ?>"><?php echo $aStyle->name; ?></a><?php if ( $styleCounter !=  $numStyles) { echo ', '; } ?>
								<?php } ?>
							</span>
							<a href="/beer/<?php echo $aBeer->getSlug(); ?>" class="yellow-button" title="<?php echo $aBeer->getTitle(); ?>">See where it's pouring</a>
						</div>
						<p><?php echo $aBeer->getDescription(); ?></p>
					</li>
					
					<?php } ?>
					
				</ul>
			</div>
			
			<?php get_template_part('template_three-ads'); ?>
			
		</div>
	</section>

<?php get_footer(); ?>