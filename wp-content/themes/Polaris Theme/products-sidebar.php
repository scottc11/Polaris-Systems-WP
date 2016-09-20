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
