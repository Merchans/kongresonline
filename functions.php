<?php
define( 'THEME_DIRECTORY', get_template_directory() );
define( 'THEME_DIRECTORY_URI', get_template_directory_uri() );

/* CHI custom posty type */
require_once THEME_DIRECTORY . "/inc/cpt/cpt_advertising.php";
require_once THEME_DIRECTORY . "/inc/cpt/cpt_video.php";

/* CHI meta boxes*/
require_once THEME_DIRECTORY . "/inc/mtb/mtb_chi_doctors_degree.php";
require_once THEME_DIRECTORY . "/inc/mtb/mtb_chi_video.php";
require_once THEME_DIRECTORY . "/inc/mtb/mtb_chi_advertising.php";
require_once THEME_DIRECTORY . "/inc/mtb/mtb_chi_all_posts.php";
require_once THEME_DIRECTORY . "/inc/mtb/mtb_category_logo.php";
require_once THEME_DIRECTORY . "/inc/mtb/mtb_category_background.php";
require_once THEME_DIRECTORY . "/inc/mtb/mtb_category_range.php";
require_once THEME_DIRECTORY . "/inc/mtb/mtb_chi_category_all_posts.php";
require_once THEME_DIRECTORY . "/inc/mtb/mtb_chi_category_advertising.php";
require_once THEME_DIRECTORY . "/inc/mtb/mtb_chi_checkbox_meta.php";
require_once THEME_DIRECTORY . "/inc/mtb/mtb_catagory_select.php";


/*
 * EXCERPT EDITOR
* */
require_once THEME_DIRECTORY . "/inc/excerpt-editor.php";
$excerpt = new Excerpt();

//Allow HTML Tags in Wordpress Excerpt
require_once THEME_DIRECTORY . "/inc/excerpt-allow.php";

/*
*   CHI Option Page
*/
require_once THEME_DIRECTORY . "/inc/opg/chi_option_menu_page.php";
/**
 * CHI Scripts and Styles
 */
require_once THEME_DIRECTORY . "/inc/scripts-and-styles.php";

/*
* CHI WP AMIN ORDER MENU
*/
require_once THEME_DIRECTORY . "/inc/reorder_admin_menu.php";

// CHI menuse
require_once THEME_DIRECTORY . "/inc/menues.php";


// CHI change labels
require_once THEME_DIRECTORY . "/inc/labels.php";

// CHI all header
function chi_all_headers() {
	if ( is_front_page() ) :
		return get_header();
	elseif ( is_404() ) :
		return get_header( '404' );
	elseif ( is_category() ) :
		return get_header( 'category' );
	elseif ( is_singular( 'chi_video' ) ) :
		return get_header( 'single' );
	elseif ( is_single() ) :
		return get_header( 'single' );
	else :
		return get_header();
	endif;
}

// GLOBAL VARIABLES SECTION
global $is_active_them_starter;
$is_active_them_starter = false;


/*
* CHI THEME SUPPERT
*/

add_theme_support( 'post-thumbnails' );
add_theme_support( 'menus' );


add_filter( 'nav_menu_link_attributes', 'chi_menu_add_class', 10, 3 );

function chi_menu_add_class( $atts, $item, $args ) {

	if ( in_array( 'current-menu-item', $atts ) ) {
		$class = 'nav-link chi-nav-link active chi-active ';
	} else {
		$class = 'nav-link chi-nav-link'; // or something based on $item
	}
	$atts['class'] = $class;

	return $atts;
}


add_filter( 'nav_menu_css_class', 'special_nav_class', 10, 2 );

function special_nav_class( $classes, $item ) {
	if ( in_array( 'current-menu-item', $classes ) ) {
		$classes[] = 'active chi-active';
	}

	return $classes;
}


function get_chi_make_specilal_form_category( $id = null ) {
	$home_url      = get_home_url();
	$category_slug = get_the_category( $id )[0]->slug;
	$url           = $home_url . '/' . $category_slug;

	return $url;
}

function chi_video_time( $id = false ) {
	if ( $id == false ) {
		$id = get_the_ID();
	}

	return get_post_meta( $id, [ "video_meta_box_video-length" ][0] );
}

add_filter( 'next_posts_link_attributes', 'posts_link_attributes' );
add_filter( 'previous_posts_link_attributes', 'posts_link_attributes' );

function posts_link_attributes() {
	return 'class="add-your-class-here"';
}

/* Print lable of CP  */

function get_chi_print_cp_lables() {
	$args = array(
		'public'              => true,
		'exclude_from_search' => false,
		'_builtin'            => false,
	);

	$output     = 'chi_video'; // names or objects, note names is the default
	$operator   = 'and'; // 'and' or 'or'
	$post_types = get_post_types( $args, $output, $operator );

	return $post_types["$output"]->label;
}


