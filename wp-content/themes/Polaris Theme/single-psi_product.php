<?php
/*
Template Name: Product Page
*/
?>

<?php get_header(); ?>

	<!-- START OF LOOP -->
	<?php

		// define the post type for the loop
		$args = array( 'post_type' => 'psi_product' );
		// Create a new WP loop query and hand it the custom post type arguments
		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();

	?>

	<article id="post-<?php the_ID(); ?>" class="container">

			<div class="row">

				<div class="col-xs-12">
					<h3 class="color-accent-baby-blue">Products / strapping Machines / Dynaric DF30</h3>
					<hr>
				</div>

			</div>


			<header class="row">
				<div class="col-xs-12">
					<div class="float-left">
						<h2><?php the_title(); ?></h2>
						<h3 class="font-weight-reg">Semi-Automatic Strapping Machine</h3 class="no-bold">
					</div>

					<div class="supplier-logo-container float-right">
						<img class="vertical-center" src="assets/dynaric.png" alt="" />
					</div>

				</div>

				<div class="col-xs-12">
					<p class="bigger-text">
						An economical, easy to use strapping machine designed to run 1/4 ”– 5/8” strapping. Equipped with externally adjustable strap feed and electronic tension control, the DF-30 is the perfect machine for securing and unitizing outgoing shipments.Offering added safety for the operator the DF30 has been redesigned with rounded corners, as well as an audible cycle alert safety signal. An "ACASS" is given when the strap has been inserted into the sealing mechanism prior to tensioning.
					</p>
				</div>
			</header>

	</article>

	<!-- END OF LOOP -->
	<?php endwhile; else: ?>
		<p><?php _e( 'The product you are looking for could not be found.' ); ?></p>
	<?php endif; ?>

<?php get_footer(); ?>
