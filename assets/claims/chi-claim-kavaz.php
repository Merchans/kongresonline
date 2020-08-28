<?php

$category = get_the_category()[0]->slug;

$article = get_site_url() . "/". $category;
$video = get_site_url() . "/video/". $category;

$active_article =  "";
$active_video =  "";
$url_segments = array_filter(explode("/", $_SERVER['REQUEST_URI']));
$only_articles = ($_SERVER['REQUEST_URI']);

if (strpos($only_articles, "?clanky-a-reportaze"))
{
    $active_article = "chi-active";
}

$alert = "ostatní články";
$all_video = is_integer(strpos($only_articles, "?clanky-a-reportaze"));
if ($all_video)
{
    $active_article = "chi-active";
    $active_video = "";
    $alert =  __("ČLÁNKY A REPORTÁŽE", "chi");
}


// From url get ID category
$category_id = get_category_by_slug( $category )->term_id;

$args_one_video_or_post = array("post_type" => array("chi_video", "post"), "posts_per_page" => 1, "category_name" => $category, "post_status" => "publish");
$first_video_or_post_or_post = new  WP_Query($args_one_video_or_post);

$chi_special_logo = wp_get_attachment_image_src (  get_term_meta ( $category_id, "category-image-id", true ), 'full')[0];

$args_two_posts = array("post_type" => array("post", "chi_video"), "posts_per_page" => 2, "category_name" => $category, "post__not_in" => $first_video_or_post_or_post->posts[0]->ID );
?>


<div class="container">
    <?php
    if ($url_segments[1] != "video" and !$all_video )
    {?>
    <div class="chi-info-banner">
        <div class="row chi-category-bg chi-pt-15">
            <div class="col-md-6 overflow-hidden chi-pr-lg-0">
                <div class="chi-box-1" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url($first_video_or_post_or_post->posts[0]->ID) ?>) no-repeat center center; background-size: cover;">
                    <a href="<?php echo get_permalink($first_video_or_post_or_post->posts[0]->ID) ?>" class="d-block w-100 h-100"></a>
                    <div class="d-flex flex-row">
                        <?php $terms = get_the_terms($first_video_or_post_or_post->posts[0]->ID, "congress"); ?>
                        <?php if (is_array($terms) && !empty($terms)) { ?>
                            <?php foreach( $terms as $term) {?>
                                <?php $url = get_home_url() .'/'. $term->taxonomy .'/'. $term->slug;  ?>
                                <div class="chi-tag text-uppercase">
                                    <a href="<?php echo $url; ?>" class="chi-tag_link"><?php echo $term->name; ?></a>
                                </div>
                            <?php }	?>
                        <?php } ?>
                        <?php $tags = get_the_tags($first_video_or_post_or_post->posts[0]->ID); ?>
                        <?php if (is_array($tags) && !empty($tags)) { ?>
                            <?php foreach( $tags as $tag) {?>
                                <?php $url = get_tag_link($tag) ?>
                                <div class="chi-tag chi-tag--white text-uppercase">
                                    <a href="<?php echo $url; ?>" class="chi-tag_link--white"><?php echo $tag->name; ?></a>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>

                    <a href="<?php echo get_permalink($first_video_or_post_or_post->posts[0]->ID) ?>"><h1 class="chi-title-white"><?php echo $first_video_or_post_or_post->posts[0]->post_title ?></h1></a>
                    <?php $chi_title_meta_box = get_post_field("doctoral_degrees_and_name_doctoral_degrees_and_name", $first_video_or_post_or_post->posts[0]->ID  );	?>
                    <time class="chi-time" ><strong><?php echo has_title_meta_box($chi_title_meta_box) ?></strong> <?php echo czech_date( get_option('date_format'), strtotime($first_video_or_post_or_post->posts[0]->post_date) )?></time>
                </div>
            </div>
            <div class="col-md-6 overflow-hidden">
                <div class="row">
                    <div class="col-md-12 overflow-hidden">
                        <div class="chi-box-2 chi-box--pl-33 chi-box--pb-33">
                            <div class="chi-box-2__textarea">
                                <h1>
                                    <a class="chi-title-white chi-title-white--fz27 chi-title-white--mb-20" href="/kongresove-zpravodajstvi">Kongresové zpravodajství</a>
                                </h1>
                                <p class="chi-kavaz-text">
                                    <a class="text-white" href="/kongresove-zpravodajstvi">Aktuální reportáže a rozhovory z odborných medicínských kongresů.</a>
                                </p>
                                <div class="chi-btn-kavaz">
                                    <a  href="/kongresove-zpravodajstvi" class="chi-btn-kavaz_link">OTEVŘÍT RUBRIKU</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 overflow-hidden">
                        <div class="chi-box-3 chi-box--pl-33 chi-box--pb-33">
                            <div class="chi-box-2__textarea">
                                <h1 class="chi-title-white chi-title-white--fz27 chi-title-white--mb-20">Okénko mladých lékařů</h1>
                                <p class="chi-kavaz-text">Rubrika mladých angiologů, kardiologů a internistů, kteří svým kolegům předávají zkušenosti z navštívených kongresů, odborné problematiky i vlastní práce.</p>
                                <div class="chi-btn-kavaz">
                                    <a href="#" class="chi-btn-kavaz_link">OTEVŘÍT RUBRIKU</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php } ?>
</div>