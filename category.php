<?php

//	define( 'GLOBAL_SETTINGS', array(
//		'CATEGORY_ID' => get_queried_object()->term_id,
//
//		'ARGS_VIDEOS' => array(
//			'post_type'   => 'chi_video',
//			'numberposts' => - 1,
//			'cat'         => get_queried_object()->term_id
//		),
//		'ARGS_POSTS'  => array(
//			'post_type'   => 'post',
//			'numberposts' => - 1,
//			'cat'         => get_queried_object()->term_id
//		),
//	) );
//
//	define( 'COUNT_POSTS', count( get_posts( GLOBAL_SETTINGS['ARGS_POSTS'] ) ) );
//	define( 'COUNT_VIDEOS', count( get_posts( GLOBAL_SETTINGS['ARGS_VIDEOS'] ) ) );


	$GLOBALS["not_in_main_loop"] = array();
	$category                    = get_queried_object();
//	$category                    = get_the_category();
	$category_ID = $category->term_id;
	$option      = ( get_term_meta( $category_ID, '_chi_selected_one_options' )[0] );

	$args_video = array(
		'post_type'   => array( 'chi_video' ),
		'numberposts' => - 1,
		'cat'         => "$category_ID"
	);

	$args_post = array(
		'post_type'   => array( 'post' ),
		'numberposts' => - 1,
		'cat'         => "$category_ID"
	);


	if ( ( count( get_posts( $args_video ) ) + count( get_posts( $args_post ) ) ) < 4 || count( get_posts( $args_post ) ) < 4 ) {
		$option = 0;
	}


	switch ( $option ) {
		case 0:
			// one video two posts
			$GLOBALS["chi_option"] = 0;
			get_template_part( "assets/claims/option-starter" );
			die();
		case 1:
			// one video two posts
			$GLOBALS["chi_option"] = 1;
			get_template_part( "assets/claims/option-default" );
			die();
			break;
		case 3:
			// your choice
			$GLOBALS["chi_option"] = 3;
			get_template_part( "assets/claims/option-3" );
			die();
			break;
		default;
			// the newest posts
			$GLOBALS["chi_option"] = 2;
			get_template_part( "assets/claims/option-2" );
			die();
			break;
	}
