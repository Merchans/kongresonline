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


$alert = "čtěte také";
$all_video = is_integer(strpos($only_articles, "?clanky-a-reportaze"));

if ($url_segments[1] == "video" or $all_video)
{
    $active_video = "chi-active";
    $category = $url_segments[2];
    $alert = __("všechna videa", "chi");
    ?>
    <style>
        .chi-claim
        {
            height: 100%!important;
        }
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
    $alert =  __("ČLÁNKY A REPORTÁŽE", "chi");
}


?>
<div <?php body_class("chi-claim"); ?>>
    <?php get_template_part("chi-category-nav-content"); ?>
    <?php

    $args_one_video = array("post_type" => array("chi_video", "post"), "posts_per_page" => 1, "category_name" => $category, "post_status" => "publish");

    $first_video = new  WP_Query($args_one_video);
    $ids_not_in_main_loop = wp_list_pluck( $first_video->posts, 'ID' );

    $args_two_posts = array("post_type" => array("post", "chi_video"), "posts_per_page" => 2, "category_name" => $category, "post__not_in" => [$ids_not_in_main_loop[0]]);


    ?>
    <?php chi_special_logo(); ?>
    <div class="container">
        <?php
        if ($url_segments[1] != "video" and !$all_video )
        {?>
            <div class="chi-info-banner">
                <div class="row chi-category-bg chi-pt-15">
                    <div class="col-md-6 overflow-hidden chi-pr-lg-0">
                        <div class="chi-box-1" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url($first_video->post->ID) ?>) no-repeat center center; background-size: cover;">
							<a href="<?php echo $first_video->post->guid;  ?>" class="d-block w-100 h-100"></a>
                            <div class="d-flex flex-row">
                                <?php $terms = get_the_terms($first_video->post->ID, "congress"); ?>
                                <?php if (is_array($terms) && !empty($terms)) { ?>
                                    <?php foreach( $terms as $term) {?>
                                        <?php $url = get_home_url() .'/'. $term->taxonomy .'/'. $term->slug;  ?>
                                        <div class="chi-tag text-uppercase">
                                            <a href="<?php echo $url; ?>" class="chi-tag_link"><?php echo $term->name; ?></a>
                                        </div>
                                    <?php }	?>
                                <?php } ?>
                                <?php $tags = get_the_tags($first_video->post->ID); ?>
                                <?php if (is_array($tags) && !empty($tags)) { ?>
                                    <?php foreach( $tags as $tag) {?>
                                        <?php $url = get_tag_link($tag) ?>
                                        <div class="chi-tag chi-tag--white text-uppercase">
                                            <a href="<?php echo $url; ?>" class="chi-tag_link--white"><?php echo $tag->name; ?></a>
                                        </div>
                                    <?php } ?>
                                <?php } ?>
                            </div>
                            <a href="<?php echo $first_video->post->guid ?>"><h1 class="chi-title-white"><?php echo $first_video->post->post_title ?></h1></a>
                            <?php $chi_title_meta_box = get_post_field("doctoral_degrees_and_name_doctoral_degrees_and_name", $first_video->post->ID  );	?>
							<time class="chi-time" ><strong><?php echo has_title_meta_box($chi_title_meta_box) ?></strong> <?php echo czech_date( get_option('date_format'), strtotime($first_video->post->post_date) )?></time>
                        </div>
                    </div>
                    <div class="col-md-6 overflow-hidden">
                        <div class="row">
                            <?php

                            $category_posts = new WP_Query($args_two_posts);

                            if($category_posts->have_posts()) :
                                $i= 2;
                                $categories = get_the_category()[0]->slug;
                                while($category_posts->have_posts()) :
                                    $category_posts->the_post();
                                    ?>
                                    <div class="col-md-12 overflow-hidden">
                                        <div class="chi-box-<?php echo $i ?>" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url($category_posts->post->ID) ?>) no-repeat center center; background-size: cover;">
											<a href="<?php echo get_permalink() ?>" class="d-block w-100 h-100"></a>
                                            <div class="d-flex flex-row">
                                                <?php $terms = get_the_terms(get_the_ID(), "congress"); ?>
                                                <?php if (is_array($terms) && !empty($terms)) { ?>
                                                    <?php foreach( $terms as $term) {?>
                                                        <?php $url = get_home_url() .'/'. $term->taxonomy .'/'. $term->slug;  ?>
                                                        <div class="chi-tag text-uppercase">
                                                            <a href="<?php echo $url; ?>" class="chi-tag_link"><?php echo $term->name; ?></a>
                                                        </div>
                                                    <?php }	?>
                                                <?php } ?>
                                                <?php $tags = get_the_tags(get_the_ID()); ?>
                                                <?php if (is_array($tags) && !empty($tags)) { ?>
                                                    <?php foreach( $tags as $tag) {?>
                                                        <?php $url = get_tag_link($tag) ?>
                                                        <div class="chi-tag chi-tag--white text-uppercase">
                                                            <a href="<?php echo $url; ?>" class="chi-tag_link--white"><?php echo $tag->name; ?></a>
                                                        </div>
                                                    <?php } ?>
                                                <?php } ?>
											</div>
                                            <a href="<?php echo get_permalink() ?>"><h1 class="chi-title-white"><?php the_title() ?></h1></a>
                                            <?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
                                            <strong class="chi-time"><?php echo has_title_meta_box($chi_title_meta_box) ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?></time></strong>
                                        </div>
                                    </div>
                                    <?php $i++;endwhile; wp_reset_postdata();  else: ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

