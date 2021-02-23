<?php
// chi_checkbox Meta
/*
add_action("admin_init", "chi_checkbox_init");

function chi_checkbox_init(){
  add_meta_box("chi_checkbox", "Skrýt náhledový obrázek v textu", "chi_checkbox", "post", "normal", "high");
}

function chi_checkbox(){
  global $post;
  $custom = get_post_custom($post->ID);
  $chi_field_id = $custom["chi_field_id"][0];
 ?>

  <label for="chi_field_id">Nechci zobrazovat</label>
  <?php $chi_field_id_value = get_post_meta($post->ID, 'chi_field_id', true);
  if($chi_field_id_value == "yes") $chi_field_id_checked = 'checked="checked"'; ?>
    <input type="checkbox" id="chi_field_id" name="chi_field_id" value="yes" <?php echo $chi_field_id_checked; ?> />
  <?php

}

// Save Meta Details
add_action('save_post', 'save_details');

function save_details(){
  global $post;

if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
    return $post->ID;
}

  update_post_meta($post->ID, "chi_field_id", $_POST["chi_field_id"]);
}

add_action("admin_head", "chi_checkbox_style");

function chi_checkbox_style()
{
    ?>
	<style>
		input[type=checkbox]#chi_field_id {
			margin-top: 4px!important;
	</style>
	}
    <?php
}

*/
function add_featured_image_display_settings($content, $post_id)
{

    if ( get_post_type( get_the_ID() ) == "post" ) :
        $field_id    = 'show_featured_image';
        $field_value = esc_attr(get_post_meta($post_id, $field_id, true));
        $field_text  = esc_html__('Nechci zobrazovat v textu.', 'generatewp');
        $field_state = checked($field_value, 1, false);

        $field_label = sprintf(
            '<p><label for="%1$s"><input type="checkbox" name="%1$s" id="%1$s" value="%2$s" %3$s> %4$s</label></p>',
            $field_id, $field_value, $field_state, $field_text
        );

        return $content .= $field_label;
        endif;
    return $content;

}

add_filter('admin_post_thumbnail_html', 'add_featured_image_display_settings', 10, 2);

function save_featured_image_display_settings($post_ID, $post, $update)
{
    global $post;
    $is_revision = wp_is_post_revision($post);
    $field_id    = 'show_featured_image';
    $valuse = get_post_meta($post->ID, $field_id, true);


    $field_value = isset($_REQUEST[$field_id]) ? 1 : 0;

    if( defined('DOING_AUTOSAVE') && DOING_AUTOSAVE || $is_revision )
    {
        return;
    }


    if ( $field_value != 1 )
    {
        update_post_meta( $post->ID, $field_id, $field_value);
        return;
    }

    update_post_meta( $post->ID, $field_id, $field_value);
}

add_action('save_post', 'save_featured_image_display_settings', 10, 3);

