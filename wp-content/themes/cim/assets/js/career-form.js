/**
 * Career Form Two-Step Submission
 * Handles the two-step form process for the careers page
 */

(function ($) {
  'use strict';

  // Wait for DOM to be ready
  $(document).ready(function () {
    // Elements
    const step1Form = $('#career-step1-form');
    const step2Form = $('#career-step2-form');
    const nextButton = $('#next-button');
    const backButton = $('#back-button');
    const sendButton = $('#send-button');
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
      nextButton.on('click', function (e) {
        e.preventDefault();

        if (validateStep1Form()) {
          showModal();
        }
      });

      // Back button click - hide modal
      backButton.on('click', function (e) {
        e.preventDefault();
        hideModal();
      });

      // Close modal when clicking outside
      modal.on('click', function (e) {
        if (e.target === this) {
          hideModal();
        }
      });

      // Submit final form
      sendButton.on('click', function (e) {
        e.preventDefault();

        submitFinalForm();
      });

      // Remove error class on input
      step1Form.find('input').on('input', function () {
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
      requiredFields.each(function () {
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
     * Submit final form
     */
    function submitFinalForm() {
      // Show loading state
      const sendButton = step2Form.find('.send-button');
      const originalText = sendButton.text();
      sendButton.prop('disabled', true).text('Sending...');

      // Remove any existing messages
      $('.form-message, .form-error-message').remove();

      // Combine data from both forms
      const formData = new FormData(step1Form[0]);
      const step2Data = new FormData(step2Form[0]);

      // Append step 2 data to form data
      for (let pair of step2Data.entries()) {
        formData.append(pair[0], pair[1]);
      }

      // Add action and nonce for security
      formData.append('action', 'cim_career_form'); // AJAX action hook
      formData.append('nonce', step1Form.find('#career_form_nonce').val());

      const ajaxurl = '/careers';
      // Submit via Ajax
      $.ajax({
        url: ajaxurl, // WordPress AJAX URL (should be localized)
        type: 'POST',
        data: formData,
        processData: false, // Don't process the data
        contentType: false, // Don't set content type
        success: function (response) {
          // Reset button
          sendButton.prop('disabled', false).text(originalText);

          if (response.success) {
            // Show success message
            const successMessage = $('<div class="form-message success-message">' + response.data.message + '</div>');
            step1Form.prepend(successMessage);

            // Reset forms
            step1Form[0].reset();
            step2Form[0].reset();

            // Hide modal
            hideModal();

            // Scroll to success message
            $('html, body').animate({
              scrollTop: successMessage.offset().top - 100
            }, 300);
          } else {
            // Show error message in modal
            step2Form.prepend('<div class="form-error-message">' + response.data.message + '</div>');
          }
        },
        error: function () {
          // Reset button
          sendButton.prop('disabled', false).text(originalText);

          // Show generic error message
          step2Form.prepend('<div class="form-error-message">An error occurred. Please try again later.</div>');
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
  });

})(jQuery);