/*CZech date function */
function czech_date( $dateFormat, $dateData ) {
	$aj = array(
		"January",
		"February",
		"March",
		"April",
		"May",
		"June",
		"July",
		"August",
		"September",
		"October",
		"November",
		"December"
	);
	$cz = array(
		"ledna",
		"února",
		"března",
		"dubna",
		"května",
		"června",
		"července",
		"srpna",
		"září",
		"října",
		"listopadu",
		"prosince"
	);

	$czech_date = str_replace( $aj, $cz, date( $dateFormat, $dateData ) );

	return $czech_date;
}

/* MAIN LOOP EDIT */

function chi_category_main_query_offset( $query, $offset = 2 ) {

	if ( ! is_admin() ) {

		if ( $query->is_main_query() && $query->is_category() && $query->is_archive() && is_category( 'kardiovaskularni-zpravodajstvi' ) ) {
			$args_one_video_or_post = array(
				"post_type"      => array( "chi_video", "post" ),
				"posts_per_page" => 1,
				"category_name"  => "kardiovaskularni-zpravodajstvi",
				"post_status"    => "publish",
				'fields'         => 'ids'
			);

			$first_video_or_post_or_post = new  WP_Query( $args_one_video_or_post );

			$post = $first_video_or_post_or_post->posts;

			$query->set( 'post__not_in', $post );

			if ( strpos( $_SERVER['REQUEST_URI'], "?clanky-a-reportaze&page=1" ) or strpos( $_SERVER['REQUEST_URI'],
					"?clanky-a-reportaze" ) ) {
				$query->set( 'post__not_in', '' );

			}
			if ( isset( $_GET["page"] ) ) {
				$page = $_GET["page"];
				$page = ( ( $page - 1 ) * get_option( "posts_per_page" ) );
				$query->set( 'offset', $page );
			}

			return;
		}


		if ( $query->is_main_query() && $query->is_category() && $query->is_archive() ) {
			$category       = get_queried_object();
			$cat_id         = $category->term_id;
			$option         = get_term_meta( $cat_id, "_chi_selected_one_options", true );
			$text           = array();
			$posts_per_page = get_option( "posts_per_page" );

			if ( is_array( explode( "/", $_SERVER['REQUEST_URI'] ) ) ) {
				$text = array_filter( explode( "/", $_SERVER['REQUEST_URI'] ) );
			}


			if ( ! $option ) {
				return;
			}

			switch ( $option ) {
				case 1:
					$data = get_number_of_posts( 2, $cat_id, "post" );
					$query->set( 'post__not_in', $data['posts_id'] );

					if ( isset( $_GET["page"] ) ) {
						$page = $_GET["page"];
						$page = ( ( $page - 1 ) * $posts_per_page );
						$query->set( 'offset', $page );
					}

					if ( in_array( "?clanky-a-reportaze", $text ) or preg_grep( '/clanky-a-reportaze&page=\d/',
							$text ) ) {
						$query->set( 'post__not_in', '' );
					}
					break;
				case 2:
					$data = get_number_of_posts( 3, $cat_id, [ "chi_video", "post" ] );
					$query->set( 'post__not_in', $data['posts_id'] );

					if ( isset( $_GET["page"] ) ) {
						$page = $_GET["page"];
						$page = ( ( $page - 1 ) * $posts_per_page );
						$query->set( 'offset', $page );
					}

					if ( in_array( "video", $text ) ) {
						$query->set( 'post__not_in', '' );
						if ( isset( $_GET["page"] ) ) {
							$page = $_GET["page"];
							$page = ( ( $page - 1 ) * $posts_per_page );
							$query->set( 'offset', $page );
						}
						break;
					}

					if ( in_array( "?clanky-a-reportaze", $text ) or preg_grep( '/clanky-a-reportaze&page=\d/',
							$text ) ) {
						$query->set( 'post__not_in', '' );
					}
					break;
				case 3:
					$exclude = get_term_meta( $cat_id, 'chi_selected_in_claim_posts', true );
					$query->set( 'post__not_in', $exclude );

					if ( isset( $_GET["page"] ) ) {
						$page = $_GET["page"];
						$page = ( ( $page - 1 ) * $posts_per_page );
						$query->set( 'offset', $page );
					}


					if ( in_array( "video", $text ) ) {
						$query->set( 'post__not_in', '' );
						if ( isset( $_GET["page"] ) ) {
							$page = $_GET["page"];
							$page = ( ( $page - 1 ) * $posts_per_page );
							$query->set( 'offset', $page );
						}
						break;
					}

					if ( in_array( "?clanky-a-reportaze", $text ) or preg_grep( '/clanky-a-reportaze&page=\d/',
							$text ) ) {
						$query->set( 'post__not_in', '' );
					}
					break;
			}
		}
		//if ( $query->is_main_query() && $query->is_category() && $query->is_archive() ) {
		//	$text = array( "empty" );
		//
		//	if ( is_array( explode( "/", $_SERVER['REQUEST_URI'] ) ) ) {
		//		$text = array_filter( explode( "/", $_SERVER['REQUEST_URI'] ) );
		//	}
		//
		//	// Manipulate $query here, for instance like so
		//	if ( isset( $_GET["page"] ) ) {
		//		$page = $_GET["page"];
		//
		//		if ( in_array( "video", $text ) ) {
		//			$page = ( ( $page - 1 ) * get_option( "posts_per_page" ) );
		//			$query->set( 'offset', $page );
		//
		//			return;
		//		}
		//
		//		if ( $page == 1 ) {
		//			if ( strpos( $_SERVER['REQUEST_URI'], "?clanky-a-reportaze&page=1" ) ) {
		//
		//				$page = 0;
		//			} elseif ( $cat_id ) {
		//
		//				$data = get_number_of_posts( 3, $cat_id, [ "chi_video", "post" ] );
		//				if ( $option == 1 ) {
		//					$data = get_number_of_posts( 2, $cat_id, "post" );
		//				}
		//				$page = 0;
		//				$query->set( 'post__not_in', $data['posts_id'] );
		//			} else {
		//				$page = 2;
		//
		//			}
		//
		//		} else {
		//
		//			$data = get_number_of_posts( 3, $cat_id, [ "chi_video", "post" ] );
		//			if ( $option == 3 ) {
		//				$data['posts_id'] = get_term_meta( $cat_id, 'chi_selected_in_claim_posts', true );
		//				if ( strpos( $_SERVER['REQUEST_URI'], '?clanky-a-reportaze&page=', 0 ) ) {
		//					$data['posts_id'] = '';
		//				}
		//			}
		//			$page     = ( ( $page - 1 ) * get_option( "posts_per_page" ) );
		//			$variable = strpos( substr( $_SERVER['REQUEST_URI'], 0, strpos( $_SERVER['REQUEST_URI'], "&" ) ),
		//				"?clanky-a-reportaze" );
		//
		//			if ( $variable ) {
		//				$page = $page - $data['posts_number'];
		//				if ( $option == 3 ) {
		//					$page = $page + $data['posts_number'];
		//				}
		//			}
		//
		//			$query->set( 'post__not_in', $data['posts_id'] );
		//		}
		//
		//		$query->set( 'offset', $page );
		//	} else if ( strpos( $_SERVER['REQUEST_URI'], "?clanky-a-reportaze" ) or in_array( "video",
		//			$text ) or strpos( substr( $_SERVER['REQUEST_URI'], 0, strpos( $_SERVER['REQUEST_URI'], "&" ) ),
		//			"?clanky-a-reportaze" ) ) {
		//
		//		$query->set( 'offset', 0 );
		//
		//	} else if ( get_term_meta( $cat_id, "_chi_selected_one_options", true ) == 1 ) {
		//
		//		$data = get_number_of_posts( 2, $cat_id, [ "post" ] );
		//
		//		$query->set( 'post__not_in', $data['posts_id'] );
		//
		//	} else if ( get_term_meta( $cat_id, "_chi_selected_one_options", true ) == 2 ) {
		//
		//		$args_three_latest_post_and_videos = array(
		//			"post_type"      => array( "chi_video", "post" ),
		//			"posts_per_page" => 3,
		//			"category_name"  => $query->query["category_name"],
		//			"post_status"    => "publish"
		//		);
		//
		//		$posts_and_videos     = new  WP_Query( $args_three_latest_post_and_videos );
		//		$ids_not_in_main_loop = wp_list_pluck( $posts_and_videos->posts, 'ID' );
		//
		//
		//		$query->set( 'post__not_in', $ids_not_in_main_loop );
		//	} else if ( get_term_meta( $cat_id, "_chi_selected_one_options", true ) == 3 ) {
		//
		//		$exclude = get_term_meta( $cat_id, 'chi_selected_in_claim_posts', true );
		//
		//		$query->set( 'post__not_in', $exclude );
		//
		//	} else {
		//
		//		$query->set( 'offset', $offset );
		//	}
		//
		//}
	}

}

