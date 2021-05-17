<?php
function theme_settings_page(){}

function chi_add_setings_submenu_item()
{
    add_submenu_page( 'options-general.php',
        __( 'Nastavení úvodní stránky', 'chi-templates' ),
        __( 'Nastavení úvodní stránky', 'chi-templates' ),
        'manage_options',
        'chi-hompepage-setings',
        'chi_theme_setings_callback',

    );
}

add_action("admin_menu", "chi_add_setings_submenu_item");



function chi_theme_setings_callback()
{
 ?>
        <div class="wrap">
            <h1>Nastavení úvodní stránky</h1>
            <form method="post" action="options-general.php?page=chi-hompepage-setings">
				<?php
                settings_fields("chi_main_logo");
                settings_fields("chi_subtitle_section");
                settings_fields("chi_homepage_description");
                settings_fields("chi_all_posts_and_videos");
                do_settings_sections("chi-theme-options");
                submit_button();
                ?>
            </form>
        </div>
        <?php
}

function chi_dispalay_logo_sub_title()
{
    ?>
    <input type="text" name="chi_sub_logo_title" id="chi_sub_logo_title" class="regular-text" value="<?php echo get_option('chi_sub_logo_title'); ?>" />
    <?php
}

function chi_dispalay_description()
{
    ?>
	<textarea name="chi_homepage_description" id="chi_homepage_description" rows="5" cols="50" class="large-text" spellcheck="true"><?php echo get_option('chi_homepage_description'); ?></textarea>
    <?php
    }

function display_theme_panel_fields()
{
    add_settings_section("chi_subtitle_section", "Všechna nastavení", null, "chi-theme-options");

    add_settings_field("chi_main_logo", "Hlavní logo kongresonline", "media_selector_settings_page_callback", "chi-theme-options", "chi_subtitle_section");
    add_settings_field("chi_sub_logo_title", "Titulek pod logem", "chi_dispalay_logo_sub_title", "chi-theme-options", "chi_subtitle_section");
    add_settings_field("chi_homepage_description", "Popis titulní stránky", "chi_dispalay_description", "chi-theme-options", "chi_subtitle_section");
    add_settings_field("chi_all_posts_and_videos", "Vybrané témata na titulní stránku", "chi_selected_articles_or_videos_page_options_page_options", "chi-theme-options", "chi_subtitle_section");

    //register_setting("chi_subtitle_section", "chi_sub_logo_title");
    register_setting("chi_main_logo", "chi_main_logo", "media_selector_settings_page_callback");
}

add_action("admin_init", "display_theme_panel_fields");


function media_selector_settings_page_callback() {

    // Save attachment ID
    if ( !empty( $_POST['image_attachment_id'] ) && isset( $_POST['image_attachment_id'] ) ) :
        update_option( 'media_selector_attachment_id', absint( $_POST['image_attachment_id'] ) );
    endif;
    if ( !empty( $_POST['chi_sub_logo_title'] ) && isset( $_POST['chi_sub_logo_title'] ) ) :
        update_option( 'chi_sub_logo_title', $_POST['chi_sub_logo_title']  );
    endif;
    if ( !empty( $_POST['chi_homepage_description'] ) && isset( $_POST['chi_homepage_description'] ) ) :
        update_option( 'chi_homepage_description', $_POST['chi_homepage_description']  );
    endif;

    if ( isset( $_POST['chi_selected_articles_or_videos_page_options'] ) && !empty($_POST['chi_selected_articles_or_videos_page_options']) ) {

        $sanitized_data_posts = array();

        $data_posts = (array)$_POST['chi_selected_articles_or_videos_page_options'];

        foreach ( $data_posts as $key => $value) {
            $sanitized_data_posts[$key] = (int)strip_tags(stripslashes($value));
        }
        update_option( 'chi_selected_articles_or_videos_page_options', $_POST['chi_selected_articles_or_videos_page_options']);
    }
    else
	{
        update_option( 'chi_selected_articles_or_videos_page_options', "");
	}

    ?><!--<form method='post' action="options-general.php?page=chi-hompepage-setings">-->
	<div class='image-preview-wrapper'>
		<img id='image-preview' src='<?php echo wp_get_attachment_url( get_option( 'media_selector_attachment_id' ) ); ?>' width='300'>
	</div>
	<input id="upload_image_button" type="button" class="button" value="<?php _e( 'Upload image' ); ?>" />
	<input type='hidden' name='image_attachment_id' id='image_attachment_id' value='<?php echo get_option( 'media_selector_attachment_id' ); ?>'>
	<!--</form>--><?php

}

add_action( 'admin_footer', 'media_selector_print_scripts' );

