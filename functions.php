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
		'2RY5-2NUN-JNKM-6V4F',
		'QJSV-SAZD-8WLD-AM9X',
		'DED5-B482-8JLM-6EJP',
		'SFEV-YEGZ-ZCCD-HCSK',
		'9TQU-AUWN-SBLZ-LDVW',
		'9GQT-KH43-VJRR-JB9F',
		'HJPR-48VG-HT68-VREM',
		'GTD9-KEXH-SL8E-UURB',
		'63A8-7C9C-QDJH-7KTL',
		'H96Y-L29N-XKKL-V4MM',
		'5XTY-G3PZ-77AE-XUTE',
		'WQRJ-BK22-7CNJ-EGBS',
		'RAEM-25HD-5LWW-ATYF',
		'39N9-KXKJ-84QL-2JTT',
		'WYQ9-PATM-BFSN-JFR8',
		'HYHV-CQEC-EXTC-5TCT',
		'UW6X-GVKV-MYAR-ANKP',
		'Y4RW-28W2-3JUL-XEGN',
		'5Y9P-5CUD-ZXY8-N7TR',
		'USHA-TDAS-HPT4-824W',
		'Z4QW-X5EP-9K2J-QHR7',
		'S92C-W2DA-KEEH-5NX5',
		'BWRD-6QXS-2CYY-5UXZ',
		'RXSP-QUPL-2FB6-7LP4',
		'NFJN-CRCX-D8TT-SDDU',
		'H2VU-ZK5Q-E934-JQW7',
		'JTLS-M866-M5CT-NJT5',
		'2R8R-6VEC-QJ3K-7YAJ',
		'J7S8-2CNU-X5X2-9MCZ',
		'D9Y9-PPUZ-QB6Z-EG4T',
		'TXUL-BZFM-3K9U-YKE5',
		'HTSX-448K-N83M-WFJQ',
		'3KV5-J9DU-4VAE-AHX4',
		'MREW-L83M-HGEG-WF4Q',
		'W8GZ-72Z8-XTZD-DD9C',
		'72E8-US58-US8F-ZDHJ',
		'SYA5-AP9K-3CNN-VE2B',
		'RBED-76YL-HR3A-8GUB',
		'TWXA-M5PQ-6AFC-PTPM',
		'CAME-XLWG-QYCZ-KX7W',
		'UWWT-BKHE-HREM-C9PN',
		'YZT5-ED32-DKN7-ZRQT',
		'B3GR-H4WD-V78U-EHRE',
		'SGMR-QUHM-MYXZ-ENEJ',
		'J57K-U4S7-JJGZ-ZCBV',
		'4HAX-ZV2E-V6UT-E3HJ',
		'PKVE-HUBW-9M79-Q43V',
		'YTW6-G6DV-M25N-4XRM',
		'PUW3-7W5V-6RP4-67UK',
		'2V8H-YXKU-LXZT-RW5P',
		'6BKM-B3E8-DY9E-2SRB',
		'TDW7-LBWP-8WYP-WUAD',
		'5V4N-MPZ3-2NDM-GXB4',
		'KWVV-CJU2-QTWJ-48XJ',
		'LGVW-JFZW-WFRC-VJDR',
		'KVW3-P9T6-E9JE-PTRH',
		'4SW5-TQAM-FCW9-RPNZ',
		'KRSV-JQHD-D237-3QJF',
		'XR3B-98PZ-BEJT-6X8D',
		'MKLD-5FYX-EJT4-KPCQ',
		'U2NF-6V3A-78D5-GL2X',
		'VQ4K-RAXC-Y2HV-9KFW',
		'5Z7A-R3JL-F56X-D5R3',
		'TQQP-X7AW-TEC7-DZZV',
		'JFYW-GZMN-QGNT-BZT5',
		'JEGH-D8PC-L7NH-2VUQ',
		'8JAH-JLXG-W6VD-62QH',
		'K4UG-ZD2P-W3GF-CVWH',
		'HEZ3-4WRA-FFNP-HBXH',
		'ZB8B-CDPE-A89X-4GS2',
		'UMCP-2Q9C-VT44-XCDA',
		'EEA3-N98W-A87X-4FQN',
		'BUJY-QH8J-26H8-2GBP',
		'5Z7P-UW89-HVDE-KFK8',
		'Y4QM-KZBC-EFV8-84GW',
		'2773-P8NU-QRWG-5DBR',
		'CNV8-Z9ZK-9NQ9-CDF9',
		'S3JT-SWVG-VB38-NU7S',
		'SYED-GNYC-CYCR-8LWS',
		'FCXJ-4JTP-2BT8-KEMJ',
		'GFY5-W39A-8GTH-Y572',
		'4EHY-Y3DS-SCGY-SWYP',
		'MMZY-3DYJ-GFS3-PP6Y',
		'CG6U-YGKP-6VTA-XB86',
		'8BUR-4SUT-RTZF-G3QN',
		'ABYG-H26Q-J6NQ-CZLU',
		'KF6Y-RLKV-JMTM-VA46',
		'S9S4-VRCG-XTWA-DV8C',
		'JHT7-DSDC-E4SH-BES2',
		'UE9H-L9YM-ET5Y-LDZ3',
		'QAM8-TUHJ-FD9D-B7M7',
		'8A3U-ETZP-6VB3-Y4CJ',
		'C2N3-NRHQ-A6X6-F867',
		'HFE7-A5RR-5A65-MV65',
		'P53C-GKDX-PPR7-WSBX',
		'4NZ7-5MSF-YDL8-HQRV',
		'TC9X-9R8A-FGFU-Z5K3',
		'BXVV-CAMG-5HSL-6QNG',
		'GQQR-6FML-BQW6-QXJZ',
		'FUPX-F6M8-UGUY-W6N2',
		'WZ4N-C5SJ-6J3S-D9QR',
		'KDQH-3MCP-XB52-7SJL',
		'XQL9-RYP8-8W6D-TLAR',
		'9NPZ-FWCH-9MLV-82M5',
		'N96S-LBBU-WGQU-KWFS',
		'QZ72-D5UT-W32F-QLB6',
		'WKLJ-W9JG-HB2P-86RL',
		'JZ5D-DFDY-B3CU-GAF6',
		'9XJF-3MNY-6KTG-QD6B',
		'WCES-XSY3-CYM8-HHRH'
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
        $message = 'Thank you for your purchase. Your code is: ' . $assigned_codes[0];
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

