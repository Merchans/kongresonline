<?php

	add_action( 'edit_category_form_fields', "chi_selected_one_option_for_claim" );


	function chi_selected_one_option_for_claim( $post ) {
		wp_nonce_field( 'chi_selected_one_option_for_claim', 'chi_selected_one_option_for_claim_nonce' );
		wp_nonce_field( 'chi_selected_in_claim_posts', 'chi_selected_in_claim_posts_nonce' );


		$args = array(
				'post_type'   => array( 'post', 'chi_video' ),
				'numberposts' => -1,
				'category'    => "$post->term_id"
		);

		$chi_posts_loop = get_posts( $args );

		$all_posts_and_videos = count( $chi_posts_loop );
		$args_video           = array(
				'post_type'   => array( 'chi_video' ),
				'numberposts' => -1,
				'category'    => "$post->term_id"
		);

		$args_post = array(
				'post_type'   => array( 'post' ),
				'numberposts' => -1,
				'category'    => "$post->term_id"
		);

		$chi_post_count = count( get_posts( $args_post ) );

		$is_disable_video = count( get_posts( $args_video ) ) ? 1 : 0;

		$chi_selected_in_claim_posts_values = get_term_meta( $_GET["tag_ID"], 'chi_selected_in_claim_posts', true );
		?>
		<tr class="form-field term-parent-wrap">
			<th scope="row"><label for="chi_selected_one_options">Zobrazení úvodního obsahu</label></th>
			<td>
				<select name="chi_selected_one_options" id="chi_selected_one_options" class="postform">
					<option <?php echo $is_disable_video ? '' : 'disabled'; ?> class="level-0"
																			   value="1" <?php if ( get_term_meta( $post->term_id, "_chi_selected_one_options" )[0] == 1 ) {
						echo "selected";
					} ?>>Hlavní okno video, sekundární okna články
					</option>
					<option class="level-0"
							value="2" <?php if ( get_term_meta( $post->term_id, "_chi_selected_one_options" )[0] == 2 ) {
						echo "selected";
					} ?>>Vždy nejnovější obsah
					</option>
					<option <?php echo ( $all_posts_and_videos > 3 ) ? '' : 'disabled'; ?>
							class="level-0 show-claim-custom"
							value="3" <?php if ( get_term_meta( $post->term_id, "_chi_selected_one_options" )[0] == 3 ) {
						echo "selected";
					} ?>>Vlastní výběr
					</option>
				</select>
				<p class="description">Pokud chcete, v této sekci můžete změnit základní chování úvodních oken v
					speciálu.</p>
			</td>
		</tr>
		<tr id="chi_claim_posts">
			<th scope="row"><label for="chi_selected_in_claim_posts">Vyberte obsah kterých chcete zobrazovat na titulní
					straně speciálu</label></th>
			<td>
				<select name="chi_selected_in_claim_posts[]" id="chi_selected_in_claim_posts" multiple="multiple"
						class="claim_articles" style="width: 100%;">
					<?php
						foreach ( $chi_posts_loop as $chi_post ) {
							$dir_id = $chi_post->ID;

							$selected = ( is_array( $chi_selected_in_claim_posts_values ) && in_array( $dir_id, $chi_selected_in_claim_posts_values ) ) ? 'selected="selected"' : '';
							$print    = true;
							?>
							<option <?php echo $selected; ?> value="<?php echo $dir_id ?>">
								<?php echo $chi_post->post_title; ?>
							</option>
							<?php
						}
					?>
			</td>
		</tr>
		<?php
	}


	/**
	 * Hooks into WordPress' save_post function
	 */
	add_action( 'edited_category', 'chi_selected_one_option_save' );
	function chi_selected_one_option_save( $category ) {
		if ( isset( $_POST['chi_selected_one_options'] ) && ! empty( $_POST['chi_selected_one_options'] ) ) {

			$sanitized_data_posts = $_POST['chi_selected_one_options'];

			update_term_meta( $category, '_chi_selected_one_options', $sanitized_data_posts );
		}


	}


	add_action( 'admin_footer', 'media_selector_print_scriptsss' );

	function media_selector_print_scriptsss( $show ) {

		?>
		<script type='text/javascript'>

			jQuery(document).ready(function ($) {
				$claim = $("#chi_claim_posts");

				$("#chi_selected_in_claim_posts").select2({
					placeholder: "Zvolte tři články, které se budou zobrazovat na úvodní stránce speciálu.",
					maximumSelectionLength: 3,
				});
				<?php
				if ( isset( $_GET["tag_ID"] ) && ( get_term_meta( $_GET["tag_ID"], "_chi_selected_one_options" )[0] == 3 ))
				{
				?>
				$claim.fadeIn();
				<?php
				} ?>

				<?php
				if ( isset( $_GET["tag_ID"] ) && ( get_term_meta( $_GET["tag_ID"], "_chi_selected_one_options" )[0] != 3 ))
				{
				?>
				$claim.hide();
				<?php
				} ?>

				// $claim.hide();
				$("select.postform").change(function () {
					var selectedOption = $(this).children("option:selected").val();

					if (selectedOption == 3) {

						$('form').on('submit', function () {
							var minimum = 3;

							if ($("#chi_selected_in_claim_posts").select2('data').length < minimum) {
								alert('Please shoose ' + minimum + ' items')
								return false;
							}

						});

						$claim.fadeIn(500);

					} else {
						$('form').unbind();
						$claim.fadeOut(500);
					}

				});
				//
				// $("select.claim_articles").on('click', function () {
				//
				// 	if ($("select.claim_articles option:selected").length > 3) {
				// 		$(this).removeAttr("selected");
				// 		//alert('You can select upto 3 options only');
				// 	}
				// });
				// var last_valid_selection = null;
				//
				// $('.claim_articles').change(function (event) {
				//
				// 	if ($(this).val().length > 3) {
				//
				// 		$(this).val(last_valid_selection);
				// 	} else {
				// 		last_valid_selection = $(this).val();
				// 	}
				// });

			});

		</script><?php

	}


	add_action( 'edited_category', 'chi_selected_in_claim_posts_save' );
	function chi_selected_in_claim_posts_save( $term_id ) {
		if ( isset( $_POST['chi_selected_in_claim_posts'] ) && '' !== $_POST['chi_selected_in_claim_posts'] ) {

			$sanitized_data_posts = array();
			delete_term_meta( $term_id, 'chi_selected_in_claim_posts' );
			$data_posts = (array) $_POST['chi_selected_in_claim_posts'];

			foreach ( $data_posts as $key => $value ) {
				$sanitized_data_posts[ $key ] = (int) strip_tags( stripslashes( $value ) );
			}

			$image = $_POST['chi_selected_in_claim_posts'];
			add_term_meta( $term_id, 'chi_selected_in_claim_posts', $image, true );
		} else {
			delete_term_meta( $term_id, 'chi_selected_in_claim_posts' );
		}

	}