add_action( 'pre_get_posts', "chi_category_main_query_offset" );
add_action( 'pre_get_posts', "chi_tag_add_post_type" );
add_action( 'pre_get_posts', "chi_category_add_post_type", 20, 2 );

function chi_tag_add_post_type( $query ) {
	if ( $query->is_main_query() ) {
		if ( $query->is_tag() ) {
			$query->set( 'post_type', array( "post", "chi_video" ) );
		}
	}
}

function chi_category_add_post_type( $query, $offset = 0 ) {

	if ( ! is_admin() ) {

		if ( $query->is_main_query() && $query->is_category() && $query->is_archive() ) {

			$category    = get_queried_object();
			$category_ID = $category->term_id;
			$args_video  = array(
				'post_type'   => array( 'chi_video' ),
				'numberposts' => - 1,
				'cat'         => "$category_ID"
			);

			$args_post = array(
				'post_type'   => array( 'post' ),
				'numberposts' => - 1,
				'cat'         => "$category_ID"
			);

//				( $query->tax_query->queried_terms["category"]["terms"][0] == "cardionews" ) ||
			if ( ( ( count( get_posts( $args_video ) ) + count( get_posts( $args_post ) ) ) < 4 ) || ( count( get_posts( $args_post ) ) < 4 ) ) {

				$query->set( 'offset', 0 );
				$query->set( 'post_type', array( 'post', 'chi_video' ) );
				$query->set( 'post__not_in', "" );
			}
		}
	}
}

