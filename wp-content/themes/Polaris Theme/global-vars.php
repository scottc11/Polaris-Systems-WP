
<?php

  // for the product page I need to transmit the WP_Query from the products.php file to the
  // loop-products.php file in order to load a new query dynamically using AJAX.

  global $products_page_query;

  global $products_query_args;

  $products_query_args = array(

    'post_type' => 'psi_product',
    'supports' => array('title','editor','thumbnail','custom-fields')

  );

 ?>
