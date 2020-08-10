<?php
/**
 * Plugin class
 **/
if ( ! class_exists( 'CHI_CATEGORY_BACKGROUND' ) ) {

    class CHI_CATEGORY_BACKGROUND {

        public function __construct() {
            //
        }

        /*
         * Initialize the class and start calling our hooks and filters
         * @since 1.0.0
        */
        public function init() {
            add_action( 'category_add_form_fields', array ( $this, 'add_category_background' ), 10, 2 );
            add_action( 'created_category', array ( $this, 'save_category_background' ), 10, 2 );
            add_action( 'category_edit_form_fields', array ( $this, 'update_category_background' ), 10, 2 );
            add_action( 'edited_category', array ( $this, 'updated_category_background' ), 10, 2 );
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
        public function add_category_background ( $taxonomy ) { ?>
            <div class="form-field term-group">
                <label for="category-backgound-id"><?php _e('Pozadí speciálu', 'chi-templates'); ?></label>
                <input type="hidden" id="category-backgound-id" name="category-backgound-id" class="custom_media_url" value="">
                <div id="category-backgound-wrapper"></div>
                <p>
                    <input type="button" class="button button-secondary ct_tax_media_button_background" id="ct_tax_media_button_background" name="ct_tax_media_button_background" value="<?php _e( 'Add Image', 'chi-templates' ); ?>" />
                    <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'chi-templates' ); ?>" />
                </p>
            </div>
            <?php
        }

        /*
         * Save the form field
         * @since 1.0.0
        */
        public function save_category_background ( $term_id, $tt_id ) {
            if( isset( $_POST['category-backgound-id'] ) && '' !== $_POST['category-backgound-id'] ){
                $image = $_POST['category-backgound-id'];
                add_term_meta( $term_id, 'category-backgound-id', $image, true );
            }
        }

        /*
         * Edit the form field
         * @since 1.0.0
        */
        public function update_category_background ( $term, $taxonomy ) { ?>
            <tr class="form-field term-group-wrap">
                <th scope="row">
                    <label for="category-backgound-id"><?php _e( 'Pozadí speciálu', 'chi-templates' ); ?></label>
                </th>
                <td>
                    <?php $image_id = get_term_meta ( $term -> term_id, 'category-backgound-id', true ); ?>
                    <input type="hidden" id="category-backgound-id" name="category-backgound-id" value="<?php echo $image_id; ?>">
                    <div id="category-backgound-wrapper">
                        <?php if ( $image_id ) { ?>
                            <?php echo wp_get_attachment_image ( $image_id, 'medium' ); ?>
                        <?php } ?>
                    </div>
                    <p>
                        <input type="button" class="button button-secondary ct_tax_media_button_background" id="ct_tax_media_button_background" name="ct_tax_media_button_background" value="<?php _e( 'Add Image', 'chi-templates' ); ?>" />
                        <input type="button" class="button button-secondary ct_tax_media_remove" id="ct_tax_media_remove" name="ct_tax_media_remove" value="<?php _e( 'Remove Image', 'chi-templates' ); ?>" />
                    </p>
                </td>
            </tr>
            <?php
        }

        /*
         * Update the form field value
         * @since 1.0.0
         */
        public function updated_category_background ( $term_id, $tt_id ) {
            if( isset( $_POST['category-backgound-id'] ) && '' !== $_POST['category-backgound-id'] ){
                $image = $_POST['category-backgound-id'];
                update_term_meta ( $term_id, 'category-backgound-id', $image );
            } else {
                update_term_meta ( $term_id, 'category-backgound-id', '' );
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
									$('#category-backgound-id').val(attachment.id);
									$('#category-backgound-wrapper').html('<img class="custom_media_image_background" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
									$('#category-backgound-wrapper .custom_media_image_background').attr('src',attachment.url).css('display','block');
								} else {
									return _orig_send_attachment.apply( button_id, [props, attachment] );
								}
							}
							wp.media.editor.open(button);
							return false;
						});
					}
					ct_media_upload('.ct_tax_media_button_background.button');
					$('body').on('click','.ct_tax_media_remove',function(){
						$('#category-backgound-id').val('');
						$('#category-backgound-wrapper').html('<img class="custom_media_image_background" src="" style="margin:0;padding:0;max-height:100px;float:none;" />');
					});
					// Thanks: http://stackoverflow.com/questions/15281995/wordpress-create-category-ajax-response
					$(document).ajaxComplete(function(event, xhr, settings) {
						var queryStringArr = settings.data.split('&');
						if( $.inArray('action=add-tag', queryStringArr) !== -1 ){
							var xml = xhr.responseXML;
							$response = $(xml).find('term_id').text();
							if($response!=""){
								// Clear the thumb image
								$('#category-backgound-wrapper').html('');
							}
						}
					});
				});
            </script>
        <?php }

    }

    $CHI_CATEGORY_BACKGROUND = new CHI_CATEGORY_BACKGROUND();
    $CHI_CATEGORY_BACKGROUND -> init();

}


/** CHI SPACIAL LOGO print */
function chi_special_background()
{
    $chi_special_background = wp_get_attachment_image_src (  get_term_meta ( get_the_category()[0]->term_id , "category-backgound-id", true ), 'small')[0];
    if (isset($chi_special_background) && !empty($chi_special_background)) {?>
        <style>
            .chi-claim {
                background: linear-gradient(0deg, rgba(0, 0, 0, 0.34), rgba(0, 0, 0, 0.34)), url(<?php echo $chi_special_background ?>);
                height: 510px;
            }
        </style>
    <?php }
}