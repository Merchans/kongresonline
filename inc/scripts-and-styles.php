<?php

function ticket_select_input( $hook )
{
    if ( "post.php" == $hook )
    {
        //css
        wp_enqueue_style("genre-style", THEME_DIRECTORY_URI ."/css/lou-multi-select/multi-select.css" );

        // js
        wp_enqueue_script("ticket-movies-jsapp", "https://cdn.3up.dk/jquery@3.3.1/dist/jquery.min.js" );
        wp_enqueue_script("ticket-lou-quicksearch", THEME_DIRECTORY_URI ."/js/lou-multi-select/quicksearch.js", array("jquery"), "", true );
        wp_enqueue_script("ticket-lou-multi-select", THEME_DIRECTORY_URI ."/js/lou-multi-select/multiple-select.js", array("jquery"), "", true );
        wp_enqueue_script("ticket-lou-multi-options", THEME_DIRECTORY_URI ."/js/lou-multi-select/multiple-select-otions.js", array("jquery"), "", true );


    }
}

add_action( 'admin_enqueue_scripts', "ticket_select_input" );

if ( is_admin("post-new.php") )
{
    //css
    wp_enqueue_style("genre-style", THEME_DIRECTORY_URI ."/css/lou-multi-select/multi-select.css" );
    wp_enqueue_style("chi-style-in-admin", THEME_DIRECTORY_URI ."/css/extra-class.css" );
    wp_enqueue_style("chi-select2-css", "https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" );

    // js
    wp_enqueue_script("ticket-movies-jsapp", "https://cdn.3up.dk/jquery@3.3.1/dist/jquery.min.js" );
    wp_enqueue_script("ticket-lou-quicksearch", THEME_DIRECTORY_URI ."/js/lou-multi-select/quicksearch.js", array("jquery"), "", true );
    wp_enqueue_script("ticket-lou-multi-select", THEME_DIRECTORY_URI ."/js/lou-multi-select/multiple-select.js", array("jquery"), "", true );
    wp_enqueue_script("ticket-lou-multi-options", THEME_DIRECTORY_URI ."/js/lou-multi-select/multiple-select-otions.js", array("jquery"), "", true );
    wp_enqueue_script("ticket-lou-multi-hide", THEME_DIRECTORY_URI ."/js/lou-multi-select/hide-elements.js", array("jquery"), "", true );
    wp_enqueue_script("chi-select2-jss", "https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" );
}

function add_chi_custom_css() {
wp_enqueue_style( 'custom-css_style', get_stylesheet_directory_uri() . '/custom-css.css' );
 }
 add_action( 'wp_enqueue_scripts', 'add_chi_custom_css' );

function chi_hook_for_google_analytics() {
    ?>
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-69849523-45"></script>
		<script>
		  window.dataLayer = window.dataLayer || [];
		  function gtag(){dataLayer.push(arguments);}
		  gtag('js', new Date());

		  gtag('config', 'UA-69849523-45');
		</script>
    <?php
}
add_action('wp_head', 'chi_hook_for_google_analytics');