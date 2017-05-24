$(document).ready(function() {
	$('tr').on({
		mouseenter: function() {
			$(this).find('.hover_display').show();
		},
		mouseleave: function() {
			$(this).find('.hover_display').hide();
		}
	});
    $('.hide1, .except1').on({
        mouseenter: function() {
            $('.hide1').show();
        },
        mouseleave: function() {
            $('.hide1').hide();
        }
    });
    $('.hide2, .except2').on({
        mouseenter: function() {
            $('.hide2').show();
        },
        mouseleave: function() {
            $('.hide2').hide();
        }
    });
    $('#changePassword').validate({
        debug: true,
});
