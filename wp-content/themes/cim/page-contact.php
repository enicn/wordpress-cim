<?php
/**
 * Template Name: Contact Page
 * 
 * The template for displaying the contact page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Industrial
 */

get_header();
?>

<main id="primary" class="site-main contact-page">
    <div class="container">
        <div class="contact-wrapper">
            <div class="contact-form-section">
                <h1 class="contact-title"><?php echo esc_html(get_the_title()); ?></h1>
                
                <?php if (function_exists('the_content')) : ?>
                    <div class="contact-content">
                        <?php the_content(); ?>
                    </div>
                <?php endif; ?>
                
                <div class="contact-form">
                    <?php
                    // Check if Contact Form 7 is active
                    if (shortcode_exists('contact-form-7')) :
                        // You can replace this with your Contact Form 7 shortcode ID
                        echo do_shortcode('[contact-form-7 id="contact-form" title="Contact Form"]');
                    else :
                    ?>
                    <form id="contact-form" action="<?php echo esc_url(admin_url('admin-post.php')); ?>" method="post">
                        <div class="form-group">
                            <label for="first-name"><?php esc_html_e('First Name', 'industrial'); ?></label>
                            <input type="text" id="first-name" name="first_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="last-name"><?php esc_html_e('Last Name', 'industrial'); ?></label>
                            <input type="text" id="last-name" name="last_name" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="email"><?php esc_html_e('Email', 'industrial'); ?> *</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="phone"><?php esc_html_e('Phone', 'industrial'); ?></label>
                            <input type="tel" id="phone" name="phone">
                        </div>
                        
                        <div class="form-group full-width">
                            <label for="comments"><?php esc_html_e('Comments', 'industrial'); ?></label>
                            <textarea id="comments" name="comments" rows="5"></textarea>
                        </div>
                        
                        <div class="form-submit">
                            <button type="submit" class="submit-button"><?php esc_html_e('SEND', 'industrial'); ?></button>
                        </div>
                        
                        <input type="hidden" name="action" value="contact_form_submission">
                        <?php wp_nonce_field('contact_form_nonce', 'contact_nonce'); ?>
                    </form>
                    <?php endif; ?>
                </div>
            </div>
            
            <div class="contact-info-section">
                <div class="company-info">
                    <h2><?php esc_html_e('Canadian Innovative Materials Ltd.', 'industrial'); ?></h2>
                    
                    <div class="office-info">
                        <h3><?php esc_html_e('Calgary Office:', 'industrial'); ?></h3>
                        <p>421 7th Avenue SW, 30th Floor<br>Calgary AB Canada T2P 4K9</p>
                    </div>
                    
                    <div class="office-info">
                        <h3><?php esc_html_e('Edmonton Office:', 'industrial'); ?></h3>
                        <p>9809 33 Ave NW<br>Edmonton AB Canada T6N 1B6</p>
                    </div>
                </div>
                
                <div class="contact-map">
                    <?php 
                    // You can replace this with a Google Maps embed code or use a plugin
                    // This is a placeholder for the map
                    ?>
                    <div class="map-container">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2508.9891520477506!2d-114.0718881!3d51.0464542!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x53716fe76e972825%3A0x4615b1fc11e346a5!2s421%207%20Ave%20SW%2C%20Calgary%2C%20AB%20T2P%204K9%2C%20Canada!5e0!3m2!1sen!2sus!4v1651234567890!5m2!1sen!2sus" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main><!-- #main -->

<?php
get_footer();