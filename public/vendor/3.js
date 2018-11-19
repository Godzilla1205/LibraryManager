$( document ).ready(function() {
	$('.leftmenutrigger').on('click', function(e) {
		$('div#wrapper').toggleClass("closeSide");
		e.preventDefault();
	});
});
