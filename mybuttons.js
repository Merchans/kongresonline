(function() {
	/* Register the buttons */
	tinymce.create('tinymce.plugins.MyButtons', {
		init : function(ed, url) {
			/**
			 * Inserts shortcode content
			 */
			ed.addButton( 'chi_stats', {
				title : 'Počítadlo',
				image : '../wp-content/themes/chi/img/statistics-svgrepo-com.svg',
				cmd: 'plugin_command'
			});

			// Called when we click the Insert Gistpen button
			ed.addCommand( 'plugin_command', function() {
				// Calls the pop-up modal
				ed.windowManager.open({
					// Modal settings
					title: 'Počítadlo',
					width: jQuery( window ).width() * 0.7,
					// minus head and foot of dialog box
					height: (jQuery( window ).height() - 36 - 50) * 0.7,
					inline: 1,
					id: 'plugin-slug-insert-dialog',
					body: [{
						type: 'container',
						html: jQuery("#content").val().replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/ig,'').length,
					}],
					buttons: [
						{
							text: 'Cancel',
							id: 'plugin-slug-button-cancel',
							onclick: 'close'
						}],
				});

				appendInsertDialog();

			});

		},
		createControl : function(n, cm) {
			return null;
		},

		lenght : function()
		{
			jQuery("#content").val().replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/ig,'').length
		}

	});

	/* Start the buttons */
	tinymce.PluginManager.add( 'my_button_script', tinymce.plugins.MyButtons );
})();