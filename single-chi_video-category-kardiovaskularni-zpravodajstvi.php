<?php
chi_all_headers();
wp_head();
?>
    <style>
        .chi-other-text a
        {
            width: 275px;
            height: 59px;
            font-style: italic;
            font-weight: bold;
            font-size: 18px;
            line-height: 26px;
            color: #000000;
        }

        .chi-other-text:hover
        {
            text-decoration: underline;
        }
        p,h2,h3,h4,h6,h7
        {
            color: #212529;
        }
        p
        {
            font-style: normal;
            font-weight: normal;
            text-align: justify;
            font-size: 16px;
            line-height: 26px;
        }

        .chi-claim
        {
            background-image: none;
            height: 100%!important;
        }
    </style>
<?php  $chi_special_background = wp_get_attachment_image_src (  get_term_meta ( get_the_category()[0]->term_id , "category-backgound-id", true ), 'small')[0]; ?>
    <style>

        .chi-claim--kavaz {
            background-image: url(<?php echo $chi_special_background ?>);
            background-color: #fcfdfd;
            background-position: center 60px;
            background-repeat: no-repeat;
            background-size: contain;
        }

        .chi-category-logo-center
        {
            width: 500px;
        }

        @media (max-width: 500px)
        {
            .chi-category-logo-center
            {
                width: 100%;
            }
        }

    </style>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post() ?>
        <?php $categories = get_the_category()[0]->name; $post_type = "chi_video";?>
        <?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
        <?php chi_special_logo(); ?>
        </div>
        </div>
        <div class="chi-parent container">
        <div>
		<div class="row chi-category-bg mr-0">

        <div class="chi-breadcrump-navigation col-md-12 mt-3">
            <p>
                <strong>
                    <a href="<?php echo get_post_type_archive_link( $post_type ); ?>"><?php echo get_chi_print_cp_lables() ?></a>
                </strong> >
                <strong>
                    <a href="<?php echo get_chi_make_specilal_form_category() ?>"><?php echo $categories
                        ?></a>
                </strong>
                > <?php the_title();?>
            </p>
        </div>
        <div class="col-md-8 chi-video-section ">
            <div class="d-flex h-20">
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
            <hr class="divider mt-0">
            <div class="embed-responsive embed-responsive-16by9 mb-3"><iframe class="embed-responsive-item" src="<?php echo get_post_meta( get_the_ID() )["video_meta_box_video-url"][0] ?>" width="960" height="540" allowfullscreen="allowfullscreen"></iframe></div>
            <h1 class="chi-article-title"><?php the_title();?></h1>
            <strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?></time></strong>
            <?php the_content(); ?>
            <?php $id = get_the_ID();
            $advertising_ids = get_post_meta( $id, "_chi_advertising_horizontals");
            if ( count($advertising_ids) > 0 && ! empty($advertising_ids))
            {
                $adverts_args = array(
                    "post_type" => "chi_inzerce",
                    "include"  => $advertising_ids[0],
                );
                $adverts = get_posts($adverts_args);
                ?>
                <hr class="divider mt-0">
                <?php
                foreach ($adverts as $advert)
                {
                    echo $advert->post_content;
                }
                ?>
                <hr class="divider mt-3">
                <?php
            }
            ?>
            <div class="navigation"><p><?php posts_nav_link(); ?></p></div>
            <?php posts_nav_link('separator','prelabel','nextlabel'); ?>
            <?php get_template_part("chi-next-prev-links"); ?>
            <div class="others-articles">
                <div class="d-flex h-20 mt-5">
                    <div class="chi-tag text-uppercase mr-auto p-2">
                        <span class="chi-tag_link">PODOBNÁ VIDEA</span>
                    </div>
                </div>
                <hr class="divider mt-0">
                <div class="row">
                    <?php
                    $chi_exclude_ids = array();

                    $prev_post = get_previous_post(true);
                    if ( ! empty($prev_post->ID)) {
                        $prev_post_ID = $prev_post->ID;
                    } else {
                        $prev_post_ID = "";
                    }
                    $next_post = get_next_post(true);
                    if ( ! empty($next_post->ID)) {
                        $next_post_ID = $next_post->ID;
                    } else {
                        $next_post_ID = "";
                    }

                    $current_post_ID = get_the_ID();

                    array_push($chi_exclude_ids, $prev_post_ID, $next_post_ID, $current_post_ID);
                    $category = get_the_category()[0]->slug;
                    $args_two_posts = array("post_type" => "chi_video", "posts_per_page" => 6, "category_name" => $category, "post_status" => "publish", "post__not_in" => $chi_exclude_ids );
                    $category_posts = new WP_Query($args_two_posts);

                    if($category_posts->have_posts()) :
                        $i= 2;
                        while($category_posts->have_posts()) :
                            $category_posts->the_post();
                            ?>
                            <div class="col-md-4">
                                <div class="chi-video-box">
                                    <div class="chi-video position-relative">
                                        <div class="d-flex flex-row align-items-end chi-video-img justify-content-between chi-media-container" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">
                                            <a href="<?php echo get_permalink(); ?>" class="text-uppercase w-100 h-75 chi-media-container_child">
                                            </a>
                                            <?php $tags = get_the_tags(); ?>
                                            <?php if (is_array($tags) && !empty($tags)) { ?>
                                                <?php foreach( $tags as $tag) {?>
                                                    <?php $url = get_tag_link($tag) ?>
                                                    <div class="chi-category text-uppercase chi-media-container_child">
                                                        <a href="<?php echo $url; ?>" class="chi-category__link chi-tag_link--white"><?php echo $tag->name; ?></a>
                                                    </div>
                                                <?php } ?>
                                            <?php } ?>
                                            <div class="chi-tag mr-0">
                                                <a href="<?php echo get_permalink(); ?>" class="chi-tag_link"><?php echo chi_video_time()[0]; ?></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="chi-video-body">
                                        <a href="<?php echo get_permalink(); ?>"><h5 class="mt-0 chi-sub-title"><?php the_title(); ?></h5></a>
                                        <time class="chi-time" datetime><?php the_time(get_option("date_format")); ?></time>
                                    </div>
                                </div>
                            </div>
                            <?php $i++;endwhile; wp_reset_postdata();  else: ?>
                    <?php endif; ?>
                </div>
            </div>

        </div>
        <div class="col-md-4">
        <div class="advertisment-col">
            <div class="d-flex h-20">
                <div class="chi-tag text-uppercase mr-auto p-2">
                    <span class="chi-tag_link">Zpravodajství z kongresů</span>
                </div>
            </div>
            <hr class="divider mt-0" />
            <?php
            $terms = get_terms( array(
                'taxonomy' => 'congress',
                'hide_empty' => false,
                'slug'	=> 'kardiovaskularni-zpravodajstvi'
            ) );

            $kvaz_id = $terms[0]->term_taxonomy_id;

            $kavaz_sub_term_id = get_term_children($kvaz_id, 'congress');
            $kavaz_childs = get_terms( 'congress', array(
                'hide_empty' => false,
                'hide_empty' => 0,
                'parent' => $kvaz_id,
            ) );
            ?>
            <?php if ( $kavaz_childs && !empty($kavaz_childs)) {?>
                <ul class="news-from-congress-container">
                    <?php  foreach ($kavaz_childs as $kavaz_child) { ?>
                        <li class="news-from-congress__item">
                            <a href="<?php echo get_term_link($kavaz_child->term_id) ?>">
                                <?php echo $kavaz_child->name; ?>
                            </a>
                        </li>
                    <?php }?>
                </ul>
            <?php }?>
            <?php
            $id = get_the_ID();
            $advertising_ids = get_post_meta( $id, "_chi_advertising_verticals");
            if (count($advertising_ids) > 0 && ! empty($advertising_ids)) {
                $adverts_args = array(
                    "post_type" => "chi_inzerce",
                    "include"   => $advertising_ids[0],
                );
                $adverts      = get_posts($adverts_args);
                if ($adverts)
                {
                    ?>
                    <div class="d-flex h-20">
                        <div class="chi-tag text-uppercase mr-auto p-2">
                            <span class="chi-tag_link">REKLAMNÍ SDĚLENÍ</span>
                        </div>
                    </div>
                    <hr class="divider mt-0">
                    <?php
                }
                foreach ($adverts as $advert) {
                    echo $advert->post_content;
                }
            }
            ?>
        </div>
            <?php
            $id              = get_the_ID();
            $close_end       = false;
            $advertising_ids = get_post_meta($id, "_chi_selected_articles_or_videoss");
            if (count($advertising_ids) > 0 && ! empty($advertising_ids)) {
            $adverts_args = array(
                "post_type" => array(
                    "post",
                    "chi_video"
                ),
                "include"   => $advertising_ids[0]
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
                        if ((string)$advert->post_type == "post") {
                            if (($i % 2 != 0)) {
                                ?>
                                <figure class="inline-image chi-cards">
                                <?php
                            }
                            ?>
                            <div class="chi-theme-card">
                                <div class="image-credit-wrapper">
                                        <span class="image-credit chi-category-credit">

                <a href="<?php echo get_chi_make_specilal_form_category($advert->ID); ?>"
                   class="chi-category__link"><?php echo get_the_category($advert->ID)[0]->slug ?></a>
            </span>
                                    <?php
                                    echo get_the_post_thumbnail($advert->ID, "small");
                                    ?>
                                </div>
                                <div class="card-body chi-card-body">
                                    <div class="text-left"><a href="<?php echo get_permalink($advert->ID) ?>"
                                                              class="chi-name--min-title"><?php echo $advert->post_title ?></a>
                                    </div>
                                    <strong class="chi-name-title">
                                        <time class="chi-time"
                                              datetime><?php echo get_the_date(get_option('date_format'),
                                                $advert->ID) ?></time>
                                    </strong>
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

                foreach ($adverts as $advert) {
                    if ((string)$advert->post_type == "chi_video") {
                        ?>
                        <div class="d-flex h-20">
                            <div class="chi-tag text-uppercase mr-auto p-2">
                                <span class="chi-tag_link">VIDEA</span>
                            </div>
                        </div>
                        <hr class="divider mt-0">
                        <div class="card chi-card--borner-none chi-card">
                            <div class="chi-box-1 chi-card--box-1"
                                 style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url($advert->ID) ?>) no-repeat center center; background-size: cover;">
                                <div class="d-flex flex-row">
                                    <?php

                                    if ( ! empty(chi_video_time($advert->ID)[0]) && isset(chi_video_time($advert->ID)[0])) {
                                        ?>
                                        <div class="chi-tag text-uppercase">
												<span
                                                    class="chi-tag_link"><?php echo chi_video_time($advert->ID)[0]; ?></span>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <div class="chi-category text-uppercase">
                                        <a href="<?php echo get_chi_make_specilal_form_category($advert->ID); ?>"
                                           class="chi-category__link">
                                            <?php echo get_the_category($advert->ID)[0]->slug ?>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body chi-card-body">
                                <a href="<?php echo get_permalink($advert->ID) ?>">
                                    <h6 class="card-title chi-card-title"><?php echo $advert->post_title ?></h6>
                                </a>
                                <strong class="chi-name-title"><?php echo get_post_field("doctoral_degrees_and_name_doctoral_degrees_and_name",
                                        $advert->ID) ?>
                                    <time class="chi-time" datetime>
                                        - <?php echo get_the_date(get_option('date_format'),
                                            $advert->ID) ?></time>
                                </strong>
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
    <?php endwhile ?>
    <?php else : ?>

    <?php endif ?>
    <footer>
        <?php get_template_part("chi-footer-content"); ?>
    </footer>
    </div>
    </div>
    </div>
<?php
get_footer();
wp_footer();
?>