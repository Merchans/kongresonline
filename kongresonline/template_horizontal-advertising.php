<?php
$id = get_the_category()[0]->term_id;

$advertising_ids = get_term_meta( $id, "chi_selected_in_category_advertising_horizontal");
if ( ! empty($advertising_ids))
{
    $adverts_args = array(
        "post_type" => "chi_inzerce",
        "include"  => $advertising_ids[0],
    );
    $adverts = get_posts($adverts_args);
    ?>
	<div class="d-flex h-20 mt-5">
		<div class="chi-tag text-uppercase mr-auto p-2">
			<a href="#" class="chi-tag_link">REKLAMNÍ SDĚLENÍ</a>
		</div>
	</div>
	<hr class="divider mt-0"> <?php
    foreach ($adverts as $advert)
    {
        echo $advert->post_content;
    }
}
?>

