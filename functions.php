<?php


/****************************************************************************************/
/* Define constants
/****************************************************************************************/


define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES', THEMEROOT . '/img');


/****************************************************************************************/
/* Set Menus
/****************************************************************************************/


function register_my_menus(){
  register_nav_menus( array(
    'main-menu' => 'Main Menu'
  ));
}
add_action( 'init', 'register_my_menus' );

add_theme_support('menus');

/**
 * Register Menus
 * http://codex.wordpress.org/Function_Reference/register_nav_menus#Examples
 */
register_nav_menus(array(
    'top-bar-l' => 'Left Top Bar', // registers the menu in the WordPress admin menu editor
    'top-bar-r' => 'Right Top Bar'
));


/**
 * Left top bar
 * http://codex.wordpress.org/Function_Reference/wp_nav_menu
 */
function foundation_top_bar_l() {
    wp_nav_menu(array(
        'container' => false,                           // remove nav container
        'container_class' => '',              // class of container
        'menu' => '',                               // menu name
        'menu_class' => 'top-bar-menu left',          // adding custom nav class
        'theme_location' => 'top-bar-l',                // where it's located in the theme
        'before' => '',                                 // before each link <a>
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 5,                                   // limit the depth of the nav
      'fallback_cb' => false,                         // fallback function (see below)
        'walker' => new top_bar_walker()
  ));
}

/**
 * Right top bar
 */
function foundation_top_bar_r() {
    wp_nav_menu(array(
        'container' => false,                           // remove nav container
        'container_class' => '',              // class of container
        'menu' => '',                               // menu name
        'menu_class' => 'top-bar-menu right',           // adding custom nav class
        'theme_location' => 'top-bar-r',                // where it's located in the theme
        'before' => '',                                 // before each link <a>
        'after' => '',                                  // after each link </a>
        'link_before' => '',                            // before each link text
        'link_after' => '',                             // after each link text
        'depth' => 5,                                   // limit the depth of the nav
      'fallback_cb' => false,                         // fallback function (see below)
        'walker' => new top_bar_walker()
  ));
}
/**
 * Customize the output of menus for Foundation top bar
 */

class top_bar_walker extends Walker_Nav_Menu {

    function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {
        $element->has_children = !empty( $children_elements[$element->ID] );
        $element->classes[] = ( $element->current || $element->current_item_ancestor ) ? 'active' : '';
        $element->classes[] = ( $element->has_children ) ? 'has-dropdown' : '';

        parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

    function start_el( &$output, $object, $depth = 0, $args = array(), $current_object_id = 0 ) {
        $item_html = '';
        parent::start_el( $item_html, $object, $depth, $args );

        /*$output .= ( $depth == 0 ) ? '<li class="divider"></li>' : '';*/

        $classes = empty( $object->classes ) ? array() : (array) $object->classes;

        if( in_array('label', $classes) ) {
            $output .= '<li class="divider"></li>';
            $item_html = preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '<label>$1</label>', $item_html );
        }

  if ( in_array('divider', $classes) ) {
    $item_html = preg_replace( '/<a[^>]*>( .* )<\/a>/iU', '', $item_html );
  }

        $output .= $item_html;
    }

    function start_lvl( &$output, $depth = 0, $args = array() ) {
        $output .= "\n<ul class=\"sub-menu dropdown\">\n";
    }

}

/****************************************************************************************/
/* Set the max width of the uploaded media
/****************************************************************************************/
if (!isset($content_width)) $content_width = 637;


