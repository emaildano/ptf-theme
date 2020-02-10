<?php
/*
Template Name: Search Results: Bars Page
*/
?>
<?php

	// $barsByLetter = '';
	// $sort = '';
	// $getAllBars = '';

	$currURL = curPageURL();
	if ( isset($_GET['barsByLetter']) ) {
		$barsByLetter = $_GET['barsByLetter'];
		if ( $barsByLetter == 'all' ) {
			$getAllBars = true;
		} else if ( strlen($barsByLetter) != 1 || preg_match('/[^a-z0-9]/i', $barsByLetter) ) {
			$barsByLetter = 'a';
		}
	} else {
		if ( !isset($_GET['sortByUpdated']) ) {
			$getAllBars = 'yes';
		}
	}
	if ( isset($_GET['sortByUpdated']) ) {
		$sortOption = $_GET['sortByUpdated'];
		if ( $sortOption == 'yes' ){
			$sort = true;
		}
	}
?>
<?php get_header(); ?>

	<?php get_template_part('template_search-box'); ?>

	<section id="search-results" class="viewer">
		<div class="viewer-content">

			<?php get_template_part('template_category-nav'); ?>
			<div class="alphabetical bar-alpha">
				<ul class="clearfix">

					<li class="alpha-word alpha-updated">
						<?php if (!$sort && $getAllBars) { ?>
						<a href="/bars/?sortByUpdated=yes" title="Sort bars by most recently updated">Recently<br/>Updated</a>
						<?php } else if ($sort && $getAllBars) { ?>
						<a href="<?php echo $currURL; ?>" title="Sort these bars by most recently updated" class="active-alphabet">Recently<br/>Updated</a>
						<?php } else if (!$sort && $barsByLetter) { ?>
						<a href="<?php echo $currURL.'&sortByUpdated=yes'; ?>" title="Sort these bars by most recently updated">Recently<br/>Updated</a>
						<?php } else { ?>
						<a href="<?php echo $currURL.'&sortByUpdated=yes'; ?>" title="Sort these bars by most recently updated" class="active-alphabet">Recently<br/>Updated</a>
						<?php } ?>
					</li>

					<li class="alpha-word">
						<?php if ($getAllBars || ($sort && !$barsByLetter) ) { ?>
						<a href="/bars/?barsByLetter=all" title="View all bars" class="active-alphabet">View All</a>
						<?php } else { ?>
						<a href="/bars/?barsByLetter=all" title="View all bars">View All</a>
						<?php } ?>
					</li>

					<?php
						$allLetters = theAlphabet();
						foreach ($allLetters as $letter) {
					?>

					<li>
						<?php if ( $barsByLetter == $letter ) { ?>
						<a href="/bars/?barsByLetter=<?php echo $letter; ?>" title="View all bars starting with <?php echo $letter; ?>" class="active-alphabet"><?php echo $letter; ?></a>
						<?php } else { ?>
						<a href="/bars/?barsByLetter=<?php echo $letter; ?>" title="View all bars starting with <?php echo $letter; ?>"><?php echo $letter; ?></a>
						<?php } ?>
					</li>

					<?php } ?>

				</ul>
			</div>

			<?php
				// Get the start time of the search results script.
				$start_time = microtime(true);

				// global $wpdb;
				// echo "<pre>";
				// print_r($wpdb->queries);
				// echo "</pre>";

				$getEvents = new Event($id);

				if($getEvents) {

					$now_time = microtime(true);
					$elapsed = $now_time - $start_time;

					/**
					* Get all upcoming events.
					* TODO: this call by far takes the most processing time... find a more
					* efficient way to do this.
					*/
					$allEvents = $getEvents->getAllEvents();

					$now_time = microtime(true);
					$elapsed = $now_time - $start_time;

					$numEvents = count($allEvents->all);
					$eventCounter = 0;

					/**
					* Loop through the array of events, and add the associated bar's
					* name to a tracking array.
					*/
					while($eventCounter < $numEvents) {

						$event = $allEvents->all[$eventCounter];
						$eventBarName = $event->getBar()->getTitle();
						$eventList[$eventBarName] = TRUE;

						$eventCounter++;
					}
				}
			?>

			<div class="featured-bars">
				<div class="module">
					<h2>Featured and New Bars</h2>
					<div class="results-grid tall-results">
						<ul class="clearfix">

							<?php
								$getFeatBar = new Bar();
								$FeatBar = $getFeatBar->getFeaturedBar();
								foreach ($FeatBar as $aFeatBar) {
									$theHood = array_values($aFeatBar->getNeighborhood());
							?>

							<li>
								<a href="/bar/<?php echo $aFeatBar->getSlug(); ?>" title="<?php echo $aFeatBar->getTitle(); ?>">
									<span>
										<span class="brew-loc grid-updated">Updated: <?php echo $aFeatBar->getModifiedDate($aFeatBar->getId()); ?></span>
										<?php echo truncate_it(40, $aFeatBar->getTitle()); ?>
										<span class="brew-loc"><?php echo $theHood[0]->name; ?></span>
									</span>
									<?php
									// If the bar has an upcoming event, display an event icon.

									if ($eventList[$aFeatBar->getTitle()]) { ?>
										<span class="upcoming-event"></span>
									<?php } ?>
								</a>
							</li>

							<?php } ?>

						</ul>
					</div>
				</div>
			</div>
			<div class="results-grid tall-results">

				<?php
					$getBars = new Bar();
					if ($getAllBars) {
						$Bars = $getBars->getAllBars();
					} else {
						if ($sort) {
							$Bars = $getBars->getBarsByLetter($barsByLetter, $sort);
						} else {
							$Bars = $getBars->getBarsByLetter($barsByLetter);
						}
					}
					if ( empty($Bars) ) {
				?>

				<h2 class="fallback-h">No Bars Found</h2>
				<p class="fallback"><em>We're sorry, but we couldn't find any bars for you. Please try another search.</em></p>

			<?php
				} else {
						$numBars = count($Bars);
						$barCounter = 0;

						foreach ($Bars as $Bar) {
							$theHood = array_values($Bar->getNeighborhood());
							$barCounter++;
				?>

				<?php if ($barCounter == 1) { ?>
				<ul class="clearfix">
				<?php } ?>

					<li>
						<a href="/bar/<?php echo $Bar->getSlug(); ?>" title="<?php $Bar->getTitle(); ?>">
							<span>
								<span class="brew-loc grid-updated">Updated: <?php echo $Bar->getModifiedDate($Bar->getId()); ?></span>
								<?php echo truncate_it(40, $Bar->getTitle()); ?>
								<span class="brew-loc"><?php echo $theHood[0]->name; ?></span>
							</span>
						<?php
						// If the bar has an upcoming event, display an event icon.
						if (isset($eventList[$Bar->getTitle()]) ? $eventList[$Bar->getTitle()] : '' ) { ?>
							<span class="upcoming-event"></span>
						<?php } ?>
						</a>

					</li>

					<?php if ( $barCounter == $numBars ) { ?>
					</ul>
					<?php } ?>

				<?php
					}
				}
				?>

			<?php
				// Get total time search results script took to execute.
				$finish_time = microtime(true);
				$total_time = $finish_time - $start_time;
			?>

			</div>

			<?php get_template_part('template_three-ads'); ?>

		</div>
	</section>

<?php get_footer(); ?>
