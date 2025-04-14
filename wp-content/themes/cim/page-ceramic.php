<?php
/**
 * Template Name: Silicon Carbide Ceramic Page
 *
 * This template replicates the layout seen in the provided screenshot
 * for a page showcasing Silicon Carbide Ceramic products.
 */
get_header(); ?>

<style>
  /*--------------------------------------------------------------
# Page Specific Styles
--------------------------------------------------------------*/

  /* General Body Styling (Approximation) */
  body {
    background-color: #1a1a1a;
    /* Dark background approximation */
    /* A full replication of the wavy background would require an image or complex SVG/CSS */
  }

  /* Main Container */
  .sic-page-container {
    max-width: 1100px;
    /* Adjust max-width as needed */
    margin: 40px auto;
    /* Centering and top/bottom margin */
    background-color: #fff;
    /* White background for the main content block */
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
    font-family: sans-serif;
    /* Basic font */
    overflow: hidden;
    /* Contains floats/flex items */
  }

  /* Row Styling */
  .sic-row {
    display: flex;
    flex-wrap: wrap;
    /* Allow wrapping on smaller screens if needed */
  }

  /* Column Styling */
  .sic-col {
    flex: 1;
    /* Make columns flexible */
    min-width: 300px;
    /* Minimum width before wrapping */
  }

  /* Top Section */
  .sic-top-section {
    /* Flex properties handled by .sic-row */
  }

  .sic-top-left {
    padding: 20px;
    background-color: #fff;
    /* White background for this section */
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    /* 2 columns */
    grid-gap: 15px;
    /* Gap between images */
    align-items: center;
    justify-items: center;
  }

  .sic-top-right {
    background-color: #4d4a3a;
    /* Dark olive/brown background */
    color: #ffffff;
    padding: 30px;
    display: flex;
    flex-direction: column;
    justify-content: center;
  }

  .sic-top-right h2 {
    color: #f0a830;
    /* Gold/yellow color for heading */
    font-size: 1.8em;
    margin-top: 0;
    margin-bottom: 15px;
    font-weight: bold;
  }

  .sic-top-right p {
    font-size: 0.95em;
    line-height: 1.6;
    margin-bottom: 25px;
  }

  .sic-logo-placeholder {
    width: 150px;
    /* Adjust as needed */
    height: 50px;
    /* Adjust as needed */
    background-color: #666;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    margin-bottom: 25px;
    font-size: 0.9em;
    border: 1px dashed #aaa;
  }

  .sic-datasheet-button {
    display: inline-block;
    background: linear-gradient(to right, #8a4d9d, #6c42b0);
    /* Purple gradient */
    color: #ffffff;
    padding: 10px 20px;
    text-decoration: none;
    border-radius: 5px;
    font-weight: bold;
    text-align: center;
    transition: background 0.3s ease;
    align-self: flex-start;
    /* Align button to the start */
  }

  .sic-datasheet-button:hover {
    background: linear-gradient(to right, #6c42b0, #8a4d9d);
    /* Swap gradient on hover */
    color: #fff;
  }

  /* Bottom Section */
  .sic-bottom-section {
    /* Flex properties handled by .sic-row */
    border-top: 1px solid #eee;
    /* Separator line */
  }

  .sic-bottom-left {
    background-color: #000000;
    /* Black background */
    padding: 20px;
    display: flex;
    flex-direction: column;
    align-items: center;
    /* Center items horizontally */
    gap: 20px;
    /* Space between items */
  }

  .sic-cim-logo-placeholder {
    width: 100px;
    /* Adjust as needed */
    height: 70px;
    /* Adjust as needed */
    background-color: #f0a830;
    /* Gold background */
    display: flex;
    align-items: center;
    justify-content: center;
    color: #000;
    /* Placeholder text color */
    font-size: 0.9em;
    border: 1px dashed #aaa;
    margin-bottom: 10px;
    /* Space below logo */
  }

  .sic-bottom-right {
    background-color: #e0e0e0;
    /* Light grey background for video area */
    position: relative;
    /* For positioning overlays */
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 350px;
    /* Minimum height */
    background-image: linear-gradient(rgba(0, 0, 0, 0.1), rgba(0, 0, 0, 0.1));
    /* Slight overlay */
  }

  .sic-video-placeholder-content {
    /* Represents the visual content, like the large pipe */
    width: 80%;
    height: 80%;
    background-color: #b0b0b0;
    /* Placeholder color for the pipe */
    border-radius: 10px;
    /* Rounded corners if needed */
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.5em;
    color: #555;
    border: 2px dashed #888;
    text-align: center;
    position: relative;
    /* Context for absolute children */
    overflow: hidden;
    /* Ensure overlays stay within */
  }

  .sic-video-text-overlay-top {
    position: absolute;
    top: 30px;
    left: 30px;
    color: #ffffff;
    font-size: 2.5em;
    font-weight: bold;
    text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.5);
  }

  .sic-video-play-button {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 80px;
    height: 80px;
    background-color: rgba(0, 0, 0, 0.5);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
  }

  .sic-video-play-button::after {
    content: '';
    display: block;
    width: 0;
    height: 0;
    border-top: 20px solid transparent;
    border-bottom: 20px solid transparent;
    border-left: 30px solid #ffffff;
    margin-left: 5px;
    /* Adjust positioning of triangle */
  }


  .sic-video-text-overlay-bottom {
    position: absolute;
    bottom: 20px;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(0, 0, 0, 0.6);
    color: #ffffff;
    padding: 5px 15px;
    border-radius: 3px;
    font-size: 1.1em;
    white-space: nowrap;
  }


  /* Image Placeholders */
  .sic-image-placeholder {
    background-color: #cccccc;
    border: 1px dashed #999999;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: #666666;
    font-size: 0.9em;
    min-height: 150px;
    /* Example height */
    width: 100%;
    /* Take full width of grid cell or container */
  }

  /* Footer Menu Placeholder */
  .sic-footer-menu {
    background-color: #f1f1f1;
    /* Light grey background */
    text-align: center;
    padding: 15px 0;
    border-top: 1px solid #ddd;
  }

  .sic-hamburger-icon {
    display: inline-block;
    width: 30px;
    height: 22px;
    position: relative;
  }

  .sic-hamburger-icon span {
    display: block;
    position: absolute;
    height: 4px;
    width: 100%;
    background: #555;
    /* Icon bar color */
    border-radius: 2px;
    opacity: 1;
    left: 0;
    transform: rotate(0deg);
    transition: .25s ease-in-out;
  }

  .sic-hamburger-icon span:nth-child(1) {
    top: 0px;
  }

  .sic-hamburger-icon span:nth-child(2) {
    top: 9px;
  }

  .sic-hamburger-icon span:nth-child(3) {
    top: 18px;
  }


  /* Responsive Adjustments (Example) */
  @media (max-width: 768px) {
    .sic-row {
      flex-direction: column;
      /* Stack columns */
    }

    .sic-top-left {
      grid-template-columns: 1fr;
      /* Stack images in top-left */
    }

    .sic-bottom-right {
      min-height: 300px;
      /* Adjust height for smaller screens */
    }

    .sic-video-text-overlay-top {
      font-size: 1.8em;
      top: 15px;
      left: 15px;
    }

    .sic-video-text-overlay-bottom {
      font-size: 1em;
      bottom: 10px;
    }

    .sic-video-play-button {
      width: 60px;
      height: 60px;
    }

    .sic-video-play-button::after {
      border-top-width: 15px;
      border-bottom-width: 15px;
      border-left-width: 22px;
    }

  }
</style>

<main id="main" class="site-main sic-page-wrapper">
  <div class="sic-page-container">

    <!-- Top Section -->
    <div class="sic-row sic-top-section">
      <div class="sic-col sic-top-left">
        <div class="sic-image-placeholder">[Impeller Image 1 Placeholder]</div>
        <div class="sic-image-placeholder">[Volute Image 1 Placeholder]</div>
        <div class="sic-image-placeholder">[Impeller Image 2 Placeholder]</div>
        <div class="sic-image-placeholder">[Impeller Image 3 Placeholder]</div>
      </div>
      <div class="sic-col sic-top-right">
        <h2>SILICON CARBIDE CERAMIC (SiC)</h2>
        <p>
          CIMSiC™ is a silicon carbide ceramic with excellent corrosion, erosion and thermal shock resistance. CIM has
          developed three types of ceramic products, Nitride Bonded SiC (NBSC), Reaction Bonded SiC(RBSC), and resin
          bonded SiC.
        </p>
        <p>
          CIMSiC™ is extensively used on slurry pump suction liner, impeller, volute and hydrocyclones in mining,
          coal-fired power generation and smelting industry.
        </p>
        <div class="sic-logo-placeholder">[CIMSiC™ Logo Placeholder]</div>
        <a href="#" class="sic-datasheet-button">CIMSiC™ Datasheet</a>
      </div>
    </div>

    <!-- Bottom Section -->
    <div class="sic-row sic-bottom-section">
      <div class="sic-col sic-bottom-left">
        <div class="sic-cim-logo-placeholder">[CIM Logo Placeholder]</div>
        <div class="sic-image-placeholder">[Bottom Impeller Image Placeholder]</div>
        <div class="sic-image-placeholder">[Bottom Volute Image Placeholder]</div>
      </div>
      <div class="sic-col sic-bottom-right">
        <div class="sic-video-placeholder-content">
          <!-- This div represents the visual area where the video/image would be -->
          [Large Ceramic Part Visual Placeholder]

          <!-- Overlays -->
          <div class="sic-video-text-overlay-top">SiC</div>
          <div class="sic-video-play-button" title="Play Video"></div>
          <div class="sic-video-text-overlay-bottom">Silicon Carbide Ceramic</div>
        </div>
      </div>
    </div>

    <!-- Footer Menu Placeholder -->
    <div class="sic-footer-menu">
      <div class="sic-hamburger-icon">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>

  </div><!-- .sic-page-container -->
</main><!-- #main -->

<?php
get_footer();
?>