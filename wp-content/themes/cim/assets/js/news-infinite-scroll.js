/**
 * News Infinite Scroll
 *
 * Handles infinite scrolling functionality for the News page
 * Loads 3 posts at a time when user scrolls to the bottom of the page
 */

(function($) {
    'use strict';
    
    // Variables
    let page = 1;
    let loading = false;
    let noMorePosts = false;
    const loadingElement = $('<div class="cim-loading">Loading more posts...</div>');
    const noMorePostsElement = $('<div class="cim-no-more-posts">No more posts to load</div>');
    const newsContainer = $('.cim-news-section');
    
    // Initialize
    function init() {
        // Append loading element
        newsContainer.append(loadingElement);
        loadingElement.hide();
        
        // Append no more posts element
        newsContainer.append(noMorePostsElement);
        noMorePostsElement.hide();
        
        // Bind scroll event
        $(window).on('scroll', handleScroll);
    }
    
    // Handle scroll event
    function handleScroll() {
        if (loading || noMorePosts) return;
        
        const scrollPosition = $(window).scrollTop() + $(window).height();
        const threshold = $(document).height() - 200; // 200px before the bottom
        
        if (scrollPosition > threshold) {
            loadMorePosts();
        }
    }
    
    // Load more posts
    function loadMorePosts() {
        loading = true;
        loadingElement.show();
        
        $.ajax({
            url: cimNews.rest_url,
            method: 'GET',
            data: {
                page: page + 1,
                per_page: 3
            },
            beforeSend: function(xhr) {
                xhr.setRequestHeader('X-WP-Nonce', cimNews.nonce);
            },
            success: function(response, status, xhr) {
                if (response.length === 0) {
                    noMorePosts = true;
                    noMorePostsElement.show();
                    loadingElement.hide();
                    return;
                }
                
                // Increment page
                page++;
                
                // Append posts
                appendPosts(response);
                
                // Hide loading element
                loadingElement.hide();
                loading = false;
            },
            error: function(xhr, status, error) {
                console.error('Error loading posts:', error);
                loadingElement.hide();
                loading = false;
            }
        });
    }
    
    // Append posts to the container
    function appendPosts(posts) {
        const postsContainer = $('<div class="cim-news-container"></div>');
        
        posts.forEach(function(post) {
            const postElement = createPostElement(post);
            postsContainer.append(postElement);
        });
        
        // Insert before the "no more posts" element
        noMorePostsElement.before(postsContainer);
    }
    
    // Create post element
    function createPostElement(post) {
        const date = new Date(post.date);
        const formattedDate = date.toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
        
        const featuredMediaUrl = post._embedded && post._embedded['wp:featuredmedia'] && 
                               post._embedded['wp:featuredmedia'][0] ? 
                               post._embedded['wp:featuredmedia'][0].source_url : 
                               cimNews.placeholder_image;
        
        const authorName = post._embedded && post._embedded.author && 
                         post._embedded.author[0] ? 
                         post._embedded.author[0].name : 'CIM Media';
        
        const excerpt = post.excerpt.rendered ? 
                      $(post.excerpt.rendered).text() : '';
        
        const postHtml = `
            <article class="cim-post cim-post-large">
                <div class="cim-post-thumbnail-large">
                    <a href="${post.link}">
                        <img src="${featuredMediaUrl}" alt="${post.title.rendered}">
                    </a>
                </div>
                <div class="cim-post-content">
                    <div class="cim-post-meta">
                        <span class="cim-logo-icon">CIM</span>
                        <span class="cim-post-author">${authorName}</span> ·
                        <span class="cim-post-date">${formattedDate}</span> ·
                        <span class="cim-post-readtime">${Math.ceil(excerpt.split(' ').length / 200)} min read</span>
                    </div>
                    <h3 class="cim-post-title"><a href="${post.link}">${post.title.rendered}</a></h3>
                    <p class="cim-post-excerpt">
                        ${excerpt.substring(0, 150)}...
                    </p>
                </div>
            </article>
        `;
        
        return $(postHtml);
    }
    
    // Initialize when document is ready
    $(document).ready(init);
    
})(jQuery);