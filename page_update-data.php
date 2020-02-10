<?php
/*
Template Name: Update Data
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
				<h2>Upload</h2>
	        	<div class="entry-content">
	            	<?php
					
						if(isset($_POST['process'])){
							$importer = new Import();
							$importer->upload();
					
					?>				
					<p><?php echo $importer->getHoodCount() ?> Hoods Imported</p>			
					<p><?php echo $importer->getStyleCount() ?> Styles Imported</p>			
					<p><?php echo $importer->getBrewCount() ?> Breweries Imported</p>			
					<p><?php echo $importer->getBeerCount() ?> Beers Imported</p>			
					<p><?php echo $importer->getBarCount() ?> Bars Imported</p>			
					<?php } ?>

					<div class="admin-searchform">
						<form action="" method="post" name="Import" enctype="multipart/form-data">
							<input type="hidden" name="process" value="uploadFile" />
							<p>
								<label>Neighborhoods</label>
								<input type="file" name="hoodcsv" />
							</p>
							<p>
								<label>Beer Styles</label>
								<input type="file" name="stylecsv" />
							</p>
							<p>
								<label>Breweries</label>
								<input type="file" name="breweriesscsv" />
							</p>
							<p>
								<label>Beers</label>
								<input type="file" name="beerscsv" />
							</p>
							<p>
								<label>Bars</label>
								<input type="file" name="barscsv" />
							</p>
							
							<p>
								<input class="submit-style" type="submit" value="Submit All" />
							</p>
						</form>
					</div>
	            </div><!--! end of entry-content -->
				
				
				
				
				
	    	</article>
	    	
	    	<?php endwhile; // End the loop. Whew. ?>
		</section>
	</div>

<?php get_footer(); ?>

			
								