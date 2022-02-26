<?php /* Template Name: Přístup odepřen*/

chi_all_headers();
wp_head();

?>
<body>
<?php wp_body_open(); ?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12 chi-mt-1">
	            <?php if ( have_posts() ) : ?>
		            <?php while ( have_posts() ) : the_post() ?>
					<?php the_title('<div class="chi-404-title">', '</div>'); ?>
					<?php the_content('<div class="chi-404-text">', '</div>'); ?>
		            <?php endwhile ?>
	            <?php else : ?>

	            <?php endif ?>
            </div>
			<div class="chi-mt-1"></div>
        </div>
    </div>
    </div>
</main>
<footer>
    <div class="container">
        <?php get_template_part("chi-footer-content");	?>
    </div>
</footer>
</body>
<?php

get_footer();
wp_footer();

?>