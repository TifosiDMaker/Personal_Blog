$(document).ready(function() {
	$('tr').on({
		mouseenter: function() {
			$(this).find('p').show();
		},
		mouseleave: function() {
			$(this).find('p').hide();
		}
	});
});
