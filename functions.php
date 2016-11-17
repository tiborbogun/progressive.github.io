<?php

// Custom Field Excerpt
function custom_field_excerpt() {
    global $post;
    $text = get_field('boxtext');
    if ( '' != $text ) {
        $text = strip_shortcodes( $text );
        $text = apply_filters('the_content', $text);
        $text = str_replace(']]>', ']]>', $text);
        $excerpt_length = 50; // 20 words
        $excerpt_more = apply_filters('', ' ' . '');
        $text = wp_trim_words( $text, $excerpt_length, $excerpt_more );
    }
    return apply_filters('the_excerpt', $text);
}

/**
 * Progressive functions and definitions
 */
include_once('framework/plugins/upcomming-events.php'); // Include upcoming events widget
include_once('framework/plugins/related-articles.php'); // Include related articles widget
// include_once('framework/inc/sidebar-generator.php'); // Include Sidebar Generator
include_once('framework/inc/page-list/page-list.php'); // Site Map
include_once('framework/inc/tgm-plugin-activation/example.php'); // Plugins Activation
//define( 'ACF_LITE', true );
include_once('framework/custom-fields/custom-fields.php'); // Custom fields

/* Disable WordPress Admin Bar for all users but admins. */
show_admin_bar(false);

// Hide ACF menu item from the admin menu
function remove_acf_menu()
{

    // provide a list of usernames who can edit custom field definitions here
    $admins = array(
        'admin'
    );

    // get the current user
    $current_user = wp_get_current_user();

    // match and remove if needed
    if (!in_array($current_user->user_login, $admins)) {
        remove_menu_page('edit.php?post_type=acf');
    }

}

add_action('admin_menu', 'remove_acf_menu');

add_action('admin_menu', 'remove_acf_menu');

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * Used to set the width of images and content. Should be equal to the width the theme
 * is designed for, generally via the style.css stylesheet.
 */
if (!isset($content_width)) {
    $content_width = 640;
}

/** Tell WordPress to run Progressive_setup() when the 'after_setup_theme' hook is run. */
add_action('after_setup_theme', 'Progressive_setup');

if (!function_exists('Progressive_setup')):
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which runs
     * before the init hook. The init hook is too late for some features, such as indicating
     * support post thumbnails.
     *
     * To override Progressive_setup() in a child theme, add your own Progressive_setup to your child theme's
     * functions.php file.
     *
     * @uses add_theme_support() To add support for post thumbnails, custom headers and backgrounds, and automatic feed links.
     * @uses register_nav_menus() To add support for navigation menus.
     * @uses add_editor_style() To style the visual editor.
     * @uses load_theme_textdomain() For translation/localization support.
     * @uses register_default_headers() To register the default custom header images provided with the theme.
     * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
     *
     * @since Twenty Ten 1.0
     */
    function Progressive_setup()
    {

        // This theme styles the visual editor with editor-style.css to match the theme style.
        add_editor_style();

        // Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
        add_theme_support('post-formats', array('aside', 'gallery'));

        // This theme uses post thumbnails
        add_theme_support('post-thumbnails');

        // Add default posts and comments RSS feed links to head
        add_theme_support('automatic-feed-links');

        // Make theme available for translation
        // Translations can be filed in the /languages/ directory
        load_theme_textdomain('Progressive', get_template_directory() . '/languages');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(
            array(
                'main-menu' => __('Main menu', 'Progressive'),
                'contact-menu' => __('Contact menu', 'Progressive'),
                'articles-menu' => __('Articles menu', 'Progressive'),
                'network-menu' => __('Network menu', 'Progressive'),
                'campaign-menu' => __('Campaign menu', 'Progressive'),
                'event-menu' => __('Event menu', 'Progressive'),
                'contact-menu' => __('Contact menu', 'Progressive'),
                'login-menu' => __('Login menu', 'Progressive'),
                'subscribe-menu' => __('Subscribe menu', 'Progressive'),
                'responsive-menu' => __('Responsive menu', 'Progressive'),
            )
        );

        // This theme allows users to set a custom background.
        add_theme_support(
            'custom-background',
            array(
                // Let WordPress know what our default background color is.
                'default-color' => 'fff',
            )
        );

        // The custom header business starts here.

        $custom_header_support = array(
            // The default image to use.
            // The %s is a placeholder for the theme template directory URI.
            'default-image' => '%s/images/headers/path.jpg',
            // The height and width of our custom header.
            'width' => apply_filters('Progressive_header_image_width', 940),
            'height' => apply_filters('Progressive_header_image_height', 198),
            // Support flexible heights.
            'flex-height' => true,
            // Don't support text inside the header image.
            'header-text' => false,
            // Callback for styling the header preview in the admin.
            'admin-head-callback' => 'Progressive_admin_header_style',
        );
    }
