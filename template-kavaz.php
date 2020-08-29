<?php  /* Template Name: Kavaz spravodajstvo */ ?>
<?php  wp_head(); ?>
<?php get_header( 'category' ); ?>
<?php get_template_part("chi-category-nav-content"); ?>
<?php



$active_article =  "";
$active_video =  "";
$url_segments = array_filter(explode("/", $_SERVER['REQUEST_URI']));
$only_articles = ($_SERVER['REQUEST_URI']);

if (strpos($only_articles, "?clanky-a-reportaze"))
{
    $active_article = "chi-active";
}

// From url get ID category
$args_one_video_or_post = array("post_type" => array("chi_video", "post"), "posts_per_page" => 1, "category_name" => 'kardiovaskularni-zpravodajstvi', "post_status" => "publish");
$first_video_or_post_or_post = new  WP_Query($args_one_video_or_post);

$chi_special_logo = wp_get_attachment_image_src (  get_term_meta ( 17, "category-image-id", true ), 'full')[0];

$args_two_posts = array("post_type" => array("post", "chi_video"), "posts_per_page" => 2, "category_name" => 'kardiovaskularni-zpravodajstvi', "post__not_in" => $first_video_or_post_or_post->posts[0]->ID );
?>

<style>
    .navbar-collapse {
        justify-content: flex-end;
    }

	main
	{
		margin-bottom: 0;
	}

	.mt-25{
		margin: 0;
	}

	.chi-category-logo-center
	{
		width: 500px;
	}

	@media (max-width: 500px)
	{
		.chi-category-logo-center
		{
			width: 100%;
		}
	}

</style>

<body class="chi-claim--kavaz">
<div class="chi-category-logo-center mb-3">
    <a href="<?php  echo get_category_link( 17 ) ?>">
        <img src="<?php echo $chi_special_logo ?>" />
    </a>
</div>
<div class="chi-info-text white-color">
    <?php echo category_description( 17 ); ?>
</div>
<main>
	<div class="container chi-bg-white">
		<div class="row row--white">
			<div class="col-md-12 chi-video-section mt-30px">
				<div class="others-articles">
					<div class="d-flex h-20">
						<div class="chi-tag text-uppercase mr-auto p-2">
							<span  class="chi-tag_link"><?php _e( 'Kongresy', 'chi-templates' ); ?></span>
						</div>
					</div>
					<hr class="divider mt-0 mb-0" />
					<div class="row">
                        <?php
                        $terms = get_terms( array(
                            'taxonomy' => 'congress',
                            'hide_empty' => false,
                            'slug'	=> 'kardiovaskularni-zpravodajstvi'
                        ) );

                        $kvaz_id = $terms[0]->term_taxonomy_id;

                        $kavaz_sub_term_id = get_term_children($kvaz_id, 'congress');
                        $kavaz_childs = get_terms( 'congress', array(
                            'hide_empty' => false,
                            'hide_empty' => 0,
                            'parent' => $kvaz_id,
                        ) );
                        $colors_class =  array("congress-box--purple", "congress-box--orange", "congress-box--gray", "congress-box--dark-blue", "congress-box--blue", "congress-box--green"  );
                        ?>
                        <?php if ( $kavaz_childs && !empty($kavaz_childs)) { $i = 0;?>
                                <?php  foreach ($kavaz_childs as $kavaz_child) { ?>
									<div class="col-sm-12 col-md-6 col-lg-4 col--3n2">
										<div class="congress-box  <?php
												if ($colors_class[$i])
												{
													echo $colors_class[$i];
												}
												else
												{
													echo "congress-box--purple";
												}
												$i++;
										?>">
											<h1 class="chi-title-white chi-title-white--fz30 chi-title-white--mb-20"><a class="chi-title-white" href="<?php echo get_term_link($kavaz_child->term_id) ?>"><?php echo $kavaz_child->name; ?></a></h1>
											<p class="chi-kavaz-text chi-kavaz-text--w-292">
                                                <?php echo get_term($kavaz_child->term_id)->description  ?>
											</p>
											<div class="chi-btn-kavaz">
												<a href="<?php echo get_term_link($kavaz_child->term_id) ?>" class="chi-btn-kavaz_link kavaz_link--white"><?php _e("Zobrazit všechny příspěvky", "chi"); ?></a>
											</div>
										</div>
									</div>
                                <?php }?>
                        <?php }?>
					</div>
				</div>
			</div>
		</div>
		<div class="chi-bg-white">
            <?php  get_template_part("chi-horizontal-advertising"); ?>
		</div>
	</div>
</main>
<footer class="container chi-bg-white">
    <?php get_template_part("chi-footer-content"); ?>
</footer>
<?php get_footer(); ?>
<?php wp_footer(); ?>



