<?php


/****************************************************************************************/
/* Define constants
/****************************************************************************************/
define('THEMEROOT', get_stylesheet_directory_uri());
define('IMAGES', THEMEROOT . '/img');


/****************************************************************************************/
/* WP_HEAD GOODNESS
/* The default wordpress head is a mess.
/* Let's clean it up by removing all the junk we don't need.
/****************************************************************************************/
function parklife_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
} /* end parklife head cleanup */

// remove WP version from RSS
function parklife_rss_version() { return ''; }

// remove injected CSS for recent comments widget
function parklife_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function parklife_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function parklife_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}


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

// load Foundation initialisation script in footer
if ( ! function_exists( 'foundation_zep' ) ) {
  function foundation_zep() { ?>
  <script>
  document.write('<script src=' +
  ('__proto__' in {} ? '<? bloginfo('template_directory'); ?>/js/vendor/zepto' : '<? bloginfo('template_directory'); ?>/js/vendor/jquery') +
  '.js><\/script>')
  </script>
  <?php }
}
add_action( 'wp_footer', 'foundation_zep', 1 );

function load_custom_scripts() {

  // removes WP version of jQuery
	wp_deregister_script('jquery');

  // modernizr
  wp_enqueue_script( 'modernizr',  THEMEROOT . '/js/vendor/custom.modernizr.js', array(), '2.6.2', false );

  // wp_enqueue_script('jquery','http://ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js', array(), false, true);

  // loads jQuery 1.10.2
  // wp_enqueue_script( 'jquery',  THEMEROOT . '/js/vendor/jquery.js', array(), '1.10.2', false );

  // adding Foundation scripts file in the footer
  wp_enqueue_script('foundation-js', THEMEROOT . '/js/foundation/foundation.js', array(), $theme_version, true );

	// register main stylesheet
  wp_enqueue_style( 'theme-stylesheet', get_template_directory_uri() . '/css/app.css', array(), $theme_version, 'all' );

  // adding Foundation top-bar
  wp_enqueue_script('topbar', THEMEROOT . '/js/foundation/foundation.topbar.js', array( 'foundation-js' ), $theme_version, true );

  //adding scripts file in the footer
  // wp_enqueue_script( 'theme-js',  THEMEROOT . '/js/scripts.js', array( 'foundation-js' ), $theme_version, true );

}
add_action('wp_enqueue_scripts', 'load_custom_scripts');

// load Foundation initialisation script in footer
if ( ! function_exists( 'foundation_init' ) ) {
  function foundation_init() { ?>
  <script type="text/javascript">$(document).foundation();</script>
  <?php }
}
add_action( 'wp_footer', 'foundation_init', 9999 );




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
/* Add theme support
/****************************************************************************************/

// thumbnails
if (function_exists('add_theme_support')) {
    // adding post format support
  	add_theme_support( 'post-formats',
  		array(
  			'aside',             // title less blurb
  			'gallery',           // gallery of images
  			'link',              // quick link to other site
  			'image',             // an image
  			'quote',             // a quick quote
  			'status',            // a Facebook like status update
  			'video',             // video
  			'audio',             // audio
  			'chat'               // chat transcript
  		)
  	);

    add_theme_support('post-thumbnails', array('post'));
    set_post_thumbnail_size(230, 230, true);
    // add_image_size('custom-blog-image', 637, 0, false);

    add_theme_support( 'automatic-feed-links' );

    // rss
    add_theme_support('automatic-feed-links');
}

/****************************************************************************************/
/* PAGE NAVI
/****************************************************************************************/

// Numeric Page Navi (built into the theme by default)
function parklife_page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
	echo $before.'<nav class="page-navigation"><ul class="pagination">'."";
	if ($start_page >= 2 && $pages_to_show < $max_page) {
		$first_page_text = __( "First", 'parklifetheme' );
		echo '<li><a href="'.get_pagenum_link().'" title="'.$first_page_text.'">'.$first_page_text.'</a></li>';
	}
	echo '<li>';
	previous_posts_link('<<');
	echo '</li>';
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="current"><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li>';
	next_posts_link('>>');
	echo '</li>';
	if ($end_page < $max_page) {
		$last_page_text = __( "Last", 'parklifetheme' );
		echo '<li><a href="'.get_pagenum_link($max_page).'" title="'.$last_page_text.'">'.$last_page_text.'</a></li>';
	}
	echo '</ul></nav>'.$after."";
} /* end page navi */



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


/****************************************************************************************/
/* RANDOM CLEANUP ITEMS
/****************************************************************************************/

// remove the p from around imgs
function parklife_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

// This removes the annoying […] to a Read More link
function parklife_excerpt_more($more) {
	global $post;
	// edit here if you like
return '...  <a class="excerpt-read-more" href="'. get_permalink($post->ID) . '" title="'. __('Read', 'parklifetheme') . get_the_title($post->ID).'">'. __('Read more &raquo;', 'parklifetheme') .'</a>';
}

//hide admin bar
add_filter('show_admin_bar', '__return_false');

?>
