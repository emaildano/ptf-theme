<?php
/*
Template Name: Bar Detail Page
*/
?>
<?php get_header(); ?>

	<?php get_template_part('template_search-box'); ?>
	
	<section id="bar-detail" class="viewer">
		<div class="viewer-content">
			
			<?php get_template_part('template_category-nav'); ?>
			
			<div class="tap-list">
				<div class="the-border"></div>
				<div class="about-list clearfix">
					<h2 class="clearfix">
						<span class="tap-list-name">The Beer Hive</span>
					</h2>
					<span class="origin">Hood: <strong>Strip District/Downtown</strong></span>
				</div>
				<div class="bar-map clearfix">
					<div class="map-container">
						<iframe width="626" height="210" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=beerhive+pittsburgh&amp;aq=&amp;sll=40.76646,-111.891318&amp;sspn=0.091269,0.178528&amp;ie=UTF8&amp;hq=beerhive&amp;hnear=Pittsburgh,+Allegheny,+Pennsylvania&amp;t=m&amp;ll=40.452368,-79.983988&amp;spn=0.013716,0.053644&amp;z=14&amp;iwloc=near&addr&amp;output=embed"></iframe>
						<div class="single-button">
							<a href="#" class="a-button"><span class="entypo">D</span>See Photos</a>
						</div>
					</div>
					<div class="ad">
						<?php if(function_exists('the_ad_group')) the_ad_group('18693'); ?>
					</div>
				</div>
				<h3 class="tap-now">On Tap</h3>
				<ul class="grid-list clearfix">
					<li>
						<div class="panel">
							<span class="updated">Last Updated: 04/23/12</span>
							<div class="panel-content clearfix">
								<div class="panel-number">
									<span class="number-serving">21</span>
									<span class="serving-text">Bars<br/>Serving</span>
								</div>
								<div class="panel-text">
									<h4>Name of Something</h4>
									<p>Experience a contemporary rendition of a classic style. Hopped with purpose, Joe's is beautifully bitter and dry with an abundance of floral, noble German hops. 4.7% ABV.</p>
								</div>
							</div>
							<div class="single-button">
								<a href="#" class="a-button"><span class="beer-icon"></span>View Other Bars Serving This Beer</a>
							</div>
						</div>
					</li>
					<li>
						<div class="panel">
							<span class="updated">Last Updated: 04/23/12</span>
							<div class="panel-content clearfix">
								<div class="panel-number">
									<span class="number-serving">21</span>
									<span class="serving-text">Bars<br/>Serving</span>
								</div>
								<div class="panel-text">
									<h4>Name of Something</h4>
									<p>Experience a contemporary rendition of a classic style. Hopped with purpose, Joe's is beautifully bitter and dry with an abundance of floral, noble German hops. 4.7% ABV.</p>
								</div>
							</div>
							<div class="single-button">
								<a href="#" class="a-button"><span class="beer-icon"></span>View Other Bars Serving This Beer</a>
							</div>
						</div>
					</li>
					<li>
						<div class="panel">
							<span class="updated">Last Updated: 04/23/12</span>
							<div class="panel-content clearfix">
								<div class="panel-number">
									<span class="number-serving">21</span>
									<span class="serving-text">Bars<br/>Serving</span>
								</div>
								<div class="panel-text">
									<h4>Name of Something</h4>
									<p>Experience a contemporary rendition of a classic style. Hopped with purpose, Joe's is beautifully bitter and dry with an abundance of floral, noble German hops. 4.7% ABV.</p>
								</div>
							</div>
							<div class="single-button">
								<a href="#" class="a-button"><span class="beer-icon"></span>View Other Bars Serving This Beer</a>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</section>

<?php get_footer(); ?>