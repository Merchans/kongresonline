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
	.chi-logo {
		background: url("<?= wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>") left top no-repeat;
	}
</style>
<header>
	<div class="navbar navbar-light bg-dark chi-navbar-height">
		<div class="left" id="chi-nav-toggle">
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="true" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
		</div>
		<div class="d-felex">
			<div class="chi-logo">
				<a class="navbar-brand chi-logo__txt-indent" href="<?php echo get_home_url(); ?>"  title="Kongresonline.cz">Kongresonline.cz</a>
                <?php if (!empty( get_option('chi_sub_logo_title') ) )
                {
                	?>
				<a href="https://www.kongres-online.cz/" title="Kongresonline.cz">
					<small class="chi-logo__small-text"><?php echo get_option('chi_sub_logo_title'); ?></small>
				</a>
				<?php
                }; ?>
			</div>
            <?php get_search_form(); ?>	</div>
	</div>
	</div>

	<nav class="navbar navbar-expand-lg navbar-light bg-light chi-navbar-nav pb-0 pt-0">
		<div class="container">
			<div class="collapse navbar-collapse" id="navbarNavDropdown">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'my-custom-menu',
                        'items_wrap'      => '<ul class="navbar-nav text-uppercase">%3$s</ul>',

                    ));

                ?>
			</div>
		</div>
	</nav>
</header>
<?php get_template_part("/assets/confirms/pfizer-confirm"); ?>
<?php get_template_part("/assets/confirms/chi-confirm"); ?>
