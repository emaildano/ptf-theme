<?php
/*
Template Name: Search Results: On Tap Page
*/
?>
<?php
	if ( isset($_GET['breweriesByLetter']) ) {
		$breweriesByLetter = $_GET['breweriesByLetter'];
		if ( $breweriesByLetter == 'all' ) {
			$getAllBreweries = true;
		} else if ( strlen($breweriesByLetter) != 1 || preg_match('/[^a-z0-9]/i', $breweriesByLetter) ) {
			$breweriesByLetter = 'a';
		}
	} else {
		$breweriesByLetter = null;
		$getAllBreweries = true;
	}
?>

<?php get_header(); ?>

	<?php get_template_part('template_search-box'); ?>

	<section id="search-results" class="viewer">
		<div class="viewer-content">

			<?php get_template_part('template_category-nav'); ?>

			<div class="alphabetical">
				<ul class="clearfix">

					<li class="alpha-word">
						<?php if ($getAllBreweries) { ?>
						<a href="/on-tap/?breweriesByLetter=all" title="View all beers" class="active-alphabet">View All</a>
						<?php } else { ?>
						<a href="/on-tap/?breweriesByLetter=all" title="View all beers">View All</a>
						<?php } ?>
					</li>

					<?php
						$allLetters = theAlphabet();
						foreach ($allLetters as $letter) {
					?>

					<li>
						<?php if ( $breweriesByLetter == $letter ) { ?>
						<a href="/on-tap/?breweriesByLetter=<?php echo $letter; ?>" title="View all beers starting with <?php echo $letter; ?>" class="active-alphabet"><?php echo $letter; ?></a>
						<?php } else { ?>
						<a href="/on-tap/?breweriesByLetter=<?php echo $letter; ?>" title="View all beers starting with <?php echo $letter; ?>"><?php echo $letter; ?></a>
						<?php } ?>
					</li>

					<?php } ?>

				</ul>
			</div>
			<h2 class="breweries-h">Breweries</h2>
			<div class="results-grid">

					<?php
						$getBreweries = new Brewery();
						$getBeer = new Beer();
						if ($getAllBreweries) {
							$Breweries = $getBreweries->getAllBreweries();
						} else {
							$Breweries = $getBreweries->getBreweriesByLetter($breweriesByLetter);
						}
						if ( empty($Breweries) ) {
					?>

					<h2 class="fallback-h">No Beers Found</h2>
					<p class="fallback"><em>We're sorry, but we couldn't find any beers for you. Please try another search.</em></p>

					<?php
						} else {
							$numBrews = count($Breweries);
							$brewsCounter = 0;
							foreach ($Breweries as $Brewery) {
								$thisBrewBeers = $getBeer->getBeersByBrewery($Brewery->slug);
								$brewsCounter++;
					?>

					<?php if ($brewsCounter == 1) { ?>
					<ul class="clearfix">
					<?php } ?>

						<li>
							<a href="/brewery/<?php echo $Brewery->slug; ?>" title="<?php $Brewery->name; ?>">
								<span><?php echo truncate_it(40, $Brewery->name); ?><br/><span class="brew-loc"><?php echo $thisBrewBeers[0]->getOrigin(); ?></span></span>
							</a>
						</li>

					<?php if ( $numBrews == $brewsCounter ) { ?>
					</ul>
					<?php } ?>

					<?php
						}
					}
					?>

			</div>

			<?php get_template_part('template_three-ads'); ?>

		</div>
	</section>

<?php get_footer(); ?>