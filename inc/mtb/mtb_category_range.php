<?php
	/**
	 * Plugin class
	 **/
	if ( ! class_exists( 'CHI_RAGNE_PICKER_SPECIAL' ) ) {

		class CHI_RAGNE_PICKER_SPECIAL {

			public function __construct() {
				//
			}

			/*
			 * Initialize the class and start calling our hooks and filters
			 * @since 1.0.0
			*/
			public function init() {
				add_action( 'category_edit_form_fields', array( $this, 'height_specials' ), 10, 2 );
				add_action( 'edited_category', array( $this, 'update_range' ), 10, 2 );
				add_action( 'admin_footer', array( $this, 'add_script' ) );
			}

			/*
			 * Save the form field
			 * @since 1.0.0
			*/
			public function save_category_image( $term_id, $tt_id ) {
				if ( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ) {
					$image = $_POST['category-image-id'];
					add_term_meta( $term_id, 'category-image-id', $image, true );
				}
			}

			/*
			 * Edit the form field
			 * @since 1.0.0
			*/
			public function height_specials( $term, $taxonomy ) { ?>
				<tr class="form-field term-group-wrap">
					<th scope="row">
						<label for="slider"><?php _e( 'Výška záhlaví special', 'chi-templates' ); ?></label>
					</th>
					<td>
						<div id="slider" name="slider">
							<div id="custom-handle-id" name="custom-handle-id" class="ui-slider-handle"></div>
							<input type="hidden" id="hiddenSlider" name="slider">
						</div>
					</td>
				</tr>
				<tr class="form-field term-group-wrap">
					<th scope="row">
						<label for="sliderArticle"><?php _e( 'Výška záhlaví clanku/videa', 'chi-templates' ); ?></label>
					</th>
					<td>
						<div id="sliderArticle" name="sliderArticle">
							<div id="custom-handle-article-id" name="custom-handle-article-id"
								 class="ui-slider-handle"></div>
							<input type="hidden" id="hiddenSliderArticle" name="sliderArticle">
						</div>
					</td>
				</tr>

				<?php $term = get_term_meta( $_GET['tag_ID'], 'slider', true ); ?>

				<?php $termArticle = get_term_meta( $_GET['tag_ID'], 'sliderArticle', true ); ?>
				<?php

				echo '<pre>';
				print_r( $term );
				echo '</pre>';
				echo '<pre>';
				print_r(  $termArticle );
				echo '</pre>';
				?>
				<script>
					jQuery(document).ready(function ($) {


						var handle = $("#custom-handle-id");
						console.log(handle);
						$("#slider").slider({
							min: 250,
							max: 900,
							<?php if ( ! empty( $term ) ) {
								echo "value:$term,";
							} ?>
							create: function () {
								handle.text($(this).slider("value"));
							},
							slide: function (event, ui) {
								handle.text(ui.value);
								$('#hiddenSlider').val(ui.value);
							}

						});


						var handleArticle = $("#custom-handle-article-id");
						console.log(handle);
						$("#sliderArticle").slider({
							min: 250,
							max: 900,
							<?php if ( ! empty( $termArticle ) ) {
								echo "value:$termArticle,";
							} ?>
							create: function () {
								handleArticle.text($(this).slider("value"));
							},
							slide: function (event, ui) {
								handleArticle.text(ui.value);
								$('#hiddenSliderArticle').val(ui.value);
							}

						});

					});

				</script>
				<?php
			}

			/*
			 * Update the form field value
			 * @since 1.0.0
			 */
			public function update_range( $term_id, $tt_id ) {
				if ( isset( $_POST['slider'] ) && ! empty( $_POST['slider'] ) ) {
					$customHandleID = $_POST['slider'];
					update_term_meta( $term_id, 'slider', $customHandleID );
				}
				if ( isset( $_POST['sliderArticle'] ) && ! empty( $_POST['sliderArticle'] ) ) {
					$customHandleID = $_POST['sliderArticle'];
					update_term_meta( $term_id, 'sliderArticle', $customHandleID );
				}
			}

			/*
			 * Add script
			 * @since 1.0.0
			 */
			public function add_script() {
				if ( isset( $_GET['tag_ID'] ) ) {


					?>
					<link rel="stylesheet"
						  href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css"
						  integrity="sha512-aOG0c6nPNzGk+5zjwyJaoRUgCdOrfSDhmMID2u4+OIslr0GjpLKo7Xm0Ao3xmpM4T8AmIouRkqwj1nrdVsLKEQ=="
						  crossorigin="anonymous"/>
					<style>
						.ui-slider-horizontal .ui-slider-handle {
							top: -0.8em;
							margin-left: -.6em;
							text-align: center;
							display: flex;
							justify-content: center;
							align-items: center;
						}

						.ui-slider .ui-slider-handle {
							position: absolute;
							z-index: 2;
							width: 2em;
							height: 2em;
							cursor: default;
							-ms-touch-action: none;
							touch-action: none;
						}
					</style>

					<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"
							integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU="
							crossorigin="anonymous"></script>

				<?php }
			}

		}

		$CHI_RAGNE_PICKER_SPECIAL = new CHI_RAGNE_PICKER_SPECIAL();
		$CHI_RAGNE_PICKER_SPECIAL->init();

	}
