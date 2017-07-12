jQuery(function ($) {

	// Check all AJAX requests.
	$(document).ajaxComplete(function (event, xhr, settings) {
		try {
			// If the action of the request is "edd_load_gateway", then it's the request we want.
			if (settings.data.indexOf('action=edd_load_gateway') !== false) {
				
				// Loop over user-submitted form data (from PHP session), and repopulate it.
				for (var key in kanban_checkout.form_data.post_data) {
					$('[name="' + key + '"]').val(kanban_checkout.form_data.post_data[key]);
				}
			}
		}
		catch (err) {
		}
	});

});
