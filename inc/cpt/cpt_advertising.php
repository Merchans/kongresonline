<?php

add_action('init', 'chi_advertising_post_type');
function chi_advertising_post_type()
{
    $labels = array(
        'name'                  => _x('Inzerce', 'Post type general name', 'chi-templates'),
        'singular_name'         => _x('Inzerce', 'Post type singular name', 'chi-templates'),
        'menu_name'             => _x('Inzerce', 'Admin Menu text', 'chi-templates'),
        'name_admin_bar'        => _x('Inzerce', 'Add New on Toolbar', 'chi-templates'),
        'add_new'               => __('Vytvořit inzerci', 'chi-templates'),
        'add_new_item'          => __('Přidat novou inzerci', 'chi-templates'),
        'new_item'              => __('Přidat inzerci', 'chi-templates'),
        'edit_item'             => __('Upravit inzerát', 'chi-templates'),
        'view_item'             => __('Zobrazit inzerci', 'chi-templates'),
        'all_items'             => __('Zobrazit  ', 'chi-templates'),
        'search_items'          => __('Hledat inzerci', 'chi-templates'),
        'parent_item_colon'     => __('Rodičovská reklama:', 'chi-templates'),
        'not_found'             => __('Nebyla nalezena žádná reklama.', 'chi-templates'),
        'not_found_in_trash'    => __('V koši nebyl nalezen žádný inzerát.', 'chi-templates'),
        'featured_image'        => _x('Inzerce poster',
            'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'chi-templates'),
        'set_featured_image'    => _x('Set Inzerce poster',
            'Overrides the “Set featured image” phrase for this post type. Added in 4.3',
            'chi-templates'),
        'remove_featured_image' => _x('Remove Inzerce poster',
            'Overrides the “Remove featured image” phrase for this post type. Added in 4.3',
            'chi-templates'),
        'use_featured_image'    => _x('Use as Inzerce poster',
            'Overrides the “Use as featured image” phrase for this post type. Added in 4.3',
            'chi-templates'),
        'archives'              => _x('Inzerce archives',
            'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4',
            'chi-templates'),
        'insert_into_item'      => _x('Insert into Inzerce',
            'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4',
            'chi-templates'),
        'uploaded_to_this_item' => _x('Uploaded to this Inzerce',
            'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4',
            'chi-templates'),
        'filter_items_list'     => _x('Filter Inzerce list',
            'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4',
            'chi-templates'),
        'items_list_navigation' => _x('Inzerce list navigation',
            'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4',
            'chi-templates'),
        'items_list'            => _x('Inzerce list',
            'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4',
            'chi-templates'),
    );

    $args = array(
        'labels'             => $labels,
        'exclude_from_search' => true,
        'public'             => false,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'inzerce'),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-megaphone',
        //'taxonomies'        =>  array( 'post_tag' ),
        'supports'           => array('title', 'editor'),
    );

    register_post_type('chi_inzerce', $args);
}
