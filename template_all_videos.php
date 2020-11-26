<?php /* Template Name: Videa ze specialu */
get_header();
wp_head();
?>
    <style>
        footer {
            background: none;
        }
    </style>
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-9 chi-video-section mt-5">
                    <div class="d-flex h-20">
                        <div class="chi-tag text-uppercase">
                            <a href="#" class="chi-tag_link">VIDEA</a>
                        </div>
                    </div>
                    <hr class="divider mt-0">
                    <div class="row">
                        <?php
                        if (get_query_var("paged") == 0)
                        {
                            $current_page = 1;
                        }
                        else
                        {
                            $current_page = get_query_var("paged");
                        }
                        $args = array("post_type" => "chi_video", "paged" => $current_page);
                        $current_page = get_query_var("paged");
                        query_posts( $args );
                        ?>
                        <?php if (have_posts()) : ?>
                            <?php while (have_posts()) : the_post() ?>
                                <?php $categories = get_the_category()[0]->name; ?>
                                <div class="col-md-4">
                                    <div class="chi-video-box">
										<div class="chi-video position-relative" >
											<div class="d-flex flex-row align-items-end chi-media-img justify-content-between chi-media-container" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">
												<a href="<?php echo get_permalink(); ?>" class="text-uppercase w-100 h-75 chi-media-container_child">
												</a>
												<div class="chi-category text-uppercase chi-media-container_child">
													<a href="<?php echo get_chi_make_specilal_form_category() ?>" class="chi-category__link"><?php echo $categories ?></a>
												</div>
												<div class="chi-tag text-uppercase chi-media-container_child">
													<a href="<?php echo get_permalink()?>" class="chi-tag_link"><?php echo chi_video_time()[0]  ?></a>
												</div>
											</div>
										</div>
                                        <div class="chi-video-body">
                                            <a href="<?php echo get_permalink() ?>"><h5 class="mt-0 chi-sub-title"><?php the_title()?></h5></a>
                                            <time class="chi-time" ><?php the_date(); ?></time>
                                        </div>
                                    </div>
                                </div>
                            <?php endwhile ?>
					</div>
                    <?php get_template_part("chi-blog-pages"); ?>
                        <?php else : ?>

                        <?php endif ?>
                        <?php wp_reset_query();?>
                </div>
                <?php get_template_part("assets/aside/chi-aside"); ?>
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