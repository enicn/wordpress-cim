<?php
/**
 * Template Name: Contact Page Layout
 */
get_header(); ?>

<style>
  /*--------------------------------------------------------------
# Page Specific Styles - Contact Page
--------------------------------------------------------------*/

  /* General */
  .page-template-contact .site-main {
    /* Target main element only on this template */
    background-color: #000;
    /* Assuming black background for content area */
    color: #fff;
    padding-top: 60px;
    /* Adjust as needed */
    padding-bottom: 80px;
    /* Adjust as needed */
    position: relative;
    /* Needed if using pseudo-elements for background shapes */
    overflow: hidden;
    /* Hide overflow from potential background shapes */
  }

  /* Add pseudo-elements for background shapes if needed, e.g.: */
  .page-template-contact .site-main::before {
    content: '';
    /* Placeholder for left blue/teal shape styling */
    /* Example: */
    /*
    position: absolute;
    bottom: 0;
    left: 0;
    width: 30%;
    height: 80%;
    background: linear-gradient(to top right, #00a0d2, #0073aa);
    clip-path: polygon(0 0, 100% 100%, 0 100%);
    z-index: 0;
    */
  }

  .page-template-contact .site-main::after {
    content: '';
    /* Placeholder for right blue/teal/yellow shape styling */
    /* Example: */
    /*
    position: absolute;
    top: 0;
    right: 0;
    width: 40%;
    height: 100%;
    background: linear-gradient(to bottom left, #ffc107, #00a0d2, #005b7f);
    clip-path: polygon(100% 0, 100% 100%, 0% 100%);
    z-index: 0;
    */
  }


  .contact-container {
    max-width: 1140px;
    /* Standard container width */
    margin: 0 auto;
    padding: 0 15px;
    position: relative;
    /* Ensure content is above pseudo-elements */
    z-index: 1;
  }

  /* Contact Title */
  .contact-title {
    text-align: center;
    font-size: 3em;
    /* Adjust size */
    font-weight: bold;
    margin-bottom: 40px;
    color: #fff;
    /* White title */
    letter-spacing: 2px;
  }

  /* Contact Form */
  .contact-form-section {
    max-width: 700px;
    /* Limit form width */
    margin: 0 auto 60px auto;
    /* Center form and add bottom margin */
  }

  .contact-form .form-group {
    margin-bottom: 20px;
  }

  .contact-form label {
    display: block;
    margin-bottom: 8px;
    font-size: 0.9em;
    color: #ccc;
    /* Lighter gray for labels */
  }

  .contact-form input[type="text"],
  .contact-form input[type="email"],
  .contact-form input[type="tel"],
  .contact-form textarea {
    width: 100%;
    padding: 12px 15px;
    background-color: #1a1a1a;
    /* Dark background for fields */
    border: 1px solid #cca300;
    /* Gold/yellow border */
    color: #fff;
    font-size: 1em;
    border-radius: 0;
    /* Sharp corners */
    box-sizing: border-box;
    /* Include padding and border in element's total width and height */
  }

  .contact-form input[type="text"]:focus,
  .contact-form input[type="email"]:focus,
  .contact-form input[type="tel"]:focus,
  .contact-form textarea:focus {
    outline: none;
    border-color: #e6bf00;
    /* Brighter gold on focus */
    box-shadow: 0 0 5px rgba(204, 163, 0, 0.5);
    /* Optional focus glow */
  }

  .contact-form textarea {
    height: 150px;
    /* Adjust height */
    resize: vertical;
    /* Allow vertical resizing */
  }

  .contact-form .submit-button-container {
    text-align: center;
    /* Center the button */
    margin-top: 30px;
  }

  .contact-form button[type="submit"] {
    padding: 12px 40px;
    background-color: transparent;
    border: 2px solid #cca300;
    /* Gold/yellow border */
    color: #cca300;
    /* Gold/yellow text */
    font-size: 1em;
    font-weight: bold;
    text-transform: uppercase;
    cursor: pointer;
    transition: all 0.3s ease;
    border-radius: 0;
    /* Sharp corners */
  }

  .contact-form button[type="submit"]:hover {
    background-color: #cca300;
    color: #000;
  }

  /* Contact Info and Map Section */
  .contact-info-map-section {
    display: flex;
    /* Use flexbox for layout */
    flex-direction: column;
    /* Stack items vertically by default */
    gap: 40px;
    /* Space between info and map */
    align-items: center;
    /* Center items horizontally */
    margin-top: 60px;
  }

  @media (min-width: 992px) {

    /* On larger screens, make side-by-side */
    .contact-info-map-section {
      flex-direction: row;
      /* Side-by-side layout */
      justify-content: space-between;
      /* Space out items */
      align-items: flex-start;
      /* Align items to the top */
    }

    .contact-info {
      flex-basis: 45%;
      /* Adjust width */
      text-align: left;
    }

    .map-placeholder-container {
      flex-basis: 50%;
      /* Adjust width */
    }
  }


  .contact-info {
    text-align: center;
    /* Center text on smaller screens */
  }

  .contact-info h2 {
    font-size: 1.8em;
    color: #fff;
    margin-bottom: 20px;
  }

  .contact-info h3 {
    font-size: 1.3em;
    color: #cca300;
    /* Gold/yellow for office titles */
    margin-top: 25px;
    margin-bottom: 10px;
  }

  .contact-info p {
    font-size: 1em;
    line-height: 1.6;
    color: #ccc;
    /* Light gray for address text */
    margin-bottom: 5px;
  }

  .map-placeholder-container {
    width: 100%;
    /* Full width on small screens */
    max-width: 550px;
    /* Max width for map */
  }

  .map-placeholder {
    width: 100%;
    aspect-ratio: 16 / 11;
    /* Maintain aspect ratio similar to map */
    background-color: #333;
    /* Placeholder background */
    border: 1px solid #555;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #888;
    font-size: 1.2em;
  }