endif;

if (!function_exists('Progressive_admin_header_style')) :
    /**
     * Styles the header image displayed on the Appearance > Header admin panel.
     *
     * Referenced via add_custom_image_header() in Progressive_setup().
     *
     * @since Twenty Ten 1.0
     */
    function Progressive_admin_header_style()
    {
        ?>
        <style type="text/css" id="Progressive-admin-header-css">
            /* Shows the same border as on front end */
            #headimg {
                border-bottom: 1px solid #000;
                border-top: 4px solid #000;
            }

            /* If header-text was supported, you would style the text with these selectors:
                #headimg #name { }
                #headimg #desc { }
            */
        </style>
    <?php
    }
endif;

/**
 * Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 *
 * To override this in a child theme, remove the filter and optionally add
 * your own function tied to the wp_page_menu_args filter hook.
 *
 * @since Twenty Ten 1.0
 */
function Progressive_page_menu_args($args)
{
    if (!isset($args['show_home'])) {
        $args['show_home'] = true;
    }
    return $args;
}

add_filter('wp_page_menu_args', 'Progressive_page_menu_args');

/**
 * Sets the post excerpt length to 40 characters.
 *
 * To override this length in a child theme, remove the filter and add your own
 * function tied to the excerpt_length filter hook.
 *
 * @since Twenty Ten 1.0
 * @return int
 */
function Progressive_excerpt_length($length)
{
    return 60;
}

add_filter('excerpt_length', 'Progressive_excerpt_length');

if (!function_exists('Progressive_continue_reading_link')) :
    /**
     * Returns a "Continue Reading" link for excerpts
     *
     * @since Twenty Ten 1.0
     * @return string "Continue Reading" link
     */
    function Progressive_continue_reading_link()
    {
        return ' <a class="blue-link" href="' . get_permalink() . '">' . __('Read more', 'Progressive') . '</a>';
    }
endif;

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and Progressive_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string An ellipsis
 */
function Progressive_auto_excerpt_more($more)
{
    return ' &hellip;' . Progressive_continue_reading_link();
}

add_filter('excerpt_more', 'Progressive_auto_excerpt_more');

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 *
 * @since Twenty Ten 1.0
 * @return string Excerpt with a pretty "Continue Reading" link
 */
function Progressive_custom_excerpt_more($output)
{
    if (has_excerpt() && !is_attachment()) {
        $output .= Progressive_continue_reading_link();
    }
    return $output;
}

add_filter('get_the_excerpt', 'Progressive_custom_excerpt_more');

/**
 * Remove inline styles printed when the gallery shortcode is used.
 *
 * Galleries are styled by the theme in Twenty Ten's style.css. This is just
 * a simple filter call that tells WordPress to not use the default styles.
 *
 * @since Twenty Ten 1.2
 */
add_filter('use_default_gallery_style', '__return_false');

/**
 * Deprecated way to remove inline styles printed when the gallery shortcode is used.
 *
 * This function is no longer needed or used. Use the use_default_gallery_style
 * filter instead, as seen above.
 *
 * @since Twenty Ten 1.0
 * @deprecated Deprecated in Twenty Ten 1.2 for WordPress 3.1
 *
 * @return string The gallery style filter, with the styles themselves removed.
 */
function Progressive_remove_gallery_css($css)
{
    return preg_replace("#<style type='text/css'>(.*?)</style>#s", '', $css);
}

