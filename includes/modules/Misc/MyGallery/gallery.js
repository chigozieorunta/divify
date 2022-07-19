(function($) {
	$(document).ready(function () {
		const images = [];

		$('.my-gallery > li > img').each(function () {
			images.push($(this).attr('src'));
		});

		$('.my-gallery > li > img').click(function () {
			$('.my-gallery-overlay').fadeIn('slow');
			$('.my-gallery-overlay').css('display', 'flex');
			$('.my-gallery-overlay > img').attr('src', $(this).attr('src'));
		});

		$('.my-gallery-overlay > span').click(function () {
			let counter = parseInt(images.indexOf($('.my-gallery-overlay > img').attr('src')));
			counter = $(this).text() === '>' ? counter + 1 : counter - 1;
			$('.my-gallery-overlay > img').attr('src', images[counter]);
		});

		$('.my-gallery-close-btn').click(function () {
			$('.my-gallery-overlay').fadeOut('slow');
		});
   });
})(jQuery);