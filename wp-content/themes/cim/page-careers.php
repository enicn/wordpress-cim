<?php
/**
 * Template Name: Careers Page Layout
 *
 * This template replicates the layout for the Careers page.
 */

get_header(); ?>

<style>
  /*--------------------------------------------------------------
# Page Specific Styles
--------------------------------------------------------------*/

  /* Ensure main content area takes up space */
  .site-main {
    padding: 2em 0;
    /* Add some vertical padding */
    /* Background image/color would be controlled by theme's body/html styles or here if needed */
    /* background: url('placeholder-for-smoky-background.jpg') no-repeat center center fixed; */
    /* background-size: cover; */
  }

  /* Container for the beige content box */
  .career-content-wrapper {
    max-width: 1100px;
    /* Adjust max-width as needed */
    margin: 2em auto;
    /* Center the box horizontally, add vertical margin */
    padding: 40px 50px;
    /* Inner padding */
    background-color: #f0e6d2;
    /* Approximate beige color */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Optional subtle shadow */
    overflow: hidden;
    /* Contains floats */
  }

  /* Main title styling */
  .career-content-wrapper h1 {
    font-family: serif;
    /* Or specify a specific serif font like 'Georgia', 'Times New Roman' */
    font-size: 2.5em;
    /* Adjust size */
    margin-bottom: 1em;
    color: #333;
    /* Dark text color */
    text-align: left;
    /* Or center if preferred */
  }

  /* Container for the two columns */
  .career-columns {
    display: flex;
    flex-wrap: wrap;
    /* Allow wrapping on smaller screens */
    gap: 40px;
    /* Space between columns */
  }

  /* Left column (description) */
  .career-description {
    flex: 1;
    /* Take up available space */
    min-width: 300px;
    /* Prevent becoming too narrow */
    font-family: sans-serif;
    /* Common sans-serif */
    color: #333;
    line-height: 1.6;
  }

  /* Right column (form) */
  .career-form {
    flex: 1;
    /* Take up available space */
    min-width: 300px;
    /* Prevent becoming too narrow */
    font-family: sans-serif;
    /* Common sans-serif */
  }

  /* Style form elements */
  .career-form .form-group {
    margin-bottom: 1.5em;
    /* Space between form fields */
  }

  .career-form label {
    display: block;
    /* Label on its own line */
    margin-bottom: 0.5em;
    font-weight: normal;
    /* Or bold if preferred */
    color: #555;
    font-size: 0.9em;
  }

  .career-form input[type="text"],
  .career-form input[type="email"],
  .career-form input[type="tel"] {
    width: 100%;
    /* Full width of the container */
    padding: 10px 12px;
    border: 1px solid #000;
    /* Black border */
    background-color: #fff;
    /* White background */
    box-sizing: border-box;
    /* Include padding and border in width */
    font-size: 1em;
  }

  .career-form input::placeholder {
    color: #999;
    /* Placeholder text color */
    opacity: 1;
    /* Firefox */
  }

  /* Submit button styling */
  .career-form .submit-button {
    background-color: #333;
    /* Dark gray/black */
    color: #fff;
    /* White text */
    border: none;
    padding: 12px 30px;
    font-size: 1em;
    cursor: pointer;
    transition: background-color 0.3s ease;
    display: inline-block;
    /* Or block if you want it full width */
    /* float: right; Optional: if you want it aligned right */
    margin-top: 10px;
    /* Space above the button */
  }

  .career-form .submit-button:hover {
    background-color: #555;
    /* Slightly lighter on hover */
  }

  /* Clearfix for potential floats (like the button) */
  .career-form::after {
    content: "";
    display: table;
    clear: both;
  }

  /* Modal Styles */
  .modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    z-index: 1000;
    justify-content: center;
    align-items: center;
  }

  .modal-container {
    background-color: #ffece8;
    padding: 40px;
    border-radius: 0;
    width: 90%;
    max-width: 600px;
    position: relative;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
  }

  .modal-title {
    font-size: 2em;
    margin-bottom: 30px;
    text-align: center;
    color: #333;
  }

  .modal-subtitle {
    font-size: 1.2em;
    margin-bottom: 20px;
    color: #333;
  }

  .checkbox-group {
    margin-bottom: 30px;
  }

  .checkbox-container {
    display: flex;
    align-items: center;
    margin-bottom: 10px;
  }

  .checkbox-container input[type="checkbox"] {
    margin-right: 10px;
  }

  .select-container {
    margin-bottom: 30px;
  }

  .select-container select {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #000;
    background-color: #fff;
    font-size: 1em;
    box-sizing: border-box;
  }

  .textarea-container {
    margin-bottom: 30px;
  }

  .textarea-container textarea {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid #000;
    background-color: #fff;
    font-size: 1em;
    box-sizing: border-box;
    min-height: 100px;
    resize: vertical;
  }

  .modal-buttons {
    display: flex;
    justify-content: space-between;
  }

  .back-button,
  .send-button {
    padding: 12px 30px;
    font-size: 1em;
    cursor: pointer;
    border: none;
  }

  .back-button {
    background-color: #ccc;
    color: #333;
  }

  .send-button {
    background-color: #333;
    color: #fff;
  }

  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .career-content-wrapper {
      padding: 30px 25px;
    }

    .career-columns {
      flex-direction: column;
      /* Stack columns vertically */
      gap: 30px;
    }

    .career-content-wrapper h1 {
      font-size: 2em;
    }

    /* Ensure columns take full width when stacked */
    .career-description,
    .career-form {
      flex-basis: 100%;
      min-width: unset;
    }

    .modal-container {
      width: 95%;
      padding: 20px;
    }
  }
</style>

