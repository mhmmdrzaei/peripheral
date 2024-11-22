<?php

/** Tell WordPress to run theme_setup() when the 'after_setup_theme' hook is run. */

if ( ! function_exists( 'theme_setup' ) ):

function theme_setup() {

	/* This theme uses post thumbnails (aka "featured images")
	*  all images will be cropped to thumbnail size (below), as well as
	*  a square size (also below). You can add more of your own crop
	*  sizes with add_image_size. */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size(120, 90, true);
	add_image_size('square', 150, 150, true);


	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	/* This theme uses wp_nav_menu() in one location.
	* You can allow clients to create multiple menus by
  * adding additional menus to the array. */
	register_nav_menus( array(
		'primary' => 'Primary Navigation',
		'footer' => 'Footer Navigation',
		'commerce' => 'Commerce Menu'
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

}
endif;

add_action( 'after_setup_theme', 'theme_setup' );

/* Add all our CSS files here.
We'll let WordPress add them to our templates automatically instead
of writing our own link tags in the header. */

function project_styles(){
	wp_enqueue_style('style', get_stylesheet_uri() );

	wp_enqueue_style('fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css');

	wp_enqueue_style('googlefont', 'https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;1,400;1,500;1,600;1,700&display=swap');


}

add_action( 'wp_enqueue_scripts', 'project_styles');
/* Add all our JavaScript files here.
We'll let WordPress add them to our templates automatically instead
of writing our own script tags in the header and footer. */



function project_scripts() {

	//Don't use WordPress' local copy of jquery, load our own version from a CDN instead
	wp_deregister_script('jquery');
wp_enqueue_script(
  	'jquery',
  	"http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js",
  	false, //dependencies
  	null, //version number
  	true //load in footer
  );


  wp_enqueue_script(
  	'googleMaps',
  	"http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://maps.googleapis.com/maps/api/js?key=AIzaSyBzhl9c_fsPimCSpzBxkISfpuhaWFiAb2I",
  	false, //dependencies
  	null, //version number
  	true //load in footer
  );

  wp_enqueue_script(
  	'smoothscroll',
  	"https" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://cdnjs.cloudflare.com/ajax/libs/smooth-scrollbar/8.5.2/smooth-scrollbar.js",
  	false, //dependencies
  	null, //version number
  	true //load in footer
  );
  // wp_enqueue_script(
  // 	'gsap',
  // 	"https" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://unpkg.com/gsap@3/dist/gsap.min.js",
  // 	false, //dependencies
  // 	null, //version number
  // 	true //load in footer
  // );
  // wp_enqueue_script(
  // 	'scrollTrigger',
  // 	"https" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://unpkg.com/gsap@3/dist/ScrollTrigger.min.js",
  // 	false, //dependencies
  // 	null, //version number
  // 	true //load in footer
  // );

  wp_enqueue_script(
    'plugins', //handle
    get_template_directory_uri() . '/dist/plugins.js', //source
    false, //dependencies
    null, // version number
    true //load in footer
  );

  wp_enqueue_script(
    'scripts', //handle
    get_template_directory_uri() . '/dist/main.min.js', //source
    array( 'jquery', 'plugins' ), //dependencies
    null, // version number
    true //load in footer
  );


}

// google maps api
function my_acf_init() {
    acf_update_setting('google_api_key', 'AIzaSyBzhl9c_fsPimCSpzBxkISfpuhaWFiAb2I');
}
add_action('acf/init', 'my_acf_init');

add_action( 'wp_enqueue_scripts', 'project_scripts');

add_action( 'woocommerce_after_shop_loop_item', 'woo_show_excerpt_shop_page', 19 );
function woo_show_excerpt_shop_page() {
	global $product;

	
}
add_filter('add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment');



//custom categories

function wp_list_categories_for_post_type($post_type, $args = '') {
    $exclude = array();

    // Check ALL categories for posts of given post type
    foreach (get_categories() as $category) {
        $posts = get_posts(array('post_type' => $post_type, 'category' => $category->cat_ID));

        // If no posts found, ...
        if (empty($posts))
            // ...add category to exclude list
            $exclude[] = $category->cat_ID;
    }

    // Set up args
    if (! empty($exclude)) {
        $args .= ('' === $args) ? '' : '&';
        $args .= 'exclude='.implode(',', $exclude);
    }

    // List categories
    wp_list_categories($args);
}

/* Custom Title Tags */

function project_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}

	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $site_description";
	}

	// Add a page number if necessary.
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'Project' ), max( $paged, $page ) );
	}

	return $title;
}
add_filter( 'wp_title', 'project_wp_title', 10, 2 );

