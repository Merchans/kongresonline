<?php
chi_all_headers();
wp_head();
$num = 0;
?>
<main>
    <div class="container">
        <p class="chi-resolution-sentens mt-5">Články a videa Kongresonline.cz - výsledky vyhledávání pro "<?php echo $_GET['s'] ?>"</p>
        <?php
			$args = array( 'post_type' =>'post', 'posts_per_page' => -1,  "s" => $_GET["s"] );
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
			$num = $loop->post_count;
			endwhile;
        	wp_reset_postdata();
        ?>
		<?php
			if ($num == 1 )
			{ ?>
				<small class="chi-match-resolution">Nalezen článek</small>
				<?php
			}
			else if ($num > 4 )
			{ ?>
				<small class="chi-match-resolution">Nalezené články 1 až 4 z <?php echo $num  ?></small>
			<?php
			}
			else
			{
				?>
				<small class="chi-match-resolution">Nalezené články <?php echo $num  ?></small>
				<?php
			}
		?>
        <div class="row">
            <div class="col-md-9 mt-3">
                <div class="others-articles">
                    <ul class="list-unstyled">
						<?php

                        $args = array(
                            "post_type" => "post",
                            "posts_per_page" => 4,
                            "s"				=> $_GET["s"]

                        );

                        $loop = new WP_Query( $args );
                        while ( $loop->have_posts() ) : $loop->the_post();
                        ?>
						<?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
							<li class="media">
								<div class="image-credit-wrapper chi-othes-articles">
                                    <span class="image-credit chi-category-credit">
                <a href="<?php echo get_chi_make_specilal_form_category() ?>" class="chi-category__link"><?php echo get_the_category()[0]->name; ?></a>
            </span>
									<?php 	if (has_post_thumbnail()) { ?> <a href="<?php echo get_permalink() ?>"> <?php the_post_thumbnail( 'full' ); } ?> </a>
								</div>
								<div class="media-body ">
									<a href="<?php the_permalink() ?>"><h5 class="mt-0 mb-1 card-title chi-card-title"><?php the_title() ?></h5></a>
									<strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?><span class="reading-time"><?php echo display_read_time(); ?></span></time></strong>
									<p class="chi-card-text"><?php echo excerpt(30); ?></p>
								</div>
							</li>
						<?php endwhile;  wp_reset_postdata();  ?>
                    </ul>
                </div>
                <p class="chi-resolution-sentens mt-3 mb-3">Videa Kongresonline.cz - výsledky vyhledávání pro "<?php echo $_GET['s'] ?>"</p>
                <div class="row">
                    <?php

                    $args = array(
                        "post_type" => "chi_video",
                        "posts_per_page" => 4,
                        "s"				=> $_GET["s"]

                    );

                    $loop = new WP_Query( $args );
                    while ( $loop->have_posts() ) : $loop->the_post();
                    ?>
                    <div class="col-md-4">
                        <div class="chi-video-box">
                            <div class="chi-video position-relative">
                                <div class="d-flex flex-row align-items-end chi-media-img justify-content-between chi-media-container" style="background: linear-gradient(80deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">
									<a href="<?php echo get_permalink(); ?>" class="text-uppercase w-100 h-75 chi-media-container_child">
									</a>
									<div class="chi-category text-uppercase chi-media-container_child">
										<a href="<?php echo get_chi_make_specilal_form_category() ?>" class="chi-category__link"><?php echo get_the_category()[0]->name; ?></a>
									</div>
									<div class="chi-tag text-uppercase chi-media-container_child">
										<a href="<?php echo get_permalink(); ?>" class="chi-tag_link"><?php echo chi_video_time()[0];  ?></a>
									</div>
                                </div>
                            </div>
                            <div class="chi-video-body">
								<a href="<?php the_permalink() ?>"><h5 class="mt-0 chi-sub-title"><?php the_title() ?></h5></a>
								<time class="chi-time" ><?php the_time(get_option("date_format")); ?><span class="reading-time"><?php echo display_read_time(); ?></span></time>
                            </div>
                        </div>
                    </div>
                <?php endwhile; wp_reset_postdata();?>
				</div>
                <div class="others-articles mt-3">
					<ul class="list-unstyled">
                    <?php
                    	if ($num > 4){
                            $args = array(
                                "post_type" => "post",
                                'offset'	=>  4 + ( 10 * max( 0, get_query_var('paged') ) ),
                                "posts_per_page" => 10,
                                "s"				=> $_GET["s"],
                            );
                            $loop = new WP_Query( $args );
                            while ( $loop->have_posts() ) : $loop->the_post();

                    ?>
								<li class="media">
									<div class="image-credit-wrapper chi-othes-articles">
                                    <span class="image-credit chi-category-credit">
                <a href="<?php echo get_chi_make_specilal_form_category() ?>" class="chi-category__link"><?php echo get_the_category()[0]->name; ?></a>
            </span>
                                        <?php 	if (has_post_thumbnail()) { ?> <a href="<?php echo get_permalink() ?>"> <?php the_post_thumbnail( 'full' ); } ?> </a>
									</div>
									<div class="media-body ">
										<a href="<?php the_permalink() ?>"><h5 class="mt-0 mb-1 card-title chi-card-title"><?php the_title() ?></h5></a>
										<strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?>
                                        <span class="reading-time"><?php echo display_read_time(); ?></span>
                                        </time></strong>
										<p class="chi-card-text"><?php echo excerpt(30); ?></p>
									</div>
								</li>
					<?php endwhile; wp_reset_postdata(); } ?>
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
    <?php get_template_part("chi-footer-content");	?>
</footer>
<?php
get_footer();
wp_footer();
?>
