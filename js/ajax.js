$( '#ship-to-event-checkbox' ).click( function(){

	if ( $( this ).is(":checked")) {
		
		var checked = 'true';
		var event = $( "select#ship_to_event_list" ).val();

	} else {
		
		var checked = 'false';
		var event = '';
		
	}
	
	var data = {
		status: checked,
		event: event,
		action: 'set_event_session',
		security: ajax_object.ajax_nonce
	};
		
	$.ajax({
		type: 'POST',
		url: ajax_object.ajax_url,
		data: data,
		success : function( response ) {
			$(document.body).trigger('update_checkout');
        },
		fail : function( response ) {
			console.log( 'failure' );
		},
	} );	
} );

$( '#ship_to_event_list' ).change( function(){

	var id = $( this ).attr('id');
	
	var data = {
		eventname: $( this ).val(),
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
			$(document.body).trigger('update_checkout');
          },
          fail : function( response ) {
            console.log(response.data.message);
          }
	} );
} );
