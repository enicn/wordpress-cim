/**
 * News List Loader
 *
 * Handles loading additional news posts in a list format
 * Loads 3 posts at a time when user clicks the load more button
 */

(function($) {
    'use strict';
    
    // Variables
    let page = 1;
    let loading = false;
    let noMorePosts = false;
    const loadMoreButton = $('<button class="cim-load-more-btn">Load More News</button>');
    const loadingElement = $('<div class="cim-loading">Loading more posts...</div>');
    const noMorePostsElement = $('<div class="cim-no-more-posts">No more posts to load</div>');
    const newsListContainer = $('<div class="cim-news-list-container"></div>');
    
    // Initialize
    function init() {
        // Create news list section
        const newsSection = $('.cim-news-section');
        
        if (newsSection.length === 0) return;
        
        // Add list container after the existing content
        newsSection.append('<h3 class="cim-list-title">More News Articles</h3>');
        newsSection.append(newsListContainer);
        
        // Append button and loading elements
        newsSection.append(loadMoreButton);
        newsSection.append(loadingElement);
        loadingElement.hide();
        
        // Append no more posts element
        newsSection.append(noMorePostsElement);
        noMorePostsElement.hide();
        
        // Bind click event to load more button
        loadMoreButton.on('click', loadMorePosts);
        
        // Load initial posts
        loadMorePosts();
    }
    
    // Load more posts
    function loadMorePosts() {
        if (loading || noMorePosts) return;
        
        loading = true;
        loadMoreButton.hide();
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
                
                // Hide loading element and show button again
                loadingElement.hide();
                loadMoreButton.show();
                loading = false;
            },
            error: function(xhr, status, error) {
                console.error('Error loading posts:', error);
                loadingElement.hide();
                loadMoreButton.show();
                loading = false;
            }
        });
    }
    
    // Append posts to the container
    function appendPosts(posts) {
        posts.forEach(function(post) {
            const postElement = createPostElement(post);
            newsListContainer.append(postElement);
        });
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
            <article class="cim-post cim-post-list">
                <div class="cim-post-list-thumbnail">
                    <a href="${post.link}">
                        <img src="${featuredMediaUrl}" alt="${post.title.rendered}">
                    </a>
                </div>
                <div class="cim-post-list-content">
                    <h3 class="cim-post-title"><a href="${post.link}">${post.title.rendered}</a></h3>
                    <div class="cim-post-meta">
                        <span class="cim-logo-icon">CIM</span>
                        <span class="cim-post-author">${authorName}</span> ·
                        <span class="cim-post-date">${formattedDate}</span>
                    </div>
                    <p class="cim-post-excerpt">
                        ${excerpt.substring(0, 120)}...
                    </p>
                </div>
            </article>
        `;
        
        return $(postHtml);
    }
    
    // Add CSS styles for the list view
    function addStyles() {
        const styles = `
            <style>
                .cim-list-title {
                    font-size: 2rem;
                    margin: 40px 0 20px;
                    color: var(--cim-text-dark);
                }
                
                .cim-news-list-container {
                    display: flex;
                    flex-direction: column;
                    gap: 20px;
                    margin-bottom: 30px;
                }
                
                .cim-post-list {
                    display: flex;
                    background-color: white;
                    border: 1px solid #eee;
                    border-radius: 5px;
                    overflow: hidden;
                    box-shadow: 0 2px 4px rgba(0,0,0,0.05);
                }
                
                .cim-post-list-thumbnail {
                    flex: 0 0 200px;
                }
                
                .cim-post-list-thumbnail img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                
                .cim-post-list-content {
                    flex: 1;
                    padding: 20px;
                }
                
                .cim-post-list .cim-post-title {
                    font-size: 1.4rem;
                    margin-bottom: 10px;
                    color: var(--cim-primary-dark-blue);
                }
                
                .cim-post-list .cim-post-excerpt {
                    color: #666;
                    margin-top: 10px;
                }
                
                .cim-load-more-btn {
                    display: block;
                    margin: 20px auto;
                    padding: 10px 25px;
                    background-color: var(--cim-primary-dark-blue);
                    color: white;
                    border: none;
                    border-radius: 4px;
                    font-size: 1rem;
                    cursor: pointer;
                    transition: background-color 0.3s;
                }
                
                .cim-load-more-btn:hover {
                    background-color: #2a4a7a;
                }
                
                @media (max-width: 768px) {
                    .cim-post-list {
                        flex-direction: column;
                    }
                    
                    .cim-post-list-thumbnail {
                        flex: 0 0 180px;
                    }
                }
            </style>
        `;
        
        $('head').append(styles);
    }
    
    // Initialize when document is ready
    $(document).ready(function() {
        addStyles();
        init();
    });
    
})(jQuery);