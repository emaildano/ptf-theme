<?php get_header(); ?>

	<?php get_template_part('template_search-box'); ?>

	<section id="tap-detail" class="viewer">
		<div class="viewer-content">

			<?php get_template_part('template_category-nav'); ?>

			<?php
				$Bars = new Bar();
				$theBeerBars = $Bars->getBarsByNeighborhood($wp_query->queried_object->slug);
			?>

			<div class="tap-list">
				<div class="the-border"></div>
				<div class="about-list clearfix">
					<h2 class="no-float clearfix">
						<a href="/hoods/" class="who-serving who-serv-altered" title="View All Hoods">
							<span class="number-serving entypo">&ccedil;</span> <span class="serving-text">Back to Hoods</span>
						</a>
						<span class="tap-list-name"><?php echo $wp_query->queried_object->name; ?></span>
						<span class="who-serving second-serving">
							<span class="number-serving"><?php echo count($theBeerBars); ?></span> <span class="serving-text one-line-serving">Bar(s)</span>
						</span>
					</h2>
				</div>
				<div class="bar-map clearfix">
					<?php
						$theFieldSource = 'ptf_hoods_'.$wp_query->queried_object->term_id;
						$theMap = get_field('hood_map_url', $theFieldSource);
						if ($theMap) {
					?>
					<div class="map-container a-google-map">
						<?php $theFieldSource = 'ptf_hoods_'.$wp_query->queried_object->term_id; ?>
						<iframe width="626" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo $theMap; ?>"></iframe>
						<!--div class="single-button">
							<a href="#" class="a-button"><span class="entypo">D</span>See Photos</a>
						</div-->
					</div>
					<?php } else { ?>
					<div class="style-text-container hood-description">
						<?php
							$hoodDescr = $wp_query->queried_object->description;
							if ( $hoodDescr != '' ) {
						?>
						<?php
							$content = apply_filters('the_content', $hoodDescr);
							$content = str_replace(']]>', ']]&gt;', $content);
							echo $content;
						?>
						<?php } else { ?>
						<p class="fallback"><em>This neighborhood's description is currently unavailable.</em></p>
						<?php } ?>
					</div>
					<?php } ?>
					<div class="ad">
						<?php if(function_exists('the_ad_group')) the_ad_group('18693'); ?>
					</div>
				</div>
				<h3 class="tap-now">Craft Beer Bars in <?php echo $wp_query->queried_object->name; ?></h3>
				<ul class="grid-list clearfix">

					<?php
						foreach ( $theBeerBars as $theBeerBar ) {
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
												<p><?php echo truncate_it(42, $theBeerBar->getAddress()); ?></p>
											</li>
											<li>
												<span>Phone:</span>
												<p><?php echo $theBeerBar->getPhone(); ?></p>
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
			</div>
		</div>
	</section>

	<?php
		// For debugging Ads.
		// echo '<div style ="background: white;">';
		// $Ads = new Advertising();
		// $ads = $Ads->showAdvertisement('square', 'tax-ptf_hoods', 'ptf_hoods_18065');
		// $selectedAds = get_field('select_a_single_ad', 'ptf_hoods_17382');
		// $selectedAds = get_field('select_a_single_ad');

		// if ($selectedAds) {
	  //   print_r($selectedAds);
		// } else {
		// }
		// echo '</div>';
	?>

<?php get_footer(); ?>
