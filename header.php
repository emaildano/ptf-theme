<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="dns-prefetch" href="//ajax.googleapis.com" />
	<link rel="dns-prefetch" href="//fonts.googleapis.com" />
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://fonts.googleapis.com/css?family=Amatic+SC|Open+Sans|Oswald&display=swap" rel="stylesheet">
	<?php wp_head(); ?>
</head>
<body>
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
