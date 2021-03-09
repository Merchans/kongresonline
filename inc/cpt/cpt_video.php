<?php
/**
 * REGISTER CUSTOM POST TYPES VIDEOS
 *
 **/
function chi_videos_custom_post_type()
{
    $labels = array(
        'name'               => _x( 'Videa', 'post type general name', 'chi-templates' ),
        'singular_name'      => _x( 'Video', 'post type singular name', 'chi-templates' ),
        'menu_name'          => _x( 'Videa', 'admin menu', 'chi-templates' ),
        'name_admin_bar'     => _x( 'Video', 'add new on admin bar', 'chi-templates' ),
        'add_new'            => _x( 'Přidat nové', 'video', 'chi-templates' ),
        'add_new_item'       => __( 'Vytvořit video', 'chi-templates' ),
        'new_item'           => __( 'Nové video', 'chi-templates' ),
        'edit_item'          => __( 'Upravit video', 'chi-templates' ),
        'view_item'          => __( 'Podívejte se na video', 'chi-templates' ),
        'all_items'          => __( 'Všechna videa', 'chi-templates' ),
        'search_items'       => __( 'Hledat videa', 'chi-templates' ),
        'parent_item_colon'  => __( 'Rodičovská videa:', 'chi-templates' ),
        'not_found'          => __( 'Nebyla nalezena žádná videa.', 'chi-templates' ),
        'not_found_in_trash' => __( 'V koši nebyla nalezena žádná videa.', 'chi-templates' )
    );

    $args = array(
        'labels'             => $labels,
        'description'        => __( 'Description.', 'chi-templates' ),
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'nav_menu_item'      => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'video/%category%'),
        'capability_type'    => 'post',
        'has_archive'        => 'video',
        'hierarchical'       => true,
        'menu_position'      => 2,
        'menu_icon'          => 'dashicons-video-alt3',
        'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'revisions', ),
        'taxonomies'          => array( 'category', 'post_tag', 'chi_create_tax' ),
    );

    register_post_type( 'chi_video', $args );

}
add_action('init', 'chi_videos_custom_post_type');


	/*
	 * REGISTER TAXONIMY "kongres"
	 * */
	add_action( 'init', 'chi_create_tax' );
	function chi_create_tax() {
		register_taxonomy('congress', array('post', 'chi_video'),
			array(
				'hierarchical'  => true,
				'label'         => __( 'Kongresy', 'chi-templates' ),
				'singular_name' => __( 'Kongres', 'chi-templates' ),
				'rewrite'       => true,
				'query_var'     => true
			)
		);
	}

