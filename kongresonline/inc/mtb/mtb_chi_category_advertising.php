<?php

/* HORIZONTAL SECTION */

add_action("edit_category_form_fields", "chi_selected_in_category_advertising_horizontal");

function chi_selected_in_category_advertising_horizontal($post)
{
    wp_nonce_field('chi_selected_in_category_advertising_horizontal', 'chi_selected_in_category_advertising_horizontal_nonce');

    $args                  = array('post_type' => 'chi_inzerce', 'numberposts' => -1,);
    $chi_posts_loop = get_posts($args);


    $chi_selected_in_category_advertising_horizontal_values = get_term_meta($_GET["tag_ID"], 'chi_selected_in_category_advertising_horizontal', true); ?>
    <tr class="form-field">
        <th scope="row"><label for="chi_selected_in_category_advertising_horizontal">Výběr horizontální inzerce</label></th>
        <td>
            <select name="chi_selected_in_category_advertising_horizontal[]" id="chi_selected_in_category_advertising_horizontal" multiple="multiple">
                <?php
                foreach ($chi_posts_loop as $chi_post) {
                    $dir_id = $chi_post->ID;

                    $selected = (in_array($dir_id, $chi_selected_in_category_advertising_horizontal_values)) ? 'selected="selected"' : '';  $print = true;
                    ?>
                    <option <?php echo $selected;?> value="<?php echo $dir_id ?>">
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
add_action('edited_category', 'chi_selected_in_category_advertising_horizontal_save');
function chi_selected_in_category_advertising_horizontal_save( $term_id  )
{

    if (isset( $_POST['chi_selected_in_category_advertising_horizontal'] ) && '' !== $_POST['chi_selected_in_category_advertising_horizontal']  ) {

        $sanitized_data_posts = array();
        delete_term_meta( $term_id, 'chi_selected_in_category_advertising_horizontal');
        $data_posts = (array)$_POST['chi_selected_in_category_advertising_horizontal'];

        foreach ( $data_posts as $key => $value) {
            $sanitized_data_posts[$key] = (int)strip_tags(stripslashes($value));
        }

        $image = $_POST['chi_selected_in_category_advertising_horizontal'];
        add_term_meta( $term_id, 'chi_selected_in_category_advertising_horizontal', $image, true );
    }
    else
    {
        delete_term_meta( $term_id, 'chi_selected_in_category_advertising_horizontal');
    }

}


/* HORIZONTAL VERTICAL */

add_action("edit_category_form_fields", "chi_selected_in_category_advertising_vertical");

function chi_selected_in_category_advertising_vertical($post)
{
    wp_nonce_field('chi_selected_in_category_advertising_vertical', 'chi_selected_in_category_advertising_vertical_nonce');

    $args                  = array('post_type' => 'chi_inzerce', 'numberposts' => -1,);
    $chi_posts_loop = get_posts($args);


    $chi_selected_in_category_advertising_horizontal_values = get_term_meta($_GET["tag_ID"], 'chi_selected_in_category_advertising_vertical', true); ?>
    <tr class="form-field">
        <th scope="row"><label for="chi_selected_in_category_advertising_horizontal">Výběr vertikální inzerce</label></th>
        <td>
            <select name="chi_selected_in_category_advertising_vertical[]" id="chi_selected_in_category_advertising_vertical" multiple="multiple">
                <?php
                foreach ($chi_posts_loop as $chi_post) {
                    $dir_id = $chi_post->ID;

                    $selected = (in_array($dir_id, $chi_selected_in_category_advertising_horizontal_values)) ? 'selected="selected"' : '';  $print = true;
                    ?>
                    <option <?php echo $selected;?> value="<?php echo $dir_id ?>">
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
add_action('edited_category', 'chi_selected_in_category_advertising_vertical_save');
function chi_selected_in_category_advertising_vertical_save( $term_id  )
{

    if (isset( $_POST['chi_selected_in_category_advertising_vertical'] ) && '' !== $_POST['chi_selected_in_category_advertising_vertical']  ) {

        $sanitized_data_posts = array();
        delete_term_meta( $term_id, 'chi_selected_in_category_advertising_vertical');
        $data_posts = (array)$_POST['chi_selected_in_category_advertising_vertical'];

        foreach ( $data_posts as $key => $value) {
            $sanitized_data_posts[$key] = (int)strip_tags(stripslashes($value));
        }

        $image = $_POST['chi_selected_in_category_advertising_vertical'];
        add_term_meta( $term_id, 'chi_selected_in_category_advertising_vertical', $image, true );
    }
    else
    {
        delete_term_meta( $term_id, 'chi_selected_in_category_advertising_vertical');
    }

}