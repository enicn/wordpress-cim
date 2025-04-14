<?php
/**
 * Template Name: Additive Manufacturing Page
 *
 * This template replicates the layout for the Additive Manufacturing page.
 */

get_header(); ?>

<style>
  /*--------------------------------------------------------------
# Page Specific Styles for Additive Manufacturing
--------------------------------------------------------------*/
  .additive-manufacturing-page {
    background-color: #2d2d2d;
    /* Dark background */
    color: #e0e0e0;
    /* Light text color */
    padding-top: 50px;
    padding-bottom: 50px;
  }

  .am-container {
    max-width: 960px;
    /* Adjust max-width as needed */
    margin-left: auto;
    margin-right: auto;
    padding-left: 15px;
    padding-right: 15px;
    font-family: sans-serif;
    /* Basic font */
  }

  .am-container h1 {
    font-size: 2.8em;
    /* Large title font size */
    font-weight: bold;
    color: #daa520;
    /* Gold-like color */
    text-align: left;
    /* Align as per image */
    margin-bottom: 30px;
    letter-spacing: 1px;
  }

  .am-container h2 {
    font-size: 1.5em;
    font-weight: bold;
    color: #ffffff;
    /* White heading */
    margin-top: 40px;
    margin-bottom: 15px;
  }

  .am-container h3 {
    font-size: 1.2em;
    font-weight: bold;
    color: #ffffff;
    /* White heading */
    margin-top: 30px;
    /* Space above section titles */
    margin-bottom: 10px;
  }

  .am-container p {
    font-size: 1em;
    line-height: 1.6;
    margin-bottom: 15px;
    color: #cccccc;
    /* Slightly dimmer text for paragraphs */
  }

  .am-container p strong {
    color: #e0e0e0;
    /* Make strong text slightly brighter if needed */
  }

  .am-image-placeholder {
    background-color: #444444;
    /* Placeholder background */
    border: 1px dashed #666666;
    min-height: 300px;
    /* Example height */
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #aaaaaa;
    margin-top: 40px;
    font-size: 1.1em;
    padding: 20px;
  }

  /* Responsive adjustments if necessary */
  @media (max-width: 768px) {
    .am-container h1 {
      font-size: 2.2em;
    }

    .am-container h2 {
      font-size: 1.3em;
    }

    .am-container h3 {
      font-size: 1.1em;
    }
  }
</style>

<main id="main" class="site-main additive-manufacturing-page">
  <div class="am-container">

    <h1>ADDITIVE MANUFACTURING</h1>

    <h2>PTAAM Project: Revolutionizing Additive Manufacturing</h2>
    <p>
      At Canadian Innovative Materials, we believe in pushing the boundaries of what's possible. Our PTAAM machine
      development represents a significant leap in additive manufacturing, combining precision, efficiency, and
      versatility with plasma transferred arc welding. This endeavor is a collaborative effort, bringing together
      experts from the mining industry to redefine how we create complex field-proven 3D printed components.
    </p>

    <h3>Key Features and Capabilities:</h3>
    <p>
      <strong>Large-Scale 8-Axes Printing:</strong><br>
      Witness the power of our PTAAM machine capable of printing parts up to 2 x 2 x 2 meters in size. Unleashing new
      possibilities for manufacturing large and intricate components.
    </p>

    <h3>Hybrid Manufacturing Operations:</h3>
    <p>
      Our PTAAM system integrates AI and 3D vision technologies, marking a significant step towards hybrid additive
      manufacturing. This ensures unparalleled precision and efficiency in every layer.
    </p>

    <h3>Vertical Production Model:</h3>
    <p>
      Experience a seamless process from metal powder or wire to the production of complex 3D parts. Our vertical
      production model ensures control, quality, and reliability at every stage.
    </p>

    <h3>Environmental-Friendly Business Model:</h3>
    <p>
      Explore how PTAAM promotes a circular economy, reducing resource consumption and costs by 80%. Embrace sustainable
      manufacturing practices without compromising on quality.
    </p>

    <h3>Commercialization and Collaboration:</h3>
    <p>
      The PTAAM project goes beyond innovation; it's a commitment to transforming industries. Explore our journey in
      commercializing PTAAM technology, forging collaborations, and contributing to the growth of the manufacturing
      sector.
    </p>

    <h3>Get Involved:</h3>
    <p>
      As we embark on this groundbreaking venture, we invite you to be a part of our journey. Stay tuned for updates,
      events, and opportunities to engage with the PTAAM project. Join us in shaping the future of additive
      manufacturing.
    </p>

    <div class="am-image-placeholder">
      <!-- Image Placeholder: Add your image here using WordPress functions or static HTML -->
      Image of the manufacturing equipment will be displayed here.
    </div>

  </div><!-- .am-container -->
</main><!-- #main -->

<?php
get_footer(); ?>