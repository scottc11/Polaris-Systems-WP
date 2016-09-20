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




    <div class="row">

      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <!--          SIDEBAR               -->
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

      <?php get_template_part('products-sidebar'); ?>



      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <!--          PRODUCTS               -->
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

      <section class="container col-xs-12 col-sm-9">

        <div class="row">

          <!-- preparing the loop -->
          <?php

            require 'global-vars.php';

            // define the post type for the loop
            // the default will be all of the posts i.e psi_product

            $products_query_args = array(

              'post_type' => 'psi_product',
              'supports' => array('title','editor','thumbnail','custom-fields')

            );

            // Create a new WP loop query and hand it the custom post type arguments
            $productsQuery = new WP_Query( $products_query_args );

          ?>

          <!-- the loop -->
          <?php get_template_part('loop-products') ?>

        </div>

      </section>

    </div>
  </main>

<?php get_footer(); ?>
