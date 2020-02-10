<?php
/*
Template Name: Search Results: Events Page
*/
?>
<?php
	$currURL = curPageURL();
	if ( isset($_GET['eventsByLetter']) ) {
		$eventsByLetter = $_GET['eventsByLetter'];
		if ( $eventsByLetter == 'all' ) {
			$getAllEvents = true;
		} else if ( strlen($eventsByLetter) != 1 || preg_match('/[^a-z0-9]/i', $eventsByLetter) ) {
			$eventsByLetter = 'a';
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

					<li class="alpha-word">
						<?php if ($getAllEvents || !$eventsByLetter) { ?>
						<a href="/events/" title="View all events" class="active-alphabet">View All</a>
						<?php } else { ?>
						<a href="/events/" title="View all events">View All</a>
						<?php } ?>
					</li>

					<?php
						$allLetters = theAlphabet();
						foreach ($allLetters as $letter) {
					?>

					<li>
						<?php if ( $eventsByLetter == $letter ) { ?>
						<a href="/events/?eventsByLetter=<?php echo $letter; ?>" title="View all events starting with <?php echo $letter; ?>" class="active-alphabet"><?php echo $letter; ?></a>
						<?php } else { ?>
						<a href="/events/?eventsByLetter=<?php echo $letter; ?>" title="View all events starting with <?php echo $letter; ?>"><?php echo $letter; ?></a>
						<?php } ?>
					</li>

					<?php } ?>

				</ul>
			</div>

			<?php

				if(!isset($eventsByLetter)){
					$allEvents = Event::getAllEvents();
				}else{
					$allEvents = Event::getAllEvents($eventsByLetter);
				}



			?>



			<div class="featured-bars">
				<div class="module">
					<h2>Upcoming Events</h2>
				</div>
			</div>



			<div class="results-grid tall-results">

				<?php if (empty($allEvents->all)) { ?>

				<h2 class="fallback-h">No Events Found</h2>
				<p class="fallback"><em>We're sorry, but we couldn't find any upcoming events. Please try another search.</em></p>

				<?php } else { ?>

				<ul class="clearfix">

				<?php
						foreach ($allEvents->all as $event) {
							$bar = $event->getBar();
				?>

					<li>
						<a href="/event/<?php echo $event->getSlug(); ?>" title="<?php echo $event->getTitle(); ?>">
							<span>
								<span class="brew-loc grid-updated">Event Date: <?php echo $event->getDate(); ?></span>
								<?php echo truncate_it(40, $event->getTitle()); ?>
								<span class="brew-loc"><?php echo $bar->getTitle() ?></span>
							</span>
						</a>
					</li>

				<?php } ?>

				</ul>

				<?php } ?>

			</div>

			<?php get_template_part('template_three-ads'); ?>

		</div>
	</section>

<?php get_footer(); ?>
