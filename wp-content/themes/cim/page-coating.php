<?php
/**
 * Template Name: Coating Page Layout
 *
 * This template replicates the layout shown in the provided image,
 * with a placeholder for the image area and styled text content.
 */

get_header(); ?>

<style>
  /*--------------------------------------------------------------
# Page Specific Styles
--------------------------------------------------------------*/

  /* Container for the two-column layout */
  .coating-page-container {
    display: flex;
    max-width: 1200px;
    /* Adjust max-width as needed */
    margin: 40px auto;
    /* Add some margin around the container */
    background-color: #f0f0f0;
    /* Optional: background for the area outside the main content parts */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Optional: subtle shadow */
    overflow: hidden;
    /* Ensures child elements don't overflow */
  }

  /* Image placeholder area */
  .coating-image-placeholder {
    flex: 1 1 45%;
    /* Adjust flex-basis percentage as needed */
    background-color: #331a3f;
    /* Dark purpleish background as a visual cue */
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 500px;
    /* Give the placeholder some height */
    color: #fff;
    /* Text color for the placeholder comment */
    font-size: 1.2em;
    text-align: center;
    padding: 20px;
    /* In a real scenario, this might contain an actual img tag or background-image */
  }

  /* Text content area */
  .coating-text-content {
    flex: 1 1 55%;
    /* Adjust flex-basis percentage as needed */
    background-color: #4A8F8F;
    /* Teal background color from image */
    padding: 50px 40px;
    /* Generous padding */
    color: #ffffff;
    /* Default text color for this section */
    font-family: sans-serif;
    /* Basic sans-serif font */
  }

  .coating-text-content h1 {
    font-size: 2.8em;
    /* Large heading */
    font-weight: bold;
    text-transform: uppercase;
    margin-top: 0;
    margin-bottom: 40px;
    color: #ffffff;
  }

  .coating-text-content h2 {
    font-size: 1.6em;
    /* Sub-heading */
    font-weight: bold;
    text-transform: uppercase;
    margin-top: 30px;
    margin-bottom: 15px;
    color: #ffffff;
  }

  .coating-text-content p {
    font-size: 1em;
    line-height: 1.7;
    color: #e0e0e0;
    /* Slightly lighter than pure white */
    margin-bottom: 20px;
  }

  .coating-text-content p:last-child {
    margin-bottom: 0;
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .coating-page-container {
      flex-direction: column;
      margin: 20px auto;
    }

    .coating-image-placeholder,
    .coating-text-content {
      flex: 1 1 100%;
      /* Stack elements */
    }

    .coating-image-placeholder {
      min-height: 300px;
      /* Adjust height for mobile */
    }

    .coating-text-content {
      padding: 30px 20px;
    }

    .coating-text-content h1 {
      font-size: 2em;
      margin-bottom: 30px;
    }

    .coating-text-content h2 {
      font-size: 1.3em;
    }

    .coating-text-content p {
      font-size: 0.95em;
    }
  }
</style>

<main id="main" class="site-main">

  <div class="coating-page-container">

    <div class="coating-image-placeholder">
      <!-- Image Placeholder: Replace or populate this div -->
      <span><!-- Image Placeholder --></span>
    </div>

    <div class="coating-text-content">
      <h1>COATING</h1>

      <div class="coating-section">
        <h2>COMPOSITE POLYMER CERAMIC COATING</h2>
        <p>
          CIM developed a polymer-based ceramic coating for corrosive and erosive services. Hard ceramic particles SiC,
          Al2O3, SiO2 or Si3N4 were combined with the polymer, and the bonding strength could get above 15 MPa.
        </p>
      </div>

      <div class="coating-section">
        <h2>CORUNDUM CERAMIC COATING</h2>
        <p>
          Corundum ceramic coating is made from 2600°C molten alumina (Al2O3) centrifugally formed inside the steel pipe
          wall. The hardness of corundum ceramic coating is above 90 HRC, and it has excellent wear resistance,
          corrosion resistance and thermal shock resistance.
        </p>
      </div>
    </div>

  </div>

</main><!-- #main -->

<?php
get_footer();
?>