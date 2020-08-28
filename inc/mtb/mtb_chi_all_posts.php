<?php

add_action("add_meta_boxes", "chi_selected_articles_or_video");

function chi_selected_articles_or_video()
{
    $screen = array("post", "chi_video");
    add_meta_box
    (
        "all-posts-thems-meta",
        "Vhodné témata",
        "chi_selected_articles_or_videos_meta_options",
        $screen,
        "side",
        'high'
    );
}

function chi_selected_articles_or_videos_meta_options($post)
{
    wp_nonce_field('chi_selected_articles_or_videos_meta_options', 'chi_selected_articles_or_videos_meta_options_nonce');

    $args                  = array('post_type' => array('post', 'chi_video'), 'numberposts' => -1,);
    $chi_posts_loop = get_posts($args);


    $chi_selected_articles_or_videos_values = get_post_meta($post->ID, '_chi_selected_articles_or_videoss', true); ?>

    <br>
    <p><strong>Vybrané témata k článku</strong></p>
    <br>
    <select name="chi_selected_articles_or_videos[]" id="chi_selected_articles_or_videos" multiple="multiple">
        <?php
        foreach ($chi_posts_loop as $chi_post) {
            $dir_id = $chi_post->ID;

            $selected = (in_array($dir_id, $chi_selected_articles_or_videos_values)) ? 'selected="selected"' : '';  $print = true;
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


/**
 * Hooks into WordPress' save_post function
 */
add_action('save_post', 'chi_selected_articles_or_video_save');
function chi_selected_articles_or_video_save( $post_id )
{
    if ( isset( $_POST['chi_selected_articles_or_videos'] ) && !empty($_POST['chi_selected_articles_or_videos']) ) {

        $sanitized_data_posts = array();

        $data_posts = (array)$_POST['chi_selected_articles_or_videos'];

        foreach ( $data_posts as $key => $value) {
            $sanitized_data_posts[$key] = (int)strip_tags(stripslashes($value));
        }

        update_post_meta($post_id, '_chi_selected_articles_or_videoss', $sanitized_data_posts);
    }
    else
    {
        delete_post_meta( $post_id, '_chi_selected_articles_or_videoss');
    }

}

