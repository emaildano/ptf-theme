<?php
	$thisBar = new Bar($post->ID);
	$neighborHood = new Neighborhood();
	$thisHood = $neighborHood->getNeighborhoodByBar($post->ID);
	$thisHood = array_values($thisHood);
	$barSite = $thisBar->getSiteURL();
?>

<?php

	$barEvents = Event::getEventsByBar($post->ID);
	$eventToday = FALSE;
	$displayBarEvent = FALSE;
	$barEventTitle = '';
	$barEventDate = '';
	$barEventSlug = '';

	if($barEvents) {

		$count = 0;
		$firstEventIndex = 0;
		$earliestEvent = $barEvents[0];
		$earliestEventIndex = 0;

		// Run through the events array and find the event with the earliest date
		foreach ($barEvents as $barEvent) {
			if($earliestEvent->getDateAltFormat() > $barEvent->getDateAltFormat()) {
				$earliestEvent = $barEvents[$count];
				$earliestEventIndex = $count;
			}
			$count++;
		}

		$displayBarEvent = TRUE;
		$barEvent = $barEvents[$earliestEventIndex];
		$barEventTitle = $barEvent->getTitle();
		$barEventDate = $barEvent->getDateAltFormat();
		$barEventSlug = $barEvent->getSlug();
		$barEventDescription = $barEvent->getDescription();

		// see if the event is today
		if (date('Ymd') == date('Ymd', strtotime($barEvent->getDate()))){
			$eventToday = TRUE;
		}

	}

?>

<?php
// If there's an event today, show the 'event today' modal.
if($eventToday == TRUE) { ?>

<div id="eventTodayModal" class="reveal-modal" style="visibility: hidden;">
	<a href="#" class="close close-reveal-modal">close</a>
	<div class="content">
		<div class="date">
			<?php echo $barEventDate; ?>
		</div>
		<div class="event-title">
			<h4><?php echo $barEventTitle; ?> is happening today at <?php echo $thisBar->getTitle(); ?></h4>
		</div>
		<div class="event-description">
			<?php
			if(!empty($barEventDescription)) {
				echo $barEventDescription;
			}
			?>
		</div>
		<div class="event-link">
			<a href="/event/<?php echo $barEventSlug; ?>" class="a-button" title="View This Event">View This Event</a>
		</div>
	</div>
</div>

<?php } ?>

<?php get_header(); ?>

