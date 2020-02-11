<?php get_header(); ?>

	<?php get_template_part('template_search-box'); ?>

	<section id="style-detail" class="viewer">
		<div class="viewer-content">

			<?php get_template_part('template_category-nav'); ?>

			<?php
				$Beers = new Beer();
				$Bars = new Bar();
				// $theStyleBeers = $Beers->getBeersByStyle($wp_query->queried_object->name);
				// Adjusted to this query from the one above 3-27-19 (ZA)
				$theStyleBeers = $Beers->getBeersByStyle($wp_query->query['ptf_beer_style']);

				$barsServing = 0;
				foreach ( $theStyleBeers as $theStyleBeer ) {
					$matchingBars = $Bars->getBarCountByBeer($theStyleBeer->getId());
					if ( $matchingBars != 0 ) {
						$barsServing++;
					}
				}
			?>

			<div class="tap-list">
				<div class="the-border"></div>
				<div class="about-list clearfix">
					<h2 class="no-float clearfix">
						<a href="/styles/" class="who-serving who-serv-altered" title="View All Styles">
							<span class="number-serving entypo">&ccedil;</span> <span class="serving-text">Back to Styles</span>
						</a>
						<span class="tap-list-name"><?php echo $wp_query->queried_object->name; ?></span>
						<span class="who-serving second-serving">
							<span class="number-serving"><?php echo $barsServing; ?></span> <span class="serving-text">Beer(s) in this Style</span>
						</span>
					</h2>
				</div>
				<div class="bar-map clearfix">
					<div class="style-text-container">
						<p><?php echo $wp_query->queried_object->description; ?></p>
					</div>
					<div class="ad">
						<?php if(function_exists('the_ad_group')) the_ad_group('18694'); ?>
					</div>
				</div>
				<h3 class="tap-now">On Tap</h3>
				<ul class="grid-list clearfix">

					<?php
						foreach ( $theStyleBeers as $theStyleBeer ) {
					?>

						<?php

							$matchingBars = $Bars->getBarCountByBeer($theStyleBeer->getId());
							if ( $matchingBars != 0 ) {
						?>
						<li>
							<div class="panel">
								<div class="panel-content clearfix">
									<div class="panel-number">
										<span class="number-serving"><?php echo $Bars->getBarCountByBeer($theStyleBeer->getId()); ?></span>
										<span class="serving-text">Bars<br/>Serving</span>
									</div>
									<div class="panel-text">
										<h4><a href="/beer/<?php echo $theStyleBeer->getSlug(); ?>" title="<?php echo $theStyleBeer->getTitle(); ?>"><?php echo $theStyleBeer->getTitle(); ?></a></h4>
										<p><?php echo truncate_it(238, $theStyleBeer->getDescription()); ?></p>
									</div>
								</div>
								<div class="single-button view-other-bars">
									<a href="/beer/<?php echo $theStyleBeer->getSlug(); ?>" class="a-button" title="View other bars serving <?php echo $theStyleBeer->getTitle(); ?>"><span class="beer-icon"></span>View This Beer</a>
								</div>
							</div>
						</li>
						<?php } ?>

						<?php } ?>

				</ul>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
