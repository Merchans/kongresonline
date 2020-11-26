<?php
chi_all_headers();
?>
	<style>
		.navbar-collapse {
			justify-content: flex-end;
		}
	</style>
<?php
wp_head();
chi_special_background();

$category = get_the_category()[0]->slug;
$article  = get_site_url() . "/" . $category;
$video    = get_site_url() . "/video/" . $category;

$active_article = "";
$active_video   = "";
$url_segments           = array_filter(explode("/", $_SERVER['REQUEST_URI']));

$only_articles  = ($_SERVER['REQUEST_URI']);

if (strpos($only_articles, "?clanky-a-reportaze")) {
    $active_article = "chi-active";
}


$alert = __("čtěte také", "chi");
$all_video = is_integer(strpos($only_articles, "?clanky-a-reportaze"));

if ($url_segments[1] == "video" or $all_video) {
    $active_video = "chi-active";
    $category     = $url_segments[2];
    $alert        = __("všechna videa", "chi");
    ?>
	<style>
		.chi-claim {
			height: 100% !important;
		}

		.chi-position-botom {
			padding: 0;
		}

		.chi-info-text {
			margin: 0;
			padding: 0 0 24px 0;
		}

		.white-color > p {
			margin: 0;
		}
	</style>
    <?php
}

if ($all_video) {
    $active_article = "chi-active";
    $active_video   = "";
    $alert          =  __("ČLÁNKY A REPORTÁŽE", "chi");
}

?>
<?php get_template_part('assets/claims/chi-claims'); ?>

	<main class="chi-position-botom chi-category-bg">
		<div class="container">
			<div class="row  pt-5"></div>
			<div class="row">
				<div class="col-md-9 chi-video-section">

                    <?php get_template_part("assets/claims/video-section"); ?>
                    <?php
                    if ($url_segments[1] != "video" and ! $all_video) {
                        get_template_part("chi-horizontal-advertising");
                    }
                    ?>
					<div class="others-articles">
						<div class="d-flex h-20 <?php /* if ($url_segments[1] != 'video' and ! $all_video) {
                        echo 'mt-5';
                    } */?>">
							<div class="chi-tag text-uppercase mr-auto p-2">
								<a href="#" class="chi-tag_link" id="ostatni-clanky"><?php echo $alert ?></a>
							</div>
						</div>
						<hr class="divider mt-0">
						<ul class="list-unstyled">
                            <?php if (have_posts()) : ?>
                                <?php while (have_posts()) : the_post() ?>
                                    <?php $chi_title_meta_box = get_post_field("doctoral_degrees_and_name_doctoral_degrees_and_name") ?>
									<li class="media">
										<div class="image-credit-wrapper chi-othes-articles">
                                            <?php $terms = get_the_terms(get_the_ID(), "congress"); ?>
                                            <?php if (is_array($terms) && ! empty($terms)) { ?>
                                                <?php $url = get_home_url() . '/' . $terms[0]->taxonomy . '/' . $terms[0]->slug; ?>
												<span class="image-credit chi-category-credit">
														<a href="<?php echo $url; ?>"
														   class="chi-category__link"><?php echo $terms[0]->name; ?></a>
													</span>
                                            <?php } ?>
											<a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail() ?></a>
										</div>
										<div class="media-body ">
											<a href="<?php echo get_permalink(); ?>"><h5
														class="mt-0 mb-1 card-title chi-card-title"><?php the_title() ?></h5>
											</a>
											<strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?>
												<time class="chi-time"><?php the_time(get_option("date_format")) ?></time>
											</strong>
											<p class="chi-card-text"><?php echo excerpt(30); ?></p>
										</div>
									</li>
                                <?php endwhile ?>
                            <?php else : ?>

                            <?php endif ?>
						</ul>
                        <?php echo '<nav class="d-flex justify-content-end"><ul class="pagination chi-pagination">'; ?>
                        <?php echo get_pagination_links();
                        ?>
                        <?php echo '</ul></nav>'; ?>
                        <?php
                        if ($url_segments[1] == "video") {
                            get_template_part("chi-horizontal-advertising");
                        }
                        ?>
					</div>
				</div>
				<div class="col-md-3">
					<div class="advertisment-col">
                        <?php get_template_part("assets/aside/chi-aside-category"); ?>
					</div>
				</div>
		</div>
		</div>
	</main>
	<footer class="chi-category-bg">
        <?php get_template_part("chi-footer-content"); ?>
	</footer>
<?php
get_footer();
wp_footer();
