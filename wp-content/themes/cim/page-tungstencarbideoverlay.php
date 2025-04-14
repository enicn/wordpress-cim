<?php
/**
 * Template Name: WCO Page Layout
 */
get_header(); ?>

<style>
  /*--------------------------------------------------------------
# Page Specific Styles
--------------------------------------------------------------*/

  /* General Section Styling */
  .wco-section {
    padding: 40px 0;
    overflow: hidden;
    /* Prevents margin collapse and contains floats */
  }

  /* Section 1: Top Section (Image + Text) */
  .wco-section-1 {
    background-color: #ffffff;
    /* White background behind the columns */
    padding: 0;
    /* No padding on the section itself */
  }

  .wco-section-1-container {
    display: flex;
    flex-wrap: wrap;
    /* Allow wrapping on smaller screens */
    align-items: stretch;
    /* Make columns equal height */
    max-width: 100%;
    /* Ensure it doesn't exceed viewport */
    margin: 0 auto;
  }

  .wco-section-1 .wco-image-column,
  .wco-section-1 .wco-text-column {
    width: 50%;
    /* Each column takes half the width */
    box-sizing: border-box;
  }

  .wco-section-1 .wco-image-column .wco-placeholder {
    background-color: #e0e0e0;
    /* Placeholder background */
    display: flex;
    align-items: center;
    justify-content: center;
    color: #888;
    font-size: 1.2em;
    height: 100%;
    /* Fill the height of the container */
    min-height: 400px;
    /* Minimum height */
    text-align: center;
  }

  .wco-section-1 .wco-text-column {
    background-color: #005f87;
    /* Blue background */
    color: #ffffff;
    /* White text */
    padding: 50px 40px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .wco-section-1 .wco-text-column h1 {
    color: #f0c05a;
    /* Gold color for heading */
    font-size: 2.5em;
    font-weight: bold;
    margin-bottom: 25px;
  }

  .wco-section-1 .wco-text-column p {
    font-size: 1em;
    line-height: 1.6;
    margin-bottom: 15px;
  }

  /* Section 2: Logos and Datasheets */
  .wco-section-2 {
    background-color: #bfa96b;
    /* Gold/Brown background */
  }

  .wco-section-2-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-around;
    /* Space out items */
    align-items: center;
    max-width: 1100px;
    margin: 0 auto;
    padding: 40px 20px;
    /* Add padding inside the container */
  }

  .wco-section-2 .wco-logo-item {
    text-align: center;
    margin: 20px;
  }

  .wco-section-2 .wco-logo-placeholder {
    background-color: #e0e0e0;
    color: #555;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 300px;
    /* Approx width */
    height: 80px;
    /* Approx height */
    margin-bottom: 20px;
    font-size: 1.5em;
    font-weight: bold;
    border: 1px dashed #aaa;
  }

  .wco-section-2 .wco-datasheet-button {
    display: inline-block;
    background-color: #6a0dad;
    /* Purple color */
    color: #ffffff;
    padding: 10px 25px;
    text-decoration: none;
    border-radius: 5px;
    font-size: 0.9em;
    transition: background-color 0.3s ease;
  }

  .wco-section-2 .wco-datasheet-button:hover {
    background-color: #5a0bad;
    /* Darker purple on hover */
  }

  /* Section 3: Video/Link Section */
  .wco-section-3 {
    position: relative;
    /* Needed for absolute positioning of children */
    background-color: #333;
    /* Fallback background */
    padding: 0;
    /* No padding on the section itself */
    min-height: 500px;
    /* Give it some height */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow: hidden;
  }

  .wco-section-3 .wco-background-placeholder {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: #555;
    /* Darker placeholder */
    opacity: 0.7;
    /* Simulate faded background */
    display: flex;
    align-items: center;
    justify-content: center;
    color: #aaa;
    font-size: 1.5em;
    z-index: 1;
    /* Behind content */
  }


  .wco-section-3-content {
    position: relative;
    /* To stay above the background placeholder */
    z-index: 2;
    color: #ffffff;
    padding: 20px;
    /* background-color: rgba(0, 0, 0, 0.3); Optional semi-transparent overlay */
    border-radius: 10px;
    display: flex;
    flex-direction: column;
    align-items: center;
  }

  .wco-section-3 .wco-cim-logo-placeholder {
    background-color: #f0c05a;
    /* Goldish color */
    color: #005f87;
    /* Blue text */
    width: 100px;
    height: 70px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: bold;
    margin-bottom: 30px;
    /* Space below logo */
    border-radius: 5px;
    /* Slight rounding */
  }

  .wco-section-3 .wco-title {
    font-size: 3em;
    font-weight: bold;
    margin-bottom: 30px;
    /* Space below title */
  }

  .wco-section-3 .wco-play-button-placeholder {
    display: inline-block;
    width: 80px;
    height: 80px;
    background-color: rgba(255, 255, 255, 0.2);
    /* Semi-transparent white */
    border: 2px solid #ffffff;
    border-radius: 50%;
    /* Make it circular */
    position: relative;
    /* For positioning the triangle */
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .wco-section-3 .wco-play-button-placeholder:hover {
    background-color: rgba(255, 255, 255, 0.4);
  }

  /* Simple triangle using borders */
  .wco-section-3 .wco-play-button-placeholder::after {
    content: '';
    display: block;
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-top: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 25px solid #ffffff;
    /* White triangle */
    transform: translate(-40%, -50%);
    /* Adjust position to center */
  }

  /* Responsive Adjustments */
  @media (max-width: 991px) {

    .wco-section-1 .wco-image-column,
    .wco-section-1 .wco-text-column {
      width: 100%;
      /* Stack columns */
    }

    .wco-section-1 .wco-text-column {
      padding: 40px 30px;
    }

    .wco-section-1 .wco-text-column h1 {
      font-size: 2em;
    }
  }

  @media (max-width: 767px) {
    .wco-section-1 .wco-placeholder {
      min-height: 300px;
      /* Reduce min-height on smaller screens */
    }

    .wco-section-1 .wco-text-column {
      padding: 30px 20px;
    }

    .wco-section-2-container {
      flex-direction: column;
      /* Stack logo items */
      padding: 30px 15px;
    }

    .wco-section-2 .wco-logo-placeholder {
      width: 80%;
      /* Make logo placeholder wider */
      max-width: 280px;
      height: 70px;
    }

    .wco-section-3 {
      min-height: 400px;
    }

    .wco-section-3 .wco-title {
      font-size: 2.5em;
    }

    .wco-section-3 .wco-play-button-placeholder {
      width: 70px;
      height: 70px;
    }

    .wco-section-3 .wco-play-button-placeholder::after {
      border-top-width: 12px;
      border-bottom-width: 12px;
      border-left-width: 20px;
    }
  }
</style>

<main id="main" class="site-main">

  <!-- Section 1: Top Section -->
  <section class="wco-section wco-section-1">
    <div class="wco-section-1-container">
      <div class="wco-image-column">
        <div class="wco-placeholder">[Image Placeholder: Tungsten Carbide Parts]</div>
      </div>
      <div class="wco-text-column">
        <h1>TUNGSTEN CARBIDE OVERLAY (WCO)</h1>
        <p>Plasma Transferred Arc (PTA) weld is a high-energy, low heat welding process that provides minimal
          interaction with the base material while allowing the application of a thick weld overlay. Commonly applied
          overlay includes tungsten carbide, chrome carbide, and titanium carbide.</p>
        <p>CIM has developed proprietary PTA TungTough™ and TungHard™ WCO. The ideal combinations of high hardness,
          superior wear resistance and toughness make them the preferred materials for extreme wear applications.</p>
      </div>
    </div>
  </section>

  <!-- Section 2: Logos and Datasheets -->
  <section class="wco-section wco-section-2">
    <div class="wco-section-2-container">
      <div class="wco-logo-item">
        <div class="wco-logo-placeholder">[Logo: TUNGTOUGH™]</div>
        <a href="#" class="wco-datasheet-button">TUNGTOUGH™ Datasheet</a>
      </div>
      <div class="wco-logo-item">
        <div class="wco-logo-placeholder">[Logo: TUNGHARD™]</div>
        <a href="#" class="wco-datasheet-button">TUNGHARD™ Datasheet</a>
      </div>
    </div>
  </section>

  <!-- Section 3: Video/Link Section -->
  <section class="wco-section wco-section-3">
    <div class="wco-background-placeholder">[Background Image Placeholder: Faded Parts]</div>
    <div class="wco-section-3-content">
      <div class="wco-cim-logo-placeholder">[Logo: CIM]</div>
      <div class="wco-title">WCO</div>
      <a href="#" class="wco-play-button-placeholder" aria-label="Play WCO video">
        <!-- Play icon is added via CSS ::after pseudo-element -->
      </a>
    </div>
  </section>

</main><!-- #main -->

<?php
get_footer();
?>