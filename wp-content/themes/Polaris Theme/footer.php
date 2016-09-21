			<!-- footer -->
			<footer role="contentinfo">


				<div class="footer-background">
					<div class="footer-container container">

						<div class="footer-location col-xs-12 col-sm-4">
							<ul>
								<li><span>Polaris Sytems Inc.</span></li>
								<li>2220 Argentia Road, Unit #8</li>
								<li>Mississauga, ON</li>
								<li>L5N 2K7</li>
							</ul>
						</div>

						<div class="footer-logo col-xs-12 col-sm-4">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/logo_white.png" alt="" />
							<h4>The brightest star.</h4>
							<h4>We are polaris.</h4>
							<p>Polaris Systems Inc. &#169 <?php echo date('Y'); ?>, All Rights Reserved</p>
						</div>

						<div class="footer-contact col-xs-12 col-sm-4">
							<ul>
								<li><span>Contact us now</span></li>
								<li>905.542.7577</li>
								<li><a class="unstyled-link" href="http://www.polaris-systems.net/contact/">Email</a></li>
							</ul>
						</div>

					</div>

				</div>

			</footer>
			<!-- /footer -->

		<?php wp_footer(); ?>

		<!-- analytics -->
		<script>
			(function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
			(f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
			l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
			ga('send', 'pageview');
		</script>

		<!-- JQUERY -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<!-- <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script> -->


		<!-- FRAMEWORKS -->
		<!-- <script src="<?php echo get_template_directory_uri(); ?>/js/vendor/modernizr-2.8.3.min.js"></script> -->
		<script src="<?php echo get_template_directory_uri(); ?>/frameworks/bootstrap-3.3.7/js/bootstrap.min.js"></script>

		<!-- CUSTOM SCRIPTS -->
		<script src="<?php echo get_template_directory_uri(); ?>/js/main.js"></script>



	</body>
</html>
