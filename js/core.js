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
/*
		$('.carousel').carousel({
		  interval: 1500
		});
*/
	});
})(jQuery);