/**
 * Ajax Form Submission for CIM Theme
 * Handles Ajax submission for contact and career forms
 */

(function($) {
    'use strict';
    
    // Wait for DOM to be ready
    $(document).ready(function() {
        // Contact form
        const contactForm = $('.contact-form');
        if (contactForm.length) {
            setupContactForm(contactForm);
        }
        
        // Career form - both steps
        const careerStep1Form = $('#career-step1-form');
        const careerStep2Form = $('#career-step2-form');
        if (careerStep1Form.length && careerStep2Form.length) {
            setupCareerForm(careerStep1Form, careerStep2Form);
        }
    });
    
    /**
     * Setup contact form submission
     */
    function setupContactForm(form) {
        form.on('submit', function(e) {
            e.preventDefault();
            
            // Show loading state
            const submitButton = form.find('button[type="submit"]');
            const originalButtonText = submitButton.text();
            submitButton.text('Sending...').prop('disabled', true);
            
            // Clear previous messages
            $('.form-message').remove();
            
            // Collect form data
            const formData = new FormData(this);
            formData.append('action', 'cim_contact_form');
            formData.append('nonce', form.find('[name="contact_form_nonce"]').val());
            
            // Send Ajax request
            $.ajax({
                url: ajaxurl, // Defined in wp_localize_script
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Reset button
                    submitButton.text(originalButtonText).prop('disabled', false);
                    
                    if (response.success) {
                        // Show success message
                        const successMessage = $('<div class="form-message success-message">' + response.data.message + '</div>');
                        form.prepend(successMessage);
                        
                        // Reset form
                        form[0].reset();
                    } else {
                        // Show error message
                        const errorMessage = $('<div class="form-message error-message">' + response.data.message + '</div>');
                        form.prepend(errorMessage);
                    }
                    
                    // Scroll to message
                    $('html, body').animate({
                        scrollTop: form.offset().top - 100
                    }, 300);
                },
                error: function() {
                    // Reset button
                    submitButton.text(originalButtonText).prop('disabled', false);
                    
                    // Show error message
                    const errorMessage = $('<div class="form-message error-message">There was a server error. Please try again later.</div>');
                    form.prepend(errorMessage);
                    
                    // Scroll to message
                    $('html, body').animate({
                        scrollTop: form.offset().top - 100
                    }, 300);
                }
            });
        });
    }
    
    /**
     * Setup career form submission
     */
    function setupCareerForm(step1Form, step2Form) {
        // Elements
        const nextButton = $('#next-button');
        const backButton = $('#back-button');
        const modal = $('#career-modal');
        
        // Step 1 form fields
        const fullNameField = $('#full-name');
        const positionField = $('#position');
        const emailField = $('#email-address');
        const phoneField = $('#phone-number');
        
        // Next button click - validate step 1 and show modal
        nextButton.on('click', function(e) {
            e.preventDefault();
            
            if (validateStep1Form()) {
                showModal();
            }
        });
        
        // Back button click - hide modal
        backButton.on('click', function(e) {
            e.preventDefault();
            hideModal();
        });
        
        // Close modal when clicking outside
        modal.on('click', function(e) {
            if (e.target === this) {
                hideModal();
            }
        });
        
        // Submit final form via Ajax
        step2Form.on('submit', function(e) {
            e.preventDefault();
            submitCareerForm();
        });
        
        // Remove error class on input
        step1Form.find('input').on('input', function() {
            $(this).removeClass('error');
            $('.form-error-message').remove();
        });
        
        /**
         * Validate step 1 form
         */
        function validateStep1Form() {
            let isValid = true;
            const requiredFields = step1Form.find('[required]');
            
            // Check all required fields
            requiredFields.each(function() {
                if (!$(this).val().trim()) {
                    isValid = false;
                    $(this).addClass('error');
                } else {
                    $(this).removeClass('error');
                }
            });
            
            // Validate email format
            if (emailField.val() && !isValidEmail(emailField.val())) {
                isValid = false;
                emailField.addClass('error');
            }
            
            // Show error message if validation fails
            if (!isValid) {
                showFormError('Please fill in all required fields correctly.');
            }
            
            return isValid;
        }
        
        /**
         * Show modal for step 2
         */
        function showModal() {
            modal.css('display', 'flex');
        }
        
        /**
         * Hide modal
         */
        function hideModal() {
            modal.css('display', 'none');
        }
        
        /**
         * Submit career form via Ajax
         */
        function submitCareerForm() {
            // Show loading state
            const submitButton = step2Form.find('.send-button');
            const originalButtonText = submitButton.text();
            submitButton.text('Sending...').prop('disabled', true);
            
            // Clear previous messages
            $('.form-error-message').remove();
            
            // Collect all form data
            const formData = new FormData();
            
            // Add action and nonce
            formData.append('action', 'cim_career_form');
            formData.append('nonce', step1Form.find('[name="career_form_nonce"]').val());
            
            // Add step 1 form data
            formData.append('full_name', fullNameField.val());
            formData.append('position', positionField.val());
            formData.append('email_address', emailField.val());
            formData.append('phone_number', phoneField.val());
            
            // Add step 2 form data
            formData.append('education', $('#education').val() || '');
            formData.append('experience', $('#experience').val() || '');
            formData.append('additional_info', $('#additional-info').val() || '');
            
            // Send Ajax request
            $.ajax({
                url: ajaxurl, // Defined in wp_localize_script
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Reset button
                    submitButton.text(originalButtonText).prop('disabled', false);
                    
                    if (response.success) {
                        // Hide modal
                        hideModal();
                        
                        // Show success message
                        const successMessage = $('<div class="form-message success-message">' + response.data.message + '</div>');
                        step1Form.prepend(successMessage);
                        
                        // Reset forms
                        step1Form[0].reset();
                        step2Form[0].reset();
                    } else {
                        // Show error message in modal
                        const errorMessage = $('<div class="form-error-message">' + response.data.message + '</div>');
                        step2Form.prepend(errorMessage);
                    }
                },
                error: function() {
                    // Reset button
                    submitButton.text(originalButtonText).prop('disabled', false);
                    
                    // Show error message
                    const errorMessage = $('<div class="form-error-message">There was a server error. Please try again later.</div>');
                    step2Form.prepend(errorMessage);
                }
            });
        }
        
        /**
         * Helper function to validate email format
         */
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
        
        /**
         * Helper function to show form error
         */
        function showFormError(message) {
            // Remove any existing error messages
            $('.form-error-message').remove();
            
            // Add new error message
            const errorMessage = $('<div class="form-error-message">' + message + '</div>');
            step1Form.prepend(errorMessage);
            
            // Scroll to error message
            $('html, body').animate({
                scrollTop: errorMessage.offset().top - 100
            }, 300);
        }
    }
    
})(jQuery);