// Backwards compatibility with WordPress 3.0.
if (version_compare($GLOBALS['wp_version'], '3.1', '<')) {
    add_filter('gallery_style', 'Progressive_remove_gallery_css');
}

if (!function_exists('Progressive_comment')) :
    /**
     * Template for comments and pingbacks.
     *
     * To override this walker in a child theme without modifying the comments template
     * simply create your own Progressive_comment(), and that function will be used instead.
     *
     * Used as a callback by wp_list_comments() for displaying the comments.
     *
     * @since Twenty Ten 1.0
     */
    function Progressive_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case '' :
                ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                <div id="comment-<?php comment_ID(); ?>">
                    <div class="comment-author vcard">
                        <?php echo get_avatar($comment, 40); ?>
                        <?php printf(
                            __('%s <span class="says">says:</span>', 'Progressive'),
                            sprintf('<cite class="fn">%s</cite>', get_comment_author_link())
                        ); ?>
                    </div>
                    <!-- .comment-author .vcard -->
                    <?php if ($comment->comment_approved == '0') : ?>
                        <em class="comment-awaiting-moderation"><?php _e(
                                'Your comment is awaiting moderation.',
                                'Progressive'
                            ); ?></em>
                        <br/>
                    <?php endif; ?>

                    <div class="comment-meta commentmetadata"><a
                            href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
                            <?php
                            /* translators: 1: date, 2: time */
                            printf(
                                __('%1$s at %2$s', 'Progressive'),
                                get_comment_date(),
                                get_comment_time()
                            ); ?></a><?php edit_comment_link(__('(Edit)', 'Progressive'), ' ');
                        ?>
                    </div>
                    <!-- .comment-meta .commentmetadata -->

                    <div class="comment-body"><?php comment_text(); ?></div>

                    <div class="reply">
                        <?php comment_reply_link(
                            array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))
                        ); ?>
                    </div>
                    <!-- .reply -->
                </div><!-- #comment-##  -->

                <?php
                break;
            case 'pingback'  :
            case 'trackback' :
                ?>
                <li class="post pingback">
                <p><?php _e('Pingback:', 'Progressive'); ?> <?php comment_author_link(); ?><?php edit_comment_link(
                        __('(Edit)', 'Progressive'),
                        ' '
                    ); ?></p>
                <?php
                break;
        endswitch;
    }
endif;

/**
 * Register widgetized areas, including two sidebars and four widget-ready columns in the footer.
 *
 * To override Progressive_widgets_init() in a child theme, remove the action hook and add your own
 * function tied to the init hook.
 *
 * @since Twenty Ten 1.0
 * @uses register_sidebar
 */
function Progressive_widgets_init()
{
    register_sidebar(
        array(
            'name' => __('Sidebar', 'Progressive'),
            'id' => 'sidebar',
            'description' => __('Sidebar.', 'Progressive'),
            'before_widget' => '<div id="%1$s" class="widget-container %2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __('Copyright', 'Progressive'),
            'id' => 'copyright',
            'description' => __('Copyright.', 'Progressive'),
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __('Boxes homepage', 'Progressive'),
            'id' => 'boxes-homepage',
            'description' => __('Boxes homepage.', 'Progressive'),
            'before_widget' => '<div id="%1$s" class="%2$s">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widget-title">',
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __('Component featured', 'Progressive'),
            'id' => 'component-featured',
            'description' => __('Featured area', 'Progressive'),
            'before_widget' => '<div id="%1$s" class="%2$s component-featured__widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="page-title">',
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __('Change language', 'Progressive'),
            'id' => 'change-language',
            'description' => __('Change language', 'Progressive'),
            'before_widget' => '<div id="%1$s" class="%2$s component-featured__widget">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="page-title">',
            'after_title' => '</h3>',
        )
    );
    register_sidebar(
        array(
            'name' => __('Network homepage', 'Progressive'),
            'id' => 'network-homepage',
            'description' => __('Network homepage', 'Progressive'),
            'before_widget' => '<div id="%1$s" class="network-page__content-container">',
            'after_widget' => '</div>',
            'before_title' => '<h2 class="network-page__title">',
            'after_title' => '</h2>',
        )
    );
}

