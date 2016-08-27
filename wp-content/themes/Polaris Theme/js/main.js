
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
