( function( $ ) {
	
	$( document ).ready( function() {
		
		// Move coupon box from top of page to sidebar
		
		if ( $( 'body' ).hasClass( 'woocommerce-checkout' ) ) {
			
			var coupon = $( '#woocommerce-coupon-code' );
			
			coupon.insertAfter( '.shop_table.woocommerce-checkout-review-order-table' );
			
			coupon.removeClass( 'd-none' ); 
			
			$( '.checkout_coupon' ).addClass( 'd-block' );
			
		}
		
		$( '#search' ).on('click',( function( e ){
			
			$( '.form-group' ).addClass( 'sb-search-open' );
			$( '#search-text' ).show().focus();
			
			e.stopPropagation();			
			
		} ) );
		
		$( document ).on('click', function( e ) {
			
			if ( $( e.target ).is( '#search' ) === false ) {
			
				$( '.form-group' ).removeClass( 'sb-search-open' );
			
			}
	
		} );
		
    	// Functions for event selection modal
    	
		$( '#events' ).on( 'click', '.list-group-item', function() {

			$( this ).addClass( 'active' );
			$( '#ship_to_event' ).removeAttr( 'disabled' );
			$( '#event_name' ).val( $( this ).find( '.en' ).html() );
			$( '#event_shipping_address_1' ).val( $( this ).find( '.ea' ).html() );
			$( '#event_shipping_city' ).val( $( this ).find( '.ec' ).html() );
			$( '#event_shipping_state' ).val( $( this ).find( '.es' ).html() );
			$( '#event_shipping_postcode' ).val( $( this ).find( '.ez' ).html() );
		
		} );
		
		$( '#eventSelectModal' ).on( 'hidden.bs.modal', function () {
		
			$( '#ship_to_event' ).prop( 'disabled', true );
  
		});
    	    	
		// Reseller Fields
		
    	$( '#customer_login #resale_certificate_number_field' ).hide(); 
    	$( '#customer_login #resale_state_field' ).hide();
    	$( '#customer_login #resale_date_field' ).hide();
    	
    	$( '#customer_login #resale_account' ).change( function() {
    		
    		if ( $( this ).val() == 'yes' ) {
	    		
				$( '#customer_login #resale_certificate_number_field' ).show();
				$( '#customer_login #resale_state_field' ).show();
				$( '#customer_login #resale_date_field' ).show();
	    		
    		} else {

				$( '#customer_login #resale_certificate_number_field' ).hide();
				$( '#customer_login #resale_state_field' ).hide();
				$( '#customer_login #resale_date_field' ).hide();
	    		
    		}
    		
    	});
    	
    	// Rush Shipping Calendar
		var today = new Date();
		
		var tomorrow = new Date( today );
		
		tomorrow.setDate( tomorrow.getDate() + 1 );
		
		var todayBlackout = [ ( '0' + ( today.getMonth() + 1 ) ).slice( -2 ) + '-' + ( '0' + today.getDate() ).slice( -2 ) + '-' +  today.getFullYear() ];

		var tomorrowBlackout = [ ( '0' + ( tomorrow.getMonth() + 1 ) ).slice( -2 ) + '-' + ( '0' + tomorrow.getDate() ).slice( -2 ) + '-' +  tomorrow.getFullYear() ];

		var shipping_msg = '<div id="ui-datepicker-note" class="mt-1"><strong>Rush Shipping</strong><p class="mb-0">A Rush Order charge of $850 will now be applied to this order in addition to an expedited freight charge (freight charge will be invoiced separately after shipment), since shipments which need to arrive within 10 days of order put a lot of stress on Cooper\'s order fulfillment system. Yeah, we know it\'s A LOT and that sometimes "last minute" happens in racing. We\'re just letting you know that "last minute" costs a premium.</p></div>';
		
		// Format: 11-02-2020
		var blackoutDays = [ todayBlackout[0], tomorrowBlackout[0], '11-11-2022', '11-25-2022', '12-24-2022', '12-31-2022', '01-01-2023', '01-18-2023', '02-15-2023', '05-31-2023', '07-05-2023', '09-06-2023'];

		// Setup Rush Dates
		var rushDays = [ ( '1' + ( today.getMonth() + 1 ) ).slice( -2 ) + '-' + ( '0' + today.getDate() ).slice( -2 ) + '-' +  today.getFullYear() ];
		
		for ( var x = 0; x < 9; x++ ) { 
		
			var d = new Date( today.setDate( today.getDate() + 1 ) );
			
			var newDate = ( '0' + ( d.getMonth() + 1 ) ).slice( -2 ) + '-' + ( '0' + d.getDate() ).slice( -2 ) + '-' +  d.getFullYear();

			rushDays.push(newDate);
			
		}
		
		$( '#datepicker' ).datepicker( { 
			
			beforeShow: function() {	
						
				setTimeout( function() {
				
				  $( '#ui-datepicker-div' ).append( shipping_msg ); 
				
				}, 10);
			
			},
			
			beforeShowDay: function( date ) {
				
				// Check against blackout dates and holidays
				var current = $.datepicker.formatDate( 'mm-dd-yy', date );

 				if ( blackoutDays.indexOf(current) > -1 ) {
	 				
	 				return false;
	 				
 				}
 				 				
				if ( date.getDay() == 6 || date.getDay() == 0 ) {
	 				
	 				return false;
	 				
 				} else {
	 				
	 				return [true, $.inArray(current, rushDays) >= 0 ? 'ui-datepicker-rushdate':''];
 				
 				}
 	
			},
			firstDay: 0,
			minDate: 0,
			changeMonth: true,
			changeYear: true
		} );
	
    } );

    $( document ).on( 'change', 'input[name="payment_method"]', function() { 

		$( 'body' ).trigger( 'update_checkout' );
	
	} );
	
			
} )( jQuery );