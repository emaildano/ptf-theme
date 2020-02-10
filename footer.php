		</div>
		<footer id="main-footer">
			<?php wp_nav_menu(array('theme_location' => 'footer-menu', 'container' => 'nav', 'menu_class' => 'menu clearfix', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s<h1 class="hidden">Footer Navigation</h1></ul>')); ?>
			<div class="page-container">
				<form action="https://phillytapfinder.us4.list-manage.com/subscribe/post?u=8f36e70d5e654a62583bc8d6f&amp;id=aaed126f63" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate clearfix" target="_blank">
					<div class="input-wrapper">
						<div class="input-holder">
							<!--<label for="EMAIL">Sign up for PTF Insiders' Newsletter</label>-->
							<input type="email" value="" name="EMAIL" class="required email"
								id="mce-EMAIL" placeholder="SIGN UP FOR PTF INSIDER'S NEWSLETTER"/>
						</div>
						<div class="submit-holder">
							<input type="submit" class="submit-style" value="SIGN UP"/>
						</div>
						<div id="mce-responses" class="clear">
							<div class="response" id="mce-error-response" style="display:none"></div>
							<div class="response" id="mce-success-response" style="display:none"></div>
						</div>
					</div>
				</form>

				<div id="menu-outer">
				  <div class="table">
				    <ul id="horizontal-list">
				      <li class="twitter"><a href="http://twitter.com/phillytapfinder" target="_blank"></a></li>
				      <li class="facebook"><a href="http://www.facebook.com/PhillyTapFinder" target="_blank"></a></li>
				      <li class="email"><a href="mailto:?subject=CheckoutPhiladelphia'sCraftBeerLocator&amp;body=Ithoughtyoumaylikehttp://www.PhillyTapFinder.com,Philadephia'sgo-tosourceforfindingcraftbeerscurrentlyontap." target="_blank"></a></li>
				    </ul>
				  </div>
				</div>

				<p class="copyright">All Rights Reserved Philly Tap Finder LLC. <?php echo date('Y') ?></p>

				<?php //wp_nav_menu(array('theme_location' => 'social-menu', 'container' => 'nav', 'menu_class' => 'menu clearfix', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s<h1 class="hidden">Social Navigation</h1></ul>')); ?>
			</div>
		</footer>
	</div> <!--! end of #container -->

	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
	<script defer src="<?php bloginfo( 'template_directory' ); ?>/js/plugins.js?v=2"></script>
	<script defer src="<?php bloginfo( 'template_directory' ); ?>/js/script.js?v=2.0.3"></script>

	<!--[if lt IE 7 ]>
	<script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
	<script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
	<![endif]-->
<?php wp_footer(); ?>

<!-- nyc2 server -->

</body>
</html>
