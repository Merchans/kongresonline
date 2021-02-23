<?php wp_head(); ?>
<?php chi_all_headers(); ?>
<?php get_template_part( "chi-category-nav-content" ); ?>
<?php

	$category_slug = get_the_category()[0]->slug;


	// From url get ID category
	$category_id = get_category_by_slug( $category_slug )->term_id;


	$article = get_site_url() . "/" . $category_slug;
	$video   = get_site_url() . "/video/" . $category_slug;

	$active_article = "";
	$active_video   = "";
	$url_segments   = array_filter( explode( "/", $_SERVER['REQUEST_URI'] ) );
	$only_articles  = ( $_SERVER['REQUEST_URI'] );

	if ( strpos( $only_articles, "?clanky-a-reportaze" ) ) {
		$active_article = "chi-active";
	}

	$alert     = __( "ČLÁNKY A REPORTÁŽE", "chi" );
	$all_video = is_integer( strpos( $only_articles, "?clanky-a-reportaze" ) );

	if ( $url_segments[1] == "video" or $all_video ) {
		$active_video  = "chi-active";
		$category_slug = $url_segments[2];
		$alert         = __( "všechna videa", "chi" );
	}


	$args_one_video_or_post      = array(
			"post_type"      => array( "chi_video", "post" ),
			"posts_per_page" => 1,
			"category_name"  => $category_slug,
			"post_status"    => "publish"
	);
	$first_video_or_post_or_post = new  WP_Query( $args_one_video_or_post );

	$chi_special_logo = wp_get_attachment_image_src( get_term_meta( $category_id, "category-image-id", true ), 'full' )[0];

	$args_two_posts = array( "post_type"      => array( "post", "chi_video" ),
							 "posts_per_page" => 2,
							 "category_name"  => $category_slug,
							 "post__not_in"   => $first_video_or_post_or_post->posts[0]->ID
	);


	if ( $all_video ) {
		$active_article = "chi-active";
		$active_video   = "";
		$alert          = __( "ČLÁNKY A REPORTÁŽE", "chi" );
	}

?>

<?php $chi_special_background = wp_get_attachment_image_src( get_term_meta( get_the_category()[0]->term_id, "category-backgound-id", true ), 'small' )[0]; ?>
<style>
	.navbar-collapse {
		justify-content: flex-end;
	}

	.chi-claim--kavaz {
		background-image: url(<?php echo $chi_special_background ?>);
		background-color: #fcfdfd;
		background-position: center 60px;
		background-repeat: no-repeat;
		background-size: contain;
	}

	.chi-category-logo-center {
		width: 500px;
	}

	@media (max-width: 800px) {
		.chi-claim--kavaz {
			background-position: center 95px;
			background-image: url("<?php echo get_template_directory_uri();?>/img/kavaz-bg-mobile.png");
		}

		.chi-tag-kavaz {
			display: none;
		}
	}

	@media (max-width: 500px) {
		.chi-category-logo-center {
			width: 100%;
		}
	}

