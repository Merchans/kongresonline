<?php global $wp_query;

			// don't display the button if there are not enough posts
			if ( $wp_query->max_num_pages > 1 ) {
				echo '<div class="articles__more chi-more-videos-btn">
                <span class="chi-more-videos-btn__text">More posts</div></a>';
			} // you can use <a> as well
?>

<?php echo '<nav class="d-flex justify-content-end"><ul class="pagination chi-pagination">';?>
<?php echo paginate_links(
    array(
        'format' => 'page/%#%/#ostatni-clanky',
        'before_page_number'	=>'<span class="chi-page-link">',
        'after_page_number'		=> '</span>',
        'prev_text' => '',
        'next_text' => '<i class="chi-next-button"></i>'
    ));  ?>
<?php echo '</ul></nav>'; ?>