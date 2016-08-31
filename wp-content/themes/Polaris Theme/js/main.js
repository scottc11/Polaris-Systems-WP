


// var1 = prev.sel.image
// var2 = new.sel.image
// assign var1 to selected DIV, assign var2 to prev.sel.DIV
// first div in parent container will have 'selected' class
// if first child in parent, remove col-classes, add col-xs-12 class, add selected class
// if index == 0, add class


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
