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
            <?php if (have_posts()) : ?>
                <div class="col-md-9 chi-video-section mt-30px">
                    <div class="others-articles">
                        <div class="d-flex h-20 ">
                            <div class="chi-tag text-uppercase mr-auto p-2">
                                <span class="chi-tag_link" id="ostatni-clanky">ČLÁNKY A REPORTÁŽE</span>
                            </div>
                        </div>
                        <hr class="divider mt-0">
                        <ul class="list-unstyled">
                        <?php while (have_posts()) : the_post() ?>
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
                                <div class="media-body ">
                                    <a href="<?php echo get_permalink(); ?>"><h5
                                            class="mt-0 mb-1 card-title chi-card-title"><?php the_title() ?></h5>
                                    </a>
                                    <?php $chi_title_meta_box = get_post_field("doctoral_degrees_and_name_doctoral_degrees_and_name", get_the_ID() );	?>
                                    <strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?>
                                        <time class="chi-time"><?php the_time(get_option("date_format")) ?></time>
                                    </strong>
                                    <p class="chi-card-text"><?php echo excerpt(25) ?></p>
                                </div>
                            </li>
                        <?php endwhile ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 mt-30px">
                    <div class="advertisment-col">
                        <div class="d-flex h-20">
                            <div class="chi-tag text-uppercase mr-auto p-2">
                                <span class="chi-tag_link">Zpravodajství z kongresů</span>
                            </div>
                        </div>
                        <hr class="divider mt-0" />
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
                        ?>
                        <?php if ( $kavaz_childs && !empty($kavaz_childs)) {?>
                            <ul class="news-from-congress-container">
                                <?php  foreach ($kavaz_childs as $kavaz_child) { ?>
                                    <li class="news-from-congress__item">
                                        <a href="<?php echo get_term_link($kavaz_child->term_id) ?>">
                                            <?php echo $kavaz_child->name; ?>
                                        </a>
                                    </li>
                                <?php }?>
                            </ul>
                        <?php }?>
                        <?php get_template_part("assets/aside/chi-aside-category"); ?>
                    </div>
                </div>
            <?php else : ?>

            <?php endif ?>
        </div>
        <div class="container chi-bg-white">
            <?php  get_template_part("chi-horizontal-advertising"); ?>
        </div>
    </div>
</main>
<footer class="container chi-bg-white">
    <?php get_template_part("chi-footer-content"); ?>
</footer>
<?php get_footer(); ?>
<?php wp_footer(); ?>



