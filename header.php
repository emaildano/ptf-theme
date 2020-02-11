<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="dns-prefetch" href="//ajax.googleapis.com" /><!-- A DNS "handshake" to speed things up -->
	<!-- Use the .htaccess and remove these lines to avoid edge case issues. More info: h5bp.com/b/378 -->
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<title>
		<?php np_pageTitle(); ?>
	</title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />

	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=02112017" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<link href='//fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Amatic+SC:400,700' rel='stylesheet' type='text/css'>

	<?php if ( is_singular('ptf_beers') ) { ?>
	<meta property="og:title" content="<?php np_pageTitle(); ?>" /><!-- FB Open Graph biz, using some sensible defaults -->
	<meta property="og:type" content="drink" />
	<meta property="og:url" content="<?php echo get_permalink($post->ID); ?>" />
	<meta property="og:image" content="<?php echo get_template_directory_uri() ?>/img/ir_logo.png" />
	<meta property="og:site_name" content="PhillyTapFinder.com" />
	<?php $post_object = get_post( $post->ID ); // Get post content to use as description ?>
	<meta property="og:description" content="<?php echo strip_tags($post_object->post_content); ?>" />
	<meta property="fb:admins" content="1216007741" />

	<?php } else if ( is_singular('ptf_bars') ) { ?>
	<meta property="og:title" content="<?php np_pageTitle(); ?>" /><!-- FB Open Graph biz, using some sensible defaults -->
	<meta property="og:type" content="bar" />
	<meta property="og:url" content="<?php echo get_permalink($post->ID); ?>" />
	<meta property="og:image" content="<?php echo get_template_directory_uri() ?>/img/ir_logo.png" />
	<meta property="og:site_name" content="PhillyTapFinder.com" />
	<meta property="og:description" content="<?php np_pageTitle(); ?>" />
	<meta property="fb:admins" content="1216007741" />

	<?php } else { ?>
	<meta property="og:title" content="<?php echo get_bloginfo('name'); ?>" /><!-- FB Open Graph biz, using some sensible defaults -->
	<meta property="og:type" content="website" />
	<meta property="og:url" content="<?php echo get_bloginfo('url'); ?>" />
	<meta property="og:image" content="<?php echo get_template_directory_uri() ?>/img/ir_logo.png" />
	<meta property="og:site_name" content="<?php echo get_bloginfo('name'); ?>" />
	<meta property="og:description" content="<?php echo get_bloginfo('description'); ?>" />
	<meta property="fb:admins" content="1216007741" />
	<?php } ?>
	<link rel="alternate" type="application/rss+xml" title="RSS Feed fo <?php bloginfo('name'); ?>" href="<?php bloginfo('rss2_url'); ?>" /><!--RSS link-->

	<script>
		window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
		ga('create', 'UA-16618962-1', 'auto');
		ga('send', 'pageview');
	</script>
	<script async src='https://www.google-analytics.com/analytics.js'></script>
	<script src="<?php bloginfo( 'template_directory' ); ?>/js/libs/modernizr-2.0.6.min.js"></script>

	<?php wp_head(); ?>
</head>
<?php
	if ( is_tax( 'ptf_beer_style' ) ) {
		$taxID = $wp_query->queried_object->term_id;
?>
<body <?php body_class(); ?> data-id="<?php echo $taxID; ?>">
<?php
	} else if ( is_tax( 'ptf_hoods' ) ) {
		$taxID = $wp_query->queried_object->term_id;
?>
<body <?php body_class(); ?> data-id="<?php echo $taxID; ?>">
<?php } else { ?>
<body <?php body_class(); ?> data-id="<?php echo $wp_query->post->ID; ?>">
<?php } ?>
<!-- BS for the FB like button -->
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=404063009649497";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<div id="container">
		<header id="main-header">
			<div class="page-container">
				<h1>
					<a href="<?php bloginfo( 'url' ); ?>" title="<?php bloginfo( 'name' ); ?>" class="ir"><?php bloginfo( 'name' ); ?></a>
				</h1>
				<div class="ad-leaderboard">
					<?php if(function_exists('the_ad_group')) the_ad_group('18692'); ?>
				</div>
			</div>
		</header>
		<div class="bg-container">
