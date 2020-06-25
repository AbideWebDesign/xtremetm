( function($) {
	
	$( document ).ready( function() {
		
		// Move coupon box from top of page to sidebar
		
		if ( $('body').hasClass('woocommerce-checkout') ) {
			
			var coupon = $('#woocommerce-coupon-code');
			coupon.insertAfter('.shop_table.woocommerce-checkout-review-order-table');
			coupon.removeClass('d-none'); 
			$('.checkout_coupon').addClass('d-block');
		}


		// Change brand images
		
		if ( $('body').hasClass('store-rehv') ) {
			
			$('.menu-rehv img').attr('src', 'https://xtremetm.net/wp-content/uploads/2019/09/menu-rehv-dark.png');
			$('.menu-rehv img').attr('class', 'd-inline-block ubermenu-image ubermenu-image-size-full');
			
		} 
		
		$( '#search' ).on('click',( function(e){
			
			$('.form-group').addClass('sb-search-open');
			$('#search-text').show().focus();
			
			e.stopPropagation();			
			
		} ) );
			
		$( document ).on('click', function(e) {
			
			if ( $(e.target).is('#search') === false ) {
			
				$('.form-group').removeClass('sb-search-open');
			
			}
	
		} );
		
		// Checkout/Cart Fields
		    	
		$( '#ship-to-event-checkbox' ).click( function(e) {
	        
	        if ( $(this).is( ':checked' ) ) {
		    
		        $( '#ship-to-event' ).slideDown( 'fast' );
		        $( '.shipping_address #shipping_company_field' ).hide();
		        $( '.shipping_address .address-field' ).hide();
		        $( '#shipping_phone_field' ).hide();
		        
	        } else {
		    
		        $( '#ship-to-event' ).slideUp( 'fast' );
		        $( '#shipping_country_field' ).hide();
		        $( '.shipping_address #shipping_company_field' ).show();
		        $( '.shipping_address .address-field' ).show();
		        $( '#shipping_phone_field' ).show();
		        
	        }
    	
    	} );
    	
    	$( '#ship-rush-checkbox' ).click( function() {
	        
	        if ( $( this ).is( ':checked' ) ) {
		    
		        $( '#ship-date-wrap' ).slideDown( 'fast' );
		        	        
	        } else {
		    
		        $( '#ship-date-wrap' ).slideUp( 'fast' );

	        }
	        	            	
    	} );
    	
    	
    	// Functions for event selection modal
    	
		$( '#events' ).on('click', '.list-group-item', function(){

			$( this ).addClass( 'active' );
			$( '#ship_to_event' ).removeAttr( 'disabled' );
			$( '#event_name' ).val( $( this ).find( '.en' ).html() );
			$( '#event_shipping_address_1' ).val( $( this ).find( '.ea' ).html() );
			$( '#event_shipping_city' ).val( $( this ).find( '.ec' ).html() );
			$( '#event_shipping_state' ).val( $( this ).find( '.es' ).html() );
			$( '#event_shipping_postcode' ).val( $( this ).find( '.ez' ).html() );
		
		} );
		
		$( '#eventSelectModal' ).on( 'hidden.bs.modal', function (e) {
		
			$( '#ship_to_event' ).prop('disabled', true);
  
		});
    	
    	// Add select2 to delivery date select
    	
    	$('#delivery_date').select2( { width: 300 } );

		// Reseller Fields
		
    	$( '#customer_login #resale_certificate_number_field' ).hide(); 
    	$( '#customer_login #resale_state_field' ).hide();
    	$( '#customer_login #resale_date_field' ).hide();
    	
    	$( '#customer_login #resale_account' ).change( function() {
    		
    		if ( $(this).val() == 'yes' ) {
	    		
				$( '#customer_login #resale_certificate_number_field' ).show();
				$( '#customer_login #resale_state_field' ).show();
				$( '#customer_login #resale_date_field' ).show();
	    		
    		} else {

				$( '#customer_login #resale_certificate_number_field' ).hide();
				$( '#customer_login #resale_state_field' ).hide();
				$( '#customer_login #resale_date_field' ).hide();
	    		
    		}
    		
    	});

    } );
    
    $( document.body ).on( 'change', "input[name='payment_method']", function() {
	    
		$( 'body' ).trigger( 'update_checkout' );
	
	} );
				
} )( jQuery );