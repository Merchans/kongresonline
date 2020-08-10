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
<header>
    <div class="navbar navbar-light bg-dark chi-navbar-height">
        <div class="chi-logo">
            <a class="navbar-brand chi-logo__txt-indent" href="<?php echo get_home_url(); ?>"  title="Kongresonline.cz">Kongresonline.cz</a>
            <?php if (!empty( get_option('chi_sub_logo_title') ) ){ echo get_option('chi_sub_logo_title'); }; ?>
        </div>
        <?php get_search_form();  ?>
    </div>

    <nav class="navbar navbar-expand-lg navbar-light bg-light chi-navbar-nav chi-pb-0">
        <div class="container">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
                    aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
				<?php

					wp_nav_menu(
							array(
									'theme_location' => 'my-custom-menu',
                                    'items_wrap'      => '<ul class="navbar-nav text-uppercase">%3$s</ul>',
 
                            ));

				?>
                <!--<ul class="navbar-nav">
                    <li class="nav-item chi-nav-item active ">
                       a class="nav-link chi-nav-link href="#">SPECIÁLY<span
                                class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item chi-nav-item">
                        <a class="nav-link chi-nav-link" href="#">VIDEA</a>
                    </li>
                    <li class="nav-item chi-nav-item">
                        <a class="nav-link chi-nav-link" href="#">ROZHOVORY</a>
                    </li>
                    <li class="nav-item chi-nav-item">
                        <a class="nav-link chi-nav-link" href="#">TÉMATA</a>
                    </li>
                </ul>-->
            </div>
        </div>
    </nav>
</header>
<div class="chi-bg-modal" id="popupContainer">
	<div class="chi-modal-content mt-3" >
		<a href="#" class="chi-close" id="chi-close"><img src="<?php echo get_template_directory_uri(); ?>/img/close.svg" alt="krížik" ></a>
		<img src="<?php echo get_template_directory_uri(); ?>/img/chi-logo-black.svg" alt="" class="chi-logo-black">
		<small class="chi-logo-subtitle">Reportáže a rozhovory z odborných kongresů </small>
		<p class="chi-claim-text mt-3">
			Výslovně prohlašuji a potvrzuji, že jsem odborníkem podle § 2a zákona č. 40/1995 Sb., o regulaci reklamy a o změně a doplnění některých dalších zákonů, ve znění pozdějších předpisů, tedy, že jsem osobou oprávněnou léčivé přípravky vydávat nebo předepisovat.
		</p>
		<form action="#">
			<div class="custom-control custom-checkbox pl-0">
				<input type="checkbox"  id="customCheck1" checked required >
				<label  for="customCheck1" class="chi-lable">Jsem odborníkem ve zdravotnictví</label>
			</div>
			<button id="chi-submit" type="submit" class="btn chi-btn-more-acticle mx-auto w-100">Potvrzuji</button>
		</form>
	</div>
</div>