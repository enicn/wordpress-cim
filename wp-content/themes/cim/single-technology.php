<?php
/**
 * The template for displaying single technology posts
 *
 * @package cim
 */

get_header();
?>

<div style="position: fixed; inset: 0; z-index: -1;">
  <video crossorigin="anonymous" playsinline="" preload="auto" muted="" loop="" autoplay="" controls="no"
    src="https://video.wixstatic.com/video/11062b_c18db2b1461b46f2ad31bae61009fee1/1080p/mp4/file.mp4"
    style="height: 100%; width: 100%; object-fit: cover; object-position: center center; opacity: 1;"></video>
</div>
<main id="main" class="site-main technology-detail-page">
  <div class="technology-detail-container">
    <?php while (have_posts()) : the_post(); ?>
      <?php 
        $bg_color = get_post_meta(get_the_ID(), '_technology_bg_color', true);
        if (empty($bg_color)) {
          $bg_color = '#4a4a4a'; // Default color
        }
        // Get featured image URL
        $thumbnail_url = '';
        if (has_post_thumbnail()) {
          $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'medium_large');
        }
      ?>
      <!-- Technology Header Section -->
      <section class="technology-header-section" style="background-color: <?php echo esc_attr($bg_color); ?>">
        <div class="">
          <div class="technology-header-content">
            <div class="technology-featured-image" style="background-image: url('<?php echo esc_url($thumbnail_url); ?>');">
            </div>
            <div class="technology-header-text">
              <?php 
              // Get custom fields if they exist
              $tech_title = get_post_meta(get_the_ID(), '_technology_title', true);
              ?>
              <h1 class="technology-title"><?php echo $tech_title; ?>(<?php the_title(); ?>)</h1>
              <div class="technology-product-description">
                <?php the_content(); ?>
              </div>
            </div>
          </div>
        </div>
      </section>

      <!-- Technology Gallery Section -->
      <?php 
      // Check if there are gallery images
      $gallery_images = get_post_meta(get_the_ID(), '_technology_gallery', true);
      if ($gallery_images) : 
        $gallery_array = explode(',', $gallery_images);
      ?>
      <section class="technology-gallery-section">
        <div class="">
          <h2 class="section-title">Gallery</h2>
          <div class="technology-gallery">
            <?php foreach ($gallery_array as $image_id) : 
              $image_url = wp_get_attachment_image_url($image_id, 'large');
              $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
              if ($image_url) :
            ?>
              <div class="gallery-item">
                <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt); ?>" class="gallery-image">
              </div>
            <?php 
              endif;
            endforeach; ?>
          </div>
        </div>
      </section>
      <?php endif; ?>

      <!-- Technology Video Section -->
      <?php 
      // Check if there's a video URL
      $video_url = get_post_meta(get_the_ID(), '_technology_video', true);
      if ($video_url) : 
      ?>
      <section class="technology-video-section">
        <div class="">
          <h2 class="section-title">Video</h2>
          <div class="technology-video-container">
            <?php 
            // Check if it's a YouTube URL
            if (strpos($video_url, 'youtube.com') !== false || strpos($video_url, 'youtu.be') !== false) :
              // Extract video ID
              preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|\/v\/|watch\?v=|\&v=)|youtu\.be\/)([^"\&\?\/ ]{11})/', $video_url, $matches);
              $youtube_id = isset($matches[1]) ? $matches[1] : '';
              if ($youtube_id) :
            ?>
              <div class="video-responsive">
                <iframe width="560" height="315" src="https://www.youtube.com/embed/<?php echo esc_attr($youtube_id); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
              </div>
            <?php 
              endif;
            else : 
              // For other video types, just embed the URL
            ?>
              <div class="video-responsive">
                <video controls>
                  <source src="<?php echo esc_url($video_url); ?>" type="video/mp4">
                  Your browser does not support the video tag.
                </video>
              </div>
            <?php endif; ?>
          </div>
        </div>
      </section>
      <?php endif; ?>
    <?php endwhile; ?>
  </div>
</main>

<style>
/* Technology Detail Page Styles */
.technology-detail-page {
  background-color: #121212;
  color: #ffffff;
}

.technology-detail-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0;
}

/* Header Section */
.technology-header-section {
  padding: 0;
}

.technology-header-content {
  display: flex;
  flex-wrap: wrap;
  align-items: stretch;
}

.technology-featured-image {
  flex: 0 0 50%;
  background-size: cover;
  background-repeat: no-repeat;
  background-position: center;
}

.technology-featured-image img {
  width: 100%;
  height: auto;
  border-radius: 0;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.technology-header-text {
  flex: 1;
  padding: 2em;
}

.technology-title {
  font-size: 2.8em;
  font-weight: bold;
  color: #e0d6a8;
  margin-bottom: 15px;
  text-transform: uppercase;
}

.technology-subtitle {
  font-size: 1.8em;
  color: #ffffff;
  margin-bottom: 20px;
}

.technology-product-description {
  font-size: 1.1em;
  line-height: 1.6;
  color: #ffffff;
}

/* Description Section */
.technology-description-section {
  padding: 60px 0;
  background-color: #1a1a1a;
}

.technology-description {
  font-size: 1.1em;
  line-height: 1.8;
  max-width: 900px;
  margin: 0 auto;
}

.technology-description p {
  margin-bottom: 20px;
}

.technology-description strong {
  color: #e0d6a8;
}

/* Gallery Section */
.technology-gallery-section {
  padding: 60px 0;
  background-color: #121212;
}

.section-title {
  font-size: 2.2em;
  font-weight: bold;
  color: #e0d6a8;
  margin-bottom: 30px;
  text-align: center;
}

.technology-gallery {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
  gap: 20px;
}

.gallery-item {
  border-radius: 8px;
  overflow: hidden;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
  transition: transform 0.3s ease;
}

.gallery-item:hover {
  transform: scale(1.03);
}

.gallery-image {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

/* Video Section */
.technology-video-section {
  padding: 60px 0;
  background-color: #1a1a1a;
}

.video-responsive {
  position: relative;
  padding-bottom: 56.25%; /* 16:9 Aspect Ratio */
  height: 0;
  overflow: hidden;
  max-width: 100%;
  border-radius: 8px;
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
}

.video-responsive iframe,
.video-responsive video {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border-radius: 8px;
}

/* Products Section */
.technology-products-section {
  padding: 60px 0;
  background-color: #b8a05a; /* Gold background color */
  text-align: center;
}

.products-container {
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  gap: 60px;
  max-width: 1000px;
  margin: 0 auto;
}

.product-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 20px;
}

.product-logo {
  font-size: 3.5em;
  font-weight: bold;
  color: #121212;
  text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
  transform: perspective(500px) rotateX(20deg);
  margin-bottom: 20px;
  letter-spacing: -2px;
}

.tungcast-logo, .titancast-logo {
  position: relative;
  padding: 10px;
  font-family: 'Arial Black', sans-serif;
  display: flex;
  align-items: center;
  justify-content: center;
  min-height: 100px;
}

.datasheet-button {
  display: inline-block;
  padding: 12px 20px;
  background-color: #8b4c9c; /* Purple background for buttons */
  color: #ffffff;
  font-size: 1em;
  font-weight: bold;
  text-decoration: none;
  border-radius: 5px;
  transition: background-color 0.3s ease, transform 0.3s ease;
  text-transform: uppercase;
  letter-spacing: 1px;
  min-width: 200px;
}

.datasheet-button:hover {
  background-color: #9d5eb0;
  transform: translateY(-3px);
}
.technology-title {
  font-size: 2rem;
  margin-bottom: 0.5em;
  color: var(--industrial-yellow);
}

/* Responsive Styles */
@media (max-width: 768px) {
  .technology-header-content {
    flex-direction: column;
  }
  
  .technology-featured-image,
  .technology-header-text {
    flex: 0 0 100%;
    padding: 0;
    margin-bottom: 30px;
  }
  
  .technology-gallery {
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
  }
  
  .technology-title {
    font-size: 2.2em;
  }
  
  .technology-subtitle {
    font-size: 1.5em;
  }
}
</style>

<?php get_footer(); ?>