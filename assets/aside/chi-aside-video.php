<?php
if ( $args['is_single'] ) {
	$videos_ids = get_post_meta( $args['content_id'], "_chi_selected_articles_or_videoss", true );
}
else {
	$videos_ids = get_term_meta( $args['content_id'], "chi_selected_thems_in_category", true );
}

if ( $videos_ids ) {
	$videos_args = array(
		"post_type" => array(
			"chi_video",
		),
		"include"   => $videos_ids
	);
	$videos      = get_posts( $videos_args );
	foreach ( $videos as $video ) {
		if ( (string) $video->post_type == "chi_video" ) {
			?>
			<div class="d-flex h-20">
				<div class="chi-tag text-uppercase mr-auto p-2">
					<a href="#" class="chi-tag_link">VIDEO</a>
				</div>
			</div>
			<hr class="divider mt-0">
			<div class="card chi-card--borner-none chi-card">
				<div class="chi-box-1 chi-card--box-1"
					 style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url( $video->ID ) ?>) no-repeat top center; background-size: cover;">
					<a href="<?php echo get_permalink( $video->ID ) ?>" class="d-block w-100 h-100"></a>
					<div class="d-flex flex-row">
						<?php

						if ( ! empty( chi_video_time( $video->ID )[0] ) && isset( chi_video_time( $video->ID )[0] ) ) {
							?>
							<div class="chi-tag text-uppercase">
								<a href="<?php echo get_permalink( $video->ID ) ?>"
								   class="chi-tag_link"><?php echo chi_video_time( $video->ID )[0]; ?></a>
							</div>
							<?php
						}
						?>
						<div class="chi-category text-uppercase">
							<a href="<?php echo get_chi_make_specilal_form_category( $video->ID ); ?>"
							   class="chi-category__link"><?php echo get_the_category( $video->ID )[0]->slug ?></a>
						</div>
					</div>
				</div>
				<div class="card-body chi-card-body">
					<a href="<?php echo get_permalink( $video->ID ) ?>">
						<?php if ( is_automat_nbsp_active() ) : ?>
							<h6 class="card-title chi-card-title"><?php echo add_nbsp( $video->post_title,
									false ) ?></h6>
							<strong class="chi-name-title"><?php echo add_nbsp( get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name",
									$video->ID ), false ) ?>
								<time class="chi-time" datetime> <?php echo get_the_date( get_option( 'date_format' ),
										$video->ID ) ?></time>
							</strong>
						<?php else : ?>
							<h6 class="card-title chi-card-title"><?php echo $video->post_title ?></h6>
							<strong class="chi-name-title"><?php echo get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name",
									$video->ID ) ?>
								<time class="chi-time" datetime> <?php echo get_the_date( get_option( 'date_format' ),
										$video->ID ) ?></time>
							</strong>
						<?php endif ?>
					</a>
					<p class="chi-card-text"><?php echo excerpt( 30, $video->ID ); ?></p>
				</div>
			</div>
			<?php
		}
	}
}