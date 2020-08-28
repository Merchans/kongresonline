<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo("charset")?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php bloginfo("name")?> <?php wp_title( '&raquo;', $display = true, $seplocation = ''); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css">
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
	<!--Favicon-->
	<link rel="shortcut icon" href="<?php echo get_site_icon_url(); ?>"/>
</head>
<style>
    footer {
        background: none;
    }
    main {
        margin-bottom: 0px;
    }
    .navbar-collapse {
        justify-content: flex-end;
    }
</style>
<body>
<header>
    <div class="navbar navbar-light chi-bg-light chi-navbar-height">
		<div class="left" id="chi-nav-toggle">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
		<div class="d-felex">
			<div class="chi-logo-sentens right">
				Provozováno portálem <a class="navbar-brand chi-logo-text-words" href="<?php echo get_home_url(); ?>"  title="Kongresonline.cz"><u>Kongresonline.cz</u></a>
			</div>
			<div class="right">
                <?php get_search_form(); ?>
			</div>
		</div>
	</div>
    <nav class="navbar navbar-expand-lg navbar-light chi-bg-light chi-navbar-nav pt-0 pb-0">
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <?php

            wp_nav_menu(
                array(
                    'theme_location' => 'my-custom-menu',
                    'items_wrap'      => '<ul class="navbar-nav text-uppercase">%3$s</ul>',

                ));

            ?>
           <!-- <ul class="navbar-nav">
                <li class="nav-item chi-nav-item active">
                    <a class="nav-link chi-nav-link chi-active" href="index.html">KOMENTÁŘE</a>
                </li>
                <li class="nav-item chi-nav-item">
                    <a class="nav-link chi-nav-link" href="#">VIDEOKOMENTÁŘE</a>
                </li>
                <li class="nav-item chi-nav-item">
                    <a class="nav-link chi-nav-link" href="#">AKREDITOVANÉ TESTY</a>
                </li>
                <li class="nav-item chi-nav-item">
                    <a class="nav-link chi-nav-link" href="#">TÉMATA</a>
                </li>
            </ul>-->
        </div>
    </nav>
</header>