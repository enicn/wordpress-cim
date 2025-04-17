<?php
/**
 * Ajax Handlers for CIM Theme
 *
 * @package CIM
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle career form submission via Ajax
 */
function cim_ajax_career_form() {
    // Check nonce for security
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'career_form_action')) {
        wp_send_json_error(array('message' => __('Security check failed. Please refresh the page and try again.', 'cim')));
    }
    
    // Get form data
    $full_name = isset($_POST['full_name']) ? sanitize_text_field($_POST['full_name']) : '';
    $position = isset($_POST['position']) ? sanitize_text_field($_POST['position']) : '';
    $email = isset($_POST['email_address']) ? sanitize_email($_POST['email_address']) : '';
    $phone = isset($_POST['phone_number']) ? sanitize_text_field($_POST['phone_number']) : '';
    $education = isset($_POST['education']) ? sanitize_text_field($_POST['education']) : '';
    $experience = isset($_POST['experience']) ? sanitize_text_field($_POST['experience']) : '';
    $additional_info = isset($_POST['additional_info']) ? sanitize_textarea_field($_POST['additional_info']) : '';
    
    // Validate email (required field)
    if (empty($email) || !is_email($email)) {
        wp_send_json_error(array('message' => __('Please provide a valid email address.', 'cim')));
    }
    
    // Create post title from name and date
    $post_title = !empty($full_name) ? $full_name : __('Career Submission', 'cim');
    $post_title .= ' - ' . current_time('Y-m-d H:i');
    
    // Create new post
    $post_data = array(
        'post_title'    => $post_title,
        'post_status'   => 'publish',
        'post_type'     => 'career_submission',
    );
    
    // Insert post
    $post_id = wp_insert_post($post_data);
    
    if (!is_wp_error($post_id)) {
        // Save meta data
        update_post_meta($post_id, '_full_name', $full_name);
        update_post_meta($post_id, '_position', $position);
        update_post_meta($post_id, '_email', $email);
        update_post_meta($post_id, '_phone', $phone);
        update_post_meta($post_id, '_education', $education);
        update_post_meta($post_id, '_experience', $experience);
        update_post_meta($post_id, '_additional_info', $additional_info);
        update_post_meta($post_id, '_submission_date', current_time('Y-m-d H:i:s'));
        
        // Optional: Send notification email to admin
        $admin_email = get_option('admin_email');
        $subject = sprintf(__('New Career Application: %s', 'cim'), $post_title);
        $message = sprintf(
            __(
                "A new career application has been submitted:\n\n" .
                "Name: %s\n" .
                "Position: %s\n" .
                "Email: %s\n" .
                "Phone: %s\n" .
                "Education: %s\n" .
                "Experience: %s\n" .
                "Additional Info: %s\n\n" .
                "View this submission in the WordPress admin area.",
                'cim'
            ),
            $full_name,
            $position,
            $email,
            $phone,
            $education,
            $experience,
            $additional_info
        );
        wp_mail($admin_email, $subject, $message);
        
        // Return success response
        wp_send_json_success(array('message' => __('Thank you for your application! We will contact you soon.', 'cim')));
    } else {
        // Error handling
        wp_send_json_error(array('message' => __('There was an error submitting your application. Please try again.', 'cim')));
    }
}
add_action('wp_ajax_cim_career_form', 'cim_ajax_career_form');
add_action('wp_ajax_nopriv_cim_career_form', 'cim_ajax_career_form');

/**
 * Handle contact form submission via Ajax
 */
function cim_ajax_contact_form() {
    // Check nonce for security
    if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'contact_form_action')) {
        wp_send_json_error(array('message' => __('Security check failed. Please refresh the page and try again.', 'cim')));
    }
    
    // Get form data
    $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
    $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
    $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
    $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
    $comments = isset($_POST['comments']) ? sanitize_textarea_field($_POST['comments']) : '';
    
    // Validate email (required field)
    if (empty($email) || !is_email($email)) {
        wp_send_json_error(array('message' => __('Please provide a valid email address.', 'cim')));
    }
    
    // Create post title from name and date
    $name = $first_name . ' ' . $last_name;
    $post_title = !empty($name) ? trim($name) : __('Contact Submission', 'cim');
    $post_title .= ' - ' . current_time('Y-m-d H:i');
    
    // Create new post
    $post_data = array(
        'post_title'    => $post_title,
        'post_status'   => 'publish',
        'post_type'     => 'contact_submission',
    );
    
    // Insert post
    $post_id = wp_insert_post($post_data);
    
    if (!is_wp_error($post_id)) {
        // Save meta data
        update_post_meta($post_id, '_first_name', $first_name);
        update_post_meta($post_id, '_last_name', $last_name);
        update_post_meta($post_id, '_email', $email);
        update_post_meta($post_id, '_phone', $phone);
        update_post_meta($post_id, '_comments', $comments);
        update_post_meta($post_id, '_submission_date', current_time('Y-m-d H:i:s'));
        
        // Optional: Send notification email to admin
        $admin_email = get_option('admin_email');
        $subject = sprintf(__('New Contact Form Submission: %s', 'cim'), $post_title);
        $message = sprintf(
            __(
                "A new contact form submission has been received:\n\n" .
                "Name: %s %s\n" .
                "Email: %s\n" .
                "Phone: %s\n\n" .
                "Comments:\n%s\n\n" .
                "View this submission in the WordPress admin area.",
                'cim'
            ),
            $first_name,
            $last_name,
            $email,
            $phone,
            $comments
        );
        wp_mail($admin_email, $subject, $message);
        
        // Return success response
        wp_send_json_success(array('message' => __('Thank you for your message! We will contact you soon.', 'cim')));
    } else {
        // Error handling
        wp_send_json_error(array('message' => __('There was an error submitting your message. Please try again.', 'cim')));
    }
}
add_action('wp_ajax_cim_contact_form', 'cim_ajax_contact_form');
add_action('wp_ajax_nopriv_cim_contact_form', 'cim_ajax_contact_form');