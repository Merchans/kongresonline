<?php
chi_all_headers();
wp_head();
$taxonomiUrl = array_filter(explode("/", $_SERVER['REQUEST_URI']));
?>
<main>
    <div class="container">
        <p class="chi-resolution-sentens mt-5">Články a videa Kongresonline.cz</p>
        <div class="row">
            <div class="col-md-9 mt-3">
                <div class="others-articles">
                    <ul class="list-unstyled">
                        <?php if(have_posts()) : ?>
                            <?php while(have_posts()) : the_post() ?>
                                <li class="media">
									<div class="image-credit-wrapper chi-othes-articles">
                                    <span class="image-credit chi-category-credit">
                <a href="<?php echo get_chi_make_specilal_form_category() ?>" class="chi-category__link"><?php echo get_the_category()[0]->slug; ?></a>
            </span>
										<a href="<?php echo get_chi_make_specilal_form_category() ?>">  <?php 	if (has_post_thumbnail()) { the_post_thumbnail( 'full' ); } ?></a>
										</div>
                                    <div class="media-body ">
                                        <a href="<?php the_permalink() ?>"><h5 class="mt-0 mb-1 card-title chi-card-title"><?php the_title() ?></h5></a>
                                        <strong class="chi-name-title"><?php if( has_title_meta_box("") ) { echo has_title_meta_box($chi_title_meta_box); }; ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?></time></strong>
										<p class="chi-card-text"><?php echo excerpt(30); ?></p>
                                    </div>
                                </li>
                            <?php endwhile ?>
                        <?php else : ?>

                        <?php endif ?>
                    </ul>
                </div>
                <div class="others-articles mt-3">
                    <?php get_template_part("chi-blog-pages"); ?>
                </div>
            </div>
            <?php get_template_part("assets/aside/chi-aside"); ?>
        </div>
    </div>
    </div>
</main>
<footer class="single container">
    <?php get_template_part("chi-footer-content"); ?>
</footer>
<?php
get_footer();
wp_footer();
?>