/** Register sidebars by running Progressive_widgets_init() on the widgets_init hook. */
add_action('widgets_init', 'Progressive_widgets_init');

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 *
 * To override this in a child theme, remove the filter and optionally add your own
 * function tied to the widgets_init action hook.
 *
 * This function uses a filter (show_recent_comments_widget_style) new in WordPress 3.1
 * to remove the default style. Using Twenty Ten 1.2 in WordPress 3.0 will show the styles,
 * but they won't have any effect on the widget in default Twenty Ten styling.
 *
 * @since Twenty Ten 1.0
 */
function Progressive_remove_recent_comments_style()
{
    add_filter('show_recent_comments_widget_style', '__return_false');
}

add_action('widgets_init', 'Progressive_remove_recent_comments_style');

if (!function_exists('Progressive_posted_on')) :
    /**
     * Prints HTML with meta information for the current post-date/time and author.
     *
     * @since Twenty Ten 1.0
     */
    function Progressive_posted_on()
    {
        printf(
            __('<span class="%1$s">Posted on</span> %2$s ', 'Progressive'),
            'meta-prep meta-prep-author',
            sprintf(
                '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
                get_permalink(),
                esc_attr(get_the_time()),
                get_the_date()
            ),
            sprintf(
                '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
                get_author_posts_url(get_the_author_meta('ID')),
                esc_attr(sprintf(__('View all posts by %s', 'Progressive'), get_the_author(''))),
                get_the_author()
            )
        );
    }
endif;

if (!function_exists('Progressive_posted_in')) :
    /**
     * Prints HTML with meta information for the current post (category, tags and permalink).
     *
     * @since Twenty Ten 1.0
     */
    function Progressive_posted_in()
    {
        // Retrieves tag list of current post, separated by commas.
        $tag_list = get_the_tag_list('', ', ');
        if ($tag_list) {
            $posted_in = __(
                'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.',
                'Progressive'
            );
        } elseif (is_object_in_taxonomy(get_post_type(), 'category')) {
            $posted_in = __(
                'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.',
                'Progressive'
            );
        } else {
            $posted_in = __(
                'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.',
                'Progressive'
            );
        }
        // Prints the string, replacing the placeholders.
        printf(
            $posted_in,
            get_the_category_list(', '),
            $tag_list,
            get_permalink(),
            the_title_attribute('echo=0')
        );
    }
endif;

// thumb sizes
if (function_exists('add_image_size')) {
    add_image_size('icon-slider', 980, 350, true);
    add_image_size('icon-articles', 216, 164, true);
    add_image_size('icon-video', 216, 122, true);
    add_image_size('icon-photo', 122, 163, true);
    add_image_size('icon-photo-single', 176, 132, true);
    add_image_size('icon-people-small', 280, 280, true);
    add_image_size('icon-people-big', 600, 600, true);
    add_image_size('icon-event', 715, 247, true);
}