function media_selector_print_scripts() {

    $my_saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );

    ?><script type='text/javascript'>

		jQuery( document ).ready( function( $ ) {

			// Uploading files
			var file_frame;
			var wp_media_post_id = wp.media.model.settings.post.id; // Store the old id
			var set_to_post_id = <?php echo $my_saved_attachment_post_id; ?>; // Set this

			jQuery('#upload_image_button').on('click', function( event ){

				event.preventDefault();

				// If the media frame already exists, reopen it.
				if ( file_frame ) {
					// Set the post ID to what we want
					file_frame.uploader.uploader.param( 'post_id', set_to_post_id );
					// Open frame
					file_frame.open();
					return;
				} else {
					// Set the wp.media post id so the uploader grabs the ID we want when initialised
					wp.media.model.settings.post.id = set_to_post_id;
				}

				// Create the media frame.
				file_frame = wp.media.frames.file_frame = wp.media({
					title: 'Select a image to upload',
					button: {
						text: 'Use this image',
					},
					multiple: false	// Set to true to allow multiple files to be selected
				});

				// When an image is selected, run a callback.
				file_frame.on( 'select', function() {
					// We set multiple to false so only get one image from the uploader
					attachment = file_frame.state().get('selection').first().toJSON();

					// Do something with attachment.id and/or attachment.url here
					$( '#image-preview' ).attr( 'src', attachment.url ).css( 'width', 'auto' );
					$( '#image_attachment_id' ).val( attachment.id );

					// Restore the main post ID
					wp.media.model.settings.post.id = wp_media_post_id;
				});

				// Finally, open the modal
				file_frame.open();
			});

			// Restore the main ID when the add media button is pressed
			jQuery( 'a.add_media' ).on( 'click', function() {
				wp.media.model.settings.post.id = wp_media_post_id;
			});
		});

	</script><?php

}




function chi_selected_articles_or_videos_page_options_page_options($post)
{
    wp_nonce_field('chi_selected_articles_or_videos_page_options_page_options', 'chi_selected_articles_or_videos_page_options_page_options_nonce');

    $args                  = array('post_type' => array('post', 'chi_video'), 'numberposts' => -1,);
    $chi_posts_loop = get_posts($args);


    $chi_selected_articles_or_videos_page_options_values = get_option('chi_selected_articles_or_videos_page_options'); ?>

	<select name="chi_selected_articles_or_videos_page_options[]" id="chi_selected_articles_or_videos_page_options" multiple="multiple">
        <?php
        foreach ($chi_posts_loop as $chi_post) {
            $dir_id = $chi_post->ID;
            $selected = (in_array($dir_id, $chi_selected_articles_or_videos_page_options_values)) ? 'selected="selected"' : '';  $print = true;
            ?>
			<option <?php echo $selected;?> value="<?php echo $dir_id ?>">
                <?php echo $chi_post->post_title; ?>
			</option>
            <?php
        }
        ?>
	</select>
    <?php
}
?>
<?php

/*-----------------------------------------------------------------------------------*/
/* All Pages Dropdown List */
/*-----------------------------------------------------------------------------------*/

if ( !function_exists( 'admin_menu_links_to_all_edit_post_type_custom' ) ) {
    function admin_menu_links_to_all_edit_post_type_custom() {
        if ( !is_admin() ) // Only Run if On Admin Pages
            return;

        $custom = 'page';  // Change this to your custom post type slug ( So for "http://www.example.com/wp-admin/edit.php?post_type=recipes" you would change this to 'recipes'  )



        // Full List of Paramaters - http://codex.wordpress.org/Template_Tags/get_posts
        $args = array(
            'orderby'          => 'modified', //Orderr by date , title , modified, etc
            'order'            => 'DESC', // Show most recently edited on top
            'post_type'        => $custom, // Post Type Slug
            'numberposts'      => -1,  // Number of Posts to Show (Use -1 to Show All)
            'post_status'      => array('publish', 'pending', 'draft', 'future', 'private', 'inherit'),
        );
        $types = get_posts( $args ); // Get All Pages
        foreach ($types as $post_type) {
            add_submenu_page( // add_submenu_page( $parent_slug, $page_title, $menu_title, $capability, $menu_slug, $function );
                'edit.php?post_type='.$custom
                , esc_attr(ucwords($post_type->post_title)) // Get title, remove bad characters, and uppercase it
                , esc_attr(ucwords($post_type->post_title)) // Get title, remove bad characters, and uppercase it
                , 'edit_posts' // Require Edit Post/Page/Custom Capability
                , 'post.php?post=' . $post_type->ID . '&amp;action=edit' // Get the page link by its id
                , '' // No function callback
            );
        }
        wp_reset_postdata();
    }
    add_action('admin_menu', 'admin_menu_links_to_all_edit_post_type_custom');
}
/*
if ( !function_exists( 'admin_menu_links_to_all_edit_post_type_custom_css' ) ) {
    function admin_menu_links_to_all_edit_post_type_custom_css() {
        ?>
		<style type="text/css">
			ul#adminmenu li.wp-has-submenu > ul.wp-submenu.wp-submenu-wrap {
				max-height: 700px;
				overflow-x: scroll;
			}
		</style>
        <?php
    }
    add_action('admin_head', 'admin_menu_links_to_all_edit_post_typecustom_css');
}
*/