// category (can be a parent category)
function count_cat_post( $category ) {
	if ( is_string( $category ) ) {
		$catID = get_cat_ID( $category );
	} elseif ( is_numeric( $category ) ) {
		$catID = $category;
	} else {
		return 0;
	}
	$cat = get_category( $catID );

	return $cat;
}


function is_active_them_starter() {
	global $is_active_them_starter;

	if ( $is_active_them_starter ) {
		return true;
	} else {
		return false;
	}

}

function is_template_part( $template_file ) {
	global $wp_template_part;

	return $template_file === $wp_template_part;
}

add_action( 'wp_loaded', 'is_active_them_starter' );


/**
 * Pagination
 */

function get_pagination_links() {
	global $wp_query;


	if ( isset( $_GET["page"] ) ) {
		$wp_query->query_vars['page'] > 1 ? $current = $wp_query->query_vars['page'] : $current = 1;
	} else {
		$current = 1;
	}

	return paginate_links( array(
		'base'               => @add_query_arg( 'page', '%#%#ostatni-clanky' ),
		'format'             => '?page=%#%#ostatni-clanky',
		'current'            => $current,
		'total'              => $wp_query->max_num_pages,
		'prev_next'          => true,
		'before_page_number' => '<span class="chi-page-link">',
		'after_page_number'  => '</span>',
		'prev_text'          => '',
		'next_text'          => '<i class="chi-next-button"></i>'
	) );
}


function filter_post_type_link( $link, $post ) {
	if ( $post->post_type != 'chi_video' ) {
		return $link;
	}

	if ( $cats = get_the_terms( $post->ID, 'category' ) ) {
		$link = str_replace( '%category%', array_pop( $cats )->slug, $link );
	}

	return $link;
}

add_filter( 'post_type_link', 'filter_post_type_link', 10, 2 );


add_action( 'pre_get_posts', function ( $query ) {
	if ( ! is_admin() && $query->is_main_query() ) {

		//var_dump( array_filter(explode("/", $_SERVER['REQUEST_URI']))[1] );
		$text = array( "empty" );
		if ( is_array( explode( "/", $_SERVER['REQUEST_URI'] ) ) ) {
			$text = array_filter( explode( "/", $_SERVER['REQUEST_URI'] ) );
			//var_dump(array_filter(explode("/", $_SERVER['REQUEST_URI']))[1]);
		}

		if ( in_array( "video", $text ) ) {
			if ( is_archive() || is_category() ) {
				$query->set( 'post_type', 'chi_video' );
				/*$query->set( 'offset', 0 );*/
				if ( strpos( $_SERVER['REQUEST_URI'], "?clanky-a-reportaze" ) ) {
					$query->set( 'post_type', 'post' );
				}
			}
		}
	}
} );


function get_url_var( $name ) {
	$strURL  = $_SERVER['REQUEST_URI'];
	$arrVals = explode( "/", $strURL );
	$found   = 0;
	foreach ( $arrVals as $index => $value ) {
		if ( $value == $name ) {
			$found = $index;
		}
	}
	$place = $found + 1;

	return $arrVals[ $place ];
}