<?php get_template_part('template_search-box'); ?>

	<section id="bar-detail" class="viewer">
		<div class="viewer-content">

			<?php get_template_part('template_category-nav'); ?>

			<div class="tap-list">

				<div class="the-border"></div>
				<div class="about-list clearfix">
					<h2 class="clearfix">
						<a href="/bars/" class="who-serving who-serv-altered back-to-bars" title="View All Bars">
							<span class="number-serving entypo">&ccedil;</span> <span class="serving-text">Back to Bars</span>
						</a>
						<span class="tap-list-name"><?php echo $thisBar->getTitle(); ?></span>
					</h2>
					<span class="origin">Hood: <a href="/hood/<?php echo $thisHood[0]->slug; ?>" title="<?php echo $thisHood[0]->name; ?>"><strong><?php echo $thisHood[0]->name; ?></strong></a></span>
				</div>


				<div class="data-bar">
					<div class="bar-data">
						<p><?php echo '<span class="red">Updated: '.get_the_modified_date().'</span> &middot; '.$thisBar->getAddress().' &middot; <a href="tel:'.$thisBar->getPhone().'">'.$thisBar->getPhone().'</a>'; if ($barSite) { echo ' &middot; <a href="'.$barSite.'" title="'.$thisBar->getTitle().'\'s website" target="_blank">Visit website</a>'; } ?></p>
					</div>

					<div class="sharin">
						<div class="share-fb">
							<div class="fb-like" data-href="<?php get_bloginfo('url'); ?>" data-send="false" data-layout="button_count" data-width="90" data-show-faces="false"></div>
						</div>
						<div class="share-tw">
							<a href="https://twitter.com/share" class="twitter-share-button" data-via="phillytapfinder">Tweet</a>
	<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
						</div>
					</div>
				</div>

				<br><br>



				<div class="bar-map">
					<?php
						// This changes the embed link to get rid of the pop-up bubble, no matter how the user may have entered it
						$urlParsed = split_url($thisBar->getEmbedLink());
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
					</div>

					<?php
					/**
					* Check to see if chalkboard text exists; if it does, display and hide the ad div.
					* If it doesn't, don't show the chalkboard div.
					*/
					$board = get_field('chalkboard');
					$chalkboard = FALSE;

					if($board) {
						$chalkboard = TRUE;
					}
					
					?>

					<div class="chalkboard" style="<?php if(!$chalkboard){echo('display: none;');} ?>">
						<div class="inner">
							<?php
							if($chalkboard) {
								the_field('chalkboard');
							}
							?>
						</div>
					</div>

					<div class="ad" style="<?php if($chalkboard){echo('display: none;');} ?>">
						<?php if(function_exists('the_ad_group')) the_ad_group('18693'); ?>
					</div>
				</div><!-- /.bar-map -->



				<div style="clear: both; text-align: center; padding-bottom: 20px; <?php if(!$displayBarEvent){ echo 'display: none;'; }?>">
					<div class="bar-events">
						<ul>
							<li class="first">

								<?php

								if($displayBarEvent){
									if ($eventToday) {
										echo "Today's Event At<br>";
									} else {
											echo "Next Event At<br>";
									}
								}

								?>

								<?php echo $thisBar->getTitle(); ?>
							</li>
							<li class="second"></li>
							<li class="third"><?php echo $barEventDate; ?> - <?php echo $barEventTitle; ?></li>
							<li class="fourth"><a href="/event/<?php echo $barEventSlug; ?>" class="a-button" title="View This Event">View This Event</a></li>
						</ul>
					</div>
				</div>

				<?php
					$Beers = new Beer();
					$barID = $thisBar->getId();
					$theBarBeers = $Beers->getBeersByBar($barID);
				?>

				<h3 class="tap-now">On Tap</h3>

				<?php

					$sorted_beers = array();

					if(get_post_meta($post->ID, '_beers_alpha_order', true) == 'in_alpha') {
						foreach ( $theBarBeers as $beer ) {
							$sorted_beers[$beer->getTitle()] = $beer;
							ksort($sorted_beers);
						}
					} else {
						$sorted_beers = $theBarBeers;
					}
				?>

				<ul class="grid-list clearfix">

				<?php
					foreach ( $sorted_beers as $theBarBeer ) {
						$styleArray = $theBarBeer->getStyle();
				?>
					<li>
						<div class="panel">
							<div class="panel-content clearfix">
								<div class="panel-number">
									<span class="number-serving"><?php echo $thisBar->getBarCountByBeer($theBarBeer->getId()); ?></span>
									<span class="serving-text">Bar(s)<br/>Serving</span>
								</div>
								<div class="panel-text">
									<h4>
										<a href="/beer/<?php echo $theBarBeer->getSlug(); ?>" title="<?php echo $theBarBeer->getTitle(); ?>"><?php echo $theBarBeer->getTitle(); ?></a>
									</h4>
									<div class="beer-meta clearfix">
										<h5>Style: <span><?php echo truncate_it(22, $styleArray[0]->name); ?></span></h5>
										<h5>Origin: <span><?php echo truncate_it(22, $theBarBeer->getOrigin()); ?></span></h5>
									</div>
									<p><?php echo truncate_it(200, $theBarBeer->getDescription()); ?></p>
								</div>
							</div>
							<div class="single-button">
								<a href="/beer/<?php echo $theBarBeer->getSlug(); ?>" class="a-button" title="View other bars serving <?php echo $theBarBeer->getTitle(); ?>"><span class="beer-icon"></span>View Other Bars Serving This Beer</a>
							</div>
						</div>
					</li>

					<?php } ?>

				</ul>
			</div>
		</div>
	</section>

<?php get_footer(); ?>
