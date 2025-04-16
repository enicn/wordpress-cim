<?php
/**
 * Form Handlers for CIM Theme
 *
 * @package Industrial
 */

/**
 * Process career form submission
 */
function cim_process_career_form() {
    // Check if form was submitted
    if (isset($_POST['career_form_submitted']) && $_POST['career_form_submitted'] == 'true') {
        
        // Verify nonce for security
        if (!isset($_POST['career_form_nonce']) || !wp_verify_nonce($_POST['career_form_nonce'], 'career_form_action')) {
            wp_die(__('Security check failed. Please try again.', 'cim'));
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
            // Store error message in session
            if (!session_id()) {
                session_start();
            }
            $_SESSION['career_form_error'] = __('Please provide a valid email address.', 'cim');
            $_SESSION['career_form_data'] = $_POST; // Store form data for repopulation
            
            // Redirect back to form
            wp_redirect(wp_get_referer());
            exit;
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
            
            // Store success message in session
            if (!session_id()) {
                session_start();
            }
            $_SESSION['career_form_success'] = __('Thank you for your application! We will contact you soon.', 'cim');
            
            // Redirect to same page to prevent form resubmission
            wp_redirect(wp_get_referer());
            exit;
        } else {
            // Error handling
            if (!session_id()) {
                session_start();
            }
            $_SESSION['career_form_error'] = __('There was an error submitting your application. Please try again.', 'cim');
            $_SESSION['career_form_data'] = $_POST; // Store form data for repopulation
            
            // Redirect back to form
            wp_redirect(wp_get_referer());
            exit;
        }
    }
}
add_action('template_redirect', 'cim_process_career_form');

/**
 * Process contact form submission
 */
function cim_process_contact_form() {
    // Check if form was submitted
    if (isset($_POST['contact_form_submitted']) && $_POST['contact_form_submitted'] == 'true') {
        
        // Verify nonce for security
        if (!isset($_POST['contact_form_nonce']) || !wp_verify_nonce($_POST['contact_form_nonce'], 'contact_form_action')) {
            wp_die(__('Security check failed. Please try again.', 'cim'));
        }
        
        // Get form data
        $first_name = isset($_POST['first_name']) ? sanitize_text_field($_POST['first_name']) : '';
        $last_name = isset($_POST['last_name']) ? sanitize_text_field($_POST['last_name']) : '';
        $email = isset($_POST['email']) ? sanitize_email($_POST['email']) : '';
        $phone = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
        $comments = isset($_POST['comments']) ? sanitize_textarea_field($_POST['comments']) : '';
        
        // Validate email (required field)
        if (empty($email) || !is_email($email)) {
            // Store error message in session
            if (!session_id()) {
                session_start();
            }
            $_SESSION['contact_form_error'] = __('Please provide a valid email address.', 'cim');
            $_SESSION['contact_form_data'] = $_POST; // Store form data for repopulation
            
            // Redirect back to form
            wp_redirect(wp_get_referer());
            exit;
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
            
            // Store success message in session
            if (!session_id()) {
                session_start();
            }
            $_SESSION['contact_form_success'] = __('Thank you for your message! We will contact you soon.', 'cim');
            
            // Redirect to same page to prevent form resubmission
            wp_redirect(wp_get_referer());
            exit;
        } else {
            // Error handling
            if (!session_id()) {
                session_start();
            }
            $_SESSION['contact_form_error'] = __('There was an error submitting your message. Please try again.', 'cim');
            $_SESSION['contact_form_data'] = $_POST; // Store form data for repopulation
            
            // Redirect back to form
            wp_redirect(wp_get_referer());
            exit;
        }
    }
}
add_action('template_redirect', 'cim_process_contact_form');

/**
 * Display form messages
 */
function cim_display_form_messages($form_type) {
    if (!session_id()) {
        session_start();
    }
    
    $output = '';
    
    // Check for success message
    if (isset($_SESSION[$form_type . '_form_success'])) {
        $output .= '<div class="form-message success-message">' . esc_html($_SESSION[$form_type . '_form_success']) . '</div>';
        unset($_SESSION[$form_type . '_form_success']);
    }
    
    // Check for error message
    if (isset($_SESSION[$form_type . '_form_error'])) {
        $output .= '<div class="form-message error-message">' . esc_html($_SESSION[$form_type . '_form_error']) . '</div>';
        unset($_SESSION[$form_type . '_form_error']);
    }
    
    return $output;
}

/**
 * Get stored form data for repopulation
 */
function cim_get_form_data($form_type, $field) {
    if (!session_id()) {
        session_start();
    }
    
    if (isset($_SESSION[$form_type . '_form_data'][$field])) {
        $value = $_SESSION[$form_type . '_form_data'][$field];
        return esc_attr($value);
    }
    
    return '';
}

/**
 * Include form handlers in functions.php
 */
function cim_include_form_handlers() {
    // Start session if not already started
    if (!session_id() && !headers_sent()) {
        session_start();
    }
}
add_action('init', 'cim_include_form_handlers');