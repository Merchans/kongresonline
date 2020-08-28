<?php
chi_all_headers();
wp_head();
?>
<main>
    <div class="container">
        <div class="row">
            <div class="col-md-12 chi-mt-1">
                <h1 class="chi-404-title">Požadovaná stránka neexistuje</h1>
                <p class="chi-404-text">Hledáte stránku, která neexistuje. Možná tu dříve byla, možná jje použitý odkaz s chybnou adresou. Zkuste prosím znovu vyhledat podle klíčového slova, nebo přejděte do některé z našich oblíbených speciálů.</p>
                <div class="chi-mt-1"></div>
                <div class="chi-404-img">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/404.svg" alt="CHI 404">
                </div>
            </div>
        </div>
		<div class="chi-mt-1"></div>
		<div class="container">
		<div class="row">
                <?php
                $categories = get_categories();
                /*
                echo "<pre>";
                var_dump($categories);
                echo "</pre>";
                */
                foreach($categories as $category) {
                	if ($category->term_id != 1)
					{
                    	echo '<div class="chi-category-link"><a href="' . get_home_url() . '/' . $category->slug . '" class="chi-category-color">' . $category->name . '</a></div>';
                    }
                }
                ?>
		</div>
		</div>
		<!--
        <div class="row mt-25">
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li class="media chi-catagory-box">
                        <div class="image-credit-wrapper chi-category-info">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/media-obj.png">
                        </div>
                        <div class="chi-catagory-box ">
                            <a href="#" class="chi-category-link chi-category-body">Kardiorok.cz</a>
                        </div>
                    </li>
                    <li class="media chi-catagory-box">
                        <div class="image-credit-wrapper chi-category-info">

                            <img src="<?php echo get_template_directory_uri(); ?>/img/media-obj-2.png">
                        </div>
                        <div class="chi-catagory-box">
                            <a href="#" class="chi-category-link chi-category-body">Kardiorok.cz</a>
                        </div>
                    </li>
                    <li class="media chi-catagory-box">
                        <div class="image-credit-wrapper chi-category-info">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/media-obj-3.png">
                        </div>
                        <div class="chi-catagory-box">
                            <a href="#" class="chi-category-link chi-category-body">Kardiorok.cz</a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-unstyled">
                    <li class="media chi-catagory-box">
                        <div class="image-credit-wrapper chi-category-info">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/media-obj.png">
                        </div>
                        <div class="chi-catagory-box ">
                            <a href="#" class="chi-category-link chi-category-body">Kardiorok.cz</a>

                        </div>
                    </li>
                    <li class="media chi-catagory-box">
                        <div class="image-credit-wrapper chi-category-info">

                            <img src="<?php echo get_template_directory_uri(); ?>/img/media-obj-2.png">
                        </div>
                        <div class="chi-catagory-box">
                            <a href="#" class="chi-category-link chi-category-body">Kardiorok.cz</a>

                        </div>
                    </li>
                    <li class="media chi-catagory-box">
                        <div class="image-credit-wrapper chi-category-info">

                            <img src="<?php echo get_template_directory_uri(); ?>/img/media-obj-3.png">
                        </div>
                        <div class="chi-catagory-box">
                            <a href="#" class="chi-category-link chi-category-body">Kardiorok.cz</a>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    </div> -->
</main>
<footer>
    <?php get_template_part("chi-footer-content");	?>
</footer>
<script>
	document.getElementById("year").innerHTML = new Date().getFullYear();
</script>
<?php

get_footer();
wp_footer();

?>