// custom Post Types
add_action('init', 'custom_post_types');
function custom_post_types()
{

    // Slides
    $labels = array(
        'name' => _x('Slides', 'post type general name'),
        'singular_name' => _x('Slides', 'post type singular name'),
        'add_new' => _x('Add slide', 'slides'),
        'add_new_item' => __('Add new slide'),
        'edit_item' => __('Edit slide'),
        'new_item' => __('New slide'),
        'view_item' => __('View slide'),
        'search_items' => __('Search for'),
        'not_found' => __('Not found'),
        'not_found_in_trash' => __('Not found in trash'),
        'parent_item_colon' => ''
    );
    register_post_type(
        'slides',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => true,
            'exclude_from_search' => false,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'taxonomies' => array('slides_category'),
        )
    );
    // custom taxonomies
    register_taxonomy(
        'slides_category',
        'slides',
        array()
    );

    // Boxes homepage
    $labels = array(
        'name' => _x('Boxes homepage', 'post type general name'),
        'singular_name' => _x('Boxes homepage', 'post type singular name'),
        'add_new' => _x('Add box', 'boxes'),
        'add_new_item' => __('Add new box'),
        'edit_item' => __('Edit box'),
        'new_item' => __('New box'),
        'view_item' => __('View box'),
        'search_items' => __('Search for'),
        'not_found' => __('Not found'),
        'not_found_in_trash' => __('Not found in trash'),
        'parent_item_colon' => ''
    );
    register_post_type(
        'boxes',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => true,
            'exclude_from_search' => false,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'taxonomies' => array('boxes_category'),
        )
    );
    // custom taxonomies
    register_taxonomy(
        'boxes_category',
        'boxes',
        array()
    );

    // People
    $labels = array(
        'name' => _x('People', 'post type general name'),
        'singular_name' => _x('People', 'post type singular name'),
        'add_new' => _x('Add people', 'people_type'),
        'add_new_item' => __('Add new people'),
        'edit_item' => __('Edit people'),
        'new_item' => __('New people'),
        'view_item' => __('View people'),
        'search_items' => __('Search for'),
        'not_found' => __('Not found'),
        'not_found_in_trash' => __('Not found in trash'),
        'parent_item_colon' => ''
    );
    register_post_type(
        'people_type',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => true,
            'exclude_from_search' => false,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'taxonomies' => array('people_type_category'),
        )
    );
    // custom taxonomies
    register_taxonomy(
        'people_type_category',
        'people_type',
        array()
    );

    // Partners
    $labels = array(
        'name' => _x('Partners', 'post type general name'),
        'singular_name' => _x('Partners', 'post type singular name'),
        'add_new' => _x('Add partner', 'partner_type'),
        'add_new_item' => __('Add new partner'),
        'edit_item' => __('Edit partner'),
        'new_item' => __('New partner'),
        'view_item' => __('View partner'),
        'search_items' => __('Search for'),
        'not_found' => __('Not found'),
        'not_found_in_trash' => __('Not found in trash'),
        'parent_item_colon' => ''
    );
    register_post_type(
        'partner_type',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => true,
            'exclude_from_search' => false,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'taxonomies' => array('partner_type_category'),
        )
    );
    // custom taxonomies
    register_taxonomy(
        'partner_type_category',
        'partner_type',
        array()
    );

    // Events
    $labels = array(
        'name' => _x('Events', 'post type general name'),
        'singular_name' => _x('Events', 'post type singular name'),
        'add_new' => _x('Add event', 'event_type'),
        'add_new_item' => __('Add new event'),
        'edit_item' => __('Edit event'),
        'new_item' => __('New event'),
        'view_item' => __('View event'),
        'search_items' => __('Search for'),
        'not_found' => __('Not found'),
        'not_found_in_trash' => __('Not found in trash'),
        'parent_item_colon' => ''
    );
    register_post_type(
        'event_type',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => true,
            'exclude_from_search' => false,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'taxonomies' => array('event_type_category'),
        )
    );
    // custom taxonomies
    register_taxonomy(
        'event_type_category',
        'event_type',
        array()
    );

    // Social buttons
    $labels = array(
        'name' => _x('Social buttons', 'post type general name'),
        'singular_name' => _x('Social buttons', 'post type singular name'),
        'add_new' => _x('Add box', 'socials'),
        'add_new_item' => __('Add new box'),
        'edit_item' => __('Edit box'),
        'new_item' => __('New box'),
        'view_item' => __('View box'),
        'search_items' => __('Search for'),
        'not_found' => __('Not found'),
        'not_found_in_trash' => __('Not found in trash'),
        'parent_item_colon' => ''
    );
    register_post_type(
        'socials',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => true,
            'exclude_from_search' => false,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'taxonomies' => array('socials_category'),
        )
    );
    // custom taxonomies
    register_taxonomy(
        'socials_category',
        'socials',
        array()
    );
		
   // Teasers
    $labels = array(
        'name' => _x('Teasers', 'post type general name'),
        'singular_name' => _x('Teasers', 'post type singular name'),
        'add_new' => _x('Add box', 'teaser-box'),
        'add_new_item' => __('Add new box'),
        'edit_item' => __('Edit box'),
        'new_item' => __('New box'),
        'view_item' => __('View box'),
        'search_items' => __('Search for'),
        'not_found' => __('Not found'),
        'not_found_in_trash' => __('Not found in trash'),
        'parent_item_colon' => ''
    );
    register_post_type(
        'teaser-box',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => true,
            'exclude_from_search' => false,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'taxonomies' => array('teaser-box_category'),
        )
    );
    // custom taxonomies
    register_taxonomy(
        'teaser-box_category',
        'teaser-box',
        array()
    );


  // Teasers network
    $labels = array(
        'name' => _x('Teasers Network', 'post type general name'),
        'singular_name' => _x('Teasers Network', 'post type singular name'),
        'add_new' => _x('Add box', 'teaser-network-box'),
        'add_new_item' => __('Add new box'),
        'edit_item' => __('Edit box'),
        'new_item' => __('New box'),
        'view_item' => __('View box'),
        'search_items' => __('Search for'),
        'not_found' => __('Not found'),
        'not_found_in_trash' => __('Not found in trash'),
        'parent_item_colon' => ''
    );
    register_post_type(
        'teaser-network-box',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => true,
            'exclude_from_search' => false,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'taxonomies' => array('teaser-network-box_category'),
        )
    );
    // custom taxonomies
    register_taxonomy(
        'teaser-network-box_category',
        'teaser--network-box',
        array()
    );

      // Teasers network HP
    $labels = array(
        'name' => _x('HP > Network', 'post type general name'),
        'singular_name' => _x('HP > Network', 'post type singular name'),
        'add_new' => _x('Add box', 'teaser-network-hp'),
        'add_new_item' => __('Add new box'),
        'edit_item' => __('Edit box'),
        'new_item' => __('New box'),
        'view_item' => __('View box'),
        'search_items' => __('Search for'),
        'not_found' => __('Not found'),
        'not_found_in_trash' => __('Not found in trash'),
        'parent_item_colon' => ''
    );
    register_post_type(
        'teaser-network-hp',
        array(
            'labels' => $labels,
            'public' => true,
            'show_ui' => true,
            'hierarchical' => false,
            'rewrite' => true,
            'exclude_from_search' => false,
            'supports' => array(
                'title',
                'editor',
                'thumbnail',
            ),
            'taxonomies' => array('teaser-network-hp_category'),
        )
    );
    // custom taxonomies
    register_taxonomy(
        'teaser-network-hp_category',
        'teaser--network-hp',
        array()
    );
}

