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
</style>
<?php chi_special_background(); ?>
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post() ?>
<?php $categories = get_the_category()[0]->name; $post_type = "chi_video";?>
<?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
<?php chi_special_logo(); ?>
</div>
	</div>
		<div class="chi-parent container">
	<div class="chi-absolute">
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
       			 <?php get_template_part("/assets/aside/single-comercal-theme-videos"); ?>
    <?php endwhile ?>
	<?php else : ?>

	<?php endif ?>
            </div>
        </div>
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