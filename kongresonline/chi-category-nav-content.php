<?php
$category = get_the_category()[0]->slug;
$article = get_site_url() . "/". $category;
$video = get_site_url() . "/video/". $category;
$active_article =  "";
$active_video =  "";
$test = array_filter(explode("/", $_SERVER['REQUEST_URI']));
$only_articles = ($_SERVER['REQUEST_URI']);

if (strpos($only_articles, "?clanky-a-reportaze"))
{
    $active_article = "chi-active";
}


$alert = "ostatní články";
$all_video = is_integer(strpos($only_articles, "?clanky-a-reportaze"));

if ($test[1] == "video" or $all_video)
{
    $active_video = "chi-active";
    $category = $test[2];
    $alert = "všechny videa";
    ?>
	<style>
		/*
		.chi-claim
		{
			height: 100%!important;
		}*/
		.chi-position-botom
		{
			padding: 0;
		}
		.chi-info-text
		{
			margin: 0;
			padding: 0 0 24px 0;
		}
		.white-color > p
		{
			margin: 0;
		}
	</style>
	<?php
}

if ($all_video)
{
    $active_article = "chi-active";
    $active_video = "";
    $alert = "ČLÁNKY A REPORTÁŽE";
}

?>
<nav class="navbar navbar-expand-lg navbar-light chi-pb-0">
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav text-uppercase">
            <li class="nav-item chi-nav-item" >
                <?php $all_articles_url =  get_home_url() ."/". get_the_category()[0]->slug ."/?clanky-a-reportaze"; ?>
                <a class='nav-link chi-nav-link <?= $active_article ?> white-color' href='<?php echo $all_articles_url?>'>ČLÁNKY A REPORTÁŽE</a>
            </li>
			<?php

            $args = array(
                'numberposts' => 1,
                'post_type'  => 'chi_video',
				"category"	=> get_the_category()[0]->term_id,

            );

            $latest_video = get_posts( $args );
            
			?>
			<?php

				if (!empty($latest_video))
				{
					?>
					<li class="nav-item chi-nav-item">
						<a class="nav-link chi-nav-link <?= $active_video ?> white-color" href="<?= $video ?>">Videa</a>
					</li>
					<?php
				}

			?>
        </ul>
    </div>
</nav>