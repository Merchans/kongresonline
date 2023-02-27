<?php if (is_single()) {
    $page_id = get_the_ID();
    $post_category_name = get_the_category($page_id)[0]->slug;
} else {
    $post_category_name = single_cat_title('', false);
}
?>
<div class="chi-search-wrapper <?php if (is_front_page() || is_page() || is_search()) echo 'chi-search-wrapper--front-page' ?>">
    <form class="form-inline" method="get" id="chi-search-form" autocomplete="off">
        <div class="chi-search">
            <input class="form-control mr-sm-2 w-100" id="chi-search-input" type="text" placeholder="Vyhledat na celém portále&hellip;" aria-label="Search" name="s" data-category="<?php echo $post_category_name ?>">
        </div>
    </form>
    <div class="chi-search-list" id="search-results">
    </div>
</div>