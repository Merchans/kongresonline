<?php
get_header();
wp_head();
?>
<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post() ?>
    <?php

    	the_title();

    ?>
    <?php endwhile ?>
<?php else : ?>

<?php endif ?>
<?php
get_footer();
wp_footer();

?>
