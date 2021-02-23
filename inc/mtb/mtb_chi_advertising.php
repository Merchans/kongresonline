<?php

add_action("add_meta_boxes", "ticket_directors_to_movie");

function ticket_directors_to_movie()
{
    $screen = array("post", "chi_video");
    add_meta_box
    (
        "all-movies-meta",
        "Vyberte inzerci horizontální nebo vertikální",
        "ticket_directors_to_movies_meta_options",
        $screen,
        "advanced",
        'high'
    );
}

function ticket_directors_to_movies_meta_options($post)
{
    wp_nonce_field('ticket_directors_to_movies_meta_options', 'ticket_directors_to_movies_meta_options_nonce');

    $args                  = array('post_type' => 'chi_inzerce', 'numberposts' => -1,);
    $ticket_directors_loop = get_posts($args);


	(array)$chi_advertising_horizontal_values = get_post_meta($post->ID, '_chi_advertising_horizontals', true);

	?>

    <br>
    <p><strong>Vyberte všechny horizontální inzerce</strong></p>
    <br>
    <select name="chi_advertising_horizontal[]" id="actors_id" multiple="multiple">
        <?php
        foreach ($ticket_directors_loop as $ticket_director) {
            $dir_id = $ticket_director->ID;
			$print = true;

            if ( empty($chi_advertising_horizontal_values) )
            {
                $selected = '';
            }
            else
			{
                $selected = in_array($dir_id, $chi_advertising_horizontal_values) ? 'selected="selected"' : '';
			}


            ?>
            <option <?php echo $selected?> value="<?php echo $dir_id ?>">
                <?php echo $ticket_director->post_title; ?>
            </option>
            <?php
        }
        ?>
    </select>
    <br>
    <p><strong>Vyberte všechny vertikální inzerce</strong></p>
    <br>
    <select name="chi_advertising_vertical[]" id="directors_id" multiple="multiple">
        <?php
        $args               = array('post_type' => 'chi_inzerce', 'numberposts' => -1,);
        $ticket_actors_loop = get_posts($args);
		(array)$chi_advertising_vertical_values = get_post_meta($post->ID, '_chi_advertising_verticals', true);

        foreach ($ticket_actors_loop as $ticket_actor) {
            $dir_id = $ticket_actor->ID;
            $print = true;


            if ( empty($chi_advertising_vertical_values) )
            {
                $selected = '';
            }
            else
            {
                $selected = (in_array($dir_id, $chi_advertising_vertical_values)) ? 'selected="selected"' : '';
            }
            ?>
            <option <?php echo $selected;?> value="<?php echo $dir_id ?>">
                <?php echo $ticket_actor->post_title; ?>
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
add_action('save_post', 'ticket_movies_save_post');
//add_action('pre_get_scheduled_event', 'ticket_movies_save_post');

// https://wordpress.stackexchange.com/questions/288501/meta-value-does-not-save-for-scheduled-posts

function ticket_movies_save_post(  )
{
    global $post;
	$nonce = $_POST['ticket_directors_to_movies_meta_options_nonce'];

    if ( !wp_verify_nonce( $nonce, 'ticket_directors_to_movies_meta_options' ) )
        return;

	if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE){
        return;
    }


//	if ( !isset( $_POST['chi_advertising_horizontal']) && !isset( $_POST['chi_advertising_vertical']  ) )
//		return;


    if ( isset( $_POST['chi_advertising_horizontal'] ) && !empty($_POST['chi_advertising_horizontal'] )) {

        $sanitized_data_directors = array();


        $data_directors = (array)$_POST['chi_advertising_horizontal'];

        foreach ($data_directors as $key => $value) {
            $sanitized_data_directors[$key] = (int)strip_tags(stripslashes($value));
        }

        update_post_meta($post->ID, '_chi_advertising_horizontals', $sanitized_data_directors);
    }
    else
    {
        delete_post_meta( $post->ID, '_chi_advertising_horizontals');
    }

    if ( isset( $_POST['chi_advertising_vertical'] ) && !empty($_POST['chi_advertising_vertical'] )) {

        $sanitized_data_actors    = array();

        $data_actors    = (array)$_POST['chi_advertising_vertical'];

        foreach ($data_actors as $key => $value) {
            $sanitized_data_actors[$key] = (int)strip_tags(stripslashes($value));
        }

        update_post_meta($post->ID, '_chi_advertising_verticals', $sanitized_data_actors);
    }
    else
    {
        delete_post_meta( $post->ID, '_chi_advertising_verticals');
    }


}
