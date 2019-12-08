class CheckoutRoute {

	init() {
		var ckbox = $('#custom_checkbox'), gr = $('#gift_recipient');
		$('.giftcheckbox input').on('click',function () {
			if (ckbox.is(':checked')) {
				gr.slideDown(700);
			} else {
				gr.slideUp(700);
			}
		});
		$(document.forms.checkout).on('change', function() {
			// disable the gift checkbox if local pickup
			/*
			var rad = this.querySelector('.shipping_method:checked');
			if (rad) {
				ckbox.prop('disabled', rad.id.indexOf('local_pickup') != -1);
				if (rad.id.indexOf('local_pickup') != -1) {
					ckbox.prop('checked', false);
					gr.slideUp(700);
				}
			}
			*/
		}).on('submit', function() {
			// fill the hidden gift recipient fields from the shipping fields
			var _ = document.getElementById.bind(document);
			var prefix = _('shipping_first_name') ? 'shipping' : 'billing';
			_('recipient_name').value = _(prefix + '_first_name').value + ' ' + _(prefix + '_last_name').value;
			_('recipient_address').value = _(prefix + '_address_1').value + ' ' + _(prefix + '_address_2').value;
			_('recipient_city').value = _(prefix + '_city').value;
			_('recipient_state').value = _(prefix + '_state').value;
			_('recipient_zip').value = _(prefix + '_postcode').value;
		});
	}

	finalize() {
	}

}
