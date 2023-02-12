<?php
if (isset(get_the_category()[0]->slug)) {
	$category = get_the_category()[0]->slug;
}


if (is_page_template("template-kavaz.php") || is_page_template("taxonomy-congress-kardiovaskularni-zpravodajstvi.php")) {
	$category = "kardiovaskularni-zpravodajstvi";
}

$article        = get_site_url() . "/" . $category;

$video          = get_site_url() . "/video/" . $category;

$podcasty          = get_site_url() . "/podcast/" . $category;
$active_article = "";
$active_video   = "";
$active_podcasty   = "";
$url_segments   = array_filter(explode("/", $_SERVER['REQUEST_URI']));
$only_articles  = ($_SERVER['REQUEST_URI']);

if (strpos($only_articles, "?clanky-a-reportaze")) {
	$active_article = "chi-active";
}


$alert     = "čtěte také";
$all_video = is_integer(strpos($only_articles, "?clanky-a-reportaze"));

if ($url_segments[1] == "video" or $all_video) {
	if (!is_single()) {
		$active_video = "chi-active";
	}
	$category = $url_segments[2];
	$alert    = __("všechna videa", "chi");
?>
	<style>
		/*
		.chi-claim
		{
			height: 100%!important;
		}*/
		.chi-position-botom {
			padding: 0;
		}

		.chi-info-text {
			margin: 0 auto;
			padding: 0 0 24px 0;
		}

		.white-color>p {
			margin: 0;
		}
	</style>
<?php
}

if ($url_segments[1] == "podcast") {
	if (!is_single()) {
		$active_podcasty = "chi-active";
	}
	$category = $url_segments[2];
	$alert    = __("všechny podcasty", "chi");
?>
	<style>
		/*
		.chi-claim
		{
			height: 100%!important;
		}*/
		.chi-position-botom {
			padding: 0;
		}

		.chi-info-text {
			margin: 0 auto;
			padding: 0 0 24px 0;
		}

		.white-color>p {
			margin: 0;
		}
	</style>
<?php
}


if ($all_video) {
	$active_article = "chi-active";
	$active_video   = "";
	$alert          = __("ČLÁNKY A REPORTÁŽE", "chi");
}

?>
<nav class="navbar navbar-expand-lg navbar-light chi-pb-0">
	<div id="chi-nav-toggle">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
	</div>
	<div class="collapse navbar-collapse" id="navbarNavDropdown">
		<ul class="navbar-nav text-uppercase">
			<li class="nav-item chi-nav-item">
				<a class='nav-link chi-nav-link white-color' href='<?php echo get_home_url() ?>'>KONGRESONLINE</a>
			</li>
			<li class="nav-item chi-nav-item">
				<?php $all_articles_url = $article . "/?clanky-a-reportaze"; ?>
				<a class='nav-link chi-nav-link <?= $active_article ?> white-color' href='<?php echo $all_articles_url ?>'>ČLÁNKY A REPORTÁŽE</a>
			</li>
			<?php

			if (isset(get_the_category()[0]->term_id)) {
				$category_ID = get_the_category()[0]->term_id;
			} else {
				$category_ID = "";
			}

			$args = array(
				'numberposts' => 1,
				'post_type'   => 'chi_video',
				"category"    => $category_ID

			);

			$latest_video = get_posts($args);

			?>
			<?php

			if (!empty($latest_video)) {
			?>
				<li class="nav-item chi-nav-item">
					<a class="nav-link chi-nav-link <?= $active_video ?> white-color" href="<?= $video ?>">Videa</a>
				</li>
			<?php
			}
			$args = array(
				'numberposts' => 1,
				'post_type'   => ['chi_video', 'post'],
				"category"    => $category_ID,
				"tag" => 'podcasty'

			);

			$latest_podcast = get_posts($args);
			if (!empty($latest_podcast)) {
			?>
				<li class="nav-item chi-nav-item">
					<a class="nav-link chi-nav-link <?= $active_podcasty ?> white-color" href="<?= $podcasty ?>">Podcasty</a>
				</li>
			<?php
			}
			?>
		</ul>
		<div class="right">
			<?php get_search_form(); ?>
		</div>
	</div>
</nav>