<?php
/**
 * Template Name: Attachment List Page
 * Description: Displays a grid of attachments from the 'attachment' custom post type.
 */

get_header();

// Define the slug for your Custom Post Type
$post_type_slug = 'attachment'; // <--- CHANGE 'attachment' if your CPT slug is different

?>

<style>
  /*--------------------------------------------------------------
# Page Specific Styles
--------------------------------------------------------------*/
  .attachment-page-main {
    background-color: #e4b95b;
    /* Approximate background color from image */
    padding: 40px 20px;
    /* Add some padding */
    min-height: 60vh;
    /* Ensure it takes up some space */
  }

  .attachment-category-title {
    text-align: center;
    font-size: 2.5em;
    /* Adjust size as needed */
    font-weight: bold;
    color: #ffffff;
    /* White title text */
    margin-bottom: 40px;
    text-transform: uppercase;
    letter-spacing: 2px;
    /* If the title needs to be over the top blue background,
        you might need to adjust positioning or place it in the header,
        but based on the solid yellow background section, placing it here. */
    /* Use this color if the title is on the yellow part */
    /* color: #333333; */
  }

  .attachment-grid {
    display: grid;
    /* Create two equal columns */
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    /* Responsive grid */
    gap: 30px;
    /* Space between grid items */
    max-width: 1200px;
    /* Max width of the grid */
    margin: 0 auto;
    /* Center the grid */
    padding: 0 15px;
  }

  .attachment-item {
    background-color: #e4b95b;
    /* Same as main background, items overlay it */
    border: none;
    /* Remove borders if any default */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* Optional subtle shadow */
    overflow: hidden;
    /* Keep contents contained */
    display: flex;
    flex-direction: column;
  }

  .attachment-image-placeholder {
    background-color: #cccccc;
    /* Placeholder background */
    height: 250px;
    /* Adjust height as needed */
    display: flex;
    align-items: center;
    justify-content: center;
    color: #666666;
    font-size: 1.2em;
    text-align: center;
    line-height: 1.4;
  }

  .attachment-image-placeholder::before {
    content: "Product Image\A Placeholder";
    /* \A creates a line break */
    white-space: pre;
    /* Ensures line break works */
  }


  .attachment-info {
    background-color: #5a5a5a;
    /* Dark grey background for text */
    color: #ffffff;
    /* White text */
    padding: 20px;
    text-align: center;
  }

  .attachment-title {
    font-size: 1.1em;
    font-weight: bold;
    margin: 0 0 5px 0;
    /* Adjust spacing */
    text-transform: uppercase;
  }

  .attachment-subtitle {
    font-size: 0.9em;
    margin: 0;
    color: #dddddd;
    /* Lighter grey for subtitle */
    font-style: italic;
    /* Optional: make it italic */
  }

  /* Responsive adjustments */
  @media (max-width: 768px) {
    .attachment-category-title {
      font-size: 2em;
    }

    .attachment-grid {
      /* On smaller screens, it might stack to 1 column due to minmax */
      gap: 20px;
    }

    .attachment-image-placeholder {
      height: 200px;
    }
  }
</style>

<main id="main" class="site-main attachment-page-main">

  <?php
  // You might want to fetch the category name dynamically if needed,
  // or just hardcode it if this template is only for "GET ATTACHMENT".
  // Example: $category_name = get_the_title(); // If using the page title
  $category_name = "GET ATTACHMENT";
  ?>

  <h1 class="attachment-category-title"><?php echo esc_html($category_name); ?></h1>

  <div class="attachment-grid">

    <?php
    // WP_Query arguments
    $args = array(
      'post_type' => $post_type_slug, // Use the variable defined earlier
      'post_status' => 'publish',
      'posts_per_page' => -1, // Display all posts of this type
      'orderby' => 'menu_order title', // Order by page order attribute or title
      'order' => 'ASC',
    );

    // The Query
    $attachment_query = new WP_Query($args);

    // The Loop
    if ($attachment_query->have_posts()):
      while ($attachment_query->have_posts()):
        $attachment_query->the_post();
        // Get custom field data (assuming ACF is used for subtitle)
        // Replace 'attachment_subtitle' with your actual ACF field name or meta key
        $subtitle = get_field('attachment_subtitle') ?: get_post_meta(get_the_ID(), 'attachment_subtitle', true);

        ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('attachment-item'); ?>>

          <div class="attachment-image-placeholder">
            <?php
            /*
            // --- How to display the actual image ---
            // If you want to display the actual featured image later, use this:
            if ( has_post_thumbnail() ) {
                the_post_thumbnail('medium_large'); // Or another appropriate size
            } else {
                 // Fallback content if no image is set, currently handled by CSS placeholder
                 echo '<!-- No Thumbnail -->';
            }
            // Or if using an ACF image field named 'product_thumbnail':
            $thumbnail = get_field('product_thumbnail');
            if( $thumbnail ) {
                echo wp_get_attachment_image( $thumbnail['ID'], 'medium_large' );
            } else {
                 // Fallback content if no image is set, currently handled by CSS placeholder
                 echo '<!-- No Thumbnail -->';
            }
            */
            ?>
          </div><!-- .attachment-image-placeholder -->

          <div class="attachment-info">
            <h2 class="attachment-title"><?php the_title(); ?></h2>
            <?php if (!empty($subtitle)): ?>
              <p class="attachment-subtitle">(<?php echo esc_html($subtitle); ?>)</p>
              <?php // Note: Added parentheses directly here based on the image ?>
            <?php endif; ?>
            <?php
            /* Optional: Add product description if needed
            echo '<div class="attachment-description">';
            the_excerpt(); // Or the_content()
            echo '</div>';
            */
            ?>
          </div><!-- .attachment-info -->

        </article><!-- #post-<?php the_ID(); ?> -->

        <?php
      endwhile; // End of the loop.
    else:
      ?>
      <p>
        <?php esc_html_e('Sorry, no attachments found in this category.', 'textdomain'); // Replace 'textdomain' with your theme's text domain ?>
      </p>
      <?php
    endif;

    // Restore original Post Data
    wp_reset_postdata();
    ?>

  </div><!-- .attachment-grid -->

</main><!-- #main -->

<?php
get_footer();
?>