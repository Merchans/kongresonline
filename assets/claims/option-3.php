<?php
chi_all_headers();
$category = get_the_category();
$category_ID = $category[0]->cat_ID;
$option = (get_term_meta($category_ID, '_chi_selected_one_options')[0]);
$chi_selected_in_claim_posts_values = get_term_meta($category_ID, 'chi_selected_in_claim_posts', true);

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

if ($url_segments[1] == "video" or $all_video)
{
    $active_video = "chi-active";
    $category = $url_segments[2];
    $alert = "VŠECHNA VIDEA";
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

        $args_one_video = array("post_type" => "any", "p" => $chi_selected_in_claim_posts_values[0], "category_name" => $category);
        $args_two_posts = array("post_type" => "any", "post__in" => [$chi_selected_in_claim_posts_values[1], $chi_selected_in_claim_posts_values[2]], "category_name" => $category);


        $first_video = new  WP_Query($args_one_video);

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
                                                <?php $chi_title_meta_box = get_post_field("doctoral_degrees_and_name_doctoral_degrees_and_name"); ?>
												<a href="<?php echo get_permalink() ?>"><h1 class="chi-title-white"><?php the_title() ?></h1></a>
												<time class="chi-time"><strong><?php echo has_title_meta_box($chi_title_meta_box) ?></strong> <?php the_time(get_option("date_format")) ?></time>
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
    <main class="chi-position-botom chi-category-bg">
        <div class="container">
			<div class="row  pt-5"></div>
            <div class="row">
                <div class="col-md-9 chi-video-section">
                    <?php get_template_part("assets/claims/video-section"); ?>
                    <?php
                    if ($url_segments[1] != "video" and !$all_video )
                        get_template_part("chi-horizontal-advertising");
                    ?>
                    <div class="others-articles">
                        <div class="d-flex h-20 <?php if ($url_segments[1] != 'video'  and !$all_video) {echo '';} ?>">
                            <div class="chi-tag text-uppercase mr-auto p-2">
                                <span class="chi-tag_link" id="ostatni-clanky"><?php echo $alert ?></span>
                            </div>
                        </div>
                        <hr class="divider mt-0">
                        <ul class="list-unstyled">
                            <?php if (have_posts()) : ?>
                                <?php while (have_posts()) : the_post() ?>
                                    <?php $chi_title_meta_box = ""; $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
                                    <li class="media">
										<div class="image-credit-wrapper chi-othes-articles">
                                            <?php $terms = get_the_tags(); ?>
                                            <?php if ( !empty($terms) ) { ?>
                                                <?php if (is_array($terms) && ! empty($terms)) { ?>
                                                    <?php $url = get_tag_link($terms[0]->term_id); ?>
													<div class="image-credit chi-category-credit">
														<a href="<?php echo $url; ?>"
														   class="chi-category__link"><?php echo $terms[0]->name; ?></a>
													</div>
                                                <?php } ?>
                                            <?php } ?>
											<a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail() ?></a>
										</div>
                                        <div class="media-body ">
                                            <a href="<?php echo get_permalink();  ?>"><h5 class="mt-0 mb-1 card-title chi-card-title"><?php the_title() ?></h5></a>
                                            <strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?></time></strong>
                                            <p class="chi-card-text"><?php echo excerpt(30); ?></p>
                                        </div>
                                    </li>
                                <?php endwhile ?>
                            <?php else : ?>

                            <?php endif ?>
                        </ul>
                        <?php echo '<nav class="d-flex justify-content-end"><ul class="pagination chi-pagination">';?>
                        <?php echo get_pagination_links();
                        ?>
                        <?php echo '</ul></nav>'; ?>
                        <?php
                        if ($url_segments[1] == "video")
                            get_template_part("chi-horizontal-advertising");
                        ?>
                    </div>

                </div>
                <div class="col-md-3">
                    <div class="advertisment-col">
                        <div class="d-flex h-20">
                            <div class="chi-tag text-uppercase mr-auto p-2">
                                <span class="chi-tag_link">REKLAMNÍ SDĚLENÍ</span>
                            </div>
                        </div>
                        <hr class="divider mt-0">
                        <?php

                        $id = get_the_category()[0]->term_id;
                        $advertising_ids = get_term_meta( $id, "chi_selected_in_category_advertising_vertical");
                        if ( count($advertising_ids) > 0 && ! empty($advertising_ids))
                        {
                            $adverts_args = array(
                                "post_type" => "chi_inzerce",
                                "include"  => $advertising_ids[0],
                            );
                            $adverts = get_posts($adverts_args);
                            foreach ($adverts as $advert)
                            {
                                echo $advert->post_content;
                            }
                        }
                        ?>
                    </div>
                    <?php
                    $id = get_the_category()[0]->term_id;
                    $close_end       = false;
                    $advertising_ids = get_term_meta( $id, "chi_selected_thems_in_category");
                    if (count($advertising_ids) > 0 && !empty($advertising_ids)) {
                    $adverts_args = array(
                        "post_type" => array(
                            "post",
                            "chi_video"
                        ),
                        "include" => $advertising_ids[0]
                    );
                    $adverts      = get_posts($adverts_args);
                    if (count($adverts) > 0) {
                    $close_end = true;
                    ?>
                    <div class="chi-category-thems mt-5">
                        <div class="d-flex h-20">
                            <div class="chi-tag text-uppercase mr-auto p-2">
                                <span class="chi-tag_link">témata</span>
                            </div>
                        </div>
                        <hr class="divider mt-0">
                        <div class="chi-theme-box">
                            <?php
                            }
                            $i = 1;
                            foreach ($adverts as $advert) {
                                if ((string)$advert->post_type == "post"){
                                    if (($i % 2 != 0)) {
                                        ?>
                                        <figure class="inline-image chi-cards">
                                        <?php
                                    }
                                    ?>
                                    <div class="chi-theme-card">
                                        <div class="image-credit-wrapper">
                                        <span class="image-credit chi-category-credit">

                <a href="<?php echo get_chi_make_specilal_form_category($advert->ID); ?>" class="chi-category__link"><?php echo get_the_category($advert->ID)[0]->slug ?></a>
            </span>
                                            <?php
                                            echo get_the_post_thumbnail($advert->ID,"small");
                                            ?>
                                        </div>
                                        <div class="card-body chi-card-body">
                                            <div class="text-left"><a href="<?php echo get_permalink($advert->ID)  ?>" class="chi-name--min-title"><?php echo $advert->post_title ?></a></div>
                                            <strong class="chi-name-title"><time class="chi-time" datetime><?php echo get_the_date(get_option( 'date_format' ), $advert->ID )  ?></time></strong>
                                        </div>
                                    </div>
                                    <?php
                                    if (($i % 2 == 0)) {
                                        ?></figure> <?php
                                    }
                                    $i++;
                                }
                            }
                            if ($close_end) {
                                echo "</div>";
                            }
                            ?>
                        </div>
                        <?php

                        foreach ($adverts as $advert)
                        {
                            if ((string)$advert->post_type == "chi_video"){
                                ?>
                                <div class="d-flex h-20">
                                    <div class="chi-tag text-uppercase mr-auto p-2">
                                        <span class="chi-tag_link">VIDEO</span>
                                    </div>
                                </div>
                                <hr class="divider mt-0">
                                <div class="card chi-card--borner-none chi-card">
                                    <div class="chi-box-1 chi-card--box-1" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url($advert->ID) ?>) no-repeat center center; background-size: cover;">
                                        <div class="d-flex flex-row">
                                            <?php

                                            if ( !empty(chi_video_time($advert->ID)[0]) && isset( chi_video_time($advert->ID)[0]) )
                                            {
                                                ?>
                                                <div class="chi-tag text-uppercase">
                                                    <span class="chi-tag_link"><?php echo chi_video_time($advert->ID)[0]; ?></span>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                            <div class="chi-category text-uppercase">
                                                <a href="<?php echo get_chi_make_specilal_form_category($advert->ID); ?>" class="chi-category__link">
                                                    <?php echo get_the_category($advert->ID)[0]->slug ?>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body chi-card-body">
                                        <a href="<?php echo get_permalink($advert->ID)  ?>"><h6 class="card-title chi-card-title"><?php echo $advert->post_title ?></h6></a>
                                        <strong class="chi-name-title"><?php echo get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name", $advert->ID)?><time class="chi-time" datetime> - <?php echo get_the_date(get_option( 'date_format' ), $advert->ID )  ?></time></strong>
                                        <p class="chi-card-text"><?php echo excerpt(29); ?></p>

                                    </div>
                                </div>
                                <?php
                            }
                        }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
    </main>
    <footer class="container">
        <?php get_template_part("chi-footer-content");	?>
    </footer>
<?php
get_footer();
wp_footer();
?>