<?php
/*
* WP AMIN ORDER MENU
*/

function chi_cuctome_menu_order( $menu_ord ) {
    if ( !$menu_ord ) return true;

    return array(
        'index.php', // Dashboar
        'separator1', // First separatord
        'edit.php', // Posts
        'edit.php?post_type=chi_video', // Videos
        'edit.php?post_type=page', // Pages
        'edit.php?post_type=chi_inzerce',
        /* 'edit-comments.php', // Comments*/
        'upload.php', // Media
        'link-manager.php', // Links
        'separator2', // Second separator
        'themes.php', // Appearance
        'plugins.php', // Plugins
        'users.php', // Users
        'tools.php', // Tools
        'options-general.php', // Settings
        'separator-last', // Last separator
    );
}
add_filter( 'custom_menu_order', 'chi_cuctome_menu_order', 10, 1 );
add_filter( 'menu_order', 'chi_cuctome_menu_order', 10, 1 );
