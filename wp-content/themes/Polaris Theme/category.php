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

                    <a href="<?php echo get_category_link( $category->term_id ); ?>">
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
          $queryArray = array(
            'post_type' => 'psi_product',
            'cat' => $wp_query->get_queried_object()->term_id
          );
          $categoryQuery = new WP_Query( $queryArray );

          // var_dump($wp_query->get_queried_object());
          ?>

          <!-- START OF LOOP --> <!-- query arguments set in products page -->
          <?php if ( $categoryQuery->have_posts() ) : while ( $categoryQuery->have_posts() ) : $categoryQuery->the_post(); ?>


          <div class="col-xs-6 col-sm-4">
            <div class="product-summary-container">
              <div class="product-summary-img">
                <!-- product thumbnail -->
                <?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
                  <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                    <?php the_post_thumbnail(); ?>
                  </a>
                <?php endif; ?>
              <!-- /product thumbnail -->
              </div>


              <div class="product-summary-heading">

                <?php
                  $categories = get_the_category();
                  $manufacturerCat = get_category_by_slug('manufacturer');
                  $manufacturerCatID =  $manufacturerCat->term_id;
                  $typeCat = get_category_by_slug('type');
                  $typeCatID =  $typeCat->term_id;

                  // looping through categories array and matching child categories
                  // with parent categories.
                  foreach ($categories as $category) {
                    if ($category->category_parent == $manufacturerCatID) { ?>
                      <h4 class="ps-brand"><?php echo $category->name; ?></h4>
                      <?php
                    }
                  }

                  foreach ($categories as $category) {
                    if ($category->category_parent == $typeCatID) { ?>
                        <h4 class="ps-type"><?php echo $category->name; ?></h4>
                      <?php
                    }
                  }

                ?>

                <h4 class="ps-name"><?php the_title(); ?></h4>

              </div>
            </div>
          </div>




          <!-- END OF LOOP -->
          <?php endwhile; else: ?>
            <p><?php _e( 'The product you are looking for could not be found.' ); ?></p>
          <?php endif; ?>




        </div>

      </section>



    </div>

  </main>

<?php get_footer(); ?>
