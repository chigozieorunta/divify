(function($) {
	
})(jQuery);

(function($) {
   $(document).ready(function(){
	   $('.my-gallery > li > img').click(function () {
		   console.log('Oh when the saints...');
		   alert('DOM is ready');
	   });
   });
})(jQuery);