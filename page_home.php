<?php
/*
Template Name: Home Page
*/
?>
<?php get_header(); ?>

	<section id="main-search">
		<div class="page-container">
		<?php while ( have_posts() ) : the_post(); // Start Loop ?>
			<?php echo get_the_content(); ?>
		<?php endwhile; // End the loop. Whew. ?>
			<?php get_template_part('template_homepage-nav'); ?>
			<?php get_template_part('template_search-box'); ?>
		</div>
	</section>

	<?php
		$getFeatBar = new Bar();
		$FeatBar = $getFeatBar->getHomeFeaturedBar();
		$beerArray = $FeatBar[0]->getBeers();
		$beerLimit = 0;

		$theBeers = array();

		foreach ( $beerArray as $beer ) {
                    $temp = array('title' => $beer->getTitle(), 'slug' => $beer->getSlug());
                    array_push($theBeers, $temp);
			$beerLimit++;
			if ( $beerLimit == 12 ) {
				break;
			}
		}
	?>

<?php
	$getFeatBeer = new Beer();
	$FeatBeer = $getFeatBeer->getFeaturedBeerOrBrewery();
	$beerDescription = $FeatBeer->payload[0]->getDescription();
	$beerTitle = $FeatBeer->payload[0]->getTitle();

	$bloginfo = get_bloginfo('template_url');
	$image_link = get_post_meta($FeatBeer->payload[0]->getId(), "image-link");
	$featured_beer_large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($FeatBeer->payload[0]->getId()), 'full');

	if ( $FeatBeer->type === 'brewery' ) {
		$beerSlug = '/brewery/'.$FeatBeer->payload[0]->getSlug();
	} else {
		$beerSlug = '/beer/'.$FeatBeer->payload[0]->getSlug();
	}
