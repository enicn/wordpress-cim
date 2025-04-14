/**
 * Career Form Two-Step Submission
 * Handles the two-step form process for the careers page
 */

(function($) {
    'use strict';
    
    // Wait for DOM to be ready
    $(document).ready(function() {
        // Elements
        const step1Form = $('#career-step1-form');
        const step2Form = $('#career-step2-form');
        const nextButton = $('#next-button');
        const backButton = $('#back-button');
        const modal = $('#career-modal');
        
        // Step 1 form fields
        const fullNameField = $('#full-name');
        const positionField = $('#position');
        const emailField = $('#email-address');
        const phoneField = $('#phone-number');
        
        // Initialize
        if (step1Form.length && step2Form.length) {
            setupEventListeners();
        }
        
        /**
         * Set up event listeners
         */
        function setupEventListeners() {
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
            
            // Submit final form
            step2Form.on('submit', function(e) {
                e.preventDefault();
                submitFinalForm();
            });
            
            // Remove error class on input
            step1Form.find('input').on('input', function() {
                $(this).removeClass('error');
                $('.form-error-message').remove();
            });
        }
        
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
         * Submit final form with all data
         */
        function submitFinalForm() {
            // Create a combined form to submit all data
            const combinedForm = $('<form>');
            combinedForm.attr({
                'method': 'post',
                'action': ''
            });
            
            // Add step 1 form data
            const step1Data = {
                'career_form_nonce': $('[name="career_form_nonce"]').val(),
                'career_form_submitted': 'true',
                'full_name': fullNameField.val(),
                'position': positionField.val(),
                'email_address': emailField.val(),
                'phone_number': phoneField.val()
            };
            
            // Add step 2 form data
            const services = [];
            $('input[name="services[]"]:checked').each(function() {
                services.push($(this).val());
            });
            
            const step2Data = {
                'services': services.join(', '),
                'budget': $('#budget').val() || '',
                'additional_info': $('#additional-info').val() || ''
            };
            
            // Combine all data
            const allData = {...step1Data, ...step2Data};
            
            // Add all form fields
            $.each(allData, function(name, value) {
                $('<input>').attr({
                    type: 'hidden',
                    name: name,
                    value: value
                }).appendTo(combinedForm);
            });
            
            // Append to body and submit
            combinedForm.appendTo('body').submit();
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
    });
    
})(jQuery);