// end custom Post Types

// custom scripts
function Progressive_scripts()
{
    wp_enqueue_script(
        'bootstrap',
        get_template_directory_uri() . '/framework/js/bootstrap.min.js',
        array(),
        '1.0.0',
        true
    );
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/framework/js/scripts.js', array(), '1.0.0', true);
    wp_enqueue_script(
        'flexslider',
        get_template_directory_uri() . '/framework/js/jquery.flexslider.js',
        array(),
        '1.0.0',
        true
    );
}

add_action('wp_enqueue_scripts', 'Progressive_scripts');

// custom excerpt
function excerpt($limit)
{
    $excerpt = explode(' ', get_the_excerpt(), $limit);
    if (count($excerpt) >= $limit) {
        array_pop($excerpt);
        $excerpt = implode(" ", $excerpt) . '...';
    } else {
        $excerpt = implode(" ", $excerpt);
    }
    $excerpt = preg_replace('`[[^]]*]`', '', $excerpt);
    return $excerpt;
}

function content($limit)
{
    $content = explode(' ', get_the_content(), $limit);
    if (count($content) >= $limit) {
        array_pop($content);
        $content = implode(" ", $content) . '...';
    } else {
        $content = implode(" ", $content);
    }
    $content = preg_replace('/[.+]/', '', $content);
    $content = apply_filters('the_content', $content);
    $content = str_replace(']]>', ']]&gt;', $content);
    return $content;
}

