<?php
/**
 * Live Chat functionality for CIM Theme
 *
 * @package CIM
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Class to handle Live Chat functionality
 */
class CIM_Live_Chat {

    /**
     * Constructor
     */
    public function __construct() {
        // Enqueue scripts and styles
        add_action('wp_enqueue_scripts', array($this, 'enqueue_scripts'));
        
        // Add chat HTML to footer
        add_action('wp_footer', array($this, 'add_chat_html'));
        
        // AJAX handlers
        add_action('wp_ajax_cim_send_chat_message', array($this, 'handle_chat_message'));
        add_action('wp_ajax_nopriv_cim_send_chat_message', array($this, 'handle_chat_message'));
        
        // Admin menu for chat settings and history
        add_action('admin_menu', array($this, 'add_admin_menu'));
        
        // Register settings
        add_action('admin_init', array($this, 'register_settings'));
    }

    /**
     * Enqueue scripts and styles
     */
    public function enqueue_scripts() {
        // Enqueue Font Awesome if not already enqueued
        if (!wp_style_is('font-awesome', 'enqueued')) {
            wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', array(), '5.15.4');
        }
        
        // Enqueue chat styles
        wp_enqueue_style('cim-live-chat', get_template_directory_uri() . '/assets/css/live-chat.css', array(), '1.0.0');
        
        // Enqueue chat script
        wp_enqueue_script('cim-live-chat', get_template_directory_uri() . '/assets/js/live-chat.js', array('jquery'), '1.0.0', true);
        
        // Localize script with AJAX URL and nonce
        wp_localize_script('cim-live-chat', 'cimChat', array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('cim_chat_nonce'),
        ));
    }

    /**
     * Add chat HTML to footer
     */
    public function add_chat_html() {
        // Get chat settings
        $chat_enabled = get_option('cim_chat_enabled', true);
        $chat_title = get_option('cim_chat_title', 'Live Chat');
        $chat_welcome = get_option('cim_chat_welcome', 'Welcome to CIM! How can we help you today?');
        
        // Only show chat if enabled
        if (!$chat_enabled) {
            return;
        }
        
        // Output chat HTML
        ?>
        <div class="live-chat-container">
            <button class="chat-button">
                <i class="fas fa-comments"></i> Let's Chat
            </button>
            
            <div class="chat-window">
                <div class="chat-header">
                    <h3 class="chat-title"><?php echo esc_html($chat_title); ?></h3>
                    <button class="chat-close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                
                <div class="chat-messages">
                    <!-- Messages will be added here via JavaScript -->
                </div>
                
                <div class="chat-input-container">
                    <input type="text" class="chat-input" placeholder="Type your message...">
                    <button class="chat-send">
                        <i class="fas fa-paper-plane"></i>
                    </button>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     * Handle chat message AJAX request
     */
    public function handle_chat_message() {
        // Check nonce
        if (!isset($_POST['nonce']) || !wp_verify_nonce($_POST['nonce'], 'cim_chat_nonce')) {
            wp_send_json_error(array('message' => 'Security check failed'));
        }
        
        // Get message
        $message = isset($_POST['message']) ? sanitize_text_field($_POST['message']) : '';
        
        if (empty($message)) {
            wp_send_json_error(array('message' => 'Message is empty'));
        }
        
        // Store message in database
        $this->store_message($message, 'user');
        
        // Get auto-response or default response
        $response = $this->get_response($message);
        
        // Store response in database
        $this->store_message($response, 'agent');
        
        // Send email notification to admin if enabled
        $this->maybe_send_notification($message);
        
        // Return response
        wp_send_json_success(array('message' => $response));
    }

    /**
     * Store message in database
     *
     * @param string $message The message text
     * @param string $type The message type (user or agent)
     */
    private function store_message($message, $type) {
        global $wpdb;
        
        // Get table name
        $table_name = $wpdb->prefix . 'cim_chat_messages';
        
        // Check if table exists, create if not
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            $this->create_tables();
        }
        
        // Get user info
        $user_id = get_current_user_id();
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        
        // Insert message
        $wpdb->insert(
            $table_name,
            array(
                'message' => $message,
                'type' => $type,
                'user_id' => $user_id,
                'user_ip' => $user_ip,
                'user_agent' => $user_agent,
                'created_at' => current_time('mysql'),
            ),
            array('%s', '%s', '%d', '%s', '%s', '%s')
        );
    }

    /**
     * Create database tables
     */
    private function create_tables() {
        global $wpdb;
        
        $table_name = $wpdb->prefix . 'cim_chat_messages';
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE $table_name (
            id bigint(20) NOT NULL AUTO_INCREMENT,
            message text NOT NULL,
            type varchar(20) NOT NULL,
            user_id bigint(20) NOT NULL,
            user_ip varchar(100) NOT NULL,
            user_agent text NOT NULL,
            created_at datetime NOT NULL,
            PRIMARY KEY  (id)
        ) $charset_collate;";
        
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    /**
     * Get response for message
     *
     * @param string $message The user message
     * @return string The response message
     */
    private function get_response($message) {
        // Get auto-responses from settings
        $auto_responses = get_option('cim_chat_auto_responses', array());
        
        // Check if message contains any keywords for auto-response
        foreach ($auto_responses as $keyword => $response) {
            if (stripos($message, $keyword) !== false) {
                return $response;
            }
        }
        
        // Return default response if no keyword match
        return get_option('cim_chat_default_response', 'Thank you for your message. Our team will get back to you shortly.');
    }

    /**
     * Send notification email if enabled
     *
     * @param string $message The user message
     */
    private function maybe_send_notification($message) {
        // Check if notifications are enabled
        $notifications_enabled = get_option('cim_chat_notifications_enabled', false);
        
        if (!$notifications_enabled) {
            return;
        }
        
        // Get notification email
        $notification_email = get_option('cim_chat_notification_email', get_option('admin_email'));
        
        // Send email
        $subject = 'New Chat Message on ' . get_bloginfo('name');
        $body = "A new chat message has been received:\n\n";
        $body .= "Message: $message\n\n";
        $body .= "Time: " . current_time('mysql') . "\n";
        $body .= "IP: " . $_SERVER['REMOTE_ADDR'] . "\n";
        
        wp_mail($notification_email, $subject, $body);
    }

    /**
     * Add admin menu for chat settings and history
     */
    public function add_admin_menu() {
        add_menu_page(
            'Live Chat',
            'Live Chat',
            'manage_options',
            'cim-live-chat',
            array($this, 'render_settings_page'),
            'dashicons-format-chat',
            30
        );
        
        add_submenu_page(
            'cim-live-chat',
            'Chat Settings',
            'Settings',
            'manage_options',
            'cim-live-chat',
            array($this, 'render_settings_page')
        );
        
        add_submenu_page(
            'cim-live-chat',
            'Chat History',
            'History',
            'manage_options',
            'cim-live-chat-history',
            array($this, 'render_history_page')
        );
    }

    /**
     * Register settings
     */
    public function register_settings() {
        register_setting('cim_chat_settings', 'cim_chat_enabled');
        register_setting('cim_chat_settings', 'cim_chat_title');
        register_setting('cim_chat_settings', 'cim_chat_welcome');
        register_setting('cim_chat_settings', 'cim_chat_default_response');
        register_setting('cim_chat_settings', 'cim_chat_auto_responses');
        register_setting('cim_chat_settings', 'cim_chat_notifications_enabled');
        register_setting('cim_chat_settings', 'cim_chat_notification_email');
    }

    /**
     * Render settings page
     */
    public function render_settings_page() {
        // Get current settings
        $chat_enabled = get_option('cim_chat_enabled', true);
        $chat_title = get_option('cim_chat_title', 'Live Chat');
        $chat_welcome = get_option('cim_chat_welcome', 'Welcome to CIM! How can we help you today?');
        $chat_default_response = get_option('cim_chat_default_response', 'Thank you for your message. Our team will get back to you shortly.');
        $chat_notifications_enabled = get_option('cim_chat_notifications_enabled', false);
        $chat_notification_email = get_option('cim_chat_notification_email', get_option('admin_email'));
        
        // Auto-responses (default empty array)
        $auto_responses = get_option('cim_chat_auto_responses', array());
        
        // Render settings form
        ?>
        <div class="wrap">
            <h1>Live Chat Settings</h1>
            
            <form method="post" action="options.php">
                <?php settings_fields('cim_chat_settings'); ?>
                
                <table class="form-table">
                    <tr>
                        <th scope="row">Enable Live Chat</th>
                        <td>
                            <input type="checkbox" name="cim_chat_enabled" value="1" <?php checked($chat_enabled); ?>>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Chat Window Title</th>
                        <td>
                            <input type="text" name="cim_chat_title" value="<?php echo esc_attr($chat_title); ?>" class="regular-text">
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Welcome Message</th>
                        <td>
                            <textarea name="cim_chat_welcome" rows="3" class="large-text"><?php echo esc_textarea($chat_welcome); ?></textarea>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Default Response</th>
                        <td>
                            <textarea name="cim_chat_default_response" rows="3" class="large-text"><?php echo esc_textarea($chat_default_response); ?></textarea>
                            <p class="description">This response will be sent when no auto-response keywords match.</p>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Email Notifications</th>
                        <td>
                            <input type="checkbox" name="cim_chat_notifications_enabled" value="1" <?php checked($chat_notifications_enabled); ?>>
                            <label for="cim_chat_notifications_enabled">Send email notification for new messages</label>
                        </td>
                    </tr>
                    
                    <tr>
                        <th scope="row">Notification Email</th>
                        <td>
                            <input type="email" name="cim_chat_notification_email" value="<?php echo esc_attr($chat_notification_email); ?>" class="regular-text">
                        </td>
                    </tr>
                </table>
                
                <h2>Auto Responses</h2>
                <p>Set up automatic responses based on keywords in user messages.</p>
                
                <div id="auto-responses-container">
                    <?php if (!empty($auto_responses)) : ?>
                        <?php foreach ($auto_responses as $keyword => $response) : ?>
                            <div class="auto-response-row">
                                <input type="text" name="cim_chat_auto_responses[<?php echo esc_attr($keyword); ?>]" value="<?php echo esc_attr($response); ?>" class="regular-text" placeholder="Response">
                                <input type="text" value="<?php echo esc_attr($keyword); ?>" class="regular-text" placeholder="Keyword" disabled>
                                <button type="button" class="button remove-auto-response">Remove</button>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                
                <div class="auto-response-row">
                    <input type="text" id="new-response" class="regular-text" placeholder="Response">
                    <input type="text" id="new-keyword" class="regular-text" placeholder="Keyword">
                    <button type="button" class="button button-secondary" id="add-auto-response">Add Auto Response</button>
                </div>
                
                <?php submit_button(); ?>
            </form>
        </div>
        
        <script>
        jQuery(document).ready(function($) {
            // Add auto response
            $('#add-auto-response').on('click', function() {
                var keyword = $('#new-keyword').val().trim();
                var response = $('#new-response').val().trim();
                
                if (keyword === '' || response === '') {
                    alert('Please enter both keyword and response.');
                    return;
                }
                
                var html = '<div class="auto-response-row">'
                    + '<input type="text" name="cim_chat_auto_responses[' + keyword + ']" value="' + response + '" class="regular-text" placeholder="Response">'
                    + '<input type="text" value="' + keyword + '" class="regular-text" placeholder="Keyword" disabled>'
                    + '<button type="button" class="button remove-auto-response">Remove</button>'
                    + '</div>';
                
                $('#auto-responses-container').append(html);
                
                // Clear inputs
                $('#new-keyword').val('');
                $('#new-response').val('');
            });
            
            // Remove auto response
            $(document).on('click', '.remove-auto-response', function() {
                $(this).closest('.auto-response-row').remove();
            });
        });
        </script>
        <?php
    }

    /**
     * Render history page
     */
    public function render_history_page() {
        global $wpdb;
        
        // Get table name
        $table_name = $wpdb->prefix . 'cim_chat_messages';
        
        // Check if table exists
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {
            echo '<div class="wrap"><h1>Chat History</h1><p>No chat history available.</p></div>';
            return;
        }
        
        // Get messages grouped by user_ip and date
        $conversations = $wpdb->get_results(
            "SELECT 
                user_ip, 
                DATE(created_at) as chat_date, 
                MIN(created_at) as start_time,
                COUNT(*) as message_count
            FROM $table_name 
            GROUP BY user_ip, DATE(created_at)
            ORDER BY start_time DESC"
        );
        
        // Render history page
        ?>
        <div class="wrap">
            <h1>Chat History</h1>
            
            <?php if (empty($conversations)) : ?>
                <p>No chat history available.</p>
            <?php else : ?>
                <table class="wp-list-table widefat fixed striped">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>User IP</th>
                            <th>Messages</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($conversations as $conversation) : ?>
                            <tr>
                                <td><?php echo esc_html($conversation->chat_date); ?></td>
                                <td><?php echo esc_html($conversation->user_ip); ?></td>
                                <td><?php echo esc_html($conversation->message_count); ?></td>
                                <td>
                                    <a href="<?php echo admin_url('admin.php?page=cim-live-chat-history&view=conversation&ip=' . $conversation->user_ip . '&date=' . $conversation->chat_date); ?>" class="button button-small">View</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
            
            <?php
            // View conversation if requested
            if (isset($_GET['view']) && $_GET['view'] === 'conversation' && isset($_GET['ip']) && isset($_GET['date'])) {
                $ip = sanitize_text_field($_GET['ip']);
                $date = sanitize_text_field($_GET['date']);
                
                // Get messages for this conversation
                $messages = $wpdb->get_results(
                    $wpdb->prepare(
                        "SELECT * FROM $table_name 
                        WHERE user_ip = %s AND DATE(created_at) = %s 
                        ORDER BY created_at ASC",
                        $ip,
                        $date
                    )
                );
                
                if (!empty($messages)) :
                ?>
                <h2>Conversation on <?php echo esc_html($date); ?> from IP: <?php echo esc_html($ip); ?></h2>
                
                <div class="chat-history-container" style="max-width: 600px; margin: 20px 0; border: 1px solid #ddd; border-radius: 5px; overflow: hidden;">
                    <div class="chat-history-messages" style="padding: 15px; max-height: 400px; overflow-y: auto;">
                        <?php foreach ($messages as $msg) : ?>
                            <div class="chat-history-message" style="margin-bottom: 15px; padding: 10px; border-radius: 5px; max-width: 80%; <?php echo $msg->type === 'user' ? 'background-color: #f0f0f0; margin-left: 0;' : 'background-color: #e6f2ff; margin-left: 20%;'; ?>">
                                <div class="message-content"><?php echo esc_html($msg->message); ?></div>
                                <div class="message-meta" style="font-size: 12px; color: #777; margin-top: 5px;">
                                    <?php echo esc_html($msg->type === 'user' ? 'User' : 'Agent'); ?> | 
                                    <?php echo esc_html(date('H:i', strtotime($msg->created_at))); ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php
                endif;
            }
            ?>
        </div>
        <?php
    }
}

// Initialize the class
$cim_live_chat = new CIM_Live_Chat();