/* CATEGORY CHANGE CHECKBOX to RADIOBOX */
function admin_js() { ?>
	<script type="text/javascript">

		jQuery(document).ready(function () {
			jQuery('form#post').find('.categorychecklist input').each(function () {
				var new_input = jQuery('<input type="radio" />'),
					attrLen = this.attributes.length;

				for (i = 0; i < attrLen; i++) {
					if (this.attributes[i].name != 'type') {
						new_input.attr(this.attributes[i].name.toLowerCase(), this.attributes[i].value);
					}
				}

				jQuery(this).replaceWith(new_input);
			});
		});

	</script>
<?php }

add_action( 'admin_head', 'admin_js' );


function has_title_meta_box( $meta_box ) {
	if ( isset( $meta_box ) && ! empty( $meta_box ) ) {
		return $meta_box . " – ";
	}

	return "";
}


function chi_claims() {

	$category = get_the_category()[0]->slug;


	$args_one_video       = array(
		"post_type"      => array( "chi_video", "post" ),
		"posts_per_page" => 1,
		"category_name"  => $category,
		"post_status"    => "publish"
	);
	$first_video          = new  WP_Query( $args_one_video );
	$ids_not_in_main_loop = wp_list_pluck( $first_video->posts, 'ID' );

	$args_two_posts = array(
		"post_type"      => array( "post", "chi_video" ),
		"posts_per_page" => 2,
		"category_name"  => $category,
		"post__not_in"   => [ $ids_not_in_main_loop[0] ]
	);

	$category_posts         = new WP_Query( $args_two_posts );
	$ids_not_in_main_loop   = wp_list_pluck( $first_video->posts, 'ID' );
	$ids_not_in_main_loop[] = wp_list_pluck( $category_posts->posts, 'ID' );
	$ids_not_in_main_loop   = array_merge( $ids_not_in_main_loop, $ids_not_in_main_loop[1] );
	unset( $ids_not_in_main_loop[1] );

	$ids_not_in_main_loop = array_values( $ids_not_in_main_loop );

	return $ids_not_in_main_loop;

}


add_filter( 'body_class', function ( $classes ) {
	if ( is_single() || is_category() ) {
		global $post;

		foreach ( ( get_the_category( $post->ID ) ) as $category ) {
			$classes[] = 'special-' . $category->slug;
		}
	}

	return $classes;
} );


// Custom single template by category
// https://halgatewood.com/wordpress-custom-single-templates-by-category
// For single posts
add_filter( 'single_template', 'chi_check_for_category_single_template' );
function chi_check_for_category_single_template( $t ) {
	foreach ( (array) get_the_category() as $cat ) {
		if ( is_singular( "chi_video" ) ) {
			foreach ( (array) get_the_category() as $cat ) {
				if ( file_exists( STYLESHEETPATH . "/single-chi_video-category-{$cat->slug}.php" ) ) {
					return STYLESHEETPATH . "/single-chi_video-category-{$cat->slug}.php";
				}
				if ( $cat->parent ) {
					$cat = get_the_category_by_ID( $cat->parent );
					if ( file_exists( STYLESHEETPATH . "/single-chi_video-category-{$cat->slug}.php" ) ) {
						return STYLESHEETPATH . "/single-chi_video-category-{$cat->slug}.php";
					}
				}
			}

			return $t;
		}

		if ( file_exists( STYLESHEETPATH . "/single-category-{$cat->slug}.php" ) ) {
			return STYLESHEETPATH . "/single-category-{$cat->slug}.php";
		}
		if ( $cat->parent ) {
			$cat = get_the_category_by_ID( $cat->parent );
			if ( file_exists( STYLESHEETPATH . "/single-category-{$cat->slug}.php" ) ) {
				return STYLESHEETPATH . "/single-category-{$cat->slug}.php";
			}
		}
	}

	return $t;
}


// https://markjaquith.wordpress.com/2014/02/19/template_redirect-is-not-for-loading-templates/
function kardiovaskularni_zpravodajstvi_template_file( $template ) {

	if ( is_tax() ) {

		$term = get_term_by( 'slug', get_query_var( 'term' ), get_query_var( 'taxonomy' ) );

		$kardiovaskularni_zpravodajstvi_ID = 50;   // Taxnomie ID for "kardiovaskularni-zpravodajstvi"
		if ( $term->parent ) {
			if ( $term->parent == $kardiovaskularni_zpravodajstvi_ID ) {
				$new_template = locate_template( array( 'taxonomy-congress-kardiovaskularni-zpravodajstvi.php' ) );
				if ( '' != $new_template ) {
					return $new_template;
				}
			}
		}
	}

	return $template;
}