function template_chooser($template)
{
    global $wp_query;
    $customSearch = (bool)get_query_var('custom_search');

    if ($wp_query->is_search && $customSearch) {
        return locate_template('page-articles.php'); //  redirect to archive-search.php
    }
    return $template;
}

function add_query_vars_filter($vars)
{
    $vars[] = "custom_search";
    $vars[] = "query";
    $vars[] = "time-range";
    $vars[] = "term";
    return $vars;
}

function custom_search()
{
global $wp_query;
    $args = array(
'paged' => get_query_var( 'paged' ),
        's' => get_query_var('query'),
        'post_type' => 'post',
    );
    $timeRange = get_query_var('time-range');
    if (!empty($timeRange)) {
        $from = new DateTime();
        $from->modify("-{$timeRange} days");
        $dateQuery = array(
            'after' => array(
                'year' => $from->format('Y'),
                'month' => $from->format('m'),
                'day' => $from->format('d'),
            ),
            'inclusive' => true,
        );
        $args['date_query'] = $dateQuery;
    }
    $terms = $_GET['term'];
    if (!empty($terms) && is_array($terms)) {
        $args['cat'] = implode(',', $terms);
    }
    $wp_query = new WP_Query($args);
return $wp_query;
}

add_filter('query_vars', 'add_query_vars_filter');

add_filter('template_include', 'template_chooser');

//Gets post cat slug and looks for single-[cat slug].php and applies it
add_filter(
    'single_template',
    create_function(
        '$the_template',
        'foreach( (array) get_the_category() as $cat ) {
            if ( file_exists(TEMPLATEPATH . "/single-{$cat->slug}.php") )
            return TEMPLATEPATH . "/single-{$cat->slug}.php"; }
        return $the_template;'
    )
);

function monthsWithEvents(DateTime $start = null, DateTime $end = null)
{
    global $wpdb;
    if (is_null($start)) {
        $start = new DateTime();
    }

    if (is_null($end)) {
        $end = clone $start;
        $end->modify('+12 months');
    }

    $start = $start->format('Ymd');
    $end = $end->format('Ymd');
    $sql = "SELECT CONCAT_WS('-', YEAR(postmeta.meta_value), MONTH(postmeta.meta_value)) AS month, postmeta.meta_value FROM (SELECT * FROM wp_postmeta WHERE meta_key LIKE 'event_start_day' AND wp_postmeta.meta_value BETWEEN {$start} AND {$end}) AS postmeta GROUP BY month ORDER BY meta_value ASC";
    return $wpdb->get_results($sql);
}

function yearsWithEvents(DateTime $start = null, DateTime $end = null)
{
    global $wpdb;
    if (is_null($start)) {
        $start = new DateTime();
    }

    if (is_null($end)) {
        $end = clone $start;
        $start->modify('-100 years');
    }

    $start = $start->format('Ymd');
    $end = $end->format('Ymd');
    $sql = "SELECT YEAR(postmeta.meta_value) AS year FROM (SELECT * FROM wp_postmeta WHERE meta_key LIKE 'event_start_day' AND wp_postmeta.meta_value BETWEEN {$start} AND {$end}) AS postmeta GROUP BY year ORDER BY meta_value DESC";
    return $wpdb->get_results($sql);
}

function eventsFromDateRange(DateTime $from, DateTime $to, $limit = null)
{
    $from = $from->format('Ymd');
    $to = $to->format('Ymd');

    $args = array(
        'post_type' => 'event_type',
        'post_status' => 'publish',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
            array(
                'key' => 'event_start_day',
                'value' => "{$from}, {$to}", // change to how "event date" is stored
                'compare' => 'BETWEEN',
                'type' => 'date',
            )
        )
    );

    if (!is_null($limit)) {
        $args['posts_per_page'] = (int)$limit;
    }
    return new WP_Query($args);
}

function searchfilter($query) {

    if ($query->is_search && !is_admin() ) {
      $query->set('post_type',array('post'));
    }

return $query;
}

add_filter('pre_get_posts','searchfilter');

?>
