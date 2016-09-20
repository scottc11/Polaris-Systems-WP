<?php
/*
Template Name: Products Page
*/
?>

<?php get_header(); ?>

<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/products.css">

<?php require 'global-vars.php'; ?>

<script>
  function changeCatParameter() {
    var php = <?php  ?>;
  }
</script>


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


          <?php // ASSIGNING CATEGORIES TO VARIABLES FOR USE IN LISTS

            $sidebarCategories = get_categories();

            // getting all the parent categories
            $parent_categories = get_categories( array(
                'orderby' => 'name',
                'parent'  => 0
              )
            );

            $parent_ids = array(); // array to hold ID's

            // building and array full of all the parent category ID's
            foreach ($parent_categories as $category) {
              $parent_ids[$category->slug] = $category->term_id;
            }
          ?>

          <!-- ~~~~~~~~~~~~~~~ -->
          <!-- TYPE -->

          <div class="widget-container">

            <div class="widget-header">

              <h4>Type</h4>
              <div class="expander">
                <h4 class=""><span class="glyphicon glyphicon-triangle-top"></span></h4>
              </div>

            </div>

            <div class="widget-content">
              <ul>
                <?php foreach ($sidebarCategories as $category) {
                  if ( $category->category_parent == $parent_ids['type']) { ?>
                    <a href="<?php echo get_term_link( $category->term_id ); ?>">
                      <li><?php echo $category->name; ?></li>
                    </a>
                  <?php }
                } ?>
              </ul>
            </div>
          </div>



          <div class="widget-container">
            <div class="widget-header">
              <h4>Manufacturer</h4>
              <div class="expander">
                <h4 class=""><span class="glyphicon glyphicon-triangle-top"></span></h4>
              </div>
            </div>

            <div class="widget-content">
              <ul>
                <?php foreach ($sidebarCategories as $category) {
                  if ( $category->category_parent == $parent_ids['manufacturer']) { ?>
                    <li><?php echo $category->name; ?></li>
                  <?php }
                } ?>
              </ul>
            </div>
          </div>

          <div class="widget-container">
            <div class="widget-header">
              <h4>Performance</h4>
              <div class="expander">
                <h4 class=""><span class="glyphicon glyphicon-triangle-top"></span></h4>
              </div>
            </div>

            <div class="widget-content">
              <ul>
                <?php foreach ($sidebarCategories as $category) {
                  if ( $category->category_parent == $parent_ids['performance']) { ?>
                    <li><?php echo $category->name; ?></li>
                  <?php }
                } ?>
              </ul>
            </div>
          </div>

        </div>

      </aside>




      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
      <!--          PRODUCTS               -->
      <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

      <section class="container col-xs-12 col-sm-9">

        <div class="row">

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

          <?php get_template_part('loop-products') ?>

        </div>

      </section>



    </div>

  </main>





<?php get_footer(); ?>
