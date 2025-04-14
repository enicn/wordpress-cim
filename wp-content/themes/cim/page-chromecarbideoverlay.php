<?php
/**
 * Template Name: CCO Page Layout
 */
get_header(); ?>

<style>
  /*--------------------------------------------------------------
# Page Specific Styles
--------------------------------------------------------------*/
  .cco-page-main {
    /* Add styles if needed for the overall main container */
  }

  /* Top Section */
  .cco-top-section {
    display: flex;
    flex-wrap: wrap;
    /* Allow wrapping on smaller screens if needed */
    min-height: 50vh;
    /* Adjust height as needed */
    background-color: #f0f0f0;
    /* Fallback background */
  }

  .cco-top-left-column {
    flex: 1;
    /* Adjust flex ratio as needed, e.g., flex: 1; */
    min-width: 300px;
    /* Minimum width before wrapping */
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px;
    /* Add padding if needed */
    /* Placeholder for the left image */
    background-color: #dcdcdc;
    border: 1px dashed #aaaaaa;
    color: #555;
    text-align: center;
    font-size: 1.2em;
  }

  .cco-top-right-column {
    flex: 1.5;
    /* Adjust flex ratio as needed, e.g., flex: 1.5; makes it wider */
    min-width: 300px;
    /* Minimum width before wrapping */
    background-color: #2A402A;
    /* Dark green background */
    color: #ffffff;
    padding: 40px 50px;
    /* Adjust padding */
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .cco-top-right-column h1 {
    color: #E0D050;
    /* Yellowish color */
    font-size: 2.5em;
    /* Adjust font size */
    font-weight: bold;
    margin-bottom: 20px;
  }

  .cco-top-right-column p {
    font-size: 1em;
    /* Adjust font size */
    line-height: 1.6;
    margin-bottom: 15px;
  }

  .cco-logo-button-area {
    margin-top: 30px;
    /* Space above logo/button */
    display: flex;
    align-items: center;
    gap: 20px;
    /* Space between logo and button */
  }

  .cco-duraplate-logo-placeholder {
    /* Placeholder for DuraPlate Logo */
    width: 150px;
    /* Adjust size */
    height: 50px;
    /* Adjust size */
    background-color: #777777;
    border: 1px dashed #aaaaaa;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-size: 0.9em;
  }

  .cco-datasheet-button {
    display: inline-block;
    padding: 10px 20px;
    background: linear-gradient(to right, #6a3f9a, #4d68b1);
    /* Purple/blue gradient */
    color: #ffffff;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    transition: opacity 0.3s ease;
  }

  .cco-datasheet-button:hover {
    opacity: 0.9;
  }

  /* Bottom Section */
  .cco-bottom-section {
    padding: 40px 20px;
    /* Adjust padding */
    background-color: #e0dcd7;
    /* Light brownish/grey background to mimic wood */
    position: relative;
    min-height: 50vh;
    /* Adjust height */
  }

  .cco-cim-logo-placeholder {
    /* Placeholder for CIM Logo */
    position: absolute;
    top: 20px;
    left: 20px;
    width: 100px;
    /* Adjust size */
    height: 60px;
    /* Adjust size */
    background-color: #f0ad4e;
    /* Yellowish background */
    border: 1px dashed #aaaaaa;
    color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-size: 0.9em;
    z-index: 10;
  }

  .cco-video-area {
    position: relative;
    width: 70%;
    /* Adjust width */
    max-width: 800px;
    /* Max width */
    margin: 60px auto 20px auto;
    /* Center horizontally, add margin top/bottom */
  }

  .cco-video-placeholder {
    /* Placeholder for the main video/image */
    width: 100%;
    aspect-ratio: 16 / 9;
    /* Common video aspect ratio */
    background-color: #555555;
    /* Dark grey for video placeholder */
    border: 1px dashed #aaaaaa;
    color: #ffffff;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
    font-size: 1.5em;
  }

  .cco-play-button {
    font-size: 3em;
    /* Size of the play icon */
    color: #ffffff;
    margin-top: 10px;
    /* Space between CCO text and play button */
    cursor: pointer;
  }

  .cco-bottom-caption {
    position: absolute;
    bottom: 30px;
    /* Adjust position from bottom */
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(0, 0, 0, 0.6);
    color: #E0D050;
    /* Yellowish text */
    padding: 8px 20px;
    border-radius: 4px;
    font-size: 1.1em;
    white-space: nowrap;
  }

  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .cco-top-section {
      flex-direction: column;
    }

    .cco-top-right-column {
      padding: 30px 20px;
    }

    .cco-top-right-column h1 {
      font-size: 2em;
    }

    .cco-video-area {
      width: 90%;
    }

    .cco-bottom-caption {
      font-size: 1em;
      bottom: 15px;
    }

    .cco-cim-logo-placeholder {
      width: 80px;
      height: 48px;
      font-size: 0.8em;
    }
  }
</style>

<main id="main" class="site-main cco-page-main">

  <!-- Top Section -->
  <section class="cco-top-section">
    <div class="cco-top-left-column">
      <!-- Placeholder for Top Left Image -->
      Top Left Image Placeholder
    </div>
    <div class="cco-top-right-column">
      <h1>CHROME CARBIDE<br>OVERLAY (CCO)</h1>
      <p>CIM DuraPlate™ is a composite Chrome Carbide Overlay (CCO) manufactured by special automatic welding
        technology. The overlay surface is smooth and free of welding beads and check cracks.</p>
      <p>The CCO overlay can be made up to 19 mm thick with a single pass and a maximum of 25 mm. The hardness, G65 and
        chemistry are consistent through-thickness of the overlay.</p>
      <p>The microstructure of the cryptocrystalline martensitic matrix with precipitated chrome carbide and the other
        composite carbides makes the DuraPlate™ harder and more abrasion-resistant than typical CCO materials.</p>
      <div class="cco-logo-button-area">
        <div class="cco-duraplate-logo-placeholder">
          <!-- Placeholder for DuraPlate Logo -->
          DuraPlate™ Logo
        </div>
        <a href="#" class="cco-datasheet-button">DuraPlate™ Datasheet</a>
      </div>
    </div>
  </section>

  <!-- Bottom Section -->
  <section class="cco-bottom-section">
    <div class="cco-cim-logo-placeholder">
      <!-- Placeholder for CIM Logo -->
      CIM Logo
    </div>
    <div class="cco-video-area">
      <div class="cco-video-placeholder">
        <!-- Placeholder for Video/Image -->
        CCO
        <div class="cco-play-button">▶</div> <!-- Simple Play Button Icon -->
      </div>
      <div class="cco-bottom-caption">
        Chrome Carbide Overlay
      </div>
    </div>
  </section>

</main><!-- #main -->

<?php
get_footer();
?>