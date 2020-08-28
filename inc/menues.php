<?php

function wpb_custom_new_menu() {
    register_nav_menus(
        array(
            'my-custom-menu' => __( 'Menu pro kongresonline' ),
            'extra-menu' => __( 'Menu pro speciály' )
        )
    );
}
add_action( 'init', 'wpb_custom_new_menu' );