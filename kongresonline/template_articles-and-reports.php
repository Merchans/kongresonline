<?php /* Template Name: Články a reportáže*/

chi_all_headers();
wp_head();

$args_one_video = array("post_type" => "chi_video", "posts_per_page" => 1);
$first_video    = new  WP_Query($args_one_video);
$first_video_ID = $first_video->posts[0]->ID;

?>
<body>
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-9 chi-video-section">
                <div class="others-articles">
                    <div class="d-flex h-20 mt-5">
                        <div class="chi-tag text-uppercase mr-auto p-2">
                            <span class="chi-tag_link" id="ostatni-clanky">Články a reportáže</span>
                        </div>
                    </div>
                    <hr class="divider mt-0">
                    <ul class="list-unstyled">
                        <?php

                        if (get_url_var("page") == "")
                        {
                            $current_page = 1;
                        }
                        else
                        {
                            (int)$current_page = get_url_var("page");
                        }
                        $args = array("post_type" => "post", "paged" => $current_page);
                        $current_page = get_query_var("paged");
                        query_posts( $args );
                        ?>
                        <?php if (have_posts()) : ?>
                            <?php while (have_posts()) : the_post() ?>
                                <?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
                                <li class="media">
                                    <div class="image-credit-wrapper chi-othes-articles">
                                    <span class="image-credit chi-category-credit">

                 <a href="<?php echo get_category_link( get_the_category( get_the_ID() )[0] ); ?>" class="chi-category__link"><?php echo get_the_category()[0]->slug ?></a>
            </span>
                                        <?php the_post_thumbnail("medium") ?>
                                    </div>
                                    <div class="media-body ">
                                        <a href="<?php echo get_permalink() ?>"><h5 class="mt-0 mb-1 card-title chi-card-title"><?php the_title(); ?></h5></a>
                                        <strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?>
                                            <time class="chi-time" datetime><?php the_time(get_option("date_format")); ?></time>
                                        </strong>
                                        <p class="chi-card-text"><?php echo wp_trim_words( get_the_content(), 25) ?></p>
                                    </div>
                                </li>
                            <?php endwhile ?>
                        <?php else : ?>

                        <?php endif ?>
                    </ul>
                    <?php get_template_part("chi-blog-pages"); ?>
                    <!--
                    <div class="row mt-5 mx-auto">
                        <a class="btn chi-btn-more-acticle mx-auto" href="#" role="button">10 dalších článků&hellip;</a>
                        <nav aria-label="..." class="...">
                            <ul class="pagination chi-pagination">
                                <li class="page-item chi-page-item "><a class="chi-page-link active" href="#">1</a></li>
                                <li class="page-item chi-page-item ">
                                    <a class="chi-page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                </li>
                                <li class="page-item chi-page-item"><a class="chi-page-link" href="#">3</a></li>
                                <li class="page-item chi-page-item">
                                    <a class="chi-page-link chi-page-link-last" href="#">&hellip;</a>
                                </li>
                            </ul>
                        </nav>
                    </div>-->
                </div>

            </div>
            <?php get_template_part("chi-aside"); ?>
        </div>
    </div>
    </div>
</main>
<footer>
    <div class="container">
        <?php get_template_part("chi-footer-content");	?>
    </div>
</footer>
</body>
<?php

get_footer();
wp_footer();

?>