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