<div style="position: fixed; inset: 0; z-index: -1;">
  <video crossorigin="anonymous" playsinline="" preload="auto" muted="" loop="" autoplay="" controls="no"
    src="https://video.wixstatic.com/video/11062b_4d1ce144268d4ffda4eb0e5d39af01d0/720p/mp4/file.mp4"
    style="height: 100%; width: 100%; object-fit: cover; object-position: center center; opacity: 1;"></video>
</div>
<main id="main" class="site-main">
  <div class="career-content-wrapper">
    <h1><?php esc_html_e('Careers at Canadian Innovative Materials', 'text-domain'); ?></h1>
    <div class="career-columns">
      <div class="career-description">
        <p>
          <?php esc_html_e('Canadian Innovative Materials is expanding! We are seeking self-motivated team players who thrive in a dynamic startup environment and are eager to help build and sell innovative products. If you\'re looking to be part of a growing opportunity from the ground up, we\'d love to hear from you -- send us your email to connect!', 'text-domain'); ?>
        </p>
      </div>
      <div class="career-form">
        <?php 
          // Display form messages
          echo cim_display_form_messages('career');
          ?>

          <form id="career-step1-form" action="" method="post">
          <?php wp_nonce_field('career_form_action', 'career_form_nonce'); ?>
          <input type="hidden" name="career_form_submitted" value="true">

          <div class="form-group">
            <label for="full-name"><?php esc_html_e('What\'s your name?', 'text-domain'); ?></label>
            <input type="text" id="full-name" name="full_name"
              placeholder="<?php esc_attr_e('Full Name', 'text-domain'); ?>"
              value="<?php echo cim_get_form_data('career', 'full_name'); ?>">
          </div>

          <div class="form-group">
            <label
              for="position"><?php esc_html_e('What\'s position you apply?', 'text-domain'); // Typo kept from image, consider changing to 'applying for?' ?></label>
            <input type="text" id="position" name="position"
              value="<?php echo cim_get_form_data('career', 'position'); ?>">
          </div>

          <div class="form-group">
            <label for="email-address"><?php esc_html_e('What\'s your email address? *', 'text-domain'); ?></label>
            <input type="email" id="email-address" name="email_address"
              placeholder="<?php esc_attr_e('Email', 'text-domain'); ?>" required
              value="<?php echo cim_get_form_data('career', 'email_address'); ?>">
          </div>

          <div class="form-group">
            <label for="phone-number"><?php esc_html_e('What\'s your phone number?', 'text-domain'); ?></label>
            <input type="tel" id="phone-number" name="phone_number"
              placeholder="<?php esc_attr_e('Phone', 'text-domain'); ?>"
              value="<?php echo cim_get_form_data('career', 'phone_number'); ?>">
          </div>

          <button type="button" id="next-button" class="submit-button"><?php esc_html_e('Next', 'text-domain'); ?></button>
        </form>
      </div>

      <!-- Modal for Step 2 Form -->
      <div id="career-modal" class="modal-overlay">
        <div class="modal-container">
          <h2 class="modal-title"><?php esc_html_e('Additional Information', 'text-domain'); ?></h2>
          
          <form id="career-step2-form" action="" method="post">
            <div class="modal-subtitle"><?php esc_html_e('Education', 'text-domain'); ?></div>
            <div class="select-container">
              <select id="education" name="education">
                <option value="" selected disabled><?php esc_html_e('Highest Education Level', 'text-domain'); ?></option>
                <option value="High School"><?php esc_html_e('High School', 'text-domain'); ?></option>
                <option value="College Diploma"><?php esc_html_e('College Diploma', 'text-domain'); ?></option>
                <option value="Bachelor's Degree"><?php esc_html_e('Bachelor\'s Degree', 'text-domain'); ?></option>
                <option value="Master's Degree"><?php esc_html_e('Master\'s Degree', 'text-domain'); ?></option>
                <option value="PhD"><?php esc_html_e('PhD', 'text-domain'); ?></option>
                <option value="Other"><?php esc_html_e('Other', 'text-domain'); ?></option>
              </select>
            </div>

            <div class="modal-subtitle"><?php esc_html_e('Work Experience', 'text-domain'); ?></div>
            <div class="select-container">
              <select id="experience" name="experience">
                <option value="" selected disabled><?php esc_html_e('Years of Experience', 'text-domain'); ?></option>
                <option value="0-1 year"><?php esc_html_e('0-1 year', 'text-domain'); ?></option>
                <option value="1-3 years"><?php esc_html_e('1-3 years', 'text-domain'); ?></option>
                <option value="3-5 years"><?php esc_html_e('3-5 years', 'text-domain'); ?></option>
                <option value="5-10 years"><?php esc_html_e('5-10 years', 'text-domain'); ?></option>
                <option value="10+ years"><?php esc_html_e('10+ years', 'text-domain'); ?></option>
              </select>
            </div>

            <div class="modal-subtitle"><?php esc_html_e('Tell us about yourself and why you want to join our team', 'text-domain'); ?></div>
            <div class="textarea-container">
              <textarea id="additional-info" name="additional_info" placeholder="<?php esc_attr_e('Include relevant skills and experience', 'text-domain'); ?>"></textarea>
            </div>

            <div class="modal-buttons">
              <button type="button" id="back-button" class="back-button"><?php esc_html_e('Back', 'text-domain'); ?></button>
              <button type="submit" class="send-button"><?php esc_html_e('Send', 'text-domain'); ?></button>
            </div>
          </form>
        </div>
      </div>
    </div> <!-- .career-columns -->
  </div> <!-- .career-content-wrapper -->
</main><!-- #main -->

<?php
// Enqueue the career form script
wp_enqueue_script('career-form-js', get_template_directory_uri() . '/assets/js/career-form.js', array('jquery'), '1.0.0', true);

get_footer();
?>