window.onload = function() {
	window.confirmIt = function (link) {
		bootbox.confirm("确定删除此条目吗？", function(result) {
			if (result) {window.location = link};
		});
	};
}
$(document).ready(function() {
	$("td").on('click', 'a.blue_link', function() {
		alert("Hello!");
		$(this).parent().parent().append("I'm here!");	
	});
});
