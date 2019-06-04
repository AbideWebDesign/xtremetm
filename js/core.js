( function($) {
	
	$( document ).ready(function(){
		
		$( '#search' ).on("click",( function(e){
			
			$(".form-group").addClass("sb-search-open");
			$("#search-text").show();
			e.stopPropagation();			
			
		} ) );
			
		$( document ).on("click", function(e) {
			
			if ( $(e.target).is("#search") === false ) {
			
				$(".form-group").removeClass("sb-search-open");
			
			}
	
		} );
				
		$( "#ship-to-event-checkbox" ).click( function(e) {
	        
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
    
    } );
    
    $( document.body ).on( 'change', 'input[name="payment_method"]', function() {
	    
		$( 'body' ).trigger( 'update_checkout' );
	
	} );
		
} )( jQuery );