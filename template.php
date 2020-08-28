<?php  /* Template Name: O nas */ ?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post() ?>
    <?php

    	the_title();
    ?>
    <?php endwhile ?>
<?php else : ?>

<?php endif ?>

<?php
$args = array(
    'post_type' => 'chi_video',
    'offset' => 2,
    'posts_per_page' => 3,
    "category_name" => $category,
);

$the_query = new WP_Query( $args );

if ( $the_query->have_posts() ) :
    $i = 0;  $categories = get_the_category()[0]->slug;
    while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
        <div class="<?php if ($i > 0)
        {echo 'mt-5';}
        ?>">
            <div class="media chi-media position-relative">
                <div class="d-flex flex-row align-items-end chi-media-img justify-content-between" style="background: url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">
                    <div class="chi-category text-uppercase">
                        <a href="#" class="chi-category__link"><?php echo $categories ?></a>
                    </div>
                    <div class="chi-tag text-uppercase">
                        <a href="<?php echo get_permalink(); ?>" class="chi-tag_link"><?php echo chi_video_time()[0];  ?></a>
                    </div>
                </div>
                <div class="media-body">
                    <a href="<?php echo get_permalink(); ?>"><h5 class="mt-0 chi-sub-title"><?php the_title();?></h5></a>
                    <time class="chi-time" datetime><?php the_date(); ?></time>
                </div>
            </div>
        </div>
        <?php $i++; endwhile; wp_reset_postdata();	else: ?>

    <p>Nenalezeno</p>

<?php endif; ?>
