<?php
/**
 * Template Name: CIMTIC Page Layout
 * Description: A page template replicating the layout from the provided image with placeholders.
 */
get_header(); ?>

<style>
  /*--------------------------------------------------------------
# Page Specific Styles
--------------------------------------------------------------*/
  .site-main.cimtic-page {
    /* Optional: Add styles for the overall page container if needed,
       like a dark background similar to the image's outer area.
       Using a simple dark grey for demonstration. */
    background-color: #222;
    /* Dark background */
    padding-top: 50px;
    /* Add padding */
    padding-bottom: 50px;
    display: flex;
    /* Helps with vertical centering if needed */
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    /* Ensure it takes at least viewport height */
  }

  .cimtic-content-wrapper {
    max-width: 960px;
    /* Adjust max-width as needed */
    width: 90%;
    /* Responsive width */
    margin: 0 auto;
    /* Center the block */
    background-color: #fff;
    /* Fallback background */
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
    font-family: sans-serif;
    /* Basic font */
    line-height: 1.6;
  }

  .cimtic-top-section {
    display: flex;
    flex-wrap: wrap;
    /* Allow wrapping on smaller screens */
    background-color: #f0f0f0;
    /* Fallback */
  }

  .cimtic-image-column {
    flex: 1 1 50%;
    /* Take up 50% width */
    min-height: 350px;
    /* Minimum height for the placeholder area */
    background-color: #777;
    /* Placeholder background color */
    background-image: repeating-linear-gradient(45deg,
        #888 0px, #888 10px,
        #777 10px, #777 20px
        /* Diagonal lines pattern */
      );
    display: flex;
    justify-content: center;
    align-items: center;
    color: #fff;
    font-size: 1.2em;
    font-style: italic;
    text-align: center;
    box-sizing: border-box;
    padding: 20px;
  }

  .cimtic-text-column {
    flex: 1 1 50%;
    /* Take up 50% width */
    background-color: #4a704f;
    /* Green background from image */
    color: #ffffff;
    /* White text */
    padding: 40px;
    box-sizing: border-box;
  }

  .cimtic-text-column h2 {
    color: #f0c05a;
    /* Gold/Yellow color for heading */
    font-size: 2.8em;
    margin-top: 0;
    margin-bottom: 25px;
    font-weight: bold;
  }

  .cimtic-text-column p {
    margin-bottom: 15px;
    font-size: 0.95em;
  }

  .cimtic-text-column p:last-child {
    margin-bottom: 0;
  }

  .cimtic-bottom-section {
    background-color: #b89a5a;
    /* Tan/Gold background from image */
    padding: 50px 40px;
    min-height: 150px;
    /* Minimum height */
    display: flex;
    justify-content: center;
    /* Center the logo placeholder */
    align-items: center;
    text-align: center;
    box-sizing: border-box;
  }

  .cimtic-logo-placeholder {
    /* Placeholder style for the 3D logo */
    display: inline-block;
    padding: 20px 40px;
    border: 2px dashed #4a704f;
    /* Dashed border */
    background-color: rgba(255, 255, 255, 0.2);
    /* Slight overlay */
    color: #4a704f;
    /* Darker text */
    font-weight: bold;
    font-style: italic;
    font-size: 1.5em;
  }

  /* Basic Responsive adjustments */
  @media (max-width: 768px) {
    .cimtic-top-section {
      flex-direction: column;
      /* Stack columns */
    }

    .cimtic-image-column,
    .cimtic-text-column {
      flex-basis: 100%;
      /* Make columns full width */
    }

    .cimtic-text-column {
      padding: 30px;
    }

    .cimtic-text-column h2 {
      font-size: 2.2em;
    }

    .cimtic-bottom-section {
      padding: 40px 30px;
    }

    .cimtic-logo-placeholder {
      font-size: 1.2em;
      padding: 15px 30px;
    }
  }
</style>

<main id="main" class="site-main cimtic-page">

  <div class="cimtic-content-wrapper">

    <div class="cimtic-top-section">

      <div class="cimtic-image-column">
        <!-- Image Placeholder -->
        <span>Left Column Image Area</span>
      </div>

      <div class="cimtic-text-column">
        <h2>CIMTIC</h2>
        <p>
          CIMTIC™ is sintered titanium carbide (TiC) with excellent wettability with the steel. It is designed to
          combine sintered TiC with iron or steel by the cast-in process. The sintered TiC is metallurgically bonded in
          the base metal during the casting process and eliminates the residual stress that usually happened in the
          brazing process.
        </p>
        <p>
          CIMTIC™ is extensively used to build rollers for steel rolling, drilling bits, crusher teeth, shovel teeth,
          and hammer crusher tips.
        </p>
      </div>

    </div>

    <div class="cimtic-bottom-section">
      <div class="cimtic-logo-placeholder">
        <!-- Logo Placeholder -->
        <span>CIMTIC Logo Area</span>
      </div>
    </div>

  </div>

</main><!-- #main -->

<?php
get_footer();
?>