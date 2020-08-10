<?php
chi_all_headers();
wp_head();

$args_one_video = array("post_type" => "chi_video", "posts_per_page" => 1);
$first_video = new  WP_Query($args_one_video);
$first_video_ID = $first_video->posts[0]->ID;

?>
    <body>
    <main>
        <div class="container">
            <div class="chi-info-text">
                <p>
                    <?php echo get_option('chi_homepage_description'); ?>
                </p>
            </div>
            <div class="chi-info-banner">
                <div class="row">
					<div class="col-md-6 overflow-hidden chi-pr-lg-0">
						<div class="chi-box-1" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url($first_video->post->ID) ?>) no-repeat center center; background-size: cover;">
							<div class="d-flex flex-row">
								<div class="chi-tag text-uppercase">
									<a href="/videa" class="chi-tag_link">VIDEA</a>
								</div>
								<div class="chi-category text-uppercase">
									<a href="<?php echo get_category_link(get_the_category($first_video->post->ID)[0]->cat_ID) ?>" class="chi-category__link"><?php echo get_the_category($first_video->post->ID)[0]->name ?></a>
								</div>
							</div>
							<a href="<?php echo get_permalink($first_video_ID); ?>"><h1 class="chi-title-white"><?php echo $first_video->post->post_title ?></h1></a>
                            <?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
							<strong class="chi-time"><?php echo has_title_meta_box($chi_title_meta_box) ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?></time></strong>
						</div>
					</div>
					<?php  ?>
					<div class="col-md-6 overflow-hidden">
						<div class="row">
                            <?php

                            $args_two_posts = array("post_type" => "post", "posts_per_page" => 2);
                            $category_posts = new WP_Query($args_two_posts);
                            $not_in_main_loop = array();
                            $loop = new WP_Query( $args_two_posts );
                            while( $loop->have_posts() ) {
                                $loop->the_post();
                                $not_in_main_loop[] = get_the_ID();
                            }
                            wp_reset_postdata();

                            $category_posts = new WP_Query($args_two_posts);
                            if($category_posts->have_posts()) :
                                $i= 2;
	                            //var_dump($category_posts->post->ID);
                                //$categories = get_the_category()[0]->slug;
                                while($category_posts->have_posts()) :
                                    $category_posts->the_post();
                                    ?>
									<div class="col-md-12 overflow-hidden">
										<div class="chi-box-<?php echo $i ?>" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url($category_posts->post->ID) ?>) no-repeat center center; background-size: cover;">
											<div class="d-flex flex-row">
                                                <?php $terms = get_the_terms(get_the_ID(), "congress"); ?>
                                                <?php if (is_array($terms) && !empty($terms)) { ?>
                                                    <?php foreach( $terms as $term) {?>
                                                        <?php $url = get_home_url() .'/'. $term->taxonomy .'/'. $term->slug;  ?>
														<div class="chi-tag text-uppercase">
															<a href="<?php echo $url; ?>" class="chi-tag_link"><?php echo $term->name; ?></a>
														</div>
                                                    <?php }	?>
                                                <?php } ?>
												<div class="chi-category text-uppercase">
													<a href="<?php echo get_chi_make_specilal_form_category() ?>" class="chi-category__link"><?php echo get_the_category($category_posts->post->ID)[0]->name ?></a>
												</div>
											</div>
											<a href="<?php echo get_permalink() ?>"><h1 class="chi-title-white"><?php the_title() ?></h1></a>
                                            <?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
											<strong class="chi-time"><?php echo has_title_meta_box($chi_title_meta_box) ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?></time></strong>
										</div>
									</div>
                                    <?php $i++;endwhile;   else: ?>
                            <?php endif; ?>
						</div>
					</div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-md-9 chi-video-section mt-5">
                    <div class="d-flex h-20">
                        <div class="chi-tag text-uppercase mr-auto p-2">
							<a href="/videa" class="chi-tag_link">VIDEA</a>
                        </div>
                        <div>
                        </div>
                    </div>
                    <hr class="divider mt-0">
                    <div class="row">
                        <?php
                        wp_reset_query();
                        $args_one_offset_video = array("post_type" => array("chi_video"), "posts_per_page" => 1, "post_status" => "publish", "offset" => 1 );
                        $category_posts = new WP_Query($args_one_offset_video);

                        if($category_posts->have_posts()) :
                            $i= 2;

                            while($category_posts->have_posts()) :
                                $category_posts->the_post();

                                $categories = get_the_category($category_posts->post->ID);

                                $categories_ID = get_the_category()[0]->term_id;
                                ?>
								<div class="col-md-6">
									<div class="card chi-card--borner-none chi-card">
										<div class="chi-box-1 chi-card--box-1" style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">
											<div class="d-flex flex-row">
												<div class="chi-tag text-uppercase">
													<a href="<?php echo get_permalink()?>" class="chi-tag_link"><?php echo chi_video_time()[0]  ?></a>
												</div>
												<div class="chi-category text-uppercase">
													<a href="<?php echo  get_category_link($categories_ID); ?>" class="chi-category__link"><?php echo $categories[0]->name ?></a>
												</div>
											</div>
										</div>
										<div class="card-body chi-card-body">
                                            <?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
											<a href="<?php echo get_permalink() ?>"><h5 class="card-title chi-card-title"><?php the_title(); ?></h5></a>
											<strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?> <time class="chi-time"><?php the_time(get_option("date_format")) ?></time></strong>
                                            <?php $moreLink = '<a href="' . get_permalink() . '">...</a>'; ?>
											<p class="chi-card-text"><?php echo wp_trim_words( get_the_content(), 18, $moreLink ) ?></p>
										</div>
									</div>
								</div>
                                <?php $i++;endwhile;   else: ?>
                        <?php endif; ?>
						<div class="col-md-6">
                            <?php
                            $args = array(
                                'post_type' => 'chi_video',
                                'offset' => 2,
                                'posts_per_page' => 3,
                            );
                            wp_reset_query();
                            $the_query = new WP_Query( $args );

                            if ( $the_query->have_posts() ) :
                                $i = 0;
                                while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
								<?php

                                    $categories = get_the_category($the_query->post->ID);

                                    $categories_ID = get_the_category()[0]->term_id;

								?>
									<div class="<?php if ($i > 0)
                                    {echo 'mt-5';}
                                    ?>">
										<div class="media chi-media position-relative">
											<div class="d-flex flex-row align-items-end chi-media-img justify-content-between" style="background: url(<?php echo get_the_post_thumbnail_url() ?>) no-repeat center center; background-size: cover;">
												<div class="chi-category text-uppercase">
													<a href="<?php echo get_category_link($categories_ID);  ?>" class="chi-category__link"><?php echo $categories[0]->name;?></a>
												</div>
												<div class="chi-tag text-uppercase">
													<a href="<?php echo get_permalink(); ?>" class="chi-tag_link"><?php echo chi_video_time()[0];  ?></a>
												</div>
											</div>
											<div class="media-body">
												<a href="<?php echo get_permalink(); ?>"><h5 class="mt-0 chi-sub-title"><?php the_title();?></h5></a>
												<time class="chi-time" datetime><?php the_time(get_option("date_format")); ?></time>
											</div>
										</div>
									</div>
                                    <?php $i++; endwhile;  	else: ?>

								<p>Nenalezeno</p>

                            <?php endif; ?>
						</div>
					</div>
                    <div class="others-articles">
                        <div class="d-flex h-20 mt-5">
                            <div class="chi-tag text-uppercase mr-auto p-2">
                                <a href="/clanky-a-reportaze" class="chi-tag_link" id="ostatni-clanky">ostatní články</a>
                            </div>
                        </div>
                        <hr class="divider mt-0">
                        <ul class="list-unstyled">
                            <?php

                            if (get_url_var("page") == "")
                            {
                                $current_page = 1;
                            }
                            else
                            {
								(int)$current_page = get_url_var("page");
                            }
                            $args = array("post_type" => "post", "paged" => $current_page, "post__not_in" => $not_in_main_loop);
                            $current_page = get_query_var("paged");
                            query_posts( $args );
                            ?>
                            <?php if (have_posts()) : ?>
                                <?php while (have_posts()) : the_post() ?>
                                    <?php $chi_title_meta_box = get_post_field( "doctoral_degrees_and_name_doctoral_degrees_and_name")?>
									<li class="media">
										<div class="image-credit-wrapper chi-othes-articles">
                                    <span class="image-credit chi-category-credit">

                 <a href="<?php echo get_category_link( get_the_category( get_the_ID() )[0] ); ?>" class="chi-category__link"><?php echo get_the_category()[0]->slug ?></a>
            </span>
                                            <?php the_post_thumbnail("medium") ?>
										</div>
										<div class="media-body ">
											<a href="<?php echo get_permalink() ?>"><h5 class="mt-0 mb-1 card-title chi-card-title"><?php the_title(); ?></h5></a>
											<strong class="chi-name-title"><?php echo has_title_meta_box($chi_title_meta_box) ?>
												<time class="chi-time" datetime><?php the_time(get_option("date_format")); ?></time>
											</strong>
											<p class="chi-card-text"><?php echo wp_trim_words( get_the_content(), 25) ?></p>
										</div>
									</li>
                                <?php endwhile ?>
                            <?php else : ?>

                            <?php endif ?>
                        </ul>
						<?php get_template_part("chi-blog-pages"); ?>
						<!--
                        <div class="row mt-5 mx-auto">
                            <a class="btn chi-btn-more-acticle mx-auto" href="#" role="button">10 dalších článků&hellip;</a>
                            <nav aria-label="..." class="...">
                                <ul class="pagination chi-pagination">
                                    <li class="page-item chi-page-item "><a class="chi-page-link active" href="#">1</a></li>
                                    <li class="page-item chi-page-item ">
                                        <a class="chi-page-link" href="#">2 <span class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="page-item chi-page-item"><a class="chi-page-link" href="#">3</a></li>
                                    <li class="page-item chi-page-item">
                                        <a class="chi-page-link chi-page-link-last" href="#">&hellip;</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>-->
                    </div>

                </div>
				<?php get_template_part("chi-aside"); ?>
                </div>
            </div>
        </div>
    </main>
    <!--<section class="pre-footer mt-5">
        <h4 class="pre-footer-title">Co o nás říkají odborníci?</h4>
        <div class="chi-carousel">
            <div class="bd-example">
                <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators chi-carousel-cicrcle">
                        <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
                        <li data-target="#carouselExampleCaptions" data-slide-to="3"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/800x400.png" class="d-block w-100" alt="img/800x400.png">
                            <div class="carousel-caption d-none d-md-block">
                                <p class="chi-carousel-text">Program digitálního kongresového zpravodajství vnímám velmi
                                    pozitivně a domnívám se, že takovýto projekt, jde naproti lékařům, je velice užitečný,
                                    protože přináší ve srozumitelné podobě novinky z jednotlivých oborů, čímž pomáhá
                                    zavádění inovativních postupů do béžné klinické praxe.</p>
                                <div class="chi-carousel-subtitle">
                                    <strong>Prof. MUDr. Miloš Táborský, CSc., FESC, MBAprof. MUDr.</strong>
                                    <small>předseda České kardiologické společnosti</small>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/800x400.png" class="d-block w-100" alt="img/800x400.png">
                            <div class="carousel-caption d-none d-md-block">
                                <p class="chi-carousel-text">Program digitálního kongresového zpravodajství vnímám velmi
                                    pozitivně a domnívám se, že takovýto projekt, jde naproti lékařům, je velice užitečný,
                                    protože přináší ve srozumitelné podobě novinky z jednotlivých oborů, čímž pomáhá
                                    zavádění inovativních postupů do béžné klinické praxe.</p>
                                <div class="chi-carousel-subtitle">
                                    <strong>Prof. MUDr. Miloš Táborský, CSc., FESC, MBAprof. MUDr.</strong>
                                    <small>předseda České kardiologické společnosti</small>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/800x400.png" class="d-block w-100" alt="img/800x400.png">
                            <div class="carousel-caption d-none d-md-block">
                                <p class="chi-carousel-text">Program digitálního kongresového zpravodajství vnímám velmi
                                    pozitivně a domnívám se, že takovýto projekt, jde naproti lékařům, je velice užitečný,
                                    protože přináší ve srozumitelné podobě novinky z jednotlivých oborů, čímž pomáhá
                                    zavádění inovativních postupů do béžné klinické praxe.</p>
                                <div class="chi-carousel-subtitle">
                                    <strong>Prof. MUDr. Miloš Táborský, CSc., FESC, MBAprof. MUDr.</strong>
                                    <small>předseda České kardiologické společnosti</small>
                                </div>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="<?php echo get_template_directory_uri(); ?>/img/800x400.png" class="d-block w-100" alt="">
                            <div class="carousel-caption d-none d-md-block">
                                <p class="chi-carousel-text">Program digitálního kongresového zpravodajství vnímám velmi
                                    pozitivně a domnívám se, že takovýto projekt, jde naproti lékařům, je velice užitečný,
                                    protože přináší ve srozumitelné podobě novinky z jednotlivých oborů, čímž pomáhá
                                    zavádění inovativních postupů do béžné klinické praxe.</p>
                                <div class="chi-carousel-subtitle">
                                    <strong>Prof. MUDr. Miloš Táborský, CSc., FESC, MBAprof. MUDr.</strong>
                                    <small>předseda České kardiologické společnosti</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </section>-->
    <footer>
        <div class="container chi-hr"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-4 chi-col-style">
                    <div class="chi-footer-logo">
                        <img src="<?php echo get_template_directory_uri(); ?>/img/chi-logo-1.png" alt="chi logo">
                    </div>
                    <p>Společnost <strong>CZECH HEALTH INTERACTIVE, s.r.o.</strong> se zaměřuje výhradně na digitální
                        komunikaci v oblasti zdravotnictví.</p>
                </div>
                <div class="col-md-4">
					<p>Základem naší práce je především kvalitní, odborný obsah, který šíříme pomocí moderních online nástrojů.	</p>
					<p>Naší vizí je stát se odborným partnerem pro farmaceutické společnosti v oblasti e-commerce a respektovaným médiem pro lékaře a farmaceuty.</p>
				<!--
                    <h4 class="chi-footer-title">O nás</h4>
                    <div class="chi-media-footer">
                        <div class="media chi-footer-media-title">
                            <img class="mr-3 chi-media-footer-img" src="<?php echo get_template_directory_uri(); ?>/img/vetrovsky.png" alt="Vetrovský">
                            <div class="media-body">
                                <h5 class="mt-0">MUDr. Tomáš Větrovský</h5>
                                <h6>IDEAS AND CO-OWNER</h6>
                            </div>
                        </div>
                        <p class="chi-media-footer-body">Snažím se propojit svoje zkušenosti z medicíny, marketingu a
                            digitálních technologií, abych pro Vás vyvíjel účinná a inovativní řešení v oblasti &hellip;</p>
                    </div>
                    <div class="chi-media-footer">
                        <div class="media chi-footer-media-title">
                            <img class="mr-3 chi-media-footer-img" src="<?php echo get_template_directory_uri(); ?>/img/novotny.png" alt="Novotný">
                            <div class="media-body">
                                <h5 class="mt-0">MUDr. Tomáš Novotný</h5>
                                <h6>CONTENT</h6>
                            </div>
                        </div>
                        <p class="chi-media-footer-body">Nabízím více než 12 let zkušeností z práce v odborných
                            zdravotnických médiích, které jsou opřeny hlavně o znalost medicínské problematiky a osobní
                            vazby &hellip;</p>
                    </div>
                    <div class="chi-media-footer">
                        <div class="media chi-footer-media-title">
                            <img class="mr-3 chi-media-footer-img" src="<?php echo get_template_directory_uri(); ?>/img/gadzuk.png" alt="Gadžuk">
                            <div class="media-body">
                                <h5 class="mt-0">Jindřich Gadžuk</h5>
                                <h6>SOLUTIONS</h6>
                            </div>
                        </div>
                        <p class="chi-media-footer-body">Mé dlouholeté praktické zkušenosti s rozvojem firemního IT jsou
                            zárukou vysoce odborného a osobního přístupu k Vašim potřebám. Záleží mi na tom &hellip;</p>
                    </div>-->
                </div>
                <div class="col-md-4">
					<p>
						<strong>Adresa kanceláře:</strong> <br>
						Národní 32, 110 00 Praha 1 (Palác Chicago)
					</p>
					<p>
						<strong>Fakturační údaje:</strong> <br>
						CZECH HEALTH INTERACTIVE, s.r.o. <br>
						Národní 58/32, 110 00 Praha 1 – Nové Město <br>
						IČ: 25130099, DIČ: CZ25130099
					</p>
					<a href="/o-nas" class="chi-footer-link">Více o nás</a>
					<!--
                    <div class="chi-media-footer">
                        <div class="media chi-footer-media-title">
                            <img class="mr-3 chi-media-footer-img" src="<?php echo get_template_directory_uri(); ?>/img/vanek.png" alt="Vaněk">
                            <div class="media-body">
                                <h5 class="mt-0">MUDr. Martin Vaněk</h5>
                                <h6>IDEAS AND CO-OWNER</h6>
                            </div>
                        </div>
                        <p class="chi-media-footer-body">Ostruhy jsem získával počátkem milénia téměř pět let v bývalých
                            ZDN. Následujíci dekáda v soukromém sektoru, zaměřená na odbornou tištěnou &hellip;</p>
                    </div>
                    <div class="chi-media-footer">
                        <div class="media chi-footer-media-title">
                            <img class="mr-3 chi-media-footer-img" src="<?php echo get_template_directory_uri(); ?>/img/shibalova.png" alt="Novotný">
                            <div class="media-body">
                                <h5 class="mt-0">Kateřina Shibalová</h5>
                                <h6>SOLUTIONS</h6>
                            </div>
                        </div>
                        <p class="chi-media-footer-body">Již více než 8 let se pohybuji v oblasti IT a stejně tak dlouho se
                            specializuji na farmacii. Díky svým zkušenostem z technické realizace i řízení &hellip;</p>
                    </div>
                </div>-->
            </div>
			</div>
			<?php get_template_part("chi-footer-content");	?>
    </footer>
	<script>
	    document.getElementById("year").innerHTML = new Date().getFullYear();
	</script>
    </body>
<?php

get_footer();
wp_footer();

?>