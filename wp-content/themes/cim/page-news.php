<?php
/**
 * Template Name: News Page
 * 
 * Displays posts from the 'news' and 'blog' categories in a custom layout
 * with configurable featured posts and video section
 */
get_header();

// Get featured post IDs from theme options
$featured_main_post_id = get_option('cim_featured_main_post');
$featured_sidebar_posts = get_option('cim_featured_sidebar_posts', array());
$video_url = get_option('cim_news_video_url', '');
$video_title = get_option('cim_news_video_title', 'CIM Products');
$video_subtitle = get_option('cim_news_video_subtitle', 'Silicon Carbide Ceramic');

// If no featured posts are set, query posts from the 'news' category
if (empty($featured_main_post_id) && empty($featured_sidebar_posts)) {
  $args = array(
    'post_type' => 'post',
    'posts_per_page' => 6,
    'category_name' => 'news',
  );

  $news_query = new WP_Query($args);
} else {
  // Initialize empty query for manual population
  $news_query = new WP_Query();
  $news_query->posts = array();
  $news_query->post_count = 0;

  // Add featured main post if set
  if (!empty($featured_main_post_id)) {
    $main_post = get_post($featured_main_post_id);
    if ($main_post) {
      $news_query->posts[] = $main_post;
      $news_query->post_count++;
    }
  }

  // Add featured sidebar posts if set
  if (!empty($featured_sidebar_posts) && is_array($featured_sidebar_posts)) {
    foreach ($featured_sidebar_posts as $post_id) {
      $sidebar_post = get_post($post_id);
      if ($sidebar_post) {
        $news_query->posts[] = $sidebar_post;
        $news_query->post_count++;
      }
    }
  }

  // If we still don't have enough posts, get some from the news category
  if ($news_query->post_count < 6) {
    $additional_args = array(
      'post_type' => 'post',
      'posts_per_page' => 6 - $news_query->post_count,
      'category_name' => 'news',
      'post__not_in' => array_merge(
        !empty($featured_main_post_id) ? array($featured_main_post_id) : array(),
        !empty($featured_sidebar_posts) ? $featured_sidebar_posts : array()
      ),
    );

    $additional_query = new WP_Query($additional_args);

    if ($additional_query->have_posts()) {
      $news_query->posts = array_merge($news_query->posts, $additional_query->posts);
      $news_query->post_count += $additional_query->post_count;
    }
  }
}
?>
<style>
  /* Basic Variables (optional, adjust as needed) */
  :root {
    --cim-primary-dark-blue: #1a2e4a;
    /* Approximate dark blue */
    --cim-primary-yellow: #fecb00;
    /* Approximate yellow */
    --cim-text-light: #ffffff;
    --cim-text-dark: #333333;
    --cim-text-muted: #cccccc;
    --cim-base-font: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  }

  /* General Section Styling */
  .cim-news-section {
    max-width: 1200px;
    /* Adjust max-width as needed */
    margin: 40px auto;
    /* Centering and vertical spacing */
    padding: 0 15px;
    /* Padding for smaller screens */
    font-family: var(--cim-base-font);
  }

  .cim-section-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: var(--cim-text-dark);
    /* Or white if on dark background */
    line-height: 3;
  }

  .cim-section-subtitle {
    font-weight: normal;
    font-size: 1.5rem;
    /* Adjust size */
    color: #555;
    /* Slightly muted color */
  }

  /* Layout Container */
  .cim-news-container {
    display: flex;
    flex-wrap: wrap;
    /* Allow wrapping on smaller screens */
    gap: 30px;
    /* Space between columns */
  }

  /* Columns */
  .cim-news-main-col {
    flex: 5;
    /* Takes roughly 2/3 of the space */
    min-width: 300px;
    /* Minimum width before wrapping */
  }

  .cim-news-sidebar-col {
    flex: 3;
    /* Takes roughly 1/3 of the space */
    min-width: 280px;
    /* Minimum width before wrapping */
    display: flex;
    flex-direction: column;
    gap: 20px;
    /* Space between small posts */
  }

  /* General Post Styling */
  .cim-post {
    background-color: var(--cim-primary-dark-blue);
    color: var(--cim-text-light);
    border-radius: 5px;
    /* Optional rounded corners */
    overflow: hidden;
    /* Contain children */
  }

  .cim-post a {
    color: var(--cim-text-light);
    text-decoration: none;
  }

  .cim-post a:hover {
    text-decoration: underline;
  }

  .cim-post-content {
    padding: 20px 25px;
  }

  /* Post Meta Styling */
  .cim-post-meta {
    font-size: 0.85rem;
    color: var(--cim-text-muted);
    margin-bottom: 10px;
    line-height: 1.4;
  }

  .cim-logo-icon {
    display: inline-block;
    background-color: var(--cim-primary-yellow);
    color: var(--cim-primary-dark-blue);
    /* Text color inside icon */
    padding: 4px 6px;
    border-radius: 3px;
    font-weight: bold;
    font-size: 0.75rem;
    margin-right: 8px;
    vertical-align: middle;
    /* In a real implementation, this might be an <img> or background-image */
    /* Or use Font Awesome: <i class="fas fa-building"></i> */
  }

  .cim-post-author,
  .cim-post-date,
  .cim-post-readtime {
    vertical-align: middle;
  }

  /* Large Post Specifics */
  .cim-post-large .cim-post-thumbnail-large img {
    width: 100%;
    height: auto;
    display: block;
    /* Remove bottom space */
  }

  .cim-post-large .cim-post-title {
    font-size: 1.8rem;
    margin-bottom: 15px;
    font-weight: bold;
    line-height: 1.2;
  }

  .cim-post-large .cim-post-excerpt {
    font-size: 1rem;
    line-height: 1.6;
    color: var(--cim-text-muted);
  }

  /* Small Post Specifics */
  .cim-post-small {
    display: flex;
    align-items: stretch;
    /* Make content and image same height */
  }

  .cim-post-small-content {
    flex: 1;
    /* Take available space */
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    /* Center content vertically */
  }

  .cim-post-small-thumbnail {
    flex-basis: 120px;
    /* Fixed width for thumbnail area */
    flex-shrink: 0;
    /* Don't shrink */
    background-color: #ccc;
    /* Placeholder bg */
  }

  .cim-post-small-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    /* Cover the area */
    display: block;
  }

  .cim-post-small .cim-post-title {
    font-size: 13px;
    margin-bottom: 8px;
    font-weight: bold;
    line-height: 1.3;
  }

  .cim-post-small .cim-post-meta {
    font-size: 0.8rem;
    margin-bottom: 0;
    /* Reset margin */
  }


  /* CIM Products Section */
  .cim-products-section {
    margin-top: 30px;
    /* Space above this section */
    background-color: #e0e0e0;
    /* Light gray background for the container */
    border: 1px solid #ccc;
    border-radius: 5px;
  }

  .cim-products-media {
    position: relative;
    /* For absolute positioning of overlay */
    display: flex;
    min-height: 250px;
    /* Example height */
    background-color: #555;
    /* Darker background if images don't load */
  }

  .cim-products-image-left {
    flex-basis: 30%;
    /* Adjust ratio */
    display: flex;
    flex-direction: column;
  }

  .cim-products-image-right {
    flex-basis: 70%;
    /* Adjust ratio */
  }

  .cim-products-image-left img,
  .cim-products-image-right img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .cim-products-image-left img:first-child {
    flex-grow: 1;
    height: 50%;
    /* Split height */
  }

  .cim-products-image-left img:last-child {
    flex-grow: 1;
    height: 50%;
    /* Split height */
  }


  .cim-products-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    /* Semi-transparent overlay */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    color: var(--cim-text-light);
    text-align: center;
  }

  .cim-play-button {
    display: inline-block;
    background-color: rgba(255, 255, 255, 0.3);
    color: var(--cim-text-light);
    width: 60px;
    height: 60px;
    line-height: 60px;
    font-size: 30px;
    text-align: center;
    border-radius: 50%;
    margin-bottom: 15px;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  .cim-play-button:hover {
    background-color: rgba(255, 255, 255, 0.5);
    text-decoration: none;
  }

  .cim-products-title {
    font-size: 1.8rem;
    margin: 10px 0 5px 0;
    font-weight: bold;
  }

  .cim-products-subtitle {
    font-size: 1rem;
    margin: 0;
    font-weight: bold;
  }

  .cim-products-menu-bar {
    background-color: white;
    text-align: center;
    padding: 10px;
    border-top: 1px solid #ccc;
    font-size: 1.5rem;
    color: var(--cim-text-dark);
  }

  /* All Posts Link */
  .cim-all-posts-link {
    text-align: center;
    margin-top: 40px;
    padding-bottom: 20px;
    /* Add some space at the very bottom */
  }

  .cim-all-posts-link a {
    font-weight: bold;
    color: var(--cim-primary-dark-blue);
    text-decoration: underline;
    font-size: 1.1rem;
  }

  /* Responsive Adjustments */
  @media (max-width: 992px) {
    .cim-news-main-col {
      flex: 1 1 60%;
      /* Adjust flex basis */
    }

    .cim-news-sidebar-col {
      flex: 1 1 35%;
      /* Adjust flex basis */
    }

    .cim-section-title {
      font-size: 2rem;
    }

    .cim-section-subtitle {
      font-size: 1.2rem;
    }
  }


  @media (max-width: 768px) {
    .cim-news-container {
      flex-direction: column;
      /* Stack columns */
    }

    .cim-news-main-col,
    .cim-news-sidebar-col {
      flex: 1 1 100%;
      /* Full width when stacked */
    }

    .cim-post-large .cim-post-title {
      font-size: 1.5rem;
    }

    .cim-products-media {
      flex-direction: column;
      /* Stack product images if needed */
    }

    .cim-products-image-left,
    .cim-products-image-right {
      flex-basis: auto;
      /* Reset basis */
      width: 100%;
    }

    .cim-products-image-left {
      flex-direction: row;
      /* Side by side small images */
      height: 100px;
      /* Example fixed height */
    }

    .cim-products-image-left img {
      width: 50%;
      height: 100%;
    }

    .cim-products-image-right img {
      height: 150px;
      /* Example height */
    }
  }

  @media (max-width: 480px) {
    .cim-section-title {
      font-size: 1.8rem;
    }

    .cim-section-subtitle {
      display: block;
      /* Stack subtitle */
      font-size: 1rem;
      margin-top: 5px;
    }

    .cim-post-small {
      flex-direction: column;
      /* Stack content and thumb */
    }

    .cim-post-small-thumbnail {
      flex-basis: 150px;
      /* Height when stacked */
      width: 100%;
    }

    .cim-post-small-content {
      padding: 15px;
    }
  }

  .cim-post-thumbnail-large {
    height: 20rem;
    overflow: hidden;
  }
</style>

<div
  style="position: fixed; inset: 0; z-index: -1;
background-size: cover;
background-position: center;
background-repeat: no-repeat;
background-image: url(<?php echo get_template_directory_uri() . '/assets/images/62f26520e99441c6804b83aaf5423953.webp' ?>)">
</div>
<main id="main-content" class="site-main cim-news-page">
  <div class="cim-news-section" style="background-color: rgba(255, 255, 255, 0.7)">
    <h2 class="cim-section-title">News: <span class="cim-section-subtitle">Check out the latest news from CIM</span>
    </h2>

    <?php if ($news_query->have_posts()): ?>

      <div class="cim-news-container">

        <!-- Main Content Column (Left) -->
        <div class="cim-news-main-col">

          <!-- Large Featured Post -->
          <?php
          // Display the first post as featured
          if ($news_query->have_posts()):
            $news_query->the_post();
            ?>
            <article class="cim-post cim-post-large">
              <div class="cim-post-thumbnail-large">
                <?php if (has_post_thumbnail()): ?>
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('large', array('alt' => get_the_title())); ?>
                  </a>
                <?php else: ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-min-expo-large.jpg"
                    alt="<?php the_title_attribute(); ?>">
                <?php endif; ?>
              </div>
              <div class="cim-post-content">
                <div class="cim-post-meta">
                  <span class="cim-logo-icon">CIM</span>
                  <span class="cim-post-author"><?php the_author(); ?></span> ·
                  <span class="cim-post-date"><?php echo get_the_date(); ?></span> ·
                  <span class="cim-post-readtime"><?php echo esc_html(ceil(str_word_count(get_the_content()) / 200)); ?> min
                    read</span>
                </div>
                <h3 class="cim-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <p class="cim-post-excerpt">
                  <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
                </p>
              </div>
            </article>
          <?php endif; ?>

          <!-- CIM Products Section -->
          <div class="cim-products-section">
            <div class="cim-products-media">
              <div class="cim-products-overlay">
                <?php if (!empty($video_url)): ?>
                  <a href="<?php echo esc_url($video_url); ?>" class="cim-play-button" aria-label="Play Video">▶</a>
                <?php else: ?>
                  <a href="#" class="cim-play-button" aria-label="Play Video">▶</a>
                <?php endif; ?>
                <h3 class="cim-products-title"><?php echo esc_html($video_title); ?></h3>
                <p class="cim-products-subtitle"><?php echo esc_html($video_subtitle); ?></p>
              </div>
            </div>
          </div>

        </div>

        <!-- Sidebar Column (Right) -->
        <div class="cim-news-sidebar-col">

          <?php
          // Display the remaining posts in the sidebar
          $post_count = 0;
          while ($news_query->have_posts() && $post_count < 5):
            $news_query->the_post();
            $post_count++;
            ?>
            <article class="cim-post cim-post-small">
              <div class="cim-post-small-content">
                <h4 class="cim-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
                <div class="cim-post-meta">
                  <span class="cim-logo-icon">CIM</span>
                  <span class="cim-post-author"><?php the_author(); ?></span><br>
                  <span class="cim-post-date"><?php echo get_the_date(); ?></span>
                </div>
              </div>
              <div class="cim-post-small-thumbnail">
                <?php if (has_post_thumbnail()): ?>
                  <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail('thumbnail', array('alt' => get_the_title())); ?>
                  </a>
                <?php else: ?>
                  <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-news.jpg"
                    alt="<?php the_title_attribute(); ?>">
                <?php endif; ?>
              </div>
            </article>
          <?php endwhile; ?>

        </div> <!-- End Sidebar Column -->

      </div> <!-- End News Container -->

      <div class="cim-all-posts-link">
        <a href="<?php echo esc_url(get_category_link(get_cat_ID('post'))); ?>">Click for all posts from CIM</a>
      </div>

    <?php else: ?>
      <p>No news posts found.</p>
    <?php endif; ?>

    <?php wp_reset_postdata(); // Reset the query ?>

  </div> <!-- End CIM News Section -->

</main><!-- #main-content -->

<?php
get_footer(); // Includes footer.php
?>