add_filter( 'template_include', 'kardiovaskularni_zpravodajstvi_template_file', 99 );


// slow function!!!
//	add_action( 'wp_head', 'chi_view_posts' );

function chi_view_posts() {

	/// !!!! Function segment Is not add in wp theme !!!!
	$catinfo = get_category_by_slug( segment( 3 ) );

	if ( 1 == 1 ) {
//			$cat_id  = $catinfo->term_id;

		if ( isset( $_GET["key"] ) ) {
			if ( $_GET['key'] == 'private_preview' ) {
				$args = array(
					'posts_per_page' => - 1,
					'post_type'      => array( 'post', 'chi_video' ),
					'post_status'    => array( 'draft' ),
					'category_name'  => segment( 6 ),
					'fields'         => 'ids'
				);

				$posts = new WP_Query( $args );

				if ( ! empty( $posts->posts ) ) {
					update_option( 'special_urologum', $posts->posts );
					$temperary_published = get_option( 'special_urologum' );

					if ( ! empty( $temperary_published ) ) {
						foreach ( $temperary_published as $post_id ) {
							$data = array(
								'ID'          => $post_id,
								'post_status' => 'publish',
							);
							wp_update_post( $data );
							flush_rewrite_rules();
						}
					}
				}
			}
		} else {
			if ( $temperary_published = get_option( 'special_urologum' ) ) {
				foreach ( $temperary_published as $post_id ) {
					$data = array(
						'ID'          => $post_id,
						'post_status' => 'draft',
					);
					wp_update_post( $data );
					delete_option( 'special_urologum' );
					flush_rewrite_rules();
				}
			}
		}
	}
}

// https://www.webhostinghero.com/how-to-share-a-draft-page-in-wordpress/?fbclid=IwAR1hn_xdoMmt80d8LHgGbqFtHUMMnQd_GKG94KW_MaAPpyoUb5tdobbYA5w
// https://designwithvalerie.com/share-draft-post-in-wordpress/
add_filter( 'posts_results', 'chi_set_query_to_draft', null, 2 );
function chi_set_query_to_draft( $posts, $query ) {

	if ( ! is_single() ) {
		return $posts;
	}
	if ( sizeof( $posts ) != 1 ) {
		return $posts;
	}

	$post_status_obj = get_post_status_object( get_post_status( $posts[0] ) );

	if ( ! $post_status_obj->name == 'draft' ) {
		return $posts;
	}

	if ( isset( $_GET["key"] ) ) {
		if ( $_GET['key'] != 'private_preview' ) {
			return $posts;
		}
	}

	if ( ! isset( $_GET['key'] ) ) {
		return $posts;
	}


	$query->_draft_post = $posts;

	add_filter( 'the_posts', 'show_draft_post', null, 2 );
}

function show_draft_post( $posts, $query ) {
	remove_filter( 'the_posts', 'show_draft_post', null, 2 );

	return $query->_draft_post;
}

add_filter( "preview_post_link", "sctick_a_preview_link_key", 10 );


function sctick_a_preview_link_key( $preview_link ) {
	$preview_link = $preview_link . "&key=private_preview";

	return $preview_link;
}


// Add a <sup> and <sub> index to TinyMC
// from: https://wptavern.com/how-to-add-subscript-and-superscript-characters-in-wordpress
function chi_mce_buttons_2( $buttons ) {
	/**
	 * Add in a core button that's disabled by defaultmce_buttons_2
	 *
	 */
	$buttons[] = 'Special character';
	$buttons[] = 'superscript';
	$buttons[] = 'subscript';


	return $buttons;


}


function chi_mce_buttons( $buttons ) {
	$buttons = "count";

	return $buttons;
}


add_filter( 'mce_buttons_2', 'chi_mce_buttons_2' );


function lt_html_excerpt( $text ) { // Fakes an excerpt if needed
	global $post;
	if ( '' == $text ) {
		$text = get_the_content( '' );
		$text = apply_filters( 'the_content', $text );
		$text = str_replace( '\]\]\>', ']]&gt;', $text );
		/*just add all the tags you want to appear in the excerpt --
		be sure there are no white spaces in the string of allowed tags */
		$text = strip_tags( $text, '<p><br><b><a><em>' );
		/* you can also change the length of the excerpt here, if you want */
		$excerpt_length = 15;
		$words          = explode( ' ', $text, $excerpt_length + 1 );
		if ( count( $words ) > $excerpt_length ) {
			array_pop( $words );
			array_push( $words, '[...]' );
			$text = implode( ' ', $words );
		}

		$text = closetags( $text );
	}

	return $text;
}


