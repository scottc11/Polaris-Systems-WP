



// Products Sidebar buttons
$('.expander').on('click', function() {

  var expander = $(this);
  var widgetContent = $(this).parent().parent().children('.widget-content');


  // SHOWING THE WIDGET CONTENT
  if (widgetContent.hasClass('hidden')) {

    widgetContent.removeClass('hidden');
    expander.find('.glyphicon').removeClass('glyphicon-triangle-bottom').addClass('glyphicon-triangle-top');
    return;
  }


  // HIDING THE WIDGET CONTENT
  if (widgetContent.hasClass('hidden') == false) {

    widgetContent.addClass('hidden');
    expander.find('.glyphicon').removeClass('glyphicon-triangle-top').addClass('glyphicon-triangle-bottom');
    return;
  }
});

// -----------------------------------------------------------------------------------




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
function showFeatures() {

  // iterate through each tabs content, and hide them
  $('.tab-content').each( function() {
      $(this).removeClass('active');
    }
  );

  // add an active class to the respective content tab
  $('#features-content').addClass('active');
}
$('#features-tab').on('click', showFeatures);

//show specs tab
function showSpecs() {

  // iterate through each tabs content, and hide them
  $('.tab-content').each( function() {
      $(this).removeClass('active');
    }
  );

  // add an active class to the respective content tab
  $('#specs-content').addClass('active');
}

$('#specs-tab').on('click', showSpecs);
