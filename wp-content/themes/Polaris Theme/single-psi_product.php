<?php
/*
Template Name: Product Page
*/
?>

<?php get_header(); ?>

	<!-- START OF LOOP -->
	<?php

		// define the post type for the loop
		$args = array(
			'post_type' => 'psi_product',
			'supports' => array('title','editor','thumbnail','custom-fields')
		);

		// Create a new WP loop query and hand it the custom post type arguments
		$loop = new WP_Query( $args );

		if ( $loop->have_posts() ) : while ( $loop->have_posts() ) : $loop->the_post();

	?>

	<article class="container">


			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
			<!--          WEB TRAIL       		  -->
			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

			<div class="row">

				<div class="col-xs-12">
					<h3 class="color-accent-baby-blue">Products / strapping Machines / Dynaric DF30</h3>
					<hr>
				</div>

			</div>




			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
			<!--          PRODUCT HEADER        -->
			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

			<header class="row">
				<div class="col-xs-12">

					<!-- PRODUCT TITLE AND SUB-TITLE -->
					<div class="float-left">
						<h2><?php the_title(); ?></h2>
						<?php debug_to_console($post->ID); ?>
						<?php debug_to_console(get_post_meta( $post->ID, 'description_heading', true)); ?>
						<h3 class="font-weight-reg"><?php echo get_post_meta( $post->ID, 'description_heading', true); ?></h3 class="no-bold">
					</div>

					<!-- PRODUCT BRAND/SUPPLIER IMG -->
					<div class="supplier-logo-container float-right">
						<?php
							$logoPath = get_post_meta( $post->ID, 'supplier_logo_path', true);
							// check if products logo path != " "
							if (has_supplier_logo_path($logoPath) == true ) : ?>
								<img class="vertical-center" src="<?php echo get_template_directory_uri(); ?>/assets/supplier-logos/<?php echo get_post_meta( $post->ID, 'supplier_logo_path', true); ?>.png"/>
						<?php endif; ?>
					</div>

				</div>

				<!-- PRODUCT DESCRIPTION i.e the_excerpt() -->
				<div class="col-xs-12">
					<p class="bigger-text">
						<?php the_excerpt(); ?>
					</p>
				</div>
			</header>




			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
			<!--          PRODUCT CONTENT       -->
			<!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

			<section class="row">

				<div id="product-page-images" class="margin-top-bottom-20 col-xs-12 col-md-6">
					<?php
						$images = get_attached_media('image', $post->ID);
						$counter = 0;
						foreach($images as $image) { ?>
							<!-- If first element -->
							<?php if ($counter == 0) { ?>
								<div class="main-product-img-container horizontal-center col-xs-12">
									<img src="<?php echo wp_get_attachment_url($image->ID); ?>" />
								</div>

							<?php } else { ?>
								<div class="alt-product-img-container col-xs-3 col-md-4 col-lg-3">
										<img src="<?php echo wp_get_attachment_url($image->ID); ?>" />
								</div>
							<?php } ?>
							<?php $counter++; ?>
					<?php } ?>
				</div>


				<!-- TAB BOX -->
				<div class="margin-top-bottom-20 col-xs-12 col-md-6">
					<ul class="tab-box">
						<a href="#" onclick="showDescription()" id="description-tab" ><li class="tab">Description</li></a>
						<a href="#" onclick="showSpecifications()" id="specifications-tab" ><li class="tab">Specifications</li></a>
					</ul>

					<div id="description-content" class="tab-content active">
						<p>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
						</p>
					</div>

					<div id="specifications-content" class="tab-content">
						<ul>
							<li>blah</li>
							<li>blah</li>
							<li>blah</li>
							<li>blah</li>
							<li>blah</li>
							<li>blah</li>
							<li>blah</li>
						</ul>
					</div>

					<!-- VIDEO AND BUY NOW BUTTONS -->
					<div class="">
						<div class="col-xs-6">
							<a href="#">
								<div id="buy-now" class="product-page-button">
									<h3 class="color-accent-white vertical-center">Buy Now</h3>
								</div>
							</a>
						</div>

						<div class="col-xs-6">
							<a href="#">
								<div id="watch-video" class="product-page-button">
									<h3 class="color-accent-white vertical-center">Watch Video</h3>
								</div>
							</a>
						</div>
					</div>

				</div>
				<!-- /TAB BOX -->

			</section>


	</article>

	<!-- END OF LOOP -->
	<?php endwhile; else: ?>
		<p><?php _e( 'The product you are looking for could not be found.' ); ?></p>
	<?php endif; ?>

<?php get_footer(); ?>