</style>
<body class="chi-claim--kavaz">
<?php chi_special_logo(); ?>
<?php $link = $first_video_or_post_or_post->posts[0]->ID; ?>
<main>
	<?php get_template_part( "assets/claims/chi-claim-kavaz" ); ?>
	<div class="container chi-bg-white">
		<div class="row row--white">
			<div class="col-md-9 chi-video-section mt-30px">
				<?php if ( $url_segments[1] != "video" and ! $all_video ) { ?>
					<div class="d-flex h-20">
						<div class="chi-tag text-uppercase mr-auto p-2">
							<span class="chi-tag_link">VIDEO</span>
						</div>
					</div>
					<hr class="divider mt-0"/>
					<div class="row">
						<div class="col-md-6">
							<?php
								$args_one_offset_video = array(
										"post_type"      => array( "chi_video" ),
										"posts_per_page" => 1,
										"category_name"  => $category_slug,
										"post_status"    => "publish",
										"post__not_in"   => array( $link ),

								);

								$category_posts     = new WP_Query( $args_one_offset_video );
								$chi_add_claims     = array_merge( chi_claims(), wp_list_pluck( $category_posts->posts, "ID" ) );
								$chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name" );
							?>
							<?php if ( $category_posts->have_posts() ) { ?>
								<?php while ( $category_posts->have_posts() ) {
									$category_posts->the_post();
									$not_in_main_loop[] = get_the_ID();
									?>
									<div class="card chi-card--borner-none chi-card">
										<div class="chi-box-1 chi-card--box-1"
											 style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">
											<a href="<?php echo get_permalink() ?>" class="d-block w-100 h-100"></a>
											<div class="d-flex flex-row">
												<?php $terms = get_the_tags(); ?>
												<?php if ( ! empty( $terms ) ) { ?>
													<?php if ( is_array( $terms ) && ! empty( $terms ) ) { ?>
														<div class="chi-category text-uppercase chi-media-container_child">
															<?php $url = get_tag_link( $terms[0]->term_id ); ?>
															<a href="<?php echo $url; ?>"
															   class="chi-category__link"><?php echo $terms[0]->name; ?></a>
														</div>
													<?php } ?>
												<?php } ?>
												<div class="chi-tag-kavaz text-uppercase">
													<a href="<?php echo get_permalink(); ?>"
													   class="chi-tag_link"><?php echo chi_video_time()[0]; ?></a>
												</div>
											</div>
										</div>
										<div class="card-body chi-card-body">
											<?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name" ) ?>
											<a href="<?php echo get_permalink() ?>">
												<h5 class="card-title chi-card-title"><?php echo get_the_title(); ?></h5>
											</a>

											<strong class="chi-name-title"><?php echo has_title_meta_box( $chi_title_meta_box ) ?>
												<time class="chi-time"><?php the_time( get_option( "date_format" ) ) ?></time>
											</strong>
											<p class="chi-card-text"><?php echo excerpt( 30 ); ?></p>
										</div>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
						<div class="col-md-6">
							<?php
								$args_one_video_or_post      = array(
										"post_type"      => array( "chi_video", "post" ),
										"posts_per_page" => 1,
										"category_name"  => $category_slug,
										"post_status"    => "publish"
								);
								$first_video_or_post_or_post = new  WP_Query( $args_one_video_or_post );
								$not_in_main_loop[]          = $first_video_or_post_or_post->posts[0]->ID;

								$args           = array(
										'post_type'      => 'chi_video',
										'post__not_in'   => $not_in_main_loop,
										'posts_per_page' => 3,
										"category_name"  => $category_slug,
								);
								$the_query      = new WP_Query( $args );

								if ( $the_query->have_posts() ) :
									$i = 0;
									$categories = get_the_category()[0]->slug;
									while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
										<div class="<?php if ( $i > 0 ) {
											echo 'mt-5';
										}
										?> border-bottom">
											<div class="media chi-media position-relative p-0">
												<div
														class="d-flex flex-row align-items-end chi-media-img justify-content-between chi-media-container"
														style="background: url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">

													<a href="<?php echo get_permalink(); ?>"
													   class="text-uppercase w-100 h-75 chi-media-container_child"> </a>
													<?php $terms = get_the_tags(); ?>
													<?php if ( ! empty( $terms ) ) { ?>
														<?php if ( is_array( $terms ) && ! empty( $terms ) ) { ?>
															<div class="chi-category text-uppercase chi-media-container_child">
																<?php $url = get_tag_link( $terms[0]->term_id ); ?>
																<a href="<?php echo $url; ?>"
																   class="chi-category__link"><?php echo $terms[0]->name; ?></a>
															</div>
														<?php } ?>
													<?php } ?>
													<div class="chi-tag text-uppercase chi-media-container_child">
														<a href="<?php echo get_permalink(); ?>"
														   class="chi-tag_link"><?php echo chi_video_time()[0]; ?></a>
													</div>
												</div>
												<div class="media-body">
													<a href="<?php echo get_permalink(); ?>"><h5
																class="mt-0 chi-sub-title"><?php the_title(); ?></h5>
													</a>
													<time class="chi-time"
														  datetime><?php the_time( get_option( "date_format" ) ); ?></time>
												</div>
											</div>
										</div>
										<?php $i ++; endwhile;
									wp_reset_postdata();
								else: ?>
									<?php $show_diw = 0; ?>
								<?php endif; ?>
						</div>
						<a href="<?php echo $video ?>" class="chi-more-videos-btn">
		<span class="chi-more-videos-btn__text">
			<?php _e( "Další videa" ) ?>
		</span>
						</a>
					</div>
				<?php } ?>
				<div class="others-articles">
					<?php if ( have_posts() ) : ?>
						<div class="d-flex h-20 <?php if ( $url_segments[1] == "video" and $all_video ) {
							echo "mt-5";
						} ?>">
							<div class="chi-tag text-uppercase mr-auto p-2">
								<span class="chi-tag_link" id="ostatni-clanky"><?php echo $alert ?></span>
							</div>
						</div>
						<hr class="divider mt-0"/>
						<ul class="list-unstyled">
							<?php while ( have_posts() ) : the_post() ?>
								<li class="media">
									<div class="image-credit-wrapper chi-othes-articles">
										<?php $terms = get_the_tags(); ?>
										<?php if ( ! empty( $terms ) ) { ?>
											<?php if ( is_array( $terms ) && ! empty( $terms ) ) { ?>
												<?php $url = get_tag_link( $terms[0]->term_id ); ?>
												<div class="image-credit chi-category-credit">
													<a href="<?php echo $url; ?>"
													   class="chi-category__link"><?php echo $terms[0]->name; ?></a>
												</div>
											<?php } ?>
										<?php } ?>
										<a href="<?php echo get_permalink(); ?>"><?php the_post_thumbnail() ?></a>
									</div>
									<div class="media-body ">
										<a href="<?php echo get_permalink(); ?>"><h5
													class="mt-0 mb-1 card-title chi-card-title"><?php the_title() ?></h5>
										</a>
										<?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name", get_the_ID() ); ?>
										<strong class="chi-name-title"><?php echo has_title_meta_box( $chi_title_meta_box ) ?>
											<time class="chi-time"><?php the_time( get_option( "date_format" ) ) ?></time>
										</strong>
										<p class="chi-card-text"><?php echo excerpt( 30 ) ?></p>
									</div>
								</li>
							<?php endwhile ?>
						</ul>
						<?php echo '<nav class="d-flex justify-content-end"><ul class="pagination chi-pagination">'; ?>
						<?php echo get_pagination_links(); ?>
						<?php echo '</ul></nav>'; ?>
					<?php else : ?>

					<?php endif ?>
				</div>
			</div>
			<div class="col-md-3 mt-30px">
				<div class="advertisment-col">
					<div class="d-flex h-20">
						<div class="chi-tag text-uppercase mr-auto p-2">
							<span class="chi-tag_link">Zpravodajství z kongresů</span>
						</div>
					</div>
					<hr class="divider mt-0"/>
					<?php
						$terms = get_terms( array(
								'taxonomy'   => 'congress',
								'hide_empty' => false,
								'slug'       => 'kardiovaskularni-zpravodajstvi'
						) );

						$kvaz_id = $terms[0]->term_taxonomy_id;

						$kavaz_sub_term_id = get_term_children( $kvaz_id, 'congress' );
						$kavaz_childs      = get_terms( 'congress', array(
								'hide_empty' => false,
								'hide_empty' => 0,
								'parent'     => $kvaz_id,
								'exclude'    => array( 51 ),
						) );
					?>
					<?php if ( $kavaz_childs && ! empty( $kavaz_childs ) ) { ?>
						<ul class="news-from-congress-container">
							<?php foreach ( $kavaz_childs as $kavaz_child ) { ?>
								<li class="news-from-congress__item">
									<a href="<?php echo get_term_link( $kavaz_child->term_id ) ?>">
										<?php echo $kavaz_child->name; ?>
									</a>
								</li>
							<?php } ?>
						</ul>
					<?php } ?>
					<?php get_template_part( "assets/aside/chi-aside-category" ); ?>
				</div>
			</div>
		</div>
		<div class="container chi-bg-white">
			<?php get_template_part( "chi-horizontal-advertising" ); ?>
		</div>
	</div>
</main>
<footer class="container">
	<?php get_template_part( "chi-footer-content" ); ?>
</footer>
<?php get_footer(); ?>
<?php wp_footer(); ?>
