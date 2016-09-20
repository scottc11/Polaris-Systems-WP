<?php require 'global-vars.php'; ?>

<!-- START OF LOOP --> <!-- query arguments set in products page -->
<?php if ( $productsQuery->have_posts() ) : while ( $productsQuery->have_posts() ) : $productsQuery->the_post(); ?>


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
