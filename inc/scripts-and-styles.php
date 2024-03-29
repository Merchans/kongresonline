<?php

function ticket_select_input( $hook ) {
	if ( "post.php" == $hook ) {
		//css
		wp_enqueue_style( "genre-style", THEME_DIRECTORY_URI . "/css/lou-multi-select/multi-select.css" );

		// js
		wp_enqueue_script( "ticket-movies-jsapp", "https://cdn.3up.dk/jquery@3.3.1/dist/jquery.min.js" );
		wp_enqueue_script( "ticket-lou-quicksearch", THEME_DIRECTORY_URI . "/js/lou-multi-select/quicksearch.js",
			array( "jquery" ), "", true );
		wp_enqueue_script( "ticket-lou-multi-select", THEME_DIRECTORY_URI . "/js/lou-multi-select/multiple-select.js",
			array( "jquery" ), "", true );
		wp_enqueue_script( "ticket-lou-multi-options",
			THEME_DIRECTORY_URI . "/js/lou-multi-select/multiple-select-otions.js", array( "jquery" ), "", true );


	}

	if ( "toplevel_page_wpProQuiz" != $hook ) {
		if ( is_admin() ) {
			//css
			wp_enqueue_style( "genre-style", THEME_DIRECTORY_URI . "/css/lou-multi-select/multi-select.css" );
			wp_enqueue_style( "chi-style-in-admin", THEME_DIRECTORY_URI . "/css/extra-class.css" );
			wp_enqueue_style( "chi-select2-css",
				"https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" );

			// js
			wp_enqueue_script( "ticket-movies-jsapp", "https://cdn.3up.dk/jquery@3.3.1/dist/jquery.min.js" );
			wp_enqueue_script( "ticket-lou-quicksearch", THEME_DIRECTORY_URI . "/js/lou-multi-select/quicksearch.js",
				array( "jquery" ), "", true );
			wp_enqueue_script( "ticket-lou-multi-select",
				THEME_DIRECTORY_URI . "/js/lou-multi-select/multiple-select.js", array( "jquery" ), "", true );
			wp_enqueue_script( "ticket-lou-multi-options",
				THEME_DIRECTORY_URI . "/js/lou-multi-select/multiple-select-otions.js", array( "jquery" ), "", true );
			wp_enqueue_script( "ticket-lou-multi-hide", THEME_DIRECTORY_URI . "/js/lou-multi-select/hide-elements.js",
				array( "jquery" ), "", true );
			wp_enqueue_script( "chi-select2-jss",
				"https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js" );
		}
	}
}

add_action( 'admin_enqueue_scripts', "ticket_select_input" );


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

		function gtag() {
			dataLayer.push(arguments);
		}

		gtag('js', new Date());

		gtag('config', 'UA-69849523-45');
	</script>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-TCD20BJPWY"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'G-TCD20BJPWY');
	</script>
	<?php
}

add_action( 'wp_head', 'chi_hook_for_google_analytics' );


function czech_unbranded_risk_calculator() {
	if ( is_single( 'czech-unbranded-risk-calculator' ) ) {

		wp_deregister_script('jquery');
		wp_deregister_script('chi-acordeon-efect');
		wp_deregister_style('chi-acordeon-efect');
		//css
		wp_enqueue_style( "risk-calculator-style", THEME_DIRECTORY_URI . "/css/risk-calculator/css/style.css" );

		wp_enqueue_style( "risk-calculator-swiper-style",
			THEME_DIRECTORY_URI . "/css/risk-calculator/css/swiper.min.css" );

		//<script src="js/jquery-3.2.1.min.js" type="text/javascript"></script>
		//<script type="text/javascript" src="js/iscroll.js"></script>
		//<script src="js/script.js"></script>
		//<script src="js/baseScript.js"></script>
		//<script src="js/jquery.touchSwipe.min.js"></script>
		//<script src="js/jquery.tap.js"></script>
		//<script src="js/swiper.min.js"></script>
                                 // js
		wp_enqueue_script( "risk-calculator-jquery", THEME_DIRECTORY_URI . "/js/risk-calculator/jquery-3.2.1.min.js");

		wp_enqueue_script( "risk-calculator-iscroll", THEME_DIRECTORY_URI . "/js/risk-calculator/iscroll.js",
			array( "risk-calculator-jquery") );

		wp_enqueue_script( "risk-calculator-script", THEME_DIRECTORY_URI . "/js/risk-calculator/script.js",
			array( "risk-calculator-jquery"  ) );

		wp_enqueue_script( "risk-calculator-baseScript", THEME_DIRECTORY_URI . "/js/risk-calculator/baseScript.js",
			array(  ) );
		wp_enqueue_script( "risk-calculator-touchSwipe",
			THEME_DIRECTORY_URI . "/js/risk-calculator/jquery.touchSwipe.min.js", array( "jquery" ) );

		wp_enqueue_script( "risk-calculator-jquery-tap", THEME_DIRECTORY_URI . "/js/risk-calculator/jquery.tap.js",
			array(  ) );

		wp_enqueue_script( "risk-calculator-swiper", THEME_DIRECTORY_URI . "/js/risk-calculator/swiper.min.js",
			array(  ) );
	}
}

add_action( 'wp_enqueue_scripts', "czech_unbranded_risk_calculator" );