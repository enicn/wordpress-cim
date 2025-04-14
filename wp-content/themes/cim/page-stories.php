<?php
/**
 * Template Name: Stories Page
 *
 * Displays all posts of the 'story' custom post type
 *
 * @package cim
 */

get_header();
?>
<style>
/*--------------------------------------------------------------
# Success Stories Section Styles
--------------------------------------------------------------*/

  /* Main Section Styling */
  .success-stories-section {
    background-color: #2a2a2a;
    /* Dark grey background */
    padding: 60px 0;
    /* Vertical padding */
    color: #cccccc;
    /* Default text color for the section */
  }

  /* Optional Container for Centering */
  /* Adjust max-width and padding as needed for your theme */
  .success-stories-section .container {
    max-width: 1140px;
    /* Or your theme's standard width */
    margin-left: auto;
    margin-right: auto;
    padding-left: 15px;
    padding-right: 15px;
  }

  /* Individual Story Item Styling */
  .success-story-item {
    margin-bottom: 50px;
    /* Space between story items */
  }

  /* Last item might not need bottom margin if followed by footer */
  .success-story-item:last-child {
    margin-bottom: 0;
  }

  /* Main Title Styling */
  .story-main-title {
    color: #d4af37;
    /* Gold/Yellow color */
    font-size: 1.5em;
    /* Adjust size as needed */
    font-weight: 700;
    text-transform: uppercase;
    margin-bottom: 5px;
    /* Space below main title */
    line-height: 1.3;
  }

  /* Subtitle Styling */
  .story-subtitle {
    color: #ffffff;
    /* White color */
    font-size: 1.3em;
    /* Adjust size as needed */
    font-weight: 600;
    /* Slightly less bold than main title */
    margin-bottom: 15px;
    /* Space below subtitle */
    line-height: 1.4;
  }

  /* Content Paragraph Styling */
  .story-content p {
    font-size: 1em;
    /* Standard paragraph size */
    line-height: 1.6;
    color: #cccccc;
    /* Light grey text */
    margin-bottom: 25px;
    /* Space below paragraph */
  }
  .story-footer {
    display: flex;
    align-items: center;
  }

  /* Separator Styling */
  .story-separator {
    width: 100%;
    /* Space below separator dots */
    overflow: hidden;
    /* Prevents dots from overflowing if using background repeat */
  }

  .story-separator .dots {
    /* Creates the dotted line effect */
    height: 2px;
    /* Thickness of the 'dots' */
    background-image: linear-gradient(to right, #d4af37 40%, rgba(255, 255, 255, 0) 0%);
    /* Gold/Yellow dots */
    background-position: bottom;
    background-size: 10px 2px;
    /* Adjust spacing and size of dots */
    background-repeat: repeat-x;
  }

  /* Read More Button Styling */
  .read-more-button {
    margin-left: 1em;
    width: 10em;
    background-color: #d4af37;
    /* Gold/Yellow background */
    color: #2a2a2a;
    /* Dark text color */
    padding: 10px 25px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.9em;
    border-radius: 4px;
    /* Optional: slightly rounded corners */
    transition: background-color 0.3s ease, color 0.3s ease;
    /* Smooth transition on hover */
    text-align: center;
    cursor: pointer;
    border: none;
    /* Remove default anchor border */
  }

  .read-more-button:hover,
  .read-more-button:focus {
    background-color: #c49e27;
    /* Slightly darker gold on hover */
    color: #1a1a1a;
    /* Slightly darker text on hover */
    text-decoration: none;
    /* Ensure no underline on hover */
  }


  /* Placeholder for the dark image area below */
  .dark-image-placeholder-section {
    background-color: #111111;
    /* Very dark background */
    /* In reality, you would set a background image here */
    /* background-image: url('path/to/your/placeholder-or-real-image.jpg'); */
    background-size: cover;
    background-position: center;
    min-height: 300px;
    /* Example height */
    /* Add padding or content styling if needed */
  }


  /* Responsive Adjustments (Example for smaller screens) */
  @media (max-width: 768px) {
    .story-main-title {
      font-size: 1.3em;
    }

    .story-subtitle {
      font-size: 1.1em;
    }

    .success-stories-section {
      padding: 40px 0;
    }

    .success-story-item {
      margin-bottom: 40px;
    }
  }
</style>

<main id="main-content" class="site-main cim-stories-page">
<section class="success-stories-section">
  <div class="container">
    <?php 
    // Query stories post type
    $args = array(
      'post_type' => 'story',
      'posts_per_page' => -1, // Show all stories
      'orderby' => 'date',
      'order' => 'DESC',
    );
    
    $stories_query = new WP_Query($args);
    
    if ($stories_query->have_posts()) :
      while ($stories_query->have_posts()) : $stories_query->the_post();
        // Get the subtitle
        $subtitle = get_post_meta(get_the_ID(), '_story_subtitle', true);
    ?>

    <article class="success-story-item">
      <h2 class="story-main-title"><?php the_title(); ?></h2>
      <?php if (!empty($subtitle)) : ?>
      <h3 class="story-subtitle"><?php echo esc_html($subtitle); ?></h3>
      <?php endif; ?>
      <div class="story-content">
        <?php the_excerpt(); ?>
      </div>
      <div class="story-footer">
        <div class="story-separator">
          <div class="dots"></div>
        </div>
        <a href="<?php the_permalink(); ?>" class="read-more-button"><?php _e('Read more', 'cim'); ?></a>
      </div>
    </article>

    <?php 
      endwhile;
      wp_reset_postdata();
    else : 
    ?>
    <p><?php _e('No stories found.', 'cim'); ?></p>
    <?php endif; ?>

  </div>
</section>

<section class="dark-image-placeholder-section">
  <?php // Background image section ?>
</section>

</main><!-- #main-content -->

<?php
get_footer(); // Includes footer.php
?>