/*
  Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link.
 */
function project_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'project_page_menu_args' );

/**
 * Remove WooCommerce product and WordPress page results from the search form widget
 *
 * @author   Golden Oak Web Design <info@goldenoakwebdesign.com>
 * @author   Joshua David Nelson <josh@joshuadnelson.com>
 * @license  https://www.gnu.org/licenses/gpl-2.0.html GPLv2+
 */
function golden_oak_web_design_modify_search_query( $query ) {
  // Make sure this isn't the admin or is the main query
  if( is_admin() || ! $query->is_main_query() ) {
    return;
  }

  // Make sure this isn't the WooCommerce product search form
  if( isset($_GET['post_type']) && ($_GET['post_type'] == 'product') ) {
    return;
  }

  if( $query->is_search() ) {
    $in_search_post_types = get_post_types( array( 'exclude_from_search' => false ) );

    // The post types you're removing (example: 'product' and 'page')
    $post_types_to_remove = array( 'product', 'page' );

    foreach( $post_types_to_remove as $post_type_to_remove ) {
      if( is_array( $in_search_post_types ) && in_array( $post_type_to_remove, $in_search_post_types ) ) {
        unset( $in_search_post_types[ $post_type_to_remove ] );
        $query->set( 'post_type', $in_search_post_types );
      }
    }
  }

}
add_action( 'pre_get_posts', 'golden_oak_web_design_modify_search_query' );


/*
 * Sets the post excerpt length to 40 characters.
 */
function project_excerpt_length( $length ) {
	return 150;
}
add_filter( 'excerpt_length', 'project_excerpt_length' );

/*
 * Returns a "Continue Reading" link for excerpts
 */
function project_continue_reading_link() {
	return ' <br><br><a href="'. get_permalink() . '">Continue reading <span class="meta-nav">&rarr;</span></a>';
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis and project_continue_reading_link().
 */
function project_auto_excerpt_more( $more ) {
	return ' &hellip;' . project_continue_reading_link();
}
add_filter( 'excerpt_more', 'project_auto_excerpt_more' );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 */
function project_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= project_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'project_custom_excerpt_more' );


/*
 * Register a single widget area.
 * You can register additional widget areas by using register_sidebar again
 * within project_widgets_init.
 * Display in your template with dynamic_sidebar()
 */
