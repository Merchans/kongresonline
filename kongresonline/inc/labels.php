<?php

// all information https://stackoverflow.com/questions/53664941/how-to-rename-already-registered-category
/*
 * Yes you can change the default category name to something else what ever you want.
 * First of all let's change the default label in the menu item in the WordPress admin.
 * You can copy this code into your functions.php file
*/

function revcon_change_cat_label() {
    global $submenu;
    $submenu['edit.php'][15][0] = 'Speciály'; // Rename categories to Speciály
}
add_action( 'admin_menu', 'revcon_change_cat_label' );

/*
 * This will change Category name label in Menu items.
 * Now, let’s update the other labels throughout the admin (meta boxes etc.),
 * you can paste this code directly below the code for renaming the menu label.
 */

function revcon_change_cat_object() {
    global $wp_taxonomies;
    $labels = &$wp_taxonomies['category']->labels;
    $labels->name = 'Speciály';
    $labels->singular_name = 'Speciály';
    $labels->add_new = 'Vytvořit Speciály';
    $labels->add_new_item = 'Vytvořit Speciál';
    $labels->edit_item = 'Upravit Speciál';
    $labels->new_item = 'Speciály';
    $labels->view_item = 'Zobrazit Speciál';
    $labels->search_items = 'Hledat Speciál';
    $labels->not_found = 'Nebyly nalezeny Speciály';
    $labels->not_found_in_trash = 'V koši sa nenašli žádne Speciály';
    $labels->all_items = 'Všechny Speciály';
    $labels->menu_name = 'Speciály';
    $labels->name_admin_bar = 'Speciály';
}
add_action( 'init', 'revcon_change_cat_object' );