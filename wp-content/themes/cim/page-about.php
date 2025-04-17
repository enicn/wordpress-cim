<?php
/**
 * Template Name: CIM Corporate Page Example
 *
 * @package Industrial
 */

get_header(); ?>

<style>
  .cim-corporate-page {
    background-color: var(--industrial-dark-bg);
  }

  /*--------------------------------------------------------------
# CIM Corporate Page Specific Styles
--------------------------------------------------------------*/

  /* Common Elements */
  .btn {
    display: inline-block;
    padding: 12px 0;
    width: 100%;
    border-radius: 4px;
    text-decoration: none;
    font-weight: bold;
    transition: all 0.3s ease;
    cursor: pointer;
    text-align: center;
  }

  /*--------------------------------------------------------------
# Hero Section
--------------------------------------------------------------*/
  .cim-hero-section {
    padding: 80px 0;
    position: relative;
  }

  .cim-hero-section .hero-content {
    display: flex;
    align-items: stretch;
    gap: 40px;
    /* Space between text and image */
  }

  .cim-hero-section .hero-text {
    flex: 1;
    /* Take remaining space */
  }

  .cim-hero-section h1 {
    font-size: 2.8em;
    color: var(--industrial-yellow);
    /* White title */
    margin-bottom: 20px;
    font-weight: bold;
  }

  .cim-hero-section p {
    font-size: 1.1em;
    line-height: 1.6;
    margin-bottom: 30px;
    color: #c0c0c0;
    /* Slightly lighter grey */
  }

  .cim-hero-section .cim-brochure-btn {
    background: repeat padding-box border-box 0% 0% / auto auto scroll linear-gradient(333deg, #4f44da 26%, rgba(180, 102, 64, 0) 100%), #B46640;
    /* Pinkish to Purple gradient */
    color: #ffffff;
    border: none;
  }

  .cim-hero-section .cim-brochure-btn:hover {
    background: repeat padding-box border-box 0% 0%/auto auto scroll linear-gradient(333deg, #4f44da 26%, rgba(180, 102, 64, 0) 100%), #4F44DA
  }

  .cim-hero-section .hero-image {
    flex-basis: 40%;
    /* Adjust width as needed */
    text-align: right;
    /* Align image content if needed */
  }

  .cim-hero-section .hero-image img {
    max-width: 100%;
    height: auto;
    display: block;
    /* Prevents bottom space */
    /* Placeholder style */
    background-color: #333;
    border: 1px solid #555;
    min-height: 300px;
    /* Example height */
  }

  /*--------------------------------------------------------------
# Values Section
--------------------------------------------------------------*/
  .cim-values-section {
    padding: 0;
    text-align: center;
  }

  .cim-values-section .values-grid {
    display: flex;
    justify-content: space-around;
    /* Distribute items evenly */
    gap: 30px;
    flex-wrap: wrap;
    /* Allow wrapping on smaller screens */
  }

  .cim-values-section .value-item {
    flex: 1;
    padding: 20px;
  }

  .cim-values-section .value-icon {
    width: 90px;
    height: 90px;
    border-radius: 50%;
    background-color: #006699;
    /* Tealish color from image */
    margin: 0 auto 25px auto;
    display: flex;
    align-items: center;
    justify-content: center;
    /* Placeholder for actual icons */
    color: #fff;
    font-size: 1.8em;
    font-weight: bold;
  }

  .cim-values-section .value-icon .icon-placeholder {
    font-size: 0.6em;
    /* Adjust size of placeholder text */
    opacity: 0.7;
  }


  .cim-values-section h3 {
    font-size: 1.6em;
    color: var(--industrial-yellow);
    /* Orange/Gold color from image */
    margin-bottom: 15px;
    font-weight: bold;
  }

  .cim-values-section p {
    font-size: 0.95em;
    line-height: 1.5;
    color: #b0b0b0;
  }

  /*--------------------------------------------------------------
# Vision/Mission Section & Divider
--------------------------------------------------------------*/
  .cim-vision-mission-section {
    position: relative;
    padding-top: 200px;
    /* Creates space for the divider above */
    padding-bottom: 80px;
    overflow: hidden;
    /* Important for containing pseudo-elements if used */
  }

  .vision-mission-container {
    position: relative;
    /* Ensure content is above the divider bg */
    z-index: 2;
  }


  .vision-mission-content {
    display: flex;
    gap: 50px;
    text-align: center;
    margin-bottom: 120px;
  }

  .vision-mission-content .vision-column,
  .vision-mission-content .mission-column {
    flex: 1;
  }

  .vision-mission-content h2 {
    font-size: 1.8em;
    color: var(--industrial-yellow);
    /* Yellow/Gold color */
    margin-bottom: 20px;
    font-weight: bold;
  }

  .vision-mission-content p {
    font-size: 1.05em;
    line-height: 1.6;
    color: #c0c0c0;
  }


  /*--------------------------------------------------------------
# Responsive Styles
--------------------------------------------------------------*/

  /* Tablet */
  @media (max-width: 991px) {
    .cim-hero-section .hero-content {
      flex-direction: column;
      text-align: center;
    }

    .cim-hero-section .hero-image {
      text-align: center;
      margin-top: 30px;
      flex-basis: auto;
      /* Reset basis */
      max-width: 80%;
      /* Limit image width */
    }

    .cim-values-section .value-item {
      max-width: 45%;
      /* 2 columns */
      min-width: 250px;
      /* Allow slightly larger items */
    }

    .cim-vision-mission-section .vision-mission-content {
      gap: 30px;
    }

    .geometric-divider {
      height: 200px;
      /* Adjust divider height */
    }

    .cim-vision-mission-section {
      padding-top: 150px;
      /* Adjust padding */
    }
  }

  /* Mobile */
  @media (max-width: 767px) {
    .cim-hero-section h1 {
      font-size: 2.2em;
    }

    .cim-hero-section p {
      font-size: 1em;
    }

    .cim-values-section .values-grid {
      flex-direction: column;
      align-items: center;
    }

    .cim-values-section .value-item {
      max-width: 80%;
      /* 1 column, centered */
      margin-bottom: 30px;
    }

    .cim-values-section .value-item:last-child {
      margin-bottom: 0;
    }

    .cim-vision-mission-section .vision-mission-content {
      flex-direction: column;
      gap: 40px;
    }

    .geometric-divider {
      height: 150px;
      /* Adjust divider height */
    }

    .cim-vision-mission-section {
      padding-top: 120px;
      /* Adjust padding */
    }
  }
</style>

<main id="main" class="site-main cim-corporate-page">

  <!-- Hero Section -->
  <section class="cim-hero-section">
    <div class="container">
      <div class="hero-content">
        <div class="hero-text">
          <h1><?php echo esc_html(cim_get_about_page_option('hero_title', __('CIM Corporation', 'cim'))); ?></h1>
          <p>
            <?php echo wp_kses_post(cim_get_about_page_option('hero_description', __(get_bloginfo('description') . ' (CIM) is a global leader in wear solutions, specializing in advanced materials engineered to withstand extreme abrasion in the mining, energy, and construction industries. Our proprietary technologies - including Tungsten Carbide Overlay (WCO), High Chrome White Iron (HCWI), Silicon Carbide Ceramic (SiC), and Chrome Carbide Overlay (CCO) - provide exceptional wear resistance, significantly enhancing equipment performance and longevity.', 'cim'))); ?>
          </p>
          <a href="<?php echo esc_url(cim_get_about_page_option('brochure_button_url', 'https://drive.google.com/file/d/1tKpVcyX2ZXmbXX2xVfOI7AZpGLQM1292/view?pli=1')); ?>">
            <div class="btn cim-brochure-btn"><?php echo esc_html(cim_get_about_page_option('brochure_button_text', __('CIM Brochure', 'cim'))); ?></div>
          </a>
        </div>
        <div class="hero-image">
          <!-- Image Placeholder: Replace with WordPress dynamic image or static URL -->
          <img src="<?php echo esc_url(cim_get_about_page_option('hero_image', get_template_directory_uri() . '/assets/images/CIM-Brochure-2022-Latest-Cover.webp')); ?>"
            alt="<?php esc_attr_e('CIM Wear Products Brochure Cover', 'cim'); ?>">
          <!-- Example using a placeholder image path -->
        </div>
      </div>
    </div>
  </section>

  <!-- Values Section -->
  <section class="cim-values-section"
    style="background-size: cover; background-position: center; background-image: url(<?php echo esc_url(cim_get_about_page_option('values_background_image', get_template_directory_uri() . '/assets/images/DARK-BG-NEW.jpg')); ?>">
    <div class="container">
      <div class="values-grid">
        <div class="value-item">
          <div class="value-icon integrity-icon">
            <!-- Icon Placeholder: Use SVG, FontAwesome, or Image -->
            <img src="<?php echo esc_url(cim_get_about_page_option('integrity_icon', get_template_directory_uri() . '/assets/images/icon-1.webp')); ?>" alt="integrity">
          </div>
          <h3><?php echo esc_html(cim_get_about_page_option('integrity_title', __('Integrity', 'cim'))); ?></h3>
          <p>
            <?php echo wp_kses_post(cim_get_about_page_option('integrity_description', __('We uphold the highest standards of integrity in all of our activities, prioritizing honest, transparency and a commitment to excellence.', 'cim'))); ?>
          </p>
        </div>
        <div class="value-item">
          <div class="value-icon innovation-icon">
            <!-- Icon Placeholder: Use SVG, FontAwesome, or Image -->
            <img src="<?php echo esc_url(cim_get_about_page_option('innovation_icon', get_template_directory_uri() . '/assets/images/icon-2.webp')); ?>" alt="innovation">
          </div>
          <h3><?php echo esc_html(cim_get_about_page_option('innovation_title', __('Innovation', 'cim'))); ?></h3>
          <p>
            <?php echo wp_kses_post(cim_get_about_page_option('innovation_description', __('We foster creativity, delivering globally recognized solutions that surpass the expectations of our clients and the market.', 'cim'))); ?>
          </p>
        </div>
        <div class="value-item">
          <div class="value-icon improvement-icon">
            <!-- Icon Placeholder: Use SVG, FontAwesome, or Image -->
            <img src="<?php echo esc_url(cim_get_about_page_option('improvement_icon', get_template_directory_uri() . '/assets/images/icon-3.webp')); ?>" alt="improvement">
          </div>
          <h3><?php echo esc_html(cim_get_about_page_option('improvement_title', __('Improvement', 'cim'))); ?></h3>
          <p>
            <?php echo wp_kses_post(cim_get_about_page_option('improvement_description', __('We are lifelong learners, constantly seeking professional growth. Our culture thrives on innovation and continuous improvement.', 'cim'))); ?>
          </p>
        </div>
        <div class="value-item">
          <div class="value-icon teamwork-icon">
            <!-- Icon Placeholder: Use SVG, FontAwesome, or Image -->
            <img src="<?php echo esc_url(cim_get_about_page_option('teamwork_icon', get_template_directory_uri() . '/assets/images/icon-4.webp')); ?>" alt="teamwork">
          </div>
          <h3><?php echo esc_html(cim_get_about_page_option('teamwork_title', __('Teamwork', 'cim'))); ?></h3>
          <p>
            <?php echo wp_kses_post(cim_get_about_page_option('teamwork_description', __('We collaborate as a team to foster member growth and uphold excellence, ensuring the success of our partners.', 'cim'))); ?>
          </p>
        </div>
      </div>
    </div>
    <div class="container vision-mission-container"
      style="height: 750px; display: flex; align-items: flex-end;">
      <div class="vision-mission-content">
        <div class="vision-column">
          <h2><?php echo esc_html(cim_get_about_page_option('vision_title', __('VISION', 'cim'))); ?></h2>
          <p>
            <?php echo wp_kses_post(cim_get_about_page_option('vision_description', __('To deliver innovative wear solutions and reliable products that enhance efficiency and promote sustainability for our customers.', 'cim'))); ?>
          </p>
        </div>
        <div class="mission-column">
          <h2><?php echo esc_html(cim_get_about_page_option('mission_title', __('MISSION', 'cim'))); ?></h2>
          <p>
            <?php echo wp_kses_post(cim_get_about_page_option('mission_description', __('We develop advanced coating, wear-resistant materials and disruptive technologies for mining, energy and construction applications to enhance performance and improve performance.', 'cim'))); ?>
          </p>
        </div>
      </div>
    </div>
  </section>

</main><!-- #main -->

<?php
get_footer();