function project_widgets_init() {
	// Area 1, located at the top of the sidebar.
	register_sidebar( array(
		'name' => 'Primary Widget Area',
		'id' => 'primary-widget-area',
		'description' => 'The primary widget area',
		'before_widget' => '<li id="%1$s" class="widget-container %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}

add_action( 'widgets_init', 'project_widgets_init' );

/**
 * Removes the default styles that are packaged with the Recent Comments widget.
 */
function project_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'project_remove_recent_comments_style' );


if ( ! function_exists( 'project_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post—date/time and author.
 */
function project_posted_on() {
	printf('<span class="%1$s">Posted on</span> %2$s <span class="meta-sep">by</span> %3$s',
		'meta-prep meta-prep-author',
		sprintf( '<a href="%1$s" title="%2$s" rel="bookmark"><span class="entry-date">%3$s</span></a>',
			get_permalink(),
			esc_attr( get_the_time() ),
			get_the_date()
		),
		sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s">%3$s</a></span>',
			get_author_posts_url( get_the_author_meta( 'ID' ) ),
			sprintf( esc_attr( 'View all posts by %s'), get_the_author() ),
			get_the_author()
		)
	);
}
endif;

if ( ! function_exists( 'project_posted_in' ) ) :
/**
 * Prints HTML with meta information for the current post (category, tags and permalink).
 */
function project_posted_in() {
	// Retrieves tag list of current post, separated by commas.
	$tag_list = get_the_tag_list( '', ', ' );
	if ( $tag_list ) {
		$posted_in = 'This entry was posted in %1$s and tagged %2$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} elseif ( is_object_in_taxonomy( get_post_type(), 'category' ) ) {
		$posted_in = 'This entry was posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	} else {
		$posted_in = 'Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.';
	}
	// Prints the string, replacing the placeholders.
	printf(
		$posted_in,
		get_the_category_list( ', ' ),
		$tag_list,
		get_permalink(),
		the_title_attribute( 'echo=0' )
	);
}
endif;

/* Get rid of junk! - Gets rid of all the crap in the header that you dont need */

function clean_stuff_up() {
	// windows live
	remove_action('wp_head', 'rsd_link');
	remove_action('wp_head', 'wlwmanifest_link');
	// wordpress gen tag
	remove_action('wp_head', 'wp_generator');
	// comments RSS
	remove_action( 'wp_head', 'feed_links_extra', 3 );
	remove_action( 'wp_head', 'feed_links', 3 );
}

add_action('init', 'clean_stuff_up');


/* Here are some utility helper functions for use in your templates! */

/* pre_r() - makes for easy debugging. <?php pre_r($post); ?> */
function pre_r($obj) {
	echo "<pre>";
	print_r($obj);
	echo "</pre>";
}

if( function_exists('acf_add_options_page') ) {
	
	acf_add_options_page(array(
		'page_title' 	=> 'Footer General Information',
		'menu_title'	=> 'General Information',
		'menu_slug' 	=> 'theme-general-settings',
		'capability'	=> 'edit_posts',
		'icon_url' => 'dashicons-email-alt2',
		'position' => 7,
		'redirect'		=> false
	));
	
	
}

function send_code_on_purchase($order_id) {
    // Get the list of predetermined codes
    $codes = array(
		'N2KP-RNJV-258J-TEX4',
'8YMF-MNWG-M8ND-AFP5',
'PZJ3-EX9P-R9LT-ND6H',
'ZHDA-JK3A-CTUF-AY8K',
'B566-7KB2-RZAM-WQC3',
'6BZN-SFHY-6FLC-476F',
'QCAH-5G2L-HQGF-448Y',
'PQSC-TXSK-D3AL-FDVF',
'88R7-JG89-RTTW-F9MU',
'TH9B-D5RT-RY5W-AHP2',
'P3LB-238Z-YWUX-N26L',
'XYRD-XBL7-GFB6-J5E2',
'AQAD-BCF8-KDQE-NNXS',
'V5JS-WNNS-HJ5D-PTQE',
'XZNU-T7TF-6YBM-ZXYA',
'SXRQ-Q5F6-Q54P-RK5W',
'K2RA-UCK6-VJX5-HXJW',
'AE85-LS4N-H59V-WS4Z',
'9TKB-YXZ3-4CEF-KCKP',
'7MWC-N2SR-EBNC-74CV',
'GNMT-EC8T-JAWD-EB87',
'V8NB-FPD8-JR4M-8NV5',
'LP6Y-FSNW-FDT6-RM7G',
'QWX6-PG2N-UDVK-WE6M',
'CQSY-7W49-LX8F-6G3E',
'REE4-QA7F-NJED-JSCW',
'G3YL-LW29-NGAR-NBPP',
'NQHP-76U4-9LST-6CNQ',
'A72U-NQRB-3GB2-N3NJ',
'XMBW-ECSC-G394-NSQP',
'ZVWQ-FDCV-L2EA-4CRL',
'WHDE-332A-657X-LPUJ',
'U4KQ-HN8L-283E-NKK2',
'7WU8-GSQV-YV98-38Y5',
'7ZAT-8X5V-743M-78S9',
'PN8J-9A8Z-7ZEJ-MWYF',
'4MU4-D8KM-ELPA-3PA5',
'JC4Z-K26W-V6AQ-V625',
'DKSP-FYN8-AC9Y-SQMP',
'4FVT-QSY8-ME9B-ZS35',
'TXLH-TKGE-8LZY-9QJD',
'TBSG-ZDKW-DL8Z-ELN2',
'S7Z8-2CFK-XHTM-VZGZ',
'YLTQ-NKJQ-MXFV-BUPA',
'TB5F-KJCE-ERZ8-JZ9F',
'PZPZ-JJ7V-8QD8-A5XD',
'37QE-P56U-67TA-N7UU',
'F73Y-EXSS-566C-F772',
'8ZUG-79KD-ACRC-QFBQ',
'UDWE-MQWV-NRJY-UXVC',
'2LMG-QTFP-KHYP-QPW7',
'DNPL-ZFVH-YAZB-PEPH',
'QBWP-M69F-YD4V-JRCF',
'FNYK-WTKV-594H-Q6SK',
'J8ED-6EBQ-37AG-MWYX',
'HZUY-N54D-UQA4-PWCB',
'JE7F-JY77-Y2FF-FBE3',
'GXH6-WRSD-TYN3-WETT',
'ANHR-PE82-3ETU-VNDX',
'5XK8-FVPY-F8YW-SYXD',
'9WKU-3BA9-X8LN-34R9',
'X42P-54H9-2LFT-NEMC',
'HST5-XNVB-KQM9-R9SX',
'L49E-JG6G-46UQ-5U86',
'VUBQ-SKSG-83G5-ZPJ3',
'NRY7-NM53-CXE2-DT38',
'EJFQ-4SDF-5GFQ-J3J3',
'58JQ-GU74-RU2S-QSJW',
'4F39-PP5U-5FCK-2X4E',
'NDJD-BRHB-MJCB-UJPU',
'87XG-N3GW-CNGL-P4DE',
'4JVR-E3MR-DSB9-EV5C',
'MHL6-CQ73-56SJ-PZ3Y',
'6TTL-R5AH-AZW7-GGB8',
'FQG7-FUL6-WURL-8FQW',
'QRSP-BZAD-5X6E-J32E',
'7S4H-KM8J-KKLC-4WKR',
'DB95-L7TV-3E42-Q3ZE',
'5V4G-7FNE-45RA-4PKY',
'BBDJ-EBGG-LNAU-9G3G',
'D87Q-VSYD-P7VD-LWTP',
'FW7A-JCPY-QT6S-XKBD',
'6U3R-KCJD-AUY9-KQGZ',
'S5ZB-VGXG-ADHP-NCMG',
'U76G-5V4Z-AUXQ-YTWR',
'QZVE-JXTC-57MS-P7NS',
'VMM6-7QXS-UUV3-9H33',
'GB9E-8ENM-AC96-PSQZ',
'EZ8M-W23K-T4JY-PDGU',
'VD2G-2XGZ-Q8SV-65G8',
'WH4M-UZLR-X243-ZCP6',
'S94D-RUQB-WM4N-PZZL',
'AK3T-JLPN-3C3U-77FX',
'4ZS4-CFAA-88YM-KL83',
'LC7B-GXJZ-F635-CY86',
'VC2R-GBMU-397B-7C8L',
'ZXJQ-4TBF-TWHU-WZQS',
'LPXX-S5CA-6L3K-ECE8',
'GH7X-Q7CH-FJ9U-D74X',
'GNPL-TYY5-RPY6-HH4K'
	  );

    // Get the customer's email address
    $order = wc_get_order($order_id);
    $customer_email = $order->get_billing_email();

    // Check if the order contains the specific product(s) you want to apply this code assignment to
    $target_product_ids = array(5385); // Replace with the product IDs or category IDs you want to target

    $found = false;
    foreach ($order->get_items() as $item) {
        $product_id = $item->get_product_id();
        $product = wc_get_product($product_id);

        // Check if the product ID matches the target product IDs
        if (in_array($product_id, $target_product_ids) || in_array($product->get_category_ids(), $target_product_ids)) {
            $found = true;
            break;
        }
    }

    if (!$found) {
        return; // If the purchased product(s) don't match, exit the function
    }

    // Assign a code to the customer and send an email
    $assigned_codes = get_post_meta($order_id, 'assigned_codes', true);
    if (empty($assigned_codes)) {
        // Shuffle the list of codes to randomize their order
        shuffle($codes);

        // Get the next 100 codes from the randomized list
        $assigned_codes = array_slice($codes, 0, 100);

        // Update the order with the assigned codes
        update_post_meta($order_id, 'assigned_codes', $assigned_codes);

        // Send an email to the customer with their assigned code
        $subject = 'Your purchased code';
        $message = 'Thank you for your purchase. Please visit https://peripherie.peripheralreview.com/ -- the peripherie peripherie site -- to access the project. Your access code is: ' . $assigned_codes[0];
        wp_mail($customer_email, $subject, $message);
    }
}
add_action('woocommerce_order_status_completed', 'send_code_on_purchase');



add_action('woocommerce_order_status_processing', 'custom_update_order_status', 10, 2);
function custom_update_order_status($order_id, $order)
{
    // Get the order object
    $order = wc_get_order($order_id);

    // Get the product ID for which you want to update the order status
    $target_product_id = 5385; // Replace with your actual product ID

    // Check if the order contains the target product
    $has_target_product = false;
    foreach ($order->get_items() as $item) {
        if ($item->get_product_id() === $target_product_id) {
            $has_target_product = true;
            break;
        }
    }

    // If the order contains the target product, update the order status to "Completed"
    if ($has_target_product) {
        $order->update_status('completed');
    }
}




/* is_blog() - checks various conditionals to figure out if you are currently within a blog page */
function is_blog () {
	global  $post;
	$posttype = get_post_type($post );
	return ( ((is_archive()) || (is_author()) || (is_category()) || (is_home()) || (is_single()) || (is_tag())) && ( $posttype == 'post')  ) ? true : false ;
}

