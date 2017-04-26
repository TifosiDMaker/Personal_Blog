window.onload = function() {
	window.confirmIt = function (link) {
		bootbox.confirm("确定删除此条目吗？", function(result) {
			if (result) {window.location = link};
		});
	};
}
$(document).ready(function() {
	$("td").on('click', 'a.blue_link', function() {
		event.preventDefault();
		$('.edit_form').hide();
		$(this).parent().parent().next('.edit_form').show();
	});

	$('form').on('click', 'button.cancle_button', function() {
		event.preventDefault();
		$('.edit_form').hide();
	});
});
