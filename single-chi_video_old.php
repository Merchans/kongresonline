<?php
chi_all_headers();
wp_head();
?>
	<style>
		.navbar-collapse {
			justify-content: flex-end;
		}

		footer {
			background: none;
		}
		main
		{
			margin-bottom: 0;
		}
		h3
		{
			font-weight: normal;
			font-size: 1.4em;
		}
	</style>
	<style>
		.nv-post-navigation,
		.nv-single-post-wrap .nv-tags-list,
		.nv-single-post-wrap .nv-thumb-wrap {
			margin-bottom: 20px
		}

		.nv-single-post-wrap .entry-header:first-child,
		.nv-single-post-wrap .nv-content-wrap:first-child,
		.nv-single-post-wrap .nv-post-navigation:first-child,
		.nv-single-post-wrap .nv-tags-list:first-child,
		.nv-single-post-wrap .nv-thumb-wrap:first-child {
			margin-top: 30px
		}

		.single-post-container .title {
			margin-bottom: 0
		}

		.attachment-neve-blog {
			display: flex
		}

		.nv-post-navigation {
			display: flex;
			justify-content: space-between
		}

		.nv-post-navigation .next a:hover,
		.nv-post-navigation .previous a:hover {
			text-decoration: none
		}

		.nv-post-navigation .next a:hover span:not(.nav-direction),
		.nv-post-navigation .previous a:hover span:not(.nav-direction) {
			text-decoration: underline
		}

		.nv-post-navigation .next .nav-direction,
		.nv-post-navigation .previous .nav-direction {
			color: #676767;
			display: flex;
			flex-direction: column;
			font-size: 1em;

		}

		.nv-post-navigation .next {
			margin-left: auto;
			text-align: right
		}

		.nv-content-wrap .page-numbers {
			justify-content: center;
			margin: 10px auto;
			display: flex;
			flex-wrap: wrap;
			padding-left: 0;
			list-style-type: none
		}

		.nv-content-wrap .page-numbers>a:not(:last-child) span,
		.nv-content-wrap .page-numbers>span {
			padding-right: 20px
		}

		.post-password-form {
			margin-bottom: 40px;
			text-align: center
		}

		.post-password-form input[type=submit] {
			height: 39px;
			margin-left: 10px
		}

		.post-password-form label {
			margin-bottom: 0
		}

		.post-password-form p {
			display: flex;
			justify-content: center;
			align-items: center
		}

		.post-password-form label>input {
			margin-left: 10px
		}

		.nv-tags-list {
			font-size: .85em
		}

		.nv-tags-list span {
			margin-right: 10px
		}

		.nv-tags-list a {
			display: inline-block;
			padding: 2px 10px;
			transition: all .3s ease;
			border-radius: 3px;
			margin-bottom: 10px;
			margin-right: 10px;
			border: 1px solid #0366d6;
			color: #0366d6
		}

		.nv-tags-list a:hover {
			background: #0366d6;
			border-color: #0366d6;
			color: #fff
		}

		#comments {
			border-top: 1px solid #f0f0f0;
			margin-top: 10px
		}

		#comments ol {
			list-style: none
		}

		#comments ol>ol {
			padding-left: 10px
		}

		#comments .nv-content-wrap ol {
			list-style-type: decimal
		}

		#comments .nv-comments-list>li {
			padding: 10px 0 0
		}

		#comments .children>li {
			margin-top: 20px;
			padding-top: 20px
		}

		#comments .edit-reply {
			margin-top: 20px;
			display: flex;
			justify-content: space-between;
			font-size: .85em
		}

		#comments .edit-reply .nv-reply-link {
			margin-left: auto
		}

		.nv-comments-list {
			padding-bottom: 20px
		}

		.nv-comments-title-wrap {
			margin: 40px 0 60px
		}

		.nv-comment-article {
			padding-bottom: 20px;
			border-bottom: 1px solid #f0f0f0
		}

		.nv-comment-header {
			display: flex;
			align-items: center;
			text-transform: none;
			font-style: normal;
			font-size: .85em;
			margin-bottom: 20px
		}

		.nv-comment-header .comment-author {
			display: flex;
			flex-direction: column
		}

		.nv-comment-avatar {
			margin-right: 20px
		}

		.nv-comment-avatar>img {
			float: left;
			border-radius: 50%
		}

		.comment-author .author {
			font-weight: 700;
			text-transform: uppercase
		}

		#comments input:not([type=submit]):not([type=checkbox]) {
			width: 100%
		}

		#comments textarea {
			width: 100%;
			max-width: 100%;
			min-width: 100%
		}

		#comments .comment-respond {
			margin: 40px 0
		}

		#comments .comment-reply-title small {
			float: right
		}

		.comment-form {
			display: grid;
			grid-column-gap: 20px;
			grid-row-gap: 20px
		}

		.comment-form>p:not(.comment-notes) {
			margin-bottom: 0
		}

		.comment-form label {
			margin-bottom: 10px;
			display: inline-block
		}

		.chi-other-text a
		{
			width: 275px;
			height: 59px;
			font-style: normal;
			font-weight: bold;
			font-size: 18px;
			line-height: 26px;
			color: #000000;
		}

	</style>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post() ?>
	<?php $categories = get_the_category()[0]->name; $post_type = "chi_video";?>
	<?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
	<main>

		<div class="container">
			<div class="row">
				<div class="col-md-8 chi-video-section mt-4">
					<div class="chi-breadcrump-navigation">
						<p>
							<strong>
								<a href="<?php echo get_post_type_archive_link( $post_type ); ?>"><?php echo get_chi_print_cp_lables() ?></a>
							</strong> >
							<strong>
								<a href="<?php echo get_chi_make_specilal_form_category() ?>"><?php echo $categories ?></a>
							</strong>
							> <?php the_title();?>
						</p>
					</div>
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
					<strong class="chi-name-title"><?php if (!empty($chi_title_meta_box) && $chi_title_meta_box != ""){ echo $chi_title_meta_box; } ?> <time class="chi-time">-<?php the_time(get_option("date_format"))?></time></strong>
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
					<div class="nv-post-navigation">
                        <?php previous_post_link('<div class="previous"><span class="nav-direction">Předchozí video</span><span class="chi-other-text">%link</span></a></div>', '%title', true) ?>
                        <?php next_post_link('<div class="next"><span class="nav-direction">Následující video</span><span class="chi-other-text">%link</span></a></div>', '%title', true) ?>
					</div>
					<div class="others-articles">
						<div class="d-flex h-20 mt-5">
							<div class="chi-tag text-uppercase mr-auto p-2">
								<a href="#" class="chi-tag_link">podobné VIDEA</a>
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
										<div class="d-flex flex-row align-items-end chi-video-img justify-content-end" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">
											<div class="chi-tag text-uppercase mr-0">
												<a href="<?php echo get_permalink(); ?>" class="chi-tag_link"><?php echo chi_video_time()[0];  ?></a>
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
				<div class="col-md-4 mt-5">
					<div class="advertisment-col">
						<div class="d-flex h-20">
							<div class="chi-tag text-uppercase mr-auto p-2">
								<a href="#" class="chi-tag_link">REKLAMNÍ SDĚLENÍ</a>
							</div>
						</div>
						<hr class="divider mt-0">
                        <?php

                        $id = get_the_ID();
                        $advertising_ids = get_post_meta( $id, "_chi_advertising_verticals");
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

                    $id              = get_the_ID();
                    $close_end       = false;
                    $advertising_ids = get_post_meta($id, "_chi_selected_articles_or_videoss");
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
								<a href="#" class="chi-tag_link">témata</a>
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
											<strong class="chi-name-title"><time class="chi-time" datetime><?php echo get_the_date(get_option( 'date_format' ), $advert->ID )  ?></time></strong>
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
										<a href="#" class="chi-tag_link">VIDEO</a>
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
													<a href="#" class="chi-tag_link"><?php echo chi_video_time($advert->ID)[0]; ?></a>
												</div>
                                                <?php
                                            }

                                            ?>
											<div class="chi-category text-uppercase">
												<a href="<?php echo get_chi_make_specilal_form_category($advert->ID); ?>" class="chi-category__link"><?php echo get_the_category($advert->ID)[0]->slug ?></a>
											</div>
										</div>
									</div>
									<div class="card-body chi-card-body">
										<a href="<?php echo get_permalink($advert->ID)  ?>"><h6 class="card-title chi-card-title"><?php echo $advert->post_title ?></h6></a>
										<strong class="chi-name-title"><?php echo get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name", $advert->ID)?><time class="chi-time" datetime> - <?php echo get_the_date(get_option( 'date_format' ), $advert->ID )  ?></time></strong>
										<p class="chi-card-text"><?php echo excerpt(30); ?></p>
									</div>
								</div>
                                <?php
                            }
                        }
                        }

                        ?>
						<!--	<div class="d-flex h-20">
                                            <div class="chi-tag text-uppercase mr-auto p-2">
                                                <a href="#" class="chi-tag_link">VIDEO</a>
                                            </div>
                                        </div>
                                        <hr class="divider mt-0">-->
						<!--<div class="card chi-card--borner-none chi-card">
                            <div class="chi-box-1 chi-card--box-1">
                                <div class="d-flex flex-row">
                                    <div class="chi-tag text-uppercase">
                                        <a href="#" class="chi-tag_link">2:23</a>
                                    </div>
                                    <<div class="chi-category text-uppercase">
                                                <a href="#" class="chi-category__link">dianews.cz</a>
                                            </div>
                                </div>
                            </div>
                            <div class="card-body chi-card-body">
                                <h5 class="card-title chi-card-title">Pozor na méně obvyklé příčiny komplikací diabetu</h5>
                                <strong class="chi-name-title">prof. MUDr. Štěpán Svačina, DrSc., MBA <time class="chi-time" datetime="2019-09-29 00:00">-29&nbsp;září,&nbsp;2019</time></strong>
                                <p class="chi-card-text">Diabetes je chronické onemocnění, které je zatíženo celou řadou kardiovaskulárních i jiných komplikací. Nemocné velmi často trápí mnoho komorbidit</p>
                            </div>
                        </div>
                    </div>-->
					</div></div>
	</main>
    <?php endwhile ?>
<?php else : ?>

<?php endif ?>
	<footer>
		<div class="container">
			<div class="container chi-hr mt-25 chi-pt-5"></div>
			<div class="chi-footer-webpage-info">
				<p>© 2019 CZECH HEALTH INTERACTIVE</p>
				<p><a href="#">Podmínky užití</a> | <a href="#">Sponzoři</a></p>
			</div>
		</div>
	</footer>
<?php
get_footer();
wp_footer();

?>
