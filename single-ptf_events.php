<?php get_header(); ?>

	<?php get_template_part('template_search-box'); ?>

	<section id="bar-detail" class="viewer">
		<div class="viewer-content">

			<?php get_template_part('template_category-nav'); ?>

			<?php
				$event = new Event($post->ID);
				$eventBar = $event->getBar();
				$thisHood = $eventBar->getNeighborhood();
				$thisHood = array_values($thisHood);
				$barSite = $eventBar->getSiteURL();
			?>

			<div class="tap-list">
				<div class="the-border"></div>
				<div class="about-list clearfix">
					<h2 class="clearfix">
						<a href="/events/" class="who-serving who-serv-altered back-to-bars" title="View All Events">
							<span class="number-serving entypo">&ccedil;</span> <span class="serving-text">Back to Events</span>
						</a>
						<span class="tap-list-name"><?php echo $event->getTitle(); ?> @ <a href="/bar/<?php echo $eventBar->getSlug(); ?>"><?php echo $eventBar->getTitle(); ?></a></span>
					</h2>
					<span class="origin">Hood: <a href="/hood/<?php echo $thisHood[0]->slug; ?>" title="<?php echo $thisHood[0]->name; ?>"><strong><?php echo $thisHood[0]->name; ?></strong></a></span>
				</div>
				<div class="bar-data">
					<p><?php echo ''.$eventBar->getAddress().' &middot; <a href="tel:'.$eventBar->getPhone().'">'.$eventBar->getPhone().'</a>'; if ($barSite) { echo ' &middot; <a href="'.$barSite.'" title="'.$eventBar->getTitle().'\'s website" target="_blank">Visit website</a>'; } ?></p>
				</div>

				<div class="event-details clearfix">
					<div class="event-date">
						<span><em>Event Date</em></span>

						<?php

						$format = date('m.d.y', strtotime($event->getDate()));

						?>

						<p><?php echo $format ?></p>
					</div>

					<div class="event-description-wrapper">
						<div class="event-description">
							<span><em>Event Description</em></span>
							<?php the_content(); ?>
						</div>

						<div class="sharin clearfix">
							<div class="share-fb">
								<div class="fb-like" data-href="<?php get_bloginfo('url'); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
							</div>
							<div class="share-tw">
								<a href="https://twitter.com/share" class="twitter-share-button" data-via="phillytapfinder">Tweet</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
							</div>
						</div>
					</div>


				</div>



				<div class="bar-map clearfix">
					<?php
						// This changes the embed link to get rid of the pop-up bubble, no matter how the user may have entered it
						$urlParsed = split_url($eventBar->getEmbedLink());
						parse_str($urlParsed['query'], $queryArray);
						$queryArray['iwloc'] = 'near';
						$queryArray['addr'] = '';
						$fixedQuery = urldecode(http_build_query($queryArray));
						$finalQuery = str_replace('addr=', 'addr', $fixedQuery);
						$urlParsed['query'] = $finalQuery;
						$finalMapURL = join_url( $urlParsed );
					?>
					<div class="map-container a-google-map">
						<iframe width="626" height="250" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="<?php echo urldecode($finalMapURL); ?>"></iframe>
						<!--div class="single-button">
							<a href="#" class="a-button"><span class="entypo">D</span>See Photos</a>
						</div-->
					</div>
					<div class="ad">
						<?php if(function_exists('the_ad_group')) the_ad_group('18693'); ?>
					</div>
				</div>
				<h3 class="tap-now">On Tap at this Event</h3>
				<ul class="grid-list clearfix">

				<?php

					$eventId = $event->getId();
					$eventBeers = Beer::getBeersByEvent($eventId);

					$sorted_beers = array();

					if(get_post_meta($post->ID, '_beers_alpha_order', true) == 'in_alpha') {
						foreach ( $eventBeers as $beer ) {
							$sorted_beers[$beer->getTitle()] = $beer;
							ksort($sorted_beers);
						}
					} else {
						$sorted_beers = $eventBeers;
					}

					foreach ( $sorted_beers as $beer ) {
						$styleArray = $beer->getStyle();
				?>

					<li>
						<div class="panel">
							<div class="panel-content clearfix">
								<div class="panel-number">
									<span class="number-serving"><?php echo Bar::getBarCountByBeer($beer->getId()); ?></span>
									<span class="serving-text">Bar(s)<br/>Serving</span>
								</div>
								<div class="panel-text">
									<h4>
										<a href="/beer/<?php echo $beer->getSlug(); ?>" title="<?php echo $beer->getTitle(); ?>"><?php echo $beer->getTitle(); ?></a>
									</h4>
									<div class="beer-meta clearfix">
										<h5>Style: <span><?php echo truncate_it(22, $styleArray[0]->name); ?></span></h5>
										<h5>Origin: <span><?php echo truncate_it(22, $beer->getOrigin()); ?></span></h5>
									</div>
									<p><?php echo truncate_it(200, $beer->getDescription()); ?></p>
								</div>
							</div>
							<div class="single-button">
								<a href="/beer/<?php echo $beer->getSlug(); ?>" class="a-button" title="View other bars serving <?php echo $beer->getTitle(); ?>"><span class="beer-icon"></span>View Other Bars Serving This Beer</a>
							</div>
						</div>
					</li>

					<?php } ?>

				</ul>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
