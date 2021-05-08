<?php
$id              = get_the_ID();
$advertising_ids = get_post_meta( $id, "_chi_advertising_verticals" );
?>
<?php if ( $advertising_ids ) : ?>
	<div class="d-flex h-20">
		<div class="chi-tag text-uppercase mr-auto p-2">
			<span class="chi-tag_link"><?php _e( "REKLAMNÍ SDĚLENÍ", "chi" ); ?></span>
		</div>
	</div>
	<hr class="divider mt-0">
<?php endif; ?>
<?php
if ( count( $advertising_ids ) > 0 && ! empty( $advertising_ids ) ) {
	$adverts_args = array(
		"post_type" => "chi_inzerce",
		"include"   => $advertising_ids[0],
	);
	$adverts      = get_posts( $adverts_args );
	foreach ( $adverts as $advert ) {
		echo $advert->post_content;
	}
}
?>
</div>
<?php get_template_part('/assets/aside/chi-aside-article'); ?>
<?php get_template_part('/assets/aside/chi-aside-video'); ?>