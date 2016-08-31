
function changeProductImage() {
  // get image source of the main image container
  var prevImgSrc = $('.main-product-img-container > img').attr('src');
  // get image source of the clicked image
  var newImgSrc = $(this).children('img').attr('src');

  $('.main-product-img-container > img').attr('src', newImgSrc);
  $(this).children('img').attr('src', prevImgSrc);

}

$('.alt-product-img-container').on('click', changeProductImage);


// Show Description tab
function showDescription() {

  // iterate through each tabs content, and hide them
  $('.tab-content').each( function() {
      $(this).removeClass('active');
    }
  );

  // add an active class to the respective content tab
  $('#description-content').addClass('active');
}


//show specifications tab
function showSpecifications() {

  // iterate through each tabs content, and hide them
  $('.tab-content').each( function() {
      $(this).removeClass('active');
    }
  );

  // add an active class to the respective content tab
  $('#specifications-content').addClass('active');
}
