<?php
$id              = get_the_ID();
$posts_ids = get_post_meta( $id, "_chi_selected_articles_or_videoss", true );
if ( $posts_ids ) {
	$posts_args = array(
		"post_type" => array(
			"post",
		),
		"include"   => $posts_ids
	);
	$posts      = get_posts( $posts_args );
	foreach ( $posts as $post ) {
		if ( (string) $post->post_type == "post" ) {
			?>
			<div class="d-flex h-20">
				<div class="chi-tag text-uppercase mr-auto p-2">
					<a href="#" class="chi-tag_link">téma</a>
				</div>
			</div>
			<hr class="divider mt-0">
			<div class="card chi-card--borner-none chi-card">
				<div class="chi-box-1 chi-card--box-1"
				     style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url( $post->ID ) ?>) no-repeat top center; background-size: cover;">
					<a href="<?php echo get_permalink( $post->ID ) ?>" class="d-block w-100 h-100"></a>
					<div class="d-flex flex-row">
						<?php

						if ( ! empty( chi_video_time( $post->ID )[0] ) && isset( chi_video_time( $post->ID )[0] ) ) {
							?>
							<div class="chi-tag text-uppercase">
								<a href="<?php echo get_permalink( $post->ID ) ?>"
								   class="chi-tag_link"><?php echo chi_video_time( $post->ID )[0]; ?></a>
							</div>
							<?php
						}

						?>
						<div class="chi-category text-uppercase">
							<a href="<?php echo get_chi_make_specilal_form_category( $post->ID ); ?>"
							   class="chi-category__link"><?php echo get_the_category( $post->ID )[0]->slug ?></a>
						</div>
					</div>
				</div>
				<div class="card-body chi-card-body">
					<a href="<?php echo get_permalink( $post->ID ) ?>">
						<?php if ( is_automat_nbsp_active() ) : ?>
							<h6 class="card-title chi-card-title"><?php echo add_nbsp( $post->post_title,
									false ) ?></h6>
							<strong class="chi-name-title"><?php echo add_nbsp( get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name",
									$post->ID ), false )?>
								<time class="chi-time" datetime> <?php echo get_the_date( get_option( 'date_format' ),
										$post->ID ) ?></time>
							</strong>
						<?php else : ?>
							<h6 class="card-title chi-card-title"><?php echo $post->post_title ?></h6>
							<strong class="chi-name-title"><?php echo get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name",
									$post->ID )?>
								<time class="chi-time" datetime> <?php echo get_the_date( get_option( 'date_format' ),
										$post->ID ) ?></time>
							</strong>
						<?php endif ?>
					</a>
					<p class="chi-card-text"><?php echo excerpt( 30, $post->ID ); ?></p>
				</div>
			</div>
			<?php
		}
	}
}