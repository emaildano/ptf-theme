<?php if ( is_front_page() ) { ?>

<!-- <form class="clearfix" autocomplete="off" id="primary-search">
	<div class="input-holder">
		<label style="visibility: hidden;" for="searchpft">Find your next craft beer 🍻</label>
		<input placeholder="Find your next craft beer 🍻" type="text" name="searchptf" id="searchptf" />
		<span class="entypo">&ocirc;</span>
	</div>
	<input type="submit" class="submit-style" value="Search Craft Beers On Tap" />
	<div class="search-auto-fills home-search-drop">
		<div class="search-auto-lists">
			<ul id="search-tap-list">
				<li class="auto-list-title">On Tap</li>
			</ul>
			<ul id="search-style-list">
				<li class="auto-list-title">Styles</li>
			</ul>
			<ul id="search-bar-list">
				<li class="auto-list-title">Bars</li>
			</ul>
			<ul id="search-hood-list">
				<li class="auto-list-title">Hoods</li>
			</ul>
			<ul id="no-results">
				<li class="auto-list-title">Where's my firkin beer? Sorry, no search results found.</li>
			</ul>
		</div>	
		<div class="loader"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/ajax-loader.gif" /></div>
	</div>
</form> -->

<form role="search" method="get" class="search-form" action="https://d2w9ysu1vm5q9f.cloudfront.net/">
	<label>
		<span style="visibility: hidden; display: none;" class="screen-reader-text">Find your next craft beer 🍻:</span>
		<input type="search" class="search-field aa-input input-holder" placeholder="Find your next craft beer 🍻" value="" name="s" autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style=""><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: NonBreakingSpaceOverride, &quot;Hoefler Text&quot;, &quot;Baskerville Old Face&quot;, Garamond, &quot;Times New Roman&quot;, serif; font-size: 22px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: normal; text-indent: 0px; text-rendering: optimizelegibility; text-transform: none;"></pre>
	</label>
</form>

<?php } else { ?>

<section id="search-box">
	<div class="page-container">
		<h1 class="hidden">Search Results</h1>
		<!-- <form class="clearfix" autocomplete="off" id="primary-search">
			<div class="input-holder">
				<label for="searchpft">Find your next craft beer 🍻</label>
				<input type="text" name="searchptf" id="searchptf"/>
				<span class="entypo">&ocirc;</span>
			</div>
			<div class="search-auto-fills">
				<div class="search-auto-lists">
					<ul id="search-tap-list">
						<li class="auto-list-title">On Tap</li>
					</ul>
					<ul id="search-style-list">
						<li class="auto-list-title">Styles</li>
					</ul>
					<ul id="search-bar-list">
						<li class="auto-list-title">Bars</li>
					</ul>
					<ul id="search-hood-list">
						<li class="auto-list-title">Hoods</li>
					</ul>
					<ul id="no-results">
						<li class="auto-list-title">Where's my firkin beer? Sorry, no search results found.</li>
					</ul>
				</div>
				<div class="loader"><img src="<?php bloginfo( 'stylesheet_directory' ); ?>/img/ajax-loader.gif" /></div>
			</div>
		</form> -->

		<form role="search" method="get" class="search-form" action="https://d2w9ysu1vm5q9f.cloudfront.net/">
			<label>
				<span style="visibility: hidden; display: none;" class="screen-reader-text">Find your next craft beer 🍻:</span>
				<input type="search" class="search-field aa-input input-holder" placeholder="Find your next craft beer 🍻" value="" name="s" autocomplete="off" spellcheck="false" role="combobox" aria-autocomplete="list" aria-expanded="false" aria-owns="algolia-autocomplete-listbox-0" dir="auto" style=""><pre aria-hidden="true" style="position: absolute; visibility: hidden; white-space: pre; font-family: NonBreakingSpaceOverride, &quot;Hoefler Text&quot;, &quot;Baskerville Old Face&quot;, Garamond, &quot;Times New Roman&quot;, serif; font-size: 22px; font-style: normal; font-variant: normal; font-weight: 400; word-spacing: 0px; letter-spacing: normal; text-indent: 0px; text-rendering: optimizelegibility; text-transform: none;"></pre>
			</label>
		</form>

	</div>
</section>

<?php } ?>
<script id="search-tap-tmpl" type="text/x-jquery-tmpl">
	<li>
		<a href="${link}">${name}</a>
	</li>
</script>

<script id="search-style-tmpl" type="text/x-jquery-tmpl">
	<li>
		<a href="/style/${link}">${name}</a>
	</li>
</script>
<script id="search-bar-tmpl" type="text/x-jquery-tmpl">
	<li>
		<a href="${link}">${name}</a>
	</li>
</script>
<script id="search-hood-tmpl" type="text/x-jquery-tmpl">
	<li>
		<a href="/hood/${link}">${name}</a>
	</li>
</script>