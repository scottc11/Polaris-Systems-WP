<?php
/*
Template Name: Products Page
*/
?>

<?php get_header(); ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/products.css">




  <main id="" class="container">

    <div class="row">
      <div class="col-xs-12 col-sm-9 col-sm-offset-3">
        <div class="underlined-header-container">
          <h1>Products</h1>
          <hr class="underline-hr">
        </div>
      </div>
    </div>



    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <!--          SIDEBAR               -->
    <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
    <div class="row">

      <aside class="sidebar-container col-xs-12 col-sm-3">

        <div id="products-sidebar">

          <div class="widget-container">

            <div class="widget-header">

              <h4>Products</h4>
              <div class="expander">
                <h4 class=""><span class="glyphicon glyphicon-triangle-top"></span></h4>
              </div>

            </div>

            <div class="widget-content">
              <ul>
                <li>Strapping Machines</li>
                <li>Stretch Wrappers</li>
                <li>Stretch Film + Banding</li>
                <li>Tools</li>
                <li>Accessories</li>
              </ul>
            </div>
          </div>

          <div class="widget-container">
            <div class="widget-header">
              <h4>Brands</h4>
              <div class="expander">
                <h4 class=""><span class="glyphicon glyphicon-triangle-top"></span></h4>
              </div>
            </div>

            <div class="widget-content">
              <ul>
                <li>Cyclop</li>
                <li>Wulftec</li>
                <li>Dynaric</li>
              </ul>
            </div>
          </div>

          <div class="widget-container">
            <div class="widget-header">
              <h4>Other</h4>
              <div class="expander">
                <h4 class=""><span class="glyphicon glyphicon-triangle-top"></span></h4>
              </div>
            </div>

            <div class="widget-content">
              <ul>
                <li>Strapping Machines</li>
                <li>Stretch Wrappers</li>
                <li>Stretch Film + Banding</li>
                <li>Tools</li>
                <li>Accessories</li>
              </ul>
            </div>
          </div>

        </div>

      </aside>




      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <!--          PRODUCTS               -->
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

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

      <section class="container col-xs-12 col-sm-9">
        <div class="row">

          <div class="col-xs-6 col-sm-4">
            <div class="product-summary-container">
              <div class="product-summary-img">
                <img src="assets/wrapping.png" alt="" />
              </div>
              <div class="product-summary-heading">
                <h4 class="ps-brand">Dynaric</h4>
                <h4 class="ps-type">Strapping Gun</h4>
                <h4 class="ps-name">RVHSSD</h4>
              </div>
            </div>
          </div>

          <div class="col-xs-6 col-sm-4">
            <div class="product-summary-container">
              <div class="product-summary-img">
                <img src="assets/banding.png" alt="" />
              </div>
              <div class="product-summary-heading">
                <h4 class="ps-brand">Dynaric</h4>
                <h4 class="ps-type">Strapping Gun</h4>
                <h4 class="ps-name">RVHSSD</h4>
              </div>
            </div>
          </div>

          <div class="col-xs-6 col-sm-4">
            <div class="product-summary-container">
              <div class="product-summary-img">
                <img src="assets/wrapping.png" alt="" />
              </div>
              <div class="product-summary-heading">
                <h4 class="ps-brand">Dynaric</h4>
                <h4 class="ps-type">Strapping Gun</h4>
                <h4 class="ps-name">RVHSSD</h4>
              </div>
            </div>
          </div>

          <div class="col-xs-6 col-sm-4">
            <div class="product-summary-container">
              <div class="product-summary-img">
                <img src="assets/wrapping.png" alt="" />
              </div>
              <div class="product-summary-heading">
                <h4 class="ps-brand">Dynaric</h4>
                <h4 class="ps-type">Strapping Gun</h4>
                <h4 class="ps-name">RVHSSD</h4>
              </div>
            </div>
          </div>

          <div class="col-xs-6 col-sm-4">
            <div class="product-summary-container">
              <div class="product-summary-img">
                <img src="assets/banding.png" alt="" />
              </div>
              <div class="product-summary-heading">
                <h4 class="ps-brand">Dynaric</h4>
                <h4 class="ps-type">Strapping Gun</h4>
                <h4 class="ps-name">RVHSSD</h4>
              </div>
            </div>
          </div>

          <div class="col-xs-6 col-sm-4">
            <div class="product-summary-container">
              <div class="product-summary-img">
                <img src="assets/wrapping.png" alt="" />
              </div>
              <div class="product-summary-heading">
                <h4 class="ps-brand">Dynaric</h4>
                <h4 class="ps-type">Strapping Gun</h4>
                <h4 class="ps-name">RVHSSD</h4>
              </div>
            </div>
          </div>

        </div>


        <!-- END OF LOOP -->
      	<?php endwhile; else: ?>
      		<p><?php _e( 'The product you are looking for could not be found.' ); ?></p>
      	<?php endif; ?>

      </section>



    </div>

  </main>





<?php get_footer(); ?>
