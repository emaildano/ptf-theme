<?php
/*
Template Name: Test Data
*/
?>

<?php get_header(); ?>
			
	<div class="column-container clearfix">
		<section class="wide-column">
	    	<?php while ( have_posts() ) : the_post(); // Start Loop ?>
	    	
	    	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	    		<header>
	    			<h1><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
	    		</header>
				<h2>Test</h2>
	        	<div class="entry-content">
	            	
					
				<?php
				
				//instantiate 
				//get Beer by wordpress ID, get different properties
				//$beer = new Beer(36721);
				
				//$title = $beer->getTitle(); //string
				//$brewery = $beer->getBrewery(); //array
				//$styles = $beer->getStyle(); //array
							
				//get all Styles
				//$styles = $beer->getAllStyles();
				
				//get Beer listing by Style
				//$beersByStyle = Beer::getBeersByStyle('american-strong-ale');
				
				//print_r($styles);
				
				//$beersByBrewery = Beer::getBeersByBrewery('4-hands');
				
				//print_r($beersByBrewery);
				
				//print_r(Brewery::getBreweriesByLetter('a'));
				
				//print_r(Beer::getFeaturedBeer(3));
				
				
				//$bar = new Bar(36805);
				
				//print_r($bar->getBeers());
				
				//print_r(Bar::getBarsByLetter('b'));
				
				
				
				//print_r(Neighborhood::getAllNeighborhoods());
				
				//print_r(Bar::getBarsByNeighborhood('old-city'));
				
				//print_r(Bar::getBarCountByBeer(33156));
				
				//print_r(Bar::getBarCountByBrewery('dogfish-head'));
				
				//print_r(Bar::getFeaturedBar());
				
				print_r(Beer::getBeersByBar(36806));
				
				
				?>
					
	            </div><!--! end of entry-content -->
	    	</article>
	    	
	    	<?php endwhile; // End the loop. Whew. ?>
		</section>
	</div>

<?php get_footer(); ?>

			
								