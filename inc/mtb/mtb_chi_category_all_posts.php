<?php

add_action( "edit_category_form_fields", "chi_selected_thems_in_category" );


function chi_selected_thems_in_category( $post ) {
	wp_nonce_field( 'chi_selected_thems_in_category', 'chi_selected_thems_in_category_nonce' );

	$args           = array( 'post_type' => array( 'post', 'chi_video' ), 'numberposts' => - 1, );
	$chi_posts_loop = get_posts( $args );


	$chi_selected_thems_in_category_values = get_term_meta( $_GET["tag_ID"], 'chi_selected_thems_in_category', true ); ?>
	<tr class="form-field">
		<th scope="row"><label for="chi_selected_thems_in_category">Vybrané témata k speciálu</label></th>
		<td>
			<select name="chi_selected_thems_in_category[]" id="chi_selected_thems_in_category" multiple="multiple">
				<?php
				foreach ( $chi_posts_loop as $chi_post ) {
					$dir_id   = $chi_post->ID;
					$selected = ( is_array( $chi_selected_thems_in_category_values ) && in_array( $dir_id, $chi_selected_thems_in_category_values ) ) ? 'selected="selected"' : '';
					$print    = true;
					?>
					<option <?php echo $selected; ?> value="<?php echo $dir_id ?>">
						<?php echo $chi_post->post_title; ?>
					</option>
					<?php
				}
				?>
		</td>
		</select>
	</tr>
	<?php
}


/**
 * Hooks into WordPress' save_post function
 */
add_action( 'edited_category', 'chi_selected_thems_in_category_save' );
function chi_selected_thems_in_category_save( $term_id ) {

	if ( isset( $_POST['chi_selected_thems_in_category'] ) && '' !== $_POST['chi_selected_thems_in_category'] ) {
		$sanitized_data_posts = array();
		delete_term_meta( $term_id, 'chi_selected_thems_in_category' );
		$data_posts = (array) $_POST['chi_selected_thems_in_category'];

		foreach ( $data_posts as $key => $value ) {
			$sanitized_data_posts[ $key ] = (int) strip_tags( stripslashes( $value ) );
		}

		$image = $_POST['chi_selected_thems_in_category'];
		add_term_meta( $term_id, 'chi_selected_thems_in_category', $image, true );
	} else {
		delete_term_meta( $term_id, 'chi_selected_thems_in_category' );
	}

}
