( function($) {
	
	$( document ).ready(function(){
		
		$( '#resale_certficiate_number_field' ).hide();
		$( '#resale_state_field' ).hide();
		$( '#resale_date_field' ).hide();
		
		$( '#search' ).on('click',( function(e){
			
			$('.form-group').addClass('sb-search-open');
			$('#search-text').show();
			e.stopPropagation();			
			
		} ) );
			
		$( document ).on('click', function(e) {
			
			if ( $(e.target).is('#search') === false ) {
			
				$('.form-group').removeClass('sb-search-open');
			
			}
	
		} );
				
		$( '#ship-to-event-checkbox' ).click( function(e) {
	        
	        if ( $(this).is(':checked') ) {
		    
		        $('#ship-to-event').slideDown('fast');
		        $('.shipping_address .address-field').hide();
		        $('.shipping_address #shipping_company_field').hide();
	        
	        } else {
		    
		        $('#ship-to-event').slideUp('fast');
		        $('.shipping_address .address-field').show();
		        $('.shipping_address #shipping_company_field').show();
	        
	        }
    	
    	} );
    	
    	$( '#reseller_account' ).change( function() {
    		
    		if ( $(this).val() == 'yes' ) {
	    		
				$( '#resale_certficiate_number_field' ).show();
				$( '#resale_state_field' ).show();
				$( '#resale_date_field' ).show();
	    		
    		} else {

				$( '#resale_certficiate_number_field' ).hide();
				$( '#resale_state_field' ).hide();
				$( '#resale_date_field' ).hide();
	    		
    		}
    		
    	});
    
    } );
    
    $( document.body ).on( 'change', "input[name='payment_method']", function() {
	    
		$( 'body' ).trigger( 'update_checkout' );
	
	} );
		
} )( jQuery );