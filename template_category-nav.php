<nav class="by-category">
	<ul class="clearfix">
		<li<?php if ( is_page_template('page_search-results-bar.php') || is_singular('ptf_bars') ) { echo ' class="active-category"'; } ?>>
			<span class="hover-arrow"></span>
			<a href="/bars">
				<div class="rotated clearfix">
					<span>Bars</span>
				</div>
			</a>
		</li>
		<li<?php if (is_page_template('page_search-results-tap.php') || is_singular('ptf_beers') || is_tax('ptf_breweries') ) { echo ' class="active-category"'; } ?>>
			<span class="hover-arrow"></span>
			<a href="/on-tap">
				<div class="rotated clearfix">
					<span>On Tap</span>
				</div>
			</a>
		</li>
		<li<?php if (is_page_template('page_search-results-style.php') || is_tax('ptf_beer_style')) { echo ' class="active-category"'; } ?>>
			<span class="hover-arrow"></span>
			<a href="/styles">
				<div class="rotated clearfix">
					<span>Styles</span>
				</div>
			</a>
		</li>
		<li<?php if (is_page_template('page_search-results-hood.php') || is_tax('ptf_hoods')) { echo ' class="active-category"'; } ?>>
			<span class="hover-arrow"></span>
			<a href="/hoods">
				<div class="rotated clearfix">
					<span>Hoods</span>
				</div>
			</a>
		</li>
		<li<?php if ( is_page_template('page_search-results-event.php') || is_singular('ptf_events') ) { echo ' class="active-category"'; } ?>>
			<span class="hover-arrow"></span>
			<a href="/events">
				<div class="rotated clearfix">
					<span>Events</span>
				</div>
			</a>
		</li>
	</ul>
</nav>
