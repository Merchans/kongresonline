<?php
	$category_slug = get_the_category()[0]->slug;
	$category_ID   = get_the_category()[0]->term_id;
	$article       = get_site_url() . "/" . $category_slug;
	$video         = get_site_url() . "/video/" . $category_slug;

	$active_article = "";
	$active_video   = "";
	$url_segments   = array_filter( explode( "/", $_SERVER['REQUEST_URI'] ) );
	$only_articles  = ( $_SERVER['REQUEST_URI'] );

	if ( strpos( $only_articles, "?clanky-a-reportaze" ) ) {
		$active_article = "chi-active";
	}

	$alert     = __( "všechna videa", "chi" );
	$all_video = is_integer( strpos( $only_articles, "?clanky-a-reportaze" ) );

	$show_div = 0;

	global $not_in_main_loop;
	global $chi_option;

	if ($chi_option == 3) {
		$not_in_main_loop = get_term_meta($category_ID, 'chi_selected_in_claim_posts', true);
	}


//	$not_in_main_loop = chi_claims();

	if ( ( get_term_meta( $category_ID, '_chi_selected_one_options' )[0] ) == 3 ) {
		$not_in_main_loop = get_term_meta( $category_ID, 'chi_selected_in_claim_posts', true );
	}


	$args_three_posts      =
			array(
					"post_type"      => array( "chi_video", "post" ),
					"posts_per_page" => 3,
					"category_name"  => $category_slug,
					"post_status"    => "publish"
			);

	$video_and_post_not_in = new  WP_Query( $args_three_posts );

	$post__not_in = array();

	foreach ( $video_and_post_not_in->posts as $id ) {
		$post__not_in[] = $id->ID;
	}

	wp_reset_query();

	$args_all_videos       =
			array(
					"post_type"     => array( "chi_video" ),
					"post__not_in"  => $post__not_in,
					"category_name" => $category_slug,
					"post_status"   => "publish"
			);
	$video_and_post_not_in = new  WP_Query( $args_all_videos );
	global $ids_not_in_main_loop;
	if ($chi_option == 3) {
		$ids_not_in_main_loop = get_term_meta($category_ID, 'chi_selected_in_claim_posts', true);
	}


?>
<?php if ( $url_segments[1] != "video" and ! $all_video ) {

	$args_one_offset_video = array(
			"post_type"      => array( "chi_video" ),
			"posts_per_page" => 1,
			"category_name"  => $category_slug,
			"post_status"    => "publish",
			"post__not_in"   => $ids_not_in_main_loop

	);
	$category_posts        = new WP_Query( $args_one_offset_video );
	$chi_add_claims        = array_merge( chi_claims(), wp_list_pluck( $category_posts->posts, "ID" ) );
	$chi_title_meta_box    = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name" );

	?>
	<?php

	$args           = array(
			'post_type'      => 'chi_video',
			'post__not_in'   => $post__not_in,
			'posts_per_page' => 4,
			"category_name"  => $category_slug,
	);
	if ( $category_posts->have_posts() ) :
		$i = 2;
		$categories = get_the_category()[0]->slug;
		while ( $category_posts->have_posts() ) :
			$category_posts->the_post();
			$first_video_in_video_section_id= get_the_ID();

			?>
			<div class="d-flex h-20">
				<div class="chi-tag text-uppercase mr-auto p-2">
					<span class="chi-tag_link">
						<?php _e( "VIDEA", "chi" ) ?>
					</span>
				</div>
			</div>
			<hr class="divider mt-0">
			<div class="row">
			<?php
			if ( count( get_posts( $args ) ) == 1 ) {
				$show_div = 1;
				if ($chi_option == 2 or $chi_option == 1 ) {
					$show_div = 0;
				}
				get_template_part( 'assets/claims/one-video' );
			}

			if ( count( get_posts( $args ) ) == 2 ) {
				$show_div = 1;
				get_template_part( 'assets/claims/two-videos' );
			}
			if ( count( get_posts( $args ) ) == 3 ) {
				$show_div = 1;
				get_template_part( 'assets/claims/three-videos' );
			}

			if ( count( get_posts( $args ) ) > 3 ) {
				$show_div = 1;
				?>
				<div class="col-md-6">
					<div class="card chi-card--borner-none chi-card">
						<div class="chi-box-1 chi-card--box-1"
							 style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat  top center; background-size: cover;">
							<a href="<?php echo get_permalink() ?>" class="d-block w-100 h-100"></a>
							<div class="d-flex flex-row">
								<div class="chi-tag text-uppercase">
									<a href="<?php echo get_permalink() ?>"
									   class="chi-tag_link"><?php echo chi_video_time()[0] ?></a>
								</div>
								<?php $terms = get_the_tags(); ?>
								<?php if ( is_array( $terms ) && ! empty( $terms ) ) { ?>
									<?php $url = get_tag_link( $terms[0]->term_id ); ?>
									<div class="chi-category text-uppercase">
										<a href="<?php echo $url; ?>"
										   class="chi-category__link"><?php echo $terms[0]->name; ?></a>
									</div>
								<?php } ?>
							</div>
						</div>
						<div class="card-body chi-card-body">
							<?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name" ) ?>
							<a href="<?php echo get_permalink() ?>"><h5
										class="card-title chi-card-title"><?php the_title(); ?></h5>
							</a>
							<strong class="chi-name-title"><?php echo has_title_meta_box( $chi_title_meta_box ) ?>
								<time class="chi-time"><?php the_time( get_option( "date_format" ) ) ?></time>
							</strong>
							<p class="chi-card-text"><?php echo excerpt( 30 ); ?></p>
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<?php

						$ids_not_in_main_loop[] = $first_video_in_video_section_id;

						$args           = array(
								'post_type'      => 'chi_video',
								'post__not_in'   => $ids_not_in_main_loop,
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
												style="background: url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat  top center; background-size: cover;">

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
			<?php } ?>
			<?php if ( $video_and_post_not_in->post_count == 1 ): ?>
			</div>
		<?php endif; ?>
			<?php $i ++;endwhile;
		wp_reset_postdata();
	else: ?>
	<?php endif; ?>
	<?php if ( $video_and_post_not_in->post_count > 4 ): ?>
		<a href="<?php echo $video ?>" class="chi-more-videos-btn">
		<span class="chi-more-videos-btn__text">
			<?php _e( "Další videa" ) ?>
		</span>
		</a>
	<?php endif; ?>
	<?php if ( $show_div ) {
		?>
		</div>
		<?php
	} ?>
<?php } ?>

