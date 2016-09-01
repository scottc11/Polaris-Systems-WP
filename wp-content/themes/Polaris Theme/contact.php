<?php
/*
Template Name: Contact Page
*/
?>

<?php get_header(); ?>



  <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->
  <!--          HEADER                -->
  <!-- ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~ -->

  <section class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="underlined-header-container">
          <h1>Contact Us</h1>
          <hr class="underline-hr">
        </div>
      </div>
    </div>

    <div class="row">
      <div class="contact-container col-xs-12 col-md-6">

        <div class="margin-top-20">
          <h5 class="margin-minimal">Give us a call at:</h5>
          <h4 class="color-accent-baby-blue margin-minimal">(905) 757-5522</h4>
        </div>

        <div class="margin-top-20">
          <h5 class="margin-minimal">Email us at:</h5>
          <h4 class="color-accent-baby-blue margin-minimal">sales@polaris-systems.net</h4>
        </div>

        <div class="margin-top-20">
          <h4>Contact Form</h4>

          <p>
            Please fill in required information and a sales representatives will get in touch with you.  Thank you for your interest.
          </p>
        </div>

        <form class="contact-form">
          <input id="contact-name" type="text" name="contact" placeholder="Contact Name:">

          <input id="contact-email" type="text" name="contact" placeholder="Email Address:">

          <select class="select-style" name="interest">
            <option value="machine">I'm interested in:</option>
            <option value="machine">Machine</option>
            <option value="machine">Machine</option>
            <option value="machine">Machine</option>
          </select>

          <textarea name="message" placeholder="Message:" rows="8"></textarea>

          <input type="submit" name="name" value="Send">

        </form>

      </div>



      <div class="map-container col-xs-12 col-md-6">

        <div class="">
          <h5>Or visit us in person:</h5>
          <h4 class="color-accent-baby-blue">2220 Argentia Road Unit #8, Mississauga, ON, Canada L5N 2K7</h4>
        </div>

        <div id="google-maps">

        </div>

        <!-- GOOGLE MAPS API -->

        <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDyerVxVUe9Hn08pP-IF24NNxwqNU5K02I&callback=initMap" async defer></script>

        <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/googlemap.js"></script>

        <!-- /GOOGLE MAPS API -->

      </div>

    </div>

  </section>





<?php get_footer(); ?>
