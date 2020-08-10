<?php
/**
 * Plugin class
 **/
if ( ! class_exists( 'CHI_CATEGORY_LOGO' ) ) {

    class CHI_CATEGORY_LOGO {

        public function __construct() {
            //
        }

        /*
         * Initialize the class and start calling our hooks and filters
         * @since 1.0.0
        */
        public function init() {
            add_action( 'category_add_form_fields', array ( $this, 'add_category_image' ), 10, 2 );
            add_action( 'created_category', array ( $this, 'save_category_image' ), 10, 2 );
            add_action( 'category_edit_form_fields', array ( $this, 'update_category_image' ), 10, 2 );
            add_action( 'edited_category', array ( $this, 'updated_category_image' ), 10, 2 );
            add_action( 'admin_enqueue_scripts', array( $this, 'load_media' ) );
            add_action( 'admin_footer', array ( $this, 'add_script' ) );
        }

        public function load_media() {
            wp_enqueue_media();
        }

        /*
         * Add a form field in the new category page
         * @since 1.0.0
        */
        public function add_category_image ( $taxonomy ) { ?>
			<div class="form-field term-group">
				<label for="category-image-id"><?php _e('Logo speciálu', 'chi-templates'); ?></label>
				<input type="hidden" id="category-image-id" name="category-image-id" class="custom_media_url" value="">
				<div id="category-image-wrapper"></div>
				<p>
					<input type="button" class="button button-secondary ct_tax_media_button_logon" id="ct_tax_media_button_logon" name="ct_tax_media_button_logon" value="<?php _e( 'Add Image', 'chi-templates' ); ?>" />
					<input type="button" class="button button-secondary chi_tax_media_logo_remove" id="chi_tax_media_logo_remove" name="chi_tax_media_logo_remove" value="<?php _e( 'Remove Image', 'chi-templates' ); ?>" />
				</p>
			</div>
            <?php
        }

        /*
         * Save the form field
         * @since 1.0.0
        */
        public function save_category_image ( $term_id, $tt_id ) {
            if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
                $image = $_POST['category-image-id'];
                add_term_meta( $term_id, 'category-image-id', $image, true );
            }
        }

        /*
         * Edit the form field
         * @since 1.0.0
        */
        public function update_category_image ( $term, $taxonomy ) { ?>
			<tr class="form-field term-group-wrap">
				<th scope="row">
					<label for="category-image-id"><?php _e( 'Logo speciálu', 'chi-templates' ); ?></label>
				</th>
				<td>
                    <?php $image_id = get_term_meta ( $term -> term_id, 'category-image-id', true ); ?>
					<input type="hidden" id="category-image-id" name="category-image-id" value="<?php echo $image_id; ?>">
					<div id="category-image-wrapper">
                        <?php if ( $image_id ) { ?>
                            <?php echo wp_get_attachment_image ( $image_id, 'medium' ); ?>
                        <?php } ?>
					</div>
					<p>
						<input type="button" class="button button-secondary ct_tax_media_button_logon" id="ct_tax_media_button_logon" name="ct_tax_media_button_logon" value="<?php _e( 'Add Image', 'chi-templates' ); ?>" />
						<input type="button" class="button button-secondary chi_tax_media_logo_remove" id="chi_tax_media_logo_remove" name="chi_tax_media_logo_remove" value="<?php _e( 'Remove Image', 'chi-templates' ); ?>" />
					</p>
				</td>
			</tr>
            <?php
        }

        /*
         * Update the form field value
         * @since 1.0.0
         */
        public function updated_category_image ( $term_id, $tt_id ) {
            if( isset( $_POST['category-image-id'] ) && '' !== $_POST['category-image-id'] ){
                $image = $_POST['category-image-id'];
                update_term_meta ( $term_id, 'category-image-id', $image );
            } else {
                update_term_meta ( $term_id, 'category-image-id', '' );
            }
        }

        /*
         * Add script
         * @since 1.0.0
         */
        public function add_script() { ?>
			<script>
				jQuery(document).ready( function($) {
					function ct_media_upload(button_class) {
						var _custom_media = true,
						    _orig_send_attachment = wp.media.editor.send.attachment;
						$('body').on('click', button_class, function(e) {
							var button_id = '#'+$(this).attr('id');
							var send_attachment_bkp = wp.media.editor.send.attachment;
							var button = $(button_id);
							_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
								if ( _custom_media ) {
									$('#category-image-id').val(attachment.id);
									$('#category-image-wrapper').html('<img class="custom_media_image_logo" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
									$('#category-image-wrapper .custom_media_image_logo').attr('src',attachment.url).css('display','block');
								} else {
									return _orig_send_attachment.apply( button_id, [props, attachment] );
								}
							}
							wp.media.editor.open(button);
							return false;
						});
					}
					ct_media_upload('.ct_tax_media_button_logon.button');
					$('body').on('click','.chi_tax_media_logo_remove',function(){
						$('#category-image-id').val('');
						$('#category-image-wrapper').html('<img class="custom_media_image_logo" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
					});
					// Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
					$(document).ajaxComplete(function(event, xhr, settings) {
						var queryStringArr = settings.data.split('&');
						if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
							var xml = xhr.responseXML;
							$response = $(xml).find('term_id').text();
							if($response!=""){
								// Clear the thumb image
								$('#category-image-wrapper').html('');
							}
						}
					});
				});
			</script>
        <?php }

    }

    $CHI_CATEGORY_LOGO = new CHI_CATEGORY_LOGO();
    $CHI_CATEGORY_LOGO -> init();

}


/** CHI SPACIAL LOGO print */
 function chi_special_logo()
 {
		$chi_special_logo = wp_get_attachment_image_src (  get_term_meta ( get_the_category()[0]->term_id , "category-image-id", true ), 'small')[0];
		if (isset($chi_special_logo) && !empty($chi_special_logo)) {?>
        <div class="chi-category-logo-center mb-3">
			<a href="<?php echo get_chi_make_specilal_form_category() ?>">
				<img src='<?php echo  $chi_special_logo; ?>'>
			</a>
        </div>
        <?php }
 }