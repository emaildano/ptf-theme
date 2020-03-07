<?php get_header(); ?>
<?php get_template_part('template_search-box'); ?>

<section id="tap-detail" class="viewer">
	<div class="viewer-content">

		<?php get_template_part('template_category-nav'); ?>

		<?php
		$thisBeer = new Beer($post->ID);
		$beerStyles = $thisBeer->getStyle();
		$beerOrigin = $thisBeer->getOrigin();
		$beerBrewery = $thisBeer->getBrewery();
		print_r($beerBrewery);
		$Bars = new Bar();
		$numServe = $Bars->getBarCountByBeer($thisBeer->getId());
		?>

		<div class="tap-list">
			<div class="the-border"></div>
			<div class="about-list clearfix">
				<h2 class="clearfix">
					<span class="who-serving">
						<span class="number-serving"><?php echo $numServe; ?></span> <span class="serving-text">Bar(s) Serving</span>
					</span>
					<span class="tap-list-name"><?php echo truncate_it(30, $thisBeer->getTitle()); ?></span>
				</h2>
				<span class="origin">Style:

					<?php
					$numStyles = count($beerStyles);
					$styleCounter = 0;
					foreach ($beerStyles as $aStyle) {
						$styleCounter++;
					?>
						<a href="/style/<?php echo $aStyle->slug; ?>" title="<?php echo $aStyle->name; ?>">
							<strong><?php echo $aStyle->name; ?></strong>
						</a><?php if ($styleCounter !=  $numStyles) {
									echo ', ';
								} ?>
					<?php } ?>

					<br />Origin: <strong><?php echo $beerOrigin; ?></strong>
					<br />Brewery: <strong><a href="<?php echo get_term_link($beerBrewery[0]->term_id); ?>"><?php echo $beerBrewery[0]->name; ?></strong></a>
				</span>
			</div>
			<div class="bar-map clearfix">
				<div class="style-text-container">
					<?php
					$beerDescription = $thisBeer->getDescription();
					if ($beerDescription != '') {
						echo '<p>' . $beerDescription . '</p>';
					} else {
						echo '<p class="fallback"><em>This beer\'s description is not currently available.</em></p>';
					}
					?>
				</div>
				<div class="ad">
					<?php if (function_exists('the_ad_group')) the_ad_group('18693'); ?>
				</div>
				<div class="sharin clearfix">
					<div class="share-fb">
						<div class="fb-like" data-href="<?php get_bloginfo('url'); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
					</div>
					<div class="share-tw">
						<a href="https://twitter.com/share" class="twitter-share-button" data-via="phillytapfinder">Tweet</a>
						<script>
							! function(d, s, id) {
								var js, fjs = d.getElementsByTagName(s)[0];
								if (!d.getElementById(id)) {
									js = d.createElement(s);
									js.id = id;
									js.src = "//platform.twitter.com/widgets.js";
									fjs.parentNode.insertBefore(js, fjs);
								}
							}(document, "script", "twitter-wjs");
						</script>
					</div>
				</div>
			</div>

			<?php if ($numServe == 0) { ?>
				<h3 class="tap-now">Sorry, no bars are serving this beer</h3>
			<?php }  ?>

			<?php
			$beerID = $thisBeer->getId();
			$theBeerBars = $Bars->getBarsByBeer($beerID);
			if (sizeof($theBeerBars) > 0) {
			?>


				<h3 class="tap-now">Available at these Bars</h3>
				<ul class="grid-list clearfix">
					<?php

					foreach ($theBeerBars as $theBeerBar) {
						$beersBarHoods = $theBeerBar->getNeighborhood();
						$barSite = $theBeerBar->getSiteURL();
					?>

						<li>
							<div class="panel">
								<span class="updated">Last Updated: <?php echo $theBeerBar->getModifiedDate($theBeerBar->getId()); ?></span>
								<div class="panel-content clearfix">
									<div class="clearfix">
										<div class="panel-text">
											<ul class="panel-list">
												<li>
													<span>Name:</span>
													<h4><a href="/bar/<?php echo $theBeerBar->getSlug(); ?>" title="<?php echo $theBeerBar->getTitle(); ?>"><?php echo truncate_it(34, $theBeerBar->getTitle()); ?></a></h4>
												</li>
												<li>
													<span>Address:</span>
													<p><?php echo truncate_it(36, $theBeerBar->getAddress()); ?></p>
												</li>
												<li>
													<span>Phone:</span>
													<p>
														<a href="tel:<?php echo $theBeerBar->getPhone(); ?>"><?php echo $theBeerBar->getPhone(); ?></a>
														<?php if ($barSite) { ?>&middot; <a href="<?php echo $barSite; ?>" title="Visit <?php echo $theBeerBar->getTitle(); ?>'s website" target="_blank">Visit website</a><?php } ?>
													</p>
												</li>
												<li>
													<span>Neighborhood:</span>
													<p>
														<?php
														$numHoods = count($beersBarHoods);
														$hoodCount = 0;
														foreach ($beersBarHoods as $beersBarHood) {
															$hoodCount++;
															echo '<a href="/hood/' . $beersBarHood->slug . '">' . $beersBarHood->name . '</a>';
															if ($hoodCount != $numHoods) {
																echo ', ';
															}
														}
														?>
													</p>
												</li>
											</ul>
										</div>
										<div class="panel-map">
											<div class="panel-map-container a-google-map">
												<iframe width="208" height="136" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $theBeerBar->getEmbedLink(); ?>"></iframe>
											</div>
										</div>
									</div>
									<div class="multiple-buttons clearfix">
										<a href="/bar/<?php echo $theBeerBar->getSlug(); ?>" class="a-button" title="<?php echo $theBeerBar->getTitle(); ?>"><span class="beer-icon"></span>View the Tap List</a>
										<a href="<?php echo $theBeerBar->getMapLink(); ?>" class="a-button" title="View <?php echo $theBeerBar->getTitle(); ?> on Google Maps" target="_blank"><span class="sign-icon"></span>View Map / Get Directions</a>
									</div>
								</div>
							</div>
						</li>

					<?php } ?>

				</ul>

			<?php } ?>

			<?php
			$theBeerEvents = Event::getEventsByBeer($beerID);
			if (sizeof($theBeerEvents) > 0) {
			?>

				<h3 class="tap-now">Available at these Upcoming Events</h3>
				<ul class="grid-list clearfix">
					<?php

					foreach ($theBeerEvents as $theBeerEvent) {
						$eventBar = $theBeerEvent->getBar();
						$beersBarHoods = $eventBar->getNeighborhood();
						$barSite = $eventBar->getSiteURL();
					?>

						<li class="events-panel">
							<div class="panel">
								<span class="updated">Last Updated: <?php echo $theBeerEvent->getModifiedDate($theBeerEvent->getId()); ?></span>
								<div class="panel-content clearfix">
									<div class="clearfix">
										<div class="panel-text">
											<ul class="panel-list">
												<li>
													<span>Event Name:</span>
													<h4><a href="/event/<?php echo $theBeerEvent->getSlug(); ?>" title="<?php echo $theBeerEvent->getTitle(); ?>"><?php echo truncate_it(34, $theBeerEvent->getTitle()); ?></a></h4>
												</li>
												<li>
													<span>Bar Name:</span>
													<h4><a href="/bar/<?php echo $eventBar->getSlug(); ?>" title="<?php echo $eventBar->getTitle(); ?>"><?php echo truncate_it(20, $eventBar->getTitle()); ?></a></h4>
												</li>
												<li>
													<span>Event Date:</span>
													<p><?php echo $theBeerEvent->getDate(); ?></p>
												</li>
												<li>
													<span>Address:</span>
													<p><?php echo truncate_it(20, $eventBar->getAddress()); ?></p>
												</li>
												<li>
													<span>Phone:</span>
													<p>
														<a href="tel:<?php echo $eventBar->getPhone(); ?>"><?php echo $eventBar->getPhone(); ?></a>
														<?php if ($barSite) { ?>&middot; <a href="<?php echo $barSite; ?>" title="Visit <?php echo $eventBar->getTitle(); ?>'s website" target="_blank">Visit website</a><?php } ?>
													</p>
												</li>
												<li>
													<span>Neighborhood:</span>
													<p>
														<?php
														$numHoods = count($beersBarHoods);
														$hoodCount = 0;
														foreach ($beersBarHoods as $beersBarHood) {
															$hoodCount++;
															echo '<a href="/hood/' . $beersBarHood->slug . '">' . $beersBarHood->name . '</a>';
															if ($hoodCount != $numHoods) {
																echo ', ';
															}
														}
														?>
													</p>
												</li>
											</ul>
										</div>
										<div class="panel-map">
											<div class="panel-map-container a-google-map">
												<iframe width="208" height="136" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $eventBar->getEmbedLink(); ?>"></iframe>
											</div>
										</div>
									</div>
									<div class="multiple-buttons clearfix">
										<a href="/event/<?php echo $theBeerEvent->getSlug(); ?>" class="a-button" title="<?php echo $theBeerEvent->getTitle(); ?>"><span class="beer-icon"></span>View the Tap List</a>
										<a href="<?php echo $eventBar->getMapLink(); ?>" class="a-button" title="View <?php echo $eventBar->getTitle(); ?> on Google Maps" target="_blank"><span class="sign-icon"></span>View Map / Get Directions</a>
									</div>
								</div>
							</div>
						</li>

					<?php } ?>

				</ul>

			<?php } ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>