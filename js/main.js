jQuery(function(){
	
	var post_edit = new ZeroClipboard(jQuery("#copy-url-button"), {
		moviePath: ZeroClipboardSettings.path // This variable is defined in method add_clipboard_path()
	} );

	var row_actions = new ZeroClipboard( jQuery(".row-action-copy-url"), {
		moviePath: ZeroClipboardSettings.path // This variable is defined in method add_clipboard_path()
	} );

	row_actions.on( 'mouseover', function(client, args) {
		var selectedLink = jQuery('.zeroclipboard-is-hover').first();
		if(selectedLink){
			selectedLink.parent().parent().css('visibility', 'visible');
		}
	} );

	post_edit.on( 'complete', function(client, args) {	
		alert("URL Copied to Clipboard");
	} );

	row_actions.on( 'mouseout', function(client, args) {
		var selectedLink = jQuery('.row-actions');
		if(selectedLink){
			selectedLink.removeAttr("style");
		}		
	} );

	row_actions.on( 'complete', function(client, args) {	
		alert("URL Copied to Clipboard");
	} );
});