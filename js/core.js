(function($) {
	$(document).ready(function(){
		$('#search').on("click",(function(e){
			$(".form-group").addClass("sb-search-open");
			$("#search-text").show();
			e.stopPropagation();
		}));
			
		$(document).on("click", function(e) {
			if ($(e.target).is("#search") === false) {
				$(".form-group").removeClass("sb-search-open");
			}
		});
		
		$('#ship-to-event-list').select2();
		
		$("#ship-to-event-checkbox").click(function (e) {
	        if ($(this).is(':checked')) {
		        $('#ship-to-event').slideDown('fast');
	        } else {
		        $('#ship-to-event').slideUp('fast');
	        }
    	});
	});
})(jQuery);