$( '#ship-to-event-checkbox' ).click( function() {
	
	$( this ).attr( 'disabled', true );
	
	if ( $( this ).is( ':checked' ) ) {
		
		var checked = 'true';
		
		var event = $( 'select#ship_to_event_list' ).val();
		
		$( '#datepicker' ).val( '' );

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
		populateStates();
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
			
			$( '#ship-to-event-checkbox' ).removeAttr('disabled', 'disabled');
			
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
			
			var $shipping_state = $( '#shipping_state' );
            var $shipping_state_option = $( '#shipping_state option[value="' + response.data.address.state + '"]' );
            var $shipping_state_option_no = $( '#shipping_state option[value!="' + response.data.address.state + '"]' );
            $shipping_state_option_no.remove();
            
            if ( $shipping_state_option.length != 0 ) {
	        
				$shipping_state_option.attr('selected', true);
            
            } else {

	            $shipping_state.append( $( '<option>', {
				    value: response.data.address.state,
				    text: response.data.address.state_name
				} ) );
	            
            }

			$( '#shipping_company_field label' ).text( 'Event/Warehouse' );
			$( '#shipping_company' ).val( response.data.address.event_name );
			$( '#shipping_address_1' ).val( response.data.address.street );
			$( '#shipping_city' ).val( response.data.address.city );
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

function populateStates() {
    
    var obj = ({"Data":{"Alabama":"AL","Alaska":"AK","Arizona":"AZ","Arkansas":"AR","California":"CA","Colorado":"CO",
	    "Connecticutt":"CT","Delaware":"DE","Florida":"FL","Georgia":"GA","Hawaii":"HI","Idaho":"ID","Illinois":"IL",
	    "Indiana":"IN","Iowa":"IA","Kansas":"KS","Kentucky":"KY","Louisiana":"LA","Maine":"ME","Massachusetts":"MA",
	    "Michigan":"MI","Minnesota":"MN","Mississippi":"MS","Missouri":"MO","Montana":"MT","Nebraska":"NE","Nevada":"NV",
	    "New Hampshire":"NH","New Jersey":"NJ","New Mexico":"NM","New York":"NY","North Carolina":"NC","North Dakota":"ND",
	    "Ohio":"OH","Oklahoma":"OK","Oregon":"OR","Pennsylvania":"PA","Rhode Island":"RI","South Carolina":"SC",
	    "South Dakota":"SD","Tennessee":"TN","Texas":"TX","Utah":"UT","Vermont":"VT","Virginia":"VA","Washington":"WA","West Virginia":"WV","Wisconsin":"WI","Wyoming":"WY","Virgin Islands":"V.I.","Guam":"GU","Puerto Rico":"PR","Ontario":"ON"}});
    
    var s = document.getElementById('shipping_state');
    
    var i = 0;
    
    for ( var propertyName in obj.Data ) {
        
    	s.options[i++] = new Option( propertyName, obj.Data[propertyName], true, false );
	
	}

}