$('#ship_to_event_list').change(function(){

	var id = $(this).attr('id');
	
	var data = {
		eventname: $(this).val(),
		action: 'get_event_address',
		security: ajax_object.ajax_nonce
	};

	// Get event address
	$.ajax({
		type: 'POST',
		url: ajax_object.ajax_url,
		data: data,
		success : function( response ) {
			$('#shipping_company').val(response.data.address.event_name);
			$('#shipping_address_1').val(response.data.address.street);
			$('#shipping_city').val(response.data.address.city);
			$('#shipping_state').val(response.data.address.state);
			$('#shipping_postcode').val(response.data.address.zip);
// 			$(document.body).trigger('update_checkout');
          },
          fail : function( response ) {
            console.log(response.data.message);
          }
	});
});
