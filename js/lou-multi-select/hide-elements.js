jQuery( document ).ready(function() {


	$clicket = 	jQuery(function () {
		jQuery("#chi_selected_in_claim_posts").next().addClass("for-length");
		$ul = jQuery(".for-length").find(".ms-selection");
		$liLen = $ul.find(".ms-selected").length;

		$clicket = $liLen;

		return $clicket;
	});


	$selectable = jQuery(".ms-elem-selectable");


	$selectable.on("click", function (e)
	{
		$selectable = jQuery(".ms-elem-selectable");
		$selection = jQuery(".ms-elem-selection .ms-selected");

		console.log($selection.length)
		$selection.removeClass("hide");
		var id = e.currentTarget.id;
		id = id.replace("-selectable", "-selection");
		$area = jQuery(".ms-list")[7];
		$area = jQuery(".ms-list").children(".ms-selected").length;

		var selection = jQuery(id);
		$has = "#";

		jQuery("#chi_selected_in_claim_posts").next().addClass("for-length");
		$ul = jQuery(".for-length").find(".ms-selection");
		$liLen = $ul.find(".ms-selected").length;
		$clicket = $liLen;
		console.log($clicket);

		//console.log(id);
		//console.log($area);
		//console.log(selection);

		id  = $has.concat(id);
		//console.log(id);

		selection = jQuery(".ms-list").children(id)[1];

		$clicket++;

		if ($clicket > 3)
		{
			jQuery(this).toggleClass("show");

			//selection = selection.find("li");
			//selection.style.display = "none";
			jQuery(selection).toggleClass("hide");
			$clicket = 3;
		}


		console.log("Left:");
		console.log($clicket);
	});

	$selected = jQuery(".ms-selection");


	$selection = jQuery(".ms-elem-selection .ms-selected");
	$selection.on("click", function (e){
		jQuery("#chi_selected_in_claim_posts").next().addClass("for-length");
		$ul = jQuery(".for-length").find(".ms-selection");
		$liLen = $ul.find(".ms-selected").length;
		$clicket = $liLen;
		if ($clicket > 2)
		{
			$clicket = 1;
		}
		$clicket--;

		console.log("Right:");
		console.log($clicket);

	});

});