function my_register_tinymce_button( $buttons ) {
	array_push( $buttons, "chi_stats", "button_green" );

	return $buttons;
}

function my_add_tinymce_button( $plugin_array ) {
	$plugin_array['my_button_script'] = THEME_DIRECTORY_URI . '/mybuttons.js';

	return $plugin_array;
}


add_action( 'admin_print_footer_scripts', 'check_textarea_length' );
function check_textarea_length() { ?>

	<script type="text/javascript">
		// jQuery ready fires too early, use window.onload instead

		window.onload = function () {


			// are we using visual editor?
			var visual = (typeof tinyMCE != "undefined") && tinyMCE.activeEditor && !tinyMCE.activeEditor.isHidden() ? true : false;

			if (visual) {
				title_content = $("#title").val().replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').length;
				editor_content = tinymce.get("content").getContent().replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').length;
				html_excerpt = tinymce.get("htmlExcerpt").getContent().replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').length;
				sum = title_content + editor_content + html_excerpt;


				jQuery('.mce-statusbar .mce-container-body')
					.append('<span class="word-count-message">' +
						'titulek: ' + title_content + ' perex: ' + html_excerpt + ' hlavní obsah: ' + editor_content + ' SUM(' + sum + ')' +
						'</span>');

				$("#title").on("keyup", function () {

					title_content = $("#title").val().replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').length;
					editor_content = tinymce.get("content").getContent().replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').length;
					html_excerpt = tinymce.get("htmlExcerpt").getContent().replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').length;
					sum = title_content + editor_content + html_excerpt;

					jQuery('.word-count-message').remove();
					jQuery('.mce-statusbar .mce-container-body')
						.append('<span class="word-count-message">' +
							'titulek: ' + title_content + ' perex: ' + html_excerpt + ' hlavní obsah: ' + editor_content + ' SUM(' + sum + ')' +
							'</span>');

				});

				tinyMCEExcerpt = tinymce.get("htmlExcerpt");
				tinyMCEExcerpt.on('keyup', function (ed, e) {

					title_content = $("#title").val().replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').length;
					editor_content = tinymce.get("content").getContent().replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').length;
					html_excerpt = tinymce.get("htmlExcerpt").getContent().replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').length;
					sum = title_content + editor_content + html_excerpt;

					jQuery('.word-count-message').remove();
					jQuery('.mce-statusbar .mce-container-body')
						.append('<span class="word-count-message">' +
							'titulek: ' + title_content + ' perex: ' + html_excerpt + ' hlavní obsah: ' + editor_content + ' SUM(' + sum + ')' +
							'</span>');
				});

				tinyMCE.activeEditor.on('keyup', function (ed, e) {

					title_content = $("#title").val().replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').length;
					editor_content = tinymce.get("content").getContent().replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').length;
					html_excerpt = tinymce.get("htmlExcerpt").getContent().replace(/(<([^>]+)>)/ig, '').replace(/&nbsp;/g, '').length;
					sum = title_content + editor_content + html_excerpt;

					jQuery('.word-count-message').remove();
					jQuery('.mce-statusbar .mce-container-body')
						.append('<span class="word-count-message">' +
							'titulek: ' + title_content + ' perex: ' + html_excerpt + ' hlavní obsah: ' + editor_content + ' SUM(' + sum + ')' +
							'</span>');

				});
			}

		}
	</script>
	<style type="text/css">
		.wp_themeSkin .word-count-message {
			font-size: 0.7em;
			display: none;
			float: right;
			color: #fff;
			font-weight: bold;
			margin-top: 2px;
		}

		.wp_themeSkin .toomanychars .mce-statusbar {
			background: red;
		}

		.wp_themeSkin .toomanychars .word-count-message {
			display: block;
		}

	</style>
	<script>
		var clipboard = new ClipboardJS('#copy-url-button', {
			target: function () {
				return document.querySelector('a[data-clipboard-text]');
			}
		});
		var clipboardView = new ClipboardJS('#copy-url-button-view', {
			target: function () {
				return document.querySelector('a[data-clipboard-text]');
			}
		});
		clipboard.on('success', function (e) {
			console.log(e);
		});

		clipboard.on('error', function (e) {
			console.log(e);
		});

		clipboardView.on('success', function (e) {
			console.log(e);
		});

		clipboardView.clipboard.on('error', function (e) {
			console.log(e);
		});

	</script>
	<?php

}


add_filter( 'get_sample_permalink_html', 'add_copyurl_to_clipboard' );
add_action( 'admin_init', 'copy_to_clipboard_init' );
add_action( 'admin_enqueue_scripts', 'add_clipboard_path' );

