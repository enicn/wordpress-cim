<?php
/**
 * Template Name: News List Page
 * 
 * Displays posts from the 'news' category in a list format
 * with infinite scroll loading (3 posts at a time)
 */
get_header();

// Initial posts query (first 3 posts)
$args = array(
  'post_type' => 'post',
  'posts_per_page' => 3,
  'paged' => 1
);

$news_query = new WP_Query($args);
?>

<style>
  /* Basic Variables */
  :root {
    --cim-primary-dark-blue: #1a2e4a;
    --cim-primary-yellow: #fecb00;
    --cim-text-light: #ffffff;
    --cim-text-dark: #333333;
    --cim-text-muted: #cccccc;
    --cim-base-font: system-ui, -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
  }

  /* General Section Styling */
  .cim-news-section {
    max-width: 1200px;
    margin: 40px auto;
    padding: 0 15px;
    font-family: var(--cim-base-font);
  }

  .cim-section-title {
    font-size: 2.5rem;
    font-weight: bold;
    color: var(--cim-text-dark);
    line-height: 3;
  }

  .cim-section-subtitle {
    font-weight: normal;
    font-size: 1.5rem;
    color: #555;
  }

  /* News List Styling */
  .cim-news-list-container {
    display: flex;
    flex-direction: column;
    gap: 30px;
    margin-bottom: 30px;
  }

  .cim-post-list-item {
    display: flex;
    background-color: var(--cim-primary-dark-blue);
    color: var(--cim-text-light);
    border-radius: 5px;
    overflow: hidden;
    transition: transform 0.3s ease;
  }

  .cim-post-list-item:hover {
    transform: translateY(-5px);
  }

  .cim-post-thumbnail {
    flex: 0 0 300px;
    background-color: #ccc;
  }

  .cim-post-thumbnail img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
  }

  .cim-post-content {
    flex: 1;
    padding: 25px;
    display: flex;
    flex-direction: column;
  }

  .cim-post-title {
    font-size: 1.5rem;
    margin-bottom: 15px;
    font-weight: bold;
    line-height: 1.2;
  }

  .cim-post-title a {
    color: var(--cim-text-light);
    text-decoration: none;
  }

  .cim-post-title a:hover {
    text-decoration: underline;
  }

  .cim-post-meta {
    font-size: 0.85rem;
    color: var(--cim-text-muted);
    margin-bottom: 15px;
    line-height: 1.4;
  }

  .cim-logo-icon {
    display: inline-block;
    background-color: var(--cim-primary-yellow);
    color: var(--cim-primary-dark-blue);
    padding: 4px 6px;
    border-radius: 3px;
    font-weight: bold;
    font-size: 0.75rem;
    margin-right: 8px;
    vertical-align: middle;
  }

  .cim-post-excerpt {
    font-size: 1rem;
    line-height: 1.6;
    color: var(--cim-text-muted);
    margin-bottom: 20px;
  }

  .cim-read-more {
    margin-top: auto;
    align-self: flex-start;
    background-color: var(--cim-primary-yellow);
    color: var(--cim-primary-dark-blue);
    padding: 8px 15px;
    border-radius: 3px;
    font-weight: bold;
    text-decoration: none;
    font-size: 0.9rem;
    transition: background-color 0.3s ease;
  }

  .cim-read-more:hover {
    background-color: #e0b500;
    text-decoration: none;
  }

  /* Loading Elements */
  .cim-loading {
    text-align: center;
    padding: 20px;
    font-style: italic;
    color: #666;
  }

  .cim-no-more-posts {
    text-align: center;
    padding: 20px;
    font-weight: bold;
    color: #666;
  }

  /* Responsive Adjustments */
  @media (max-width: 768px) {
    .cim-post-list-item {
      flex-direction: column;
    }

    .cim-post-thumbnail {
      flex: 0 0 200px;
      width: 100%;
    }

    .cim-section-title {
      font-size: 2rem;
      line-height: 2.5;
    }

    .cim-section-subtitle {
      font-size: 1.2rem;
      display: block;
    }
  }

  @media (max-width: 480px) {
    .cim-section-title {
      font-size: 1.8rem;
      line-height: 2;
    }

    .cim-post-title {
      font-size: 1.3rem;
    }
  }
</style>

<div
  style="position: fixed; inset: 0; z-index: -1;
  background-size: cover;
  background-position: center;
  background-repeat: no-repeat;
  background-image: url(<?php echo get_template_directory_uri() . '/assets/images/62f26520e99441c6804b83aaf5423953.webp' ?>)">
</div>

<main id="main-content" class="site-main cim-news-list-page">
  <div class="cim-news-section" style="background-color: rgba(255, 255, 255, 0.7)">
    <h2 class="cim-section-title">News: <span class="cim-section-subtitle">All news articles from AIM</span></h2>

    <div class="cim-news-list-container">
      <?php if ($news_query->have_posts()): ?>
        <?php while ($news_query->have_posts()): $news_query->the_post(); ?>
          <article class="cim-post-list-item">
            <div class="cim-post-thumbnail">
              <?php if (has_post_thumbnail()): ?>
                <a href="<?php the_permalink(); ?>">
                  <?php the_post_thumbnail('medium_large', array('alt' => get_the_title())); ?>
                </a>
              <?php else: ?>
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/placeholder-news.jpg" alt="<?php the_title_attribute(); ?>">
              <?php endif; ?>
            </div>
            <div class="cim-post-content">
              <h3 class="cim-post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
              <div class="cim-post-meta">
                <span class="cim-logo-icon">AIM</span>
                <span class="cim-post-author"><?php the_author(); ?></span> ·
                <span class="cim-post-date"><?php echo get_the_date(); ?></span> ·
                <span class="cim-post-readtime"><?php echo esc_html(ceil(str_word_count(get_the_content()) / 200)); ?> min read</span>
              </div>
              <div class="cim-post-excerpt">
                <?php echo wp_trim_words(get_the_excerpt(), 30, '...'); ?>
              </div>
              <a href="<?php the_permalink(); ?>" class="cim-read-more">Read More</a>
            </div>
          </article>
        <?php endwhile; ?>
      <?php else: ?>
        <p>No news posts found.</p>
      <?php endif; ?>
    </div>

    <?php if ($news_query->max_num_pages > 1): ?>
      <div class="cim-loading">Loading more posts...</div>
      <div class="cim-no-more-posts">No more posts to load</div>
    <?php endif; ?>

    <?php wp_reset_postdata(); // Reset the query ?>
  </div>
</main>

<?php
// Add REST API support for infinite scroll
function cim_news_list_rest_api() {
  wp_enqueue_script('cim-news-infinite-scroll', get_template_directory_uri() . '/assets/js/news-infinite-scroll.js', array('jquery'), '1.0', true);
  
  // Pass data to JavaScript
  wp_localize_script('cim-news-infinite-scroll', 'cimNews', array(
    'rest_url' => rest_url('wp/v2/posts'),
    'nonce' => wp_create_nonce('wp_rest'),
    'category' => get_cat_ID('news')
  ));
}
add_action('wp_enqueue_scripts', 'cim_news_list_rest_api');

get_footer(); // Includes footer.php
?>