<?php
$id              = get_the_category()[0]->term_id;
$advertising_ids = get_term_meta($id, "chi_selected_in_category_advertising_vertical");
if (count($advertising_ids) > 0 && ! empty($advertising_ids)) {
    $adverts_args = array(
        "post_type" => "chi_inzerce",
        "include"   => $advertising_ids[0],
    );
    $adverts      = get_posts($adverts_args);
    if ($adverts)
    {
        ?>
        <div class="d-flex h-20">
            <div class="chi-tag text-uppercase mr-auto p-2">
                <span class="chi-tag_link">REKLAMNÍ SDĚLENÍ</span>
            </div>
        </div>
        <hr class="divider mt-0">
        <?php
    }
    foreach ($adverts as $advert) {
        echo $advert->post_content;
    }
}
?>
<?php

                $id              = get_the_category()[0]->term_id;
                $close_end       = false;
                $advertising_ids = get_term_meta($id, "chi_selected_thems_in_category");
                if (count($advertising_ids) > 0 && ! empty($advertising_ids)) {
                $adverts_args = array(
                    "post_type" => array(
                        "post",
                        "chi_video"
                    ),
                    "include"   => $advertising_ids[0]
                );
                $adverts      = get_posts($adverts_args);
                if (count($adverts) > 0) {
                $close_end = true;
                ?>
				<div class="chi-category-thems mt-5">
					<div class="d-flex h-20">
						<div class="chi-tag text-uppercase mr-auto p-2">
							<span class="chi-tag_link">témata</span>
						</div>
					</div>
					<hr class="divider mt-0">
					<div class="chi-theme-box">
                        <?php
                        }
                        $i = 1;
                        foreach ($adverts as $advert) {
                            if ((string)$advert->post_type == "post") {
                                if (($i % 2 != 0)) {
                                    ?>
									<figure class="inline-image chi-cards">
                                    <?php
                                }
                                ?>
								<div class="chi-theme-card">
									<div class="image-credit-wrapper">
                                        <span class="image-credit chi-category-credit">

                <a href="<?php echo get_chi_make_specilal_form_category($advert->ID); ?>"
				   class="chi-category__link"><?php echo get_the_category($advert->ID)[0]->name ?></a>
            </span>
										<a href="<?php echo get_permalink($advert->ID); ?>">   <?php
                                        echo get_the_post_thumbnail($advert->ID, "small");
											?></a>
									</div>
									<div class="card-body chi-card-body">
										<div class="text-left chi-card-text"><a href="<?php echo get_permalink($advert->ID) ?>"
																  class="chi-name--min-title"><?php echo $advert->post_title ?></a>
										</div>
										<strong class="chi-name-title">
											<time class="chi-time"
												  datetime><?php echo get_the_date(get_option('date_format'),
                                                    $advert->ID) ?></time>
										</strong>
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

                    foreach ($adverts as $advert) {
                        if ((string)$advert->post_type == "chi_video") {
                            ?>
							<div class="d-flex h-20">
								<div class="chi-tag text-uppercase mr-auto p-2">
									<span class="chi-tag_link">VIDEO</span>
								</div>
							</div>
							<hr class="divider mt-0">
							<div class="card chi-card--borner-none chi-card">
								<div class="chi-box-1 chi-card--box-1"
									 style="background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.23) 100%), url(<?php echo get_the_post_thumbnail_url($advert->ID) ?>) no-repeat top center; background-size: cover;">
									<a href="<?php echo get_permalink($advert->ID) ?>" class="d-block w-100 h-100"></a>
									<div class="d-flex flex-row">
                                        <?php

                                        if ( ! empty(chi_video_time($advert->ID)[0]) && isset(chi_video_time($advert->ID)[0])) {
                                            ?>
											<div class="chi-tag text-uppercase">
												<span
														class="chi-tag_link"><?php echo chi_video_time($advert->ID)[0]; ?></span>
											</div>
                                            <?php
                                        }
                                        ?>
										<div class="chi-category text-uppercase">
											<a href="<?php echo get_chi_make_specilal_form_category($advert->ID); ?>"
											   class="chi-category__link">
                                                <?php echo get_the_category($advert->ID)[0]->name ?>
											</a>
										</div>
									</div>
								</div>
								<div class="card-body chi-card-body">
									<a href="<?php echo get_permalink($advert->ID) ?>">
										<h6 class="card-title chi-card-title"><?php echo $advert->post_title ?></h6>
									</a>
									<strong class="chi-name-title">
										<?php echo get_post_field("doctoral_degrees_and_name_doctoral_degrees_and_name", $advert->ID) ?>
										<time class="chi-time" datetime>
											<?php if (  get_post_field("doctoral_degrees_and_name_doctoral_degrees_and_name", $advert->ID) ):?>
											-
											<?php endif;?>
											<?php echo get_the_date(get_option('date_format'), $advert->ID) ?>
										</time>
									</strong>
									<p class="chi-card-text"><?php echo excerpt(30); ?></p>
								</div>
							</div>
                            <?php
                        }
                    }
                    }
                    ?>
				</div>