<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9]>    <html class="no-js ie9 oldie" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]><!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="dns-prefetch" href="//ajax.googleapis.com" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href='//fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link href='//fonts.googleapis.com/css?family=Amatic+SC:400,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>?v=02112017" />
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
