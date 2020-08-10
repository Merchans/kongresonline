<?php

$category = get_the_category()[0]->slug;
$article  = get_site_url() . "/" . $category;
$video    = get_site_url() . "/video/" . $category;

$active_article = "";
$active_video   = "";
$test           = array_filter(explode("/", $_SERVER['REQUEST_URI']));
$only_articles  = ($_SERVER['REQUEST_URI']);

if (strpos($only_articles, "?clanky-a-reportaze")) {
    $active_article = "chi-active";
}

$first_video = new  WP_Query();

$alert     = "ostatní články";
$all_video = is_integer(strpos($only_articles, "?clanky-a-reportaze"));

$show_diw = 1;

?>
<?php if ($test[1] != "video" and ! $all_video) {
?>

    <?php

    $args_one_offset_video = array("post_type"      => array("chi_video"),
                                   "posts_per_page" => 1,
                                   "category_name"  => $category,
                                   "post_status"    => "publish",
                                   "post__not_in"	=> chi_claims()

    );
    $category_posts        = new WP_Query($args_one_offset_video);
    $chi_add_claims = array_merge(chi_claims(), wp_list_pluck($category_posts->posts, "ID"));
    $chi_title_meta_box = get_post_field("doctoral_degrees_and_name_doctoral_degrees_and_name") ;
    if ($category_posts->have_posts()) :
        $i = 2;
        $categories        = get_the_category()[0]->slug;
        while ($category_posts->have_posts()) :
            $category_posts->the_post();
            ?>
			<div class="d-flex h-20">
				<div class="chi-tag text-uppercase mr-auto p-2">
					<a href="<?php echo get_post_type_archive_link($first_video->query["post_type"][0]) ?>"
					   class="chi-tag_link">VIDEA</a>
				</div>
			</div>
			<hr class="divider mt-0">
			<div class="row">
				<div class="col-md-6">
					<div class="card chi-card--borner-none chi-card">
						<div class="chi-box-1 chi-card--box-1"
							 style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">
							<div class="d-flex flex-row">
								<div class="chi-tag text-uppercase">
									<a href="<?php echo get_permalink() ?>"
									   class="chi-tag_link"><?php echo chi_video_time()[0] ?></a>
								</div>
							</div>
						</div>
						<div class="card-body chi-card-body">
							<?php $chi_title_meta_box = get_post_field("doctoral_degrees_and_name_doctoral_degrees_and_name") ?>
							<a href="<?php echo get_permalink() ?>"><h5
									class="card-title chi-card-title"><?php the_title(); ?></h5>
							</a>
							<strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?>
								<time class="chi-time"><?php the_time(get_option("date_format")) ?></time>
							</strong>
							<?php $moreLink = '<a href="' . get_permalink() . '">...</a>'; ?>
							<p class="chi-card-text"><?php echo wp_trim_words(get_the_content(), 28,
									$moreLink) ?></p>
						</div>
					</div>
				</div>
            <?php $i++;endwhile;
        wp_reset_postdata(); else: ?>
    <?php endif; ?>
    <div class="col-md-6">
        <?php
        $args = array(
            'post_type'      => 'chi_video',
            'post__not_in'   => $chi_add_claims,
            'posts_per_page' => 3,
            "category_name"  => $category,
        );
        $the_query      = new WP_Query($args);

        if ($the_query->have_posts()) :
            $i = 0;
            $categories = get_the_category()[0]->slug;
            while ($the_query->have_posts()) : $the_query->the_post(); ?>
                <div class="<?php if ($i > 0) {
                    echo 'mt-5';
                }
                ?>">
                    <div class="media chi-media position-relative">
                        <div class="d-flex flex-row align-items-end chi-media-img justify-content-between"
                             style="background: url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">
                            <div class="chi-tag text-uppercase">
                                <a href="<?php echo get_permalink(); ?>"
                                   class="chi-tag_link"><?php echo chi_video_time()[0]; ?></a>
                            </div>
                        </div>
                        <div class="media-body">
                            <a href="<?php echo get_permalink(); ?>"><h5
                                    class="mt-0 chi-sub-title"><?php the_title(); ?></h5>
                            </a>
                            <time class="chi-time"
                                  datetime><?php the_time(get_option("date_format")); ?></time>
                        </div>
                    </div>
				</div>
                <?php $i++; endwhile;
            wp_reset_postdata(); else: ?>
			<?php $show_diw = 0; ?>
        <?php endif; ?>
    </div>
	<?php  if($show_diw)
	{
		?>
		</div>
		<?php
	}?>
<?php } ?>