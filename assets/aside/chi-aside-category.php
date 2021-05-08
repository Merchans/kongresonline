<?php
$id              = get_the_category()[0]->term_id;
$advertising_ids = get_term_meta( $id, "chi_selected_in_category_advertising_vertical" );
if ( count( $advertising_ids ) > 0 && ! empty( $advertising_ids ) ) {
	$adverts_args = array(
		"post_type" => "chi_inzerce",
		"include"   => $advertising_ids[0],
	);
	$adverts      = get_posts( $adverts_args );
	if ( $adverts ) {
		?>
		<div class="d-flex h-20">
			<div class="chi-tag text-uppercase mr-auto p-2">
				<span class="chi-tag_link">REKLAMNÍ SDĚLENÍ</span>
			</div>
		</div>
		<hr class="divider mt-0">
		<?php
	}
	foreach ( $adverts as $advert ) {
		echo $advert->post_content;
	}
}
?>

<?php get_template_part( '/assets/aside/chi-aside', 'article',
	array( "content_id" => $id, "is_single" => is_single() ) ); ?>
<?php get_template_part( '/assets/aside/chi-aside', 'video', array( "content_id" => $id, "is_single" => is_single() ) ); ?>