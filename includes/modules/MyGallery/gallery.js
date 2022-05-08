(function($) {
   $(document).ready(function(){
	   $('.my-gallery > li > img').click(function () {
		   $('.my-gallery-overlay').fadeIn('slow');
		   $('.my-gallery-overlay > img').attr('src', $(this).attr('src'));
	   });

	   $('.my-gallery-overlay').click(function () {
		   $(this).fadeOut('slow');
	   });
   });
})(jQuery);