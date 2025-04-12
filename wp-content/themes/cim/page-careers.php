<?php
/**
 * Template Name: Careers Page
 * 
 * A template for displaying the Careers page with application form
 *
 * @package Industrial
 */

get_header();
?>

<main id="primary" class="site-main careers-page">
    <div class="page-header">
        <div class="container">
            <h1 class="page-title"><?php the_title(); ?></h1>
            <?php if (function_exists('yoast_breadcrumb')) {
                yoast_breadcrumb('<p id="breadcrumbs" class="breadcrumbs">', '</p>');
            } ?>
        </div>
    </div>
    
    <div class="container careers-container">
        <div class="careers-content">
            <h2 class="careers-heading">Careers at Canadian Innovative Materials</h2>
            
            <div class="careers-description">
                <p>Canadian Innovative Materials is expanding! We are seeking self-motivated team players who thrive in a dynamic startup environment and are eager to help build and sell innovative products. If you're looking to be part of a growing opportunity from the ground up, we'd love to hear from you -- send us your email to connect!</p>
            </div>
            
            <div class="careers-form-container">
                <form id="careers-application-form" class="careers-form" method="post">
                    <div class="form-group">
                        <label for="applicant-name">What's your name?</label>
                        <input type="text" id="applicant-name" name="applicant-name" placeholder="Full Name" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="position-applied">What's position you apply?</label>
                        <input type="text" id="position-applied" name="position-applied" placeholder="Position" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="applicant-email">What's your email address? <span class="required">*</span></label>
                        <input type="email" id="applicant-email" name="applicant-email" placeholder="Email" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="applicant-phone">What's your phone number?</label>
                        <input type="tel" id="applicant-phone" name="applicant-phone" placeholder="Phone">
                    </div>
                    
                    <div class="form-submit">
                        <button type="submit" class="submit-button">Next</button>
                    </div>
                    
                    <?php wp_nonce_field('careers_application_nonce', 'careers_nonce'); ?>
                    <input type="hidden" name="action" value="submit_careers_application">
                </form>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
// Process form submission
if (isset($_POST['action']) && $_POST['action'] == 'submit_careers_application') {
    if (check_admin_referer('careers_application_nonce', 'careers_nonce')) {
        // Get form data
        $name = sanitize_text_field($_POST['applicant-name']);
        $position = sanitize_text_field($_POST['position-applied']);
        $email = sanitize_email($_POST['applicant-email']);
        $phone = sanitize_text_field($_POST['applicant-phone']);
        
        // Prepare email content
        $to = get_option('admin_email');
        $subject = 'New Career Application from ' . $name;
        $message = "Name: $name\n";
        $message .= "Position: $position\n";
        $message .= "Email: $email\n";
        $message .= "Phone: $phone\n";
        
        // Send email
        $mail_sent = wp_mail($to, $subject, $message);
        
        // Display confirmation message
        if ($mail_sent) {
            echo '<div class="application-confirmation">Thank you for your application! We will contact you soon.</div>';
        } else {
            echo '<div class="application-error">There was an error sending your application. Please try again later.</div>';
        }
    }
}

get_footer();