// run pre selected options;
	$('#chi_selected_articles_or_videos_page_options, #directors_id, #actors_id, #chi_selected_articles_or_videos, #chi_selected_thems_in_category, #chi_selected_in_category_advertising_horizontal, #chi_selected_in_category_advertising_vertical').multiSelect({

	selectableHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=' Vyhledávání...'>",
	selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder=' Vyhledávání...'>",
	afterInit: function(ms){
		var that = this,
		    $selectableSearch = that.$selectableUl.prev(),
		    $selectionSearch = that.$selectionUl.prev(),
		    selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
		    selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

		that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
			.on('keydown', function(e){
				if (e.which === 40){
					that.$selectableUl.focus();
					return false;
				}
			});

		that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
			.on('keydown', function(e){
				if (e.which == 40){
					that.$selectionUl.focus();
					return false;
				}
			});
	},
	afterSelect: function(){
		this.qs1.cache();
		this.qs2.cache();
	},
	afterDeselect: function(){
		this.qs1.cache();
		this.qs2.cache();
	}
});
