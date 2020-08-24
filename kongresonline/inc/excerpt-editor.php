<?php
class Excerpt {

public function __construct() {
add_filter('excerpt_more', [$this, 'excerpt_more']);
add_action('edit_form_after_title', [$this, 'excerpt']);
add_action('admin_menu', [$this, 'remove_excerpt_metabox']);
add_filter('wp_trim_excerpt', [$this, 'wp_trim_excerpt'], 10, 2);
}

/**
* Remove metabox from post
*/
public function remove_excerpt_metabox() {
remove_meta_box('postexcerpt', 'post', 'normal');
}

/**
* Strip tags
*
* @param string $text
* @return string
*/
public function wp_trim_excerpt($text = '') {
return strip_tags($text, '<a><strong><em><b><i><code><ul><ol><li><blockquote><del><ins><img><pre><code><>');
    }

    /**
     * More sign...
     *
     * @return string
     */
    public function excerpt_more() {
        return '&hellip;';
    }

    /**
     * Excerpt editor after post title.
     *
     * @param $post
     */
    public function excerpt($post) {
        if ($post->post_type !== 'post' && $post->post_type !== 'chi_video') return;
        wp_editor(
            html_entity_decode($post->post_excerpt),
            'html-excerpt',
            [
                'teeny' => true,
                'quicktags' => true,
                'wpautop' => true,
                'media_buttons' => false,
                'textarea_rows' => 7,
                'textarea_name' => 'excerpt'
            ]
        );
    }
}