?>

	<section id="featured">
		<div class="page-container">
			<div class="see-through-container clearfix">

				<div class="header-wrapper">
					<div class="module-headers">
						<div class="module-header first">
							<h3>Featured Bar</h3>

							<script>
								console.log("Featured Bar: <?php echo $FeatBar[0]->getTitle(); ?>");
							  window.ga('send', 'event', 'Ad', 'Viewed', "Featured Bar: <?php echo $FeatBar[0]->getTitle(); ?>");
							</script>

							<h2><?php echo $FeatBar[0]->getTitle(); ?></h2>
							<small><?php echo $FeatBar[0]->getAddress(); ?></small>
						</div>
						<div class="module-header">
							<h3>Featured Brewery</h3>
							<h2><?php echo $beerTitle; ?></h2>
							<script>
								console.log("Featured Brewery: <?php echo $beerTitle; ?>");
								window.ga('send', 'event', 'Ad', 'Viewed', "Featured Brewery: <?php echo $beerTitle; ?>");
							</script>
							<small><?php echo $FeatBeer->payload[0]->getOrigin(); ?></small>
						</div>
					</div><!-- /.module-headers -->
				</div>

				<div class="module-content-wrapper">
					<div class="module-contents">
						<div class="module module-first">
							<div class="module-content">
								<div class="entry-content clearfix">
									<?php $bloginfo = get_bloginfo('template_url'); ?>

									<?php
										$large_image_url = wp_get_attachment_image_src( get_post_thumbnail_id($FeatBar[0]->getId()), 'full');
									?>

									<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $FeatBar[0]->getId() ), 'feat-bar-thumbnail' ); ?>
										<div class="image-container">
											<div class="center-cropped" style="background-image: url('<?php echo $large_image_url[0]; ?>');">
										</div>
									</div>
								</div>
							</div>
						</div><!-- ./module -->

						<div class="module feat-beer-brew-mod">
							<div class="module-content">
								<div class="entry-content clearfix">
								<?php if($image_link) { ?>
									<a href="<?php echo $image_link[0]; ?>" target="_blank">
								<?php	} ?>
									<div class="image-container">
										<div class="center-cropped"
											style="background-image: url('<?php echo $featured_beer_large_image_url[0]; ?>');"></div>
									</div>
								<?php if($image_link) { ?>
									</a>
								<?php } ?>
								</div>
							</div>
							</div>
						</div><!-- /.module-contents -->
					</div>

					<div class="module-footer">
						<div class="module-descriptions">
							<div class="module-description first">
								<div class="module-buttons multiple-buttons clearfix">
									<a href="/bar/<?php echo $FeatBar[0]->getSlug(); ?>" class="a-button homepage-featured-bar" data-featured-bar-title="<?php echo $FeatBar[0]->getTitle(); ?>" title="View beers available at <?php echo $FeatBar[0]->getTitle(); ?>">View Bar</a>
									<a href="<?php echo $FeatBar[0]->getMapLink(); ?>" class="a-button" title="View map of <?php echo $FeatBar[0]->getTitle(); ?> at Google Maps" target="_blank">View Map</a>
								</div>
								<div class="description beers-on-tap">
								<h3>
									Beers
									<span>on Tap</span>
								</h3>
									<ul class="beer-list">
									<?php foreach ($theBeers as $beer) { ?>
										<li><a href="/beer/<?php echo $beer['slug'] ?>"   ><?php echo $beer['title'] ?></a></li>
									<?php } ?>
									</ul>
								</div>
							</div>
							<div class="module-description">
								<div class="module-buttons single-button clearfix second">
									<a href="<?php echo $beerSlug; ?>" class="a-button homepage-featured-brewery" data-featured-brewery-title="<?php echo $beerTitle; ?>" title="View bars serving <?php echo $beerTitle; ?>">See where it's pouring</a>
									<div class="description featured-beer-brewery">
										<?php
                      if ( $beerDescription != '' ) {
                        echo $beerDescription;
                      } else {
                        echo '<p class="fallback"><em>Description not currently available.</em></p>';
                      }
                     ?>
									</div>
								</div>
							</div>
						</div>
					</div><!-- ./module-footer -->

			</div>
		</div>
	</section>

	<div class="latest-blog-wrapper">
		<div class="latest-blog">
		<h2 class="intro">
			<span class="the-latest">The Latest From</span>
			<span>The Tap Talk Blog</span>
		</h2>

			<h2 class="clearfix">
				<div class="latest-links">
					<div class="links-pane">
						<?php
							$homepage_id = get_option('page_on_front');

							$blog_title_1 = get_post_meta($homepage_id, "blog_full_title_1", true);
							$blog_link_1 = get_post_meta($homepage_id, "blog_link_1", true);
							$blog_short_title_1 = get_post_meta($homepage_id, "blog_short_title_1", true);

							$blog_title_2 = get_post_meta($homepage_id, "blog_full_title_2", true);
							$blog_link_2 = get_post_meta($homepage_id, "blog_link_2", true);
							$blog_short_title_2 = get_post_meta($homepage_id, "blog_short_title_2", true);

							$blog_title_3 = get_post_meta($homepage_id, "blog_full_title_3", true);
							$blog_link_3 = get_post_meta($homepage_id, "blog_link_3", true);
							$blog_short_title_3 = get_post_meta($homepage_id, "blog_short_title_3", true);
						?>

						<a href="<?php echo $blog_link_1; ?>" title="<?php echo $blog_title_1; ?>" target="_blank" data-link-number="3"><?php echo $blog_short_title_1; ?></a>
						<a href="<?php echo $blog_link_2; ?>" title="<?php echo $blog_title_2; ?>" target="_blank" data-link-number="3"><?php echo $blog_short_title_2; ?></a>
						<a href="<?php echo $blog_link_3; ?>" title="<?php echo $blog_title_3; ?>" target="_blank" data-link-number="3"><?php echo $blog_short_title_3; ?></a>

					</div>
				</div>
			</h2>
		</div>
	</div>

<?php get_footer(); ?>
