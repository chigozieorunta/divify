(function($) {
	
})(jQuery);

(function($) {
   $(document).ready(function(){
	   $('.my-gallery > li > img').click(function () {
		   $('.my-gallery-overlay').fadeIn('slow');
	   });
   });
})(jQuery);