</style>

<main id="main" class="site-main">
  <div class="contact-container">

    <h1 class="contact-title">CONTACT</h1>

    <section class="contact-form-section">
      <?php 
      // Display form messages for non-Ajax fallback
      echo cim_display_form_messages('contact');
      ?>
      <form action="" method="post" class="contact-form">
        <!-- Form messages for Ajax responses will be inserted here -->
        <?php wp_nonce_field('contact_form_action', 'contact_form_nonce'); ?>
        <input type="hidden" name="contact_form_submitted" value="true">
        
        <div class="form-group">
          <label for="first-name">First Name</label>
          <input type="text" id="first-name" name="first_name" value="<?php echo cim_get_form_data('contact', 'first_name'); ?>">
        </div>

        <div class="form-group">
          <label for="last-name">Last Name</label>
          <input type="text" id="last-name" name="last_name" value="<?php echo cim_get_form_data('contact', 'last_name'); ?>">
        </div>

        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" id="email" name="email" required value="<?php echo cim_get_form_data('contact', 'email'); ?>">
        </div>

        <div class="form-group">
          <label for="phone">Phone</label>
          <input type="tel" id="phone" name="phone" value="<?php echo cim_get_form_data('contact', 'phone'); ?>">
        </div>

        <div class="form-group">
          <label for="comments">Comments</label>
          <textarea id="comments" name="comments"><?php echo cim_get_form_data('contact', 'comments'); ?></textarea>
        </div>

        <div class="submit-button-container">
          <button type="submit">Send</button>
        </div>
      </form>
    </section>

    <section class="contact-info-map-section">
      <div class="contact-info">
        <h2><?php echo get_bloginfo('description'); ?> Ltd.</h2>

        <h3>Calgary Office:</h3>
        <p>421 7th Avenue SW, 30th Floor</p>
        <p>Calgary AB Canada T2P 4K9</p>

        <h3>Edmonton Office:</h3>
        <p>9809 33 Ave NW</p>
        <p>Edmonton AB Canada T6N 1B6</p>
      </div>

      <div class="map-placeholder-container">
        <!-- Map embed code or image placeholder goes here -->
        <div class="map-placeholder">
          <!-- Example: <img src="placeholder-map.jpg" alt="Map showing office location"> -->
          <!-- Or actual map embed code from Google Maps, etc. -->
          <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2508.9891520477506!2d-114.0718881!3d51.0464542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x53716fe76e972825%3A0x4615b1fc11e346a5!2s421%207%20Ave%20SW%2C%20Calgary%2C%20AB%20T2P%204K9%2C%20Canada!5e0!3m2!1sen!2sus!4v1651234567890!5m2!1sen!2sus"
            width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"
            referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      </div>
    </section>

  </div><!-- .contact-container -->
</main><!-- #main -->

<?php
get_footer(); ?>