function copy_to_clipboard_init() {
	/* Register our script. */
	wp_register_script( 'zero-clipboard', THEME_DIRECTORY_URI . '/js/ZeroClipboard.min.js' );
	wp_register_script( 'zero-clipboard-main', THEME_DIRECTORY_URI . '/js/main.js' );
	wp_enqueue_script( 'zero-clipboard' );
	wp_enqueue_script( 'zero-clipboard-main', 'jquery' );

}

function add_clipboard_path() {
	wp_localize_script( 'zero-clipboard-main', 'ZeroClipboardSettings',
		array( 'path' => THEME_DIRECTORY_URI . '/js/clipboard.min.js', ) );
}

function add_copyurl_to_clipboard( $return ) {
	global $post;
	if ( get_post_status( $post ) == "publish" ) {
		$return .= sprintf( "<span id='copy-url-btn'><a href='#' id=\"copy-url-button\" data-clipboard-text='%s' class='button button-small'>Kopírovat odkaz</a></span> ",
			get_permalink( $post->ID ) );
	}
	$return .= sprintf( "<span id='copy-url-btn-view'><a href='#' id=\"copy-url-button-view\" data-clipboard-text='%s' class='button button-small'>Kopírovat náhledový odkaz</a></span> ",
		get_site_url( "", "",
			"https" ) . "/?post_type=" . get_post_type( $post->ID ) . "&p=$post->ID&preview=true&key=private_preview" );

	return $return;
}


add_filter( 'tiny_mce_before_init', 'tinymce_add_chars' );
function tinymce_add_chars( $settings ) {
	$new_chars                  = json_encode( array(
		array( '37;', '%' ),
		array( '8224', 'Dagger' ),
		array( '8230', 'Horizontal ellipsis' ),
		array( '8539', '1/8 Fraction' ),
		array( '8730', 'Square Root' ),
		array( '8818', 'Less than or equivalent to' ),
		array( '8819', 'Greater than or equivalent to' ),
		array( '0963', 'Sigma' ),
		array( '0956', 'Mu' ),
	) );
	$settings['charmap_append'] = $new_chars;

	return $settings;
}

function chi_post_types_admin_order( $wp_query ) {
	if ( is_admin() ) {
		// Get the post type from the query
		$post_type = $wp_query->query['post_type'];

		if ( $post_type == 'chi_video' && empty( $_GET['orderby'] ) ) {

			$wp_query->set( 'orderby', 'date' );

			$wp_query->set( 'order', 'DESC' );
		}

		if ( $post_type == 'chi_inzerce' && empty( $_GET['orderby'] ) ) {

			$wp_query->set( 'orderby', 'title' );

			$wp_query->set( 'order', 'ASC' );
		}
	}
}

add_filter( 'pre_get_posts', 'chi_post_types_admin_order' );


function is_automat_nbsp_active() {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	if ( is_plugin_active( 'automat-nbsp/automat-nbsp.php' ) ) {
		return 1;
	}

	return 0;

}

function get_number_of_posts( $per_page = 3, $cat_id = null, $post_type = array() ) {

	if ( $cat_id ) {
		$args = array(
			"post_type"      => $post_type,
			"posts_per_page" => $per_page,
			"cat"            => $cat_id,
			"post_status"    => "publish"
		);

		$data                 = array();
		$data['posts_number'] = 0;
		$posts                = new WP_Query( $args );
		// The Loop
		if ( $posts->have_posts() ) :
			while ( $posts->have_posts() ) : $posts->the_post();
				// Do Stuff
				if ( get_post_type( get_the_ID() ) == "post" ) {
					$data['posts_number'] ++;
					$data['posts_id'][] = get_the_ID();
				}

			endwhile;
		endif;

		// Reset Post Data
		wp_reset_postdata();

		return $data;
	}

	return - 1;

}

function page_option( $needle, $string, $page, $query ) {
	if ( in_array( $needle, $string ) ) {
		$page = ( ( $page - 1 ) * get_option( "posts_per_page" ) );
		$query->set( 'offset', $page );

		return 1;
	}

	return - 1;
}

add_filter( 'template_include', 'chi_single_post_templates' );
function chi_single_post_templates( $template ) {
	$post_types = array( 'post' );
	$post_id    = get_the_ID();
	$post = get_post($post_id);
	$slug = $post->post_name;

	if ( is_singular( $post_types ) ) {
		if ( $slug == 'czech-unbranded-risk-calculator' ) {
			$template = get_template_directory() . '/single-czech-unbranded-risk-calculator.php';
		}
	}

	return $template;
}