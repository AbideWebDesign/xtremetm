$( '#ship-to-event-checkbox' ).click( function() {
	
	if ( $( this ).is( ':checked' ) ) {
		
		var checked = 'true';
		
		var event = $( 'select#ship_to_event_list' ).val();
		
		$( '#datepicker' ).val('');

	} else {
		
		var checked = 'false';
		
		var event = '';
		
		$( '#ship_to_event_list' ).val(0);
		$( '#ship_to_event_list' ).attr('placeholder', 'Select Event or Warehouse');
		$( '#shipping_company_field label' ).text('Company Name');
		$( '#shipping_company' ).val(''); 
		$( '#shipping_address_1' ).val('');
		$( '#shipping_address_2' ).val('');
		$( '#shipping_city' ).val('');
		$( '#shipping_state' ).val('');
		$( '#shipping_postcode' ).val('');
		$( '#shipping_company' ).removeAttr( 'readonly' );
		$( '#shipping_address_1' ).removeAttr( 'readonly' );
		$( '#shipping_address_2' ).removeAttr( 'readonly' );
		$( '#shipping_city' ).removeAttr( 'readonly' );
		$( '#shipping_state' ).removeAttr( 'readonly' );
		$( '#shipping_postcode' ).removeAttr( 'readonly' );
		$( '#datepicker' ).val('');
		
	}
	
	var data = {
		
		status: checked,
		event: event,
		action: 'set_event_session',
		security: ajax_object.ajax_nonce
	
	};
		
	$.ajax( {
	
		type: 'POST',
		url: ajax_object.ajax_url,
		data: data,
		success: function( response ) {
			
			if ( response.data.status == 'false' ) { // Checkbox has been unchecked	
	
				$( document.body ).trigger( 'update_checkout' );
				
			}
 			
        },
		fail: function( response ) {
	
			console.log( 'failure' );
	
		},
	
	} );	

} );

$( '#ship_to_event_list' ).change( function() {

	var id = $( this ).attr( 'id' );
	
	var data = {
		
		eventname: $( this ).val(),
		action: 'get_event_address',
		security: ajax_object.ajax_nonce

	};

	// Get event address
	$.ajax( {
		
		type: 'POST',
		url: ajax_object.ajax_url,
		data: data,
		success: function( response ) {
			
			$( '#shipping_company_field label' ).text('Event/Warehouse');
			$( '#shipping_company' ) .val( response.data.address.event_name );
			$( '#shipping_address_1' ).val( response.data.address.street );
			$( '#shipping_city' ).val( response.data.address.city );
			$( '#shipping_state' ).val( response.data.address.state );
			$( '#shipping_postcode' ).val( response.data.address.zip );
			$( '#shipping_company' ).attr( 'readonly','readonly' );
			$( '#shipping_address_1' ).attr( 'readonly','readonly' );
			$( '#shipping_address_2' ).attr( 'readonly','readonly' );
			$( '#shipping_city' ).attr( 'readonly','readonly' );
			$( '#shipping_state' ).attr( 'readonly','readonly' );
			$( '#shipping_postcode' ).attr( 'readonly','readonly' );
			$( document.body ).trigger( 'update_checkout' );
          
		},
		fail: function( response ) {
          
			console.log( response.data.message );
          
		}
	
	} );

} );

$( '#datepicker' ).change( function() {
	
	$('#place_order').prop( 'disabled', true );
	
	var rush_date = new Date(); 
	
	rush_date.setDate( rush_date.getDate() + 9 );
	
	var deliver_date = new Date( $( this ).val() );
	
	if ( rush_date > deliver_date ) {
		
		checked = 'true';
		
	} else {
		
		checked = 'false';
		
	}

	var data = {
		
		status: checked,
		action: 'set_rush_session',
		security: ajax_object.ajax_nonce

	};

	$.ajax( {
		
		type: 'POST',
		url: ajax_object.ajax_url,
		data: data,
		success: function( response ) {
			
			$( document.body ).trigger( 'update_checkout' );
			
			$('#place_order').prop( 'disabled', false );
						
		},
		fail: function( response ) {
			
			console.log( 'failure' );
		
		},
		
	} );		
	
} );

$( '#shipping_postcode' ).change( function() {
	
	var shipping_zip = $( this ).val();

	var data = {
		
		zip: shipping_zip,
		action: 'check_for_event',
		security: ajax_object.ajax_nonce
	
	};
	
	$.ajax( {
		
		type: 'POST',
		url: ajax_object.ajax_url,
		data: data,
		success: function( response ) {
			
			if ( response.success ) {

				var event_details = '';
	
				$.each( response.data.events, function ( key, value ) {
	
					event_details += '<button type="button" class="list-group-item list-group-item-action" data-toggle="list"><span class="en">' + value.event_name + '</span><br><span class="ea">' + value.street + '</span><br><span class="ec">' + value.city + '</span>, <span class="es">' + value.state + '</span> <span class="ez">' + value.zip + '</span> <span class="badge badge-primary badge-pill"></span></button>';
					
				} );
				
				$( '#events' ).html( event_details );
				$( '#eventSelectModal' ).modal( 'show' );
				
			}
        
        },
		fail: function( response ) {
			
			console.log( 'failure' );
		
		},
	
	} );	
	
} );

/**
 * Ajax function to set event shipping details and session when Ship to Event is clicked from modal
 */ 
$( '#ship_to_event' ).click( function() {
			
	var data = {
	
		status: 'true',
		event: $( '#event_name' ).val(),
		action: 'set_event_session',
		security: ajax_object.ajax_nonce
	
	};
	
	$.ajax( {
		
		type: 'POST',
		url: ajax_object.ajax_url,
		data: data,
		success: function( response ) {
			
			$( '#eventSelectModal' ).modal( 'hide' )
			$( '#shipping_company').val( $( '#event_name' ).val() );
			$( '#shipping_address_1' ).val( $( '#event_shipping_address_1' ).val() );
			$( '#shipping_city' ).val( $( '#event_shipping_city' ).val() );
			$( '#shipping_state' ).val( $( '#event_shipping_state' ).val() );
			$( '#shipping_postcode' ).val( $( '#event_shipping_postcode' ).val() );	
			$( '#ship_to_event_list' ).val( $( '#event_name' ).val() );
			$( '#ship-to-event-checkbox' ).prop( 'checked', true );
			$( '#ship-to-event' ).show();
			$( document.body ).trigger( 'update_checkout' );
			
		},
		fail: function( response ) {
			
			console.log( 'failure' );
		
		},
		
	} );
	
} );