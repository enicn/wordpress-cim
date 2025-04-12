/**
 * Careers Form JavaScript
 */

(function($) {
    'use strict';
    
    // Wait for DOM to be ready
    $(document).ready(function() {
        const careersForm = $('#careers-application-form');
        
        if (careersForm.length) {
            // Form validation
            careersForm.on('submit', function(e) {
                let isValid = true;
                const requiredFields = $(this).find('[required]');
                
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
                const emailField = $('#applicant-email');
                if (emailField.val() && !isValidEmail(emailField.val())) {
                    isValid = false;
                    emailField.addClass('error');
                }
                
                // If validation fails, prevent form submission
                if (!isValid) {
                    e.preventDefault();
                    showFormError('Please fill in all required fields correctly.');
                }
            });
            
            // Remove error class on input
            careersForm.find('input').on('input', function() {
                $(this).removeClass('error');
                $('.form-error-message').remove();
            });
        }
        
        // Helper function to validate email format
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
        
        // Helper function to show form error
        function showFormError(message) {
            // Remove any existing error messages
            $('.form-error-message').remove();
            
            // Add new error message
            const errorMessage = $('<div class="form-error-message">' + message + '</div>');
            careersForm.prepend(errorMessage);
            
            // Scroll to error message
            $('html, body').animate({
                scrollTop: errorMessage.offset().top - 100
            }, 300);
        }
    });
    
})(jQuery);