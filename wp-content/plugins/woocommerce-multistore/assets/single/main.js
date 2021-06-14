jQuery(function($) {
	$('.woonet-network-type-whats-difference-btn').on('click', function() {
		$('.woonet-network-type-whats-difference').toggle();
	});

	$('.woonet-wizard-option').on('change', function() {
		window.location.href = $(this).attr('data-target-url');
	});

	$('#woonet-add-child-site button').on('click', function() {
		if ( $('#woonet-add-child-site input').val() == "" ) {
			$('.error').html( "<p> URL can not be empty. </p>");
			$('.error').css('display', 'block');
		}

		var data = {
			'action': 'woonet_child_submit',
			'url': $('#woonet-add-child-site input').val()
		};

		$.post(ajaxurl, data, function(response) {
			var data = $.parseJSON(response);

			if ( data.error ) {
				$('.error').html(  "<p>" + data.message + "</p>");
				$('.error').css('display', 'block');
			}

			if ( data.success ) {
				$('.error').hide();
				$('#woonet-add-child-site').hide();
				$('#woonet-copy-code').val( data.copy_url );
				$('#woonet-copy-code-form').show();
			}
		});
	});

	$('#woonet-add-master-site button').on('click', function() {
		var data = {
			'action': 'woonet_verify',
			'url': $('#woonet-add-master-site input').val()
		};

		$.post(ajaxurl, data, function(response) {
			var data = $.parseJSON(response);

			if ( data.error ) {
				$('.error').html(  "<p>" + data.message + "</p>");
				$('.error').css('display', 'block');
			}

			if ( data.success ) {
				window.location.href = window.location.href;
				$('.notice-success').html(  "<p>" + data.message + "</p>" );
				$('.notice-success').css('display', 'block');
				$('#woonet-add-child-site input').val( data.copy_url );
			}
		});
	});

	$('#woonet-delete-master-site button').on('click', function() {
		var data = {
			'action': 'woonet_delete_master'
		};

		$.post(ajaxurl, data, function(response) {
			var data = $.parseJSON(response);

			if ( data.error ) {
				$('.error').html(  "<p>" + data.message + "</p>");
				$('.error').css('display', 'block');
			}

			if ( data.success ) {
				window.location.href = window.location.href;
			}
		});
	});
});