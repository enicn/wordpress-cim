<?php
/**
 * Template Name: CWI Product Page // You can rename this to something more specific
 */
get_header(); ?>

<style>
  /*--------------------------------------------------------------
# Page Specific Styles
--------------------------------------------------------------*/
  .cwi-page-container {
    /* Add general container styles if needed, like max-width */
    /* max-width: 1200px; */
    /* margin: 0 auto; */
    font-family: sans-serif;
    /* Basic fallback font */
  }

  /* --- Helper for Placeholders --- */
  .placeholder-info {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    width: 100%;
    color: #aaa;
    font-size: 0.9em;
    text-align: center;
    padding: 10px;
    box-sizing: border-box;
  }

  /* --- Top Section --- */
  .cwi-top-section {
    display: flex;
    /* Default to row, switch to column on smaller screens */
    flex-wrap: wrap;
    /* Allow wrapping */
    background-color: #352d20;
    /* Dark brown/olive background from image */
    color: #ffffff;
  }

  .cwi-top-image-area {
    flex: 1 1 50%;
    /* Flex grow, shrink, basis */
    min-width: 300px;
    /* Minimum width before wrapping */
    /* The image itself will define the height, or set a min-height */
  }

  .cwi-top-image-placeholder {
    width: 100%;
    min-height: 350px;
    /* Adjust as needed */
    background-color: #555;
    /* Placeholder background */
    border: 1px dashed #888;
    /* Placeholder border */
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .cwi-top-content-area {
    flex: 1 1 50%;
    /* Flex grow, shrink, basis */
    min-width: 300px;
    /* Minimum width before wrapping */
    padding: 40px;
    /* Padding around text */
    box-sizing: border-box;
  }

  .cwi-top-content-area h2 {
    font-size: 2.2em;
    /* Adjust size */
    color: #e0d6a8;
    /* Light gold/khaki color for heading */
    margin-bottom: 25px;
    line-height: 1.3;
  }

  .cwi-top-content-area p {
    font-size: 1em;
    /* Adjust size */
    line-height: 1.6;
    margin-bottom: 15px;
  }

  /* --- Middle Section --- */
  .cwi-middle-section {
    display: flex;
    flex-wrap: wrap;
    /* Allow wrapping */
    justify-content: center;
    /* Center items */
    gap: 30px;
    /* Space between items */
    background-color: #b8a05a;
    /* Gold/brown background from image */
    padding: 50px 20px;
    /* Padding top/bottom and left/right */
  }

  .cwi-product-block {
    flex: 1 1 40%;
    /* Adjust basis for how many fit per row */
    max-width: 400px;
    /* Max width for each block */
    text-align: center;
  }

  .cwi-product-logo-placeholder {
    height: 120px;
    /* Adjust as needed */
    width: 100%;
    /* Take full width of block */
    max-width: 300px;
    /* Limit logo placeholder width */
    margin: 0 auto 20px auto;
    /* Center horizontally, add bottom margin */
    background-color: #d3c08a;
    /* Lighter gold placeholder */
    border: 1px dashed #8b7340;
    /* Placeholder border */
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .cwi-product-button {
    display: inline-block;
    padding: 12px 25px;
    background: linear-gradient(to bottom, #7b4f9d, #5a3a7a);
    /* Purple gradient approximation */
    color: #ffffff;
    text-decoration: none;
    border: none;
    border-radius: 4px;
    font-weight: bold;
    cursor: pointer;
    transition: opacity 0.2s ease;
  }

  .cwi-product-button:hover {
    opacity: 0.85;
  }

  /* --- Bottom Section (Video) --- */
  .cwi-bottom-section {
    position: relative;
    /* Needed for absolute positioning of overlays */
    background-color: #111;
    /* Fallback background */
    overflow: hidden;
    /* Hide potential overflow */
  }

  .cwi-bottom-video-placeholder {
    width: 100%;
    min-height: 450px;
    /* Adjust based on desired aspect ratio/height */
    background-color: #333;
    /* Placeholder background */
    border: 1px dashed #666;
    /* Placeholder border */
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    /* Context for overlays */
  }

  .cwi-bottom-cim-logo-placeholder {
    position: absolute;
    top: 20px;
    left: 20px;
    width: 100px;
    /* Adjust size */
    height: 50px;
    /* Adjust size */
    background-color: #fff;
    /* Placeholder background */
    border: 1px dashed #ccc;
    /* Placeholder border */
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 2;
    /* Ensure it's above the video placeholder background */
  }

  .cwi-bottom-overlay-content {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    text-align: center;
    z-index: 1;
    /* Ensure it's above the video placeholder background */
    padding: 20px;
    box-sizing: border-box;
    background: rgba(0, 0, 0, 0.2);
    /* Optional subtle dark overlay */
  }

  .cwi-bottom-overlay-content h3 {
    /* HCWI Text */
    font-size: 3.5em;
    font-weight: bold;
    margin: 0;
    text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.6);
  }

  .cwi-bottom-play-button-placeholder {
    width: 70px;
    height: 70px;
    border: 3px solid #ffffff;
    border-radius: 50%;
    background-color: rgba(0, 0, 0, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    margin: 25px 0;
    /* Space above and below */
    transition: background-color 0.2s ease;
  }

  .cwi-bottom-play-button-placeholder:hover {
    background-color: rgba(0, 0, 0, 0.5);
  }

  .cwi-bottom-play-icon-placeholder {
    /* Placeholder for the triangle play icon */
    width: 0;
    height: 0;
    border-top: 15px solid transparent;
    border-bottom: 15px solid transparent;
    border-left: 25px solid #ffffff;
    margin-left: 5px;
    /* Adjust positioning inside the circle */
  }

  .cwi-bottom-overlay-content p {
    /* WC/TiC Text */
    font-size: 1.3em;
    margin: 0;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.6);
  }


  /* --- Responsive Adjustments --- */
  @media (max-width: 768px) {
    .cwi-top-section {
      flex-direction: column;
    }

    .cwi-top-image-area,
    .cwi-top-content-area {
      flex-basis: 100%;
      /* Stack full width */
    }

    .cwi-top-content-area {
      padding: 30px;
    }

    .cwi-middle-section {
      flex-direction: column;
      align-items: center;
      /* Center blocks when stacked */
    }

    .cwi-product-block {
      flex-basis: 80%;
      /* Take more width when stacked */
      max-width: 450px;
    }

    .cwi-bottom-overlay-content h3 {
      font-size: 2.5em;
    }

    .cwi-bottom-overlay-content p {
      font-size: 1.1em;
    }

    .cwi-bottom-play-button-placeholder {
      width: 60px;
      height: 60px;
    }

    .cwi-bottom-play-icon-placeholder {
      border-top-width: 12px;
      border-bottom-width: 12px;
      border-left-width: 20px;
    }
  }
</style>

<main id="main" class="site-main">
  <div class="cwi-page-container">

    <!-- Top Section -->
    <section class="cwi-top-section">
      <div class="cwi-top-image-area">
        <div class="cwi-top-image-placeholder">
          <span class="placeholder-info">Placeholder: Red Hot Cylinders Image</span>
          <!-- In real template, replace this div with: -->
          <!-- <img src="<?php // echo get_template_directory_uri(); ?>/path/to/your/top-image.jpg" alt="High Chrome White Iron Components"> -->
        </div>
      </div>
      <div class="cwi-top-content-area">
        <h2>CHROME WHITE IRON<br>(CWI)</h2>
        <p>At CIM, we collaborate with industry partners to find solutions for common wear problems; because of this,
          CIM has developed TungCast™ and TitanCast™ with Tungsten Carbide (WC) or Titanium Carbide (TiC)
          metallurgically bonded in high chrome white iron (ASTM A532 IIB).</p>
        <p>The WC or TiC reinforced layer is 15 - 25 mm. These products are extensively used in aggressive wear and
          high-impact services.</p>
      </div>
    </section>

    <!-- Middle Section -->
    <section class="cwi-middle-section">
      <div class="cwi-product-block">
        <div class="cwi-product-logo-placeholder">
          <span class="placeholder-info">Placeholder: TUNGCAST™ Logo</span>
          <!-- In real template, replace this div with: -->
          <!-- <img src="<?php // echo get_template_directory_uri(); ?>/path/to/your/tungcast-logo.png" alt="TungCast Logo"> -->
        </div>
        <a href="#" class="cwi-product-button">TUNGCAST™ Datasheet</a>
      </div>
      <div class="cwi-product-block">
        <div class="cwi-product-logo-placeholder">
          <span class="placeholder-info">Placeholder: TITANCAST™ Logo</span>
          <!-- In real template, replace this div with: -->
          <!-- <img src="<?php // echo get_template_directory_uri(); ?>/path/to/your/titancast-logo.png" alt="TitanCast Logo"> -->
        </div>
        <a href="#" class="cwi-product-button">TITANCAST™ Datasheet</a>
      </div>
    </section>

    <!-- Bottom Section -->
    <section class="cwi-bottom-section">
      <div class="cwi-bottom-video-placeholder">
        <span class="placeholder-info">Placeholder: Video Background Image (Red Hot Cylinders)</span>
        <!-- In real template, this div might be a background image or contain a video element -->
        <!-- <img src="<?php // echo get_template_directory_uri(); ?>/path/to/your/video-still.jpg" alt="Video Background" style="position:absolute; top:0; left:0; width:100%; height:100%; object-fit:cover; z-index:0;"> -->

        <div class="cwi-bottom-cim-logo-placeholder">
          <span class="placeholder-info">Placeholder: CIM Logo</span>
          <!-- In real template, replace this div with: -->
          <!-- <img src="<?php // echo get_template_directory_uri(); ?>/path/to/your/cim-logo.png" alt="CIM Logo" style="width: 100%; height: auto;"> -->
        </div>

        <div class="cwi-bottom-overlay-content">
          <h3>HCWI</h3>
          <div class="cwi-bottom-play-button-placeholder" role="button" aria-label="Play Video">
            <div class="cwi-bottom-play-icon-placeholder"></div>
          </div>
          <p>WC / TiC Reinforced Chrome White iron</p>
        </div>
      </div>
    </section>

  </div><!-- .cwi-page-container -->
</main>

<?php
get_footer(); ?>