/****************************************************************************************/
/* Load JS files
/****************************************************************************************/
function load_custom_scripts() {
  wp_enqueue_script('js','http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js', array(), false, true);
  wp_enqueue_script('modernizr-js', THEMEROOT . '/js/vendor/custom.modernizr.js', array(), false, true);
  wp_enqueue_script('foundation-js', THEMEROOT . '/js/foundation/foundation.js', array(), false, true);
  wp_enqueue_script('foundation-js2', THEMEROOT . '/js/foundation/foundation.topbar.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'load_custom_scripts');


/****************************************************************************************/
/* Register Sidebars
/****************************************************************************************/

if (function_exists('register_sidebar')) {
    register_sidebar(
      array(
        'name'  =>  'Main Sidebar',
        'id'    =>  'main-sidebar',
        'description'=> 'The main sidebar area',
        'before_widget'  =>  '<div class="sidebar-widget">',
        'after_widget'  =>  '</div> <!-- end sidebar-widget -->',
        'before_title'  =>  '<h4>',
        'after_title' =>  '</h4>'
  ));

  register_sidebar(
      array(
        'name'  =>  'Footer widget one',
        'id'    =>  'footer-widget-one',
        'description'=> 'Footer widget one area',
        'before_widget'  =>  '<div class="large-4 columns"><div class="panel">',
        'after_widget'  =>  '</div></div> <!-- end of footer widget one -->',
        'before_title'  =>  '<h4>',
        'after_title' =>  '</h4>'
  ));

  register_sidebar(
      array(
        'name'  =>  'Footer widget two',
        'id'    =>  'footer-widget-two',
        'description'=> 'Footer widget two area',
        'before_widget'  =>  '<div class="large-4 columns"><div class="panel">',
        'after_widget'  =>  '</div></div> <!-- end of footer widget two -->',
        'before_title'  =>  '<h4>',
        'after_title' =>  '</h4>'
  ));

  register_sidebar(
      array(
        'name'  =>  'Footer widget three',
        'id'    =>  'footer-widget-three',
        'description'=> 'Footer widget three area',
        'before_widget'  =>  '<div class="large-4 columns"><div class="panel">',
        'after_widget'  =>  '</div></div> <!-- end of footer widget three -->',
        'before_title'  =>  '<h4>',
        'after_title' =>  '</h4>'
  ));
}

/****************************************************************************************/
/* Add theme support of post thumbnails and post formats
/****************************************************************************************/
if (function_exists('add_theme_support')) {
    add_theme_support('post-formats', array('link', 'quote', 'gallery'));

    add_theme_support('post-thumbnails', array('post'));
    set_post_thumbnail_size(637, 0, false);
    add_image_size('custom-blog-image', 637, 0, false);

    add_theme_support( 'automatic-feed-links' );
}

/****************************************************************************************/
/* Function to display comments
/****************************************************************************************/
function custom_comments($comment, $args, $depth) {
    $GLOBALS['comment'] = $comment;

    if (get_comment_type() == 'pingback' || get_comment_type() == 'trackback') : ?>

        <li class="pingback" id="comment-<?php comment_ID(); ?>">
            <article <?php comment_class(); ?>>
                <header>
                    <h5>Pingback:</h5>
                    <p><?php edit_comment_link(); ?></p>

                </header>

                <a><?php comment_author_link(); ?></a>

            </article>

        </li>

    <?php elseif (get_comment_type() == 'comment') : ?>

        <li id="comment-<?php comment_id(); ?>">
        <article <?php comment_class('clearfix'); ?>>
            <header>
                <h5><?php comment_author_link(); ?></h5>
                <p>on <?php comment_date(); ?> at <?php comment_time(); ?> <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?></p>

            </header>
            <figure class="comment-avatar">
                <?php
                    $avatar_size = 80;
                    if ($comment->comment_parent != 0) {
                        $avatar_size = 64;
                    }

                    echo get_avatar($comment, $avatar_size);
                ?>
            </figure>

            <?php if ($comment->comment_approved == '0') : ?>
                <p class="awaiting-moderation">Your comment is awaiting moderation.</p>
            <?php endif; ?>

            <?php comment_text(); ?>

        </article>

    <?php endif;
}

/****************************************************************************************/
/* Custom Comments Form
/****************************************************************************************/
function blog_custom_comment_form($defaults) {
    $defaults['comment_notes_before'] = '';
    $defaults['id_form'] = 'comment-form';
    $defaults['comment_field'] = '<p><textarea name="comment" id="comment" cols="30" rows="10"></textarea></p>';

    return $defaults;
}

add_filter('comment_form_defaults', 'blog_custom_comment_form');
?>