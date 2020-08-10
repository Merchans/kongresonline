<?php

	$category = get_the_category();
	$category_ID = $category[0]->cat_ID;
	$option = (get_term_meta($category_ID, '_chi_selected_one_options')[0]);
	switch ($option)
	{
		case 2:
            get_template_part("assets/claims/option-2");
            die();
			break;
		case 3:
            get_template_part("assets/claims/option-3");
            die();
			break;
		default;
            get_template_part("assets/claims/option-default");
            die();
			break;
	}