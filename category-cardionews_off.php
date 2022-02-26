<?php chi_all_headers(); ?>

<?php
$id              = get_the_category()[0]->term_id;
$advertising_ids = get_term_meta( $id, "chi_selected_in_category_advertising_vertical");

wp_head();
chi_special_background();
$alert = "Články";
?>

	<div <?php body_class("chi-claim"); ?>>
		<div class="p-3"></div>
		<div class="container">
            <?php chi_special_logo(); ?>
		</div>
	</div>
	<main class="chi-category-bg">
		<div class="container">
			<div class="row pt-5"></div>
			<div class="row">
				<div class="<?php if ( count($advertising_ids) > 0 && ! empty($advertising_ids)) { echo 'col-md-9';} else { echo 'col-md-12';} ?> chi-video-section">
					<div class="others-articles">
						<div class="d-flex h-20">
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
										<div class="media-body">
											<a href="<?php echo get_permalink();  ?>"><h5 class="mt-0 mb-1 card-title chi-card-title"><?php the_title() ?></h5></a>
											<strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?>
											<span class="reading-time"><?php echo display_read_time(); ?></span></time></strong>
											<p class="chi-card-text"><?php echo excerpt(25); ?></p>
										</div>
									</li>
                                <?php endwhile ?>
                            <?php else : ?>

                            <?php endif ?>
						</ul>
                        <?php
                        $promo_video_id		=	8778;
                        $promo_video_title	=	get_post($promo_video_id)->post_title;
                        $promo_video_exerpt	=	get_post($promo_video_id)->post_excerpt;
                        $url_segments		= array_filter(explode("/", $_SERVER['REQUEST_URI']));
                        ?>
                        <?php if ($url_segments[1] != "video"): ?>
							<div class="d-flex h-20">
								<div class="chi-tag text-uppercase mr-auto p-2">
									<span class="chi-tag_link"><?php _e("video","chi"); ?></span>
								</div>
							</div>
							<hr class="divider mt-0">
							<ul class="list-unstyled">
								<li class="media">
									<div class="image-credit-wrapper chi-othes-articles">
										<a href="<?php echo get_permalink($promo_video_id); ?>">
                                            <?php echo get_the_post_thumbnail($promo_video_id); ?>
										</a>
									</div>
									<div class="media-body">
										<a href="<?php echo get_permalink($promo_video_id); ?>">
											<h5 class="mt-0 mb-1 card-title chi-card-title">
                                                <?php echo $promo_video_title; ?>
											</h5>
										</a>
										<p class="chi-card-text">
                                            <?php echo $promo_video_exerpt; ?>
										</p>
									</div>
								</li>
							</ul>
                        <?php endif; ?>
						<?php if (get_pagination_links()): ?>
							<?php  echo '<nav class="d-flex justify-content-end">' ?>
								<?php  echo '<ul class="pagination chi-pagination">';?>
									<?php echo get_pagination_links(); ?>
								<?php echo '</ul>' ?>
							<?php echo'</nav>'; ?>
						<?php endif; ?>
                        <?php  get_template_part("chi-horizontal-advertising");  ?>
					</div>

				</div>
				<?php if ( count($advertising_ids) > 0 && ! empty($advertising_ids)): ?>
				<div class="col-md-3">
					<div class="advertisment-col">
						<div class="d-flex h-20">
							<div class="chi-tag text-uppercase mr-auto p-2">
								<span class="chi-tag_link"><?php _e("REKLAMNÍ SDĚLENÍ", "chi") ?></span>
							</div>
						</div>
						<hr class="divider mt-0">
                        <?php
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
								<span class="chi-tag_link"><?php _e("témata", "chi") ?></span>
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
											<strong class="chi-name-title"><time class="chi-time" datetime><?php echo get_the_date(get_option( 'date_format' ), $advert->ID )  ?><span class="reading-time"><?php echo display_read_time(); ?></span></time></strong>
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
										<span class="chi-tag_link"><?php _e("video","chi"); ?></span>
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
										<strong class="chi-name-title"><?php echo get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name", $advert->ID)?><time class="chi-time" datetime> - <?php echo get_the_date(get_option( 'date_format' ), $advert->ID )  ?></time><span class="reading-time"><?php echo display_read_time(); ?></span></strong>
										<p class="chi-card-text"><?php echo excerpt(25); ?></p>
									</div>
								</div>
                                <?php
                            }
                        }
                        }
                        ?>
					</div>
				</div>
				<?php endif; ?>
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