<?php
	global $ids_not_in_main_loop;
	$category_slug = get_the_category()[0]->slug;

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
			<div class="<?php if ( $i == 0 ) {
				echo 'col-md-12';
			} else{
				echo 'col-md-6';
			}
			?>">
				<div class="card chi-card--borner-none chi-card">
					<div class="chi-box-1 <?php if ( $i != 0 ) {
						echo 'chi-card--box-1';}
					?>"
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
							<time class="chi-time"><?php the_time( get_option( "date_format" ) ) ?>
								<span class="reading-time"><?php echo display_read_time(); ?></span>
							</time>
						</strong>
						<p class="chi-card-text"><?php echo excerpt( 30 ); ?></p>
					</div>
				</div>
			</div>
			<?php $i ++; endwhile;
		wp_reset_postdata();
	else: ?>
		<?php $show_div = 0; ?>
	<?php endif; ?>
