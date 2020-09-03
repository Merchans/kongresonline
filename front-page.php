<?php
chi_all_headers();
wp_head();

$args_one_video = array("post_type" => "chi_video", "posts_per_page" => 1);
$first_video = new  WP_Query($args_one_video);
$first_video_ID = $first_video->posts[0]->ID;

?>
    <body>
    <main>
        <div class="container">
            <div class="chi-info-text">
                <p>
                    <?php echo get_option('chi_homepage_description'); ?>
                </p>
            </div>
            <div class="chi-info-banner">
                <div class="row">
					<div class="col-md-6 overflow-hidden chi-pr-lg-0">
						<div class="chi-box-1" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url($first_video->post->ID) ?>) no-repeat center center; background-repeat: no-repeat; background-position: left top; background-size: cover;">
							<a href="<?php echo get_permalink($first_video_ID); ?>" class="d-block w-100 h-100"></a>
							<div class="d-flex flex-row padding-t-p-5">
								<div class="chi-tag text-uppercase">
									<a href="/videa" class="chi-tag_link">VIDEA</a>
								</div>
								<div class="chi-category text-uppercase">
									<a href="<?php echo get_category_link(get_the_category($first_video->post->ID)[0]->cat_ID) ?>" class="chi-category__link"><?php echo get_the_category($first_video->post->ID)[0]->name ?></a>
								</div>
							</div>
							<a href="<?php echo get_permalink($first_video_ID); ?>"><h1 class="chi-title-white"><?php echo $first_video->post->post_title ?></h1></a>
                            <?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
							<strong class="chi-time"><?php echo has_title_meta_box($chi_title_meta_box) ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?></time></strong>
						</div>
					</div>
					<?php  ?>
					<div class="col-md-6 overflow-hidden">
						<div class="row">
                            <?php

                            $args_two_posts = array("post_type" => "post", "posts_per_page" => 2);
                            $category_posts = new WP_Query($args_two_posts);
                            $not_in_main_loop = array();
                            $loop = new WP_Query( $args_two_posts );
                            while( $loop->have_posts() ) {
                                $loop->the_post();
                                $not_in_main_loop[] = get_the_ID();
                            }
                            wp_reset_postdata();

                            $category_posts = new WP_Query($args_two_posts);
                            if($category_posts->have_posts()) :
                                $i= 2;
                                while($category_posts->have_posts()) :
                                    $category_posts->the_post();
                                    ?>
									<div class="col-md-12 overflow-hidden">
										<div class="chi-box-<?php echo $i ?>" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url($category_posts->post->ID) ?>) no-repeat center center; background-repeat: no-repeat; background-position: left top; background-size: cover;">
											<a href="<?php echo get_permalink() ?>" class="d-block w-100 h-100"></a>
											<div class="d-flex flex-row padding-t-p-5">
                                                <?php $terms = get_the_terms(get_the_ID(), "congress"); ?>
                                                <?php if (is_array($terms) && !empty($terms)) { ?>
                                                    <?php foreach( $terms as $term) {?>
                                                        <?php $url = get_home_url() .'/'. $term->taxonomy .'/'. $term->slug;  ?>
														<div class="chi-tag text-uppercase">
															<a href="<?php echo $url; ?>" class="chi-tag_link"><?php echo $term->name; ?></a>
														</div>
                                                    <?php }	?>
                                                <?php } ?>
												<div class="chi-category text-uppercase">
													<a href="<?php echo get_chi_make_specilal_form_category() ?>" class="chi-category__link"><?php echo get_the_category($category_posts->post->ID)[0]->name ?></a>
												</div>
											</div>
											<a href="<?php echo get_permalink() ?>"><h1 class="chi-title-white"><?php the_title() ?></h1></a>
                                            <?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
											<strong class="chi-time"><?php echo has_title_meta_box($chi_title_meta_box) ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?></time></strong>
										</div>
									</div>
                                    <?php $i++;endwhile;   else: ?>
                            <?php endif; ?>
						</div>
					</div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-9 chi-video-section mt-5">
                    <div class="d-flex h-20">
                        <div class="chi-tag text-uppercase mr-auto p-2">
							<a href="/videa" class="chi-tag_link">VIDEA</a>
                        </div>
                        <div>
                        </div>
                    </div>
                    <hr class="divider mt-0">
                    <div class="row">
                        <?php
                        wp_reset_query();
                        $args_one_offset_video = array("post_type" => array("chi_video"), "posts_per_page" => 1, "post_status" => "publish", "offset" => 1 );
                        $category_posts = new WP_Query($args_one_offset_video);

                        if($category_posts->have_posts()) :
                            $i= 2;

                            while($category_posts->have_posts()) :
                                $category_posts->the_post();

                                $categories = get_the_category($category_posts->post->ID);

                                $categories_ID = get_the_category()[0]->term_id;
                                ?>
								<div class="col-md-6">
									<div class="card chi-card--borner-none chi-card">
										<div class="chi-box-1 chi-card--box-1" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">
											<a href="<?php echo  get_permalink()  ?>" class="d-block w-100 h-100"></a>
											<div class="d-flex flex-row">
												<div class="chi-tag text-uppercase">
													<a href="<?php echo get_permalink()?>" class="chi-tag_link"><?php echo chi_video_time()[0]  ?></a>
												</div>
												<div class="chi-category text-uppercase">
													<a href="<?php echo  get_category_link($categories_ID); ?>" class="chi-category__link"><?php echo $categories[0]->name ?></a>
												</div>
											</div>
										</div>
										<div class="card-body chi-card-body">
                                            <?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
											<a href="<?php echo get_permalink() ?>"><h5 class="card-title chi-card-title"><?php the_title(); ?></h5></a>
											<strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?></time></strong>
											<p class="chi-card-text"><?php echo excerpt(30); ?></p>
										</div>
									</div>
								</div>
                                <?php $i++;endwhile;   else: ?>
                        <?php endif; ?>
						<div class="col-md-6">
                            <?php
                            $args = array(
                                'post_type' => 'chi_video',
                                'offset' => 2,
                                'posts_per_page' => 3,
                            );
                            wp_reset_query();
                            $the_query = new WP_Query( $args );

                            if ( $the_query->have_posts() ) :
                                $i = 0;
                                while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<?php

                                    $categories = get_the_category($the_query->post->ID);

                                    $categories_ID = get_the_category()[0]->term_id;

								?>
									<div class="<?php if ($i > 0)
                                    {echo 'mt-5';}
                                    ?> border-bottom">
										<div class="media chi-media position-relative p-0">
											<div class="d-flex flex-row align-items-end chi-media-img justify-content-between chi-media-container" style="background: url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">
												<a href="<?php echo get_permalink(); ?>" class="text-uppercase w-100 h-75 chi-media-container_child">
												</a>
												<div class="chi-category text-uppercase chi-media-container_child">
													<a href="<?php echo get_category_link($categories_ID);  ?>" class="chi-category__link"><?php echo $categories[0]->name;?></a>
												</div>
												<div class="chi-tag text-uppercase chi-media-container_child">
													<a href="<?php echo get_permalink(); ?>" class="chi-tag_link"><?php echo chi_video_time()[0];  ?></a>
												</div>
											</div>
											<div class="media-body">
												<a href="<?php echo get_permalink(); ?>"><h5 class="mt-0 chi-sub-title"><?php the_title();?></h5></a>
												<time class="chi-time" datetime><?php the_time(get_option("date_format")); ?></time>
											</div>
										</div>
									</div>
                                    <?php $i++; endwhile;  	else: ?>

								<p>Nenalezeno</p>

                            <?php endif; ?>
						</div>
						<a href="/videa" class="chi-more-videos-btn">
		<span class="chi-more-videos-btn__text">
			<?php _e("další videa") ?>
		</span>
						</a>
					</div>
                    <div class="others-articles">
                        <div class="d-flex h-20">
                            <div class="chi-tag text-uppercase mr-auto p-2">
                                <a href="/clanky-a-reportaze" class="chi-tag_link" id="ostatni-clanky">ostatní články</a>
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
                            $args = array("post_type" => "post", "paged" => $current_page, "post__not_in" => $not_in_main_loop);
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
											<a href="<?php echo get_permalink() ?>"><?php the_post_thumbnail("medium") ?></a>
										</div>
										<div class="media-body ">
											<a href="<?php echo get_permalink() ?>"><h5 class="mt-0 mb-1 card-title chi-card-title"><?php the_title(); ?></h5></a>
											<strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?>
												<time class="chi-time" datetime><?php the_time(get_option("date_format")); ?></time>
											</strong>
											<p class="chi-card-text"><?php echo excerpt(30); ?></p>
										</div>
									</li>
                                <?php endwhile ?>
                            <?php else : ?>

                            <?php endif ?>
                        </ul>
						<?php get_template_part("chi-blog-pages"); ?>
                    </div>

                </div>
				<?php get_template_part("assets/aside/chi-aside"); ?>
                </div>
            </div>
        </div>
    </main>
    <footer>
        <div class="container chi-hr"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 chi-col-style">
                    <div class="chi-footer-logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/chi-logo-1.png" alt="chi logo">
                    </div>
                    <p>Společnost <strong>CZECH HEALTH INTERACTIVE, s.r.o.</strong> se zaměřuje výhradně na digitální
                        komunikaci v oblasti zdravotnictví.</p>
                </div>
                <div class="col-md-4">
					<p>Základem naší práce je především kvalitní, odborný obsah, který šíříme pomocí moderních online nástrojů.	</p>
					<p>Naší vizí je stát se odborným partnerem pro farmaceutické společnosti v oblasti e-commerce a respektovaným médiem pro lékaře a farmaceuty.</p>
                </div>
                <div class="col-md-4">
					<p>
						<strong>Adresa kanceláře:</strong> <br>
						Národní 32, 110 00 Praha 1 (Palác Chicago)
					</p>
					<p>
						<strong>Fakturační údaje:</strong> <br>
						CZECH HEALTH INTERACTIVE, s.r.o. <br>
						Národní 58/32, 110 00 Praha 1 – Nové Město <br>
						IČ: 25130099, DIČ: CZ25130099
					</p>
					<a href="/o-nas" class="chi-footer-link">Více o nás</a>
            </div>
			</div>
			<?php get_template_part("chi-footer-content");	?>
    </footer>
	<script>
	    document.getElementById("year").innerHTML = new Date().getFullYear();
	</script>
    </body>
<?php

get_footer();
wp_footer();

?>