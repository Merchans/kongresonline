<?php /* Template Name: Všechny speciály */
chi_all_headers();
wp_head();
?>
<style>
	.chi-card {
		/* Add shadows to create the "chi-card" effect */
		box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
		transition: 0.3s;
		height: 300px;
		text-align: center;
		margin: 30px 0;
	}

	/* On mouse-over, add a deeper shadow */
	.chi-card:hover {
		box-shadow: 0 8px 16px 0 rgba(0, 0, 0, 0.2);
	}

	/* Add some padding inside the chi-card container */
	.chi-card-container {
		padding: 2px 16px;
		text-align: justify;
	}

	.chi-flex {
		display: flex;
		justify-content: space-between;
	}

	a:hover {
		text-decoration: none;
	}
</style>
<main>
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) :
    the_post() ?>
	<div class="container">
		<div class="row">
			<div class="col-md-12 chi-mt-1">
                <?php the_content(); ?>
				<div class="chi-mt-1"></div>
			</div>
		</div>
		<div class="chi-mt-1"></div>
		<div class="container">
			<div class="row">
                <?php
                $categories = get_categories();

                foreach ($categories as $category) {
                    $url = get_home_url() . '/' . $category->slug;

                    if ($category->term_id != 1) {
                        $imgId = get_term_meta($category->term_id, "category-image-id")[0] ? get_term_meta($category->term_id, "category-image-id")[0] : "";
                        $bg    = get_term_meta($category->term_id, "category-backgound-id")[0] ? get_term_meta($category->term_id, "category-backgound-id")[0] : "";

                        if (isset($imgId) && $imgId != "") {
                            $imgId = wp_get_attachment_image_src($imgId, "small")[0] ? wp_get_attachment_image_src($imgId, "small")[0] : "";
                            $bg    = wp_get_attachment_image_src($bg, "small")[0] ? wp_get_attachment_image_src($bg, "small")[0] : "";
                            ?>
							<div class="col-md-4 col-6">
							<a href="<?php echo $url ?>" class="chi-category-color"
							   title="<?php echo $category->name; ?>">
								<div class="chi-card p-20"
									 style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.34), rgba(0, 0, 0, 0.34)),  url(<?php echo $bg ?>) no-repeat center center; background-size: cover;">

									<img src="<?php echo $imgId; ?>">

                                    <?php
                                    $description_category = category_description($category->term_id);
                                    if (isset($description_category) && ! empty($description_category)) {
                                        ?>
										<div class="chi-card-container white-color">
                                            <?php echo wp_trim_words($description_category, 17, '...'); ?>
										</div>
                                        <?php
                                    }
                                    ?>
								</div>
							</a>
							</div>
                            <?php
                        } else {
                            ?>
				<div class="col-md-4 col-6">
							<a href="<?php echo $url ?>" class="chi-category-color"
							   title="<?php echo $category->name; ?>">
								<div class="chi-card p-20">
									<h3><?php echo $category->name ?></h3>
                                    <?php
                                    $description_category = category_description($category->term_id);
                                    if (isset($description_category) && ! empty($description_category)) {
                                        ?>
										<div class="chi-card-container white-color">
                                            <?php echo wp_trim_words($description_category, 17, '...'); ?>
										</div>
                                        <?php
                                    }
                                    ?>
								</div>
							</a>
				</div>
                            <?php
                        }
                    }
                }
                ?>
			</div>
		</div>
        <?php endwhile ?>
        <?php else : ?>

        <?php endif ?>
</main>
<footer class="container">
    <?php get_template_part("chi-footer-content"); ?>
</footer>
<?php

get_